<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Models\Interest;
use App\Models\Language;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::contactsOnly()
            ->select('language_id','id','name','surname','mobile_number','email', 'created_at')
            ->with(['interests','language'])
            ->paginate(5);

         return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        Gate::allowIf(auth()->user()->is_admin);
        $languages = Language::select('name', 'id')->get();
        $interests = Interest::select('name', 'id')->get();
        return view('users.create', compact('languages', 'interests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserFormRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserFormRequest $request): RedirectResponse
    {
        Gate::allowIf(auth()->user()->is_admin);
        $interests = $request->only('interests');

        $user = User::create(array_merge(['password' => bcrypt(random_bytes(12))], $request->validated()));

        $user->interests()->attach($interests['interests']);

        $request->session()->flash('status', 'Kontak Details Saved!');

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user): View
    {
        Gate::allowIf(auth()->user()->is_admin || auth()->id() == $user->id);
        $languages = Language::select('name', 'id')->get();
        $interests = Interest::select('name', 'id')->get();
        return view('users.edit', compact('user', 'languages', 'interests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserFormRequest $request, User $user): RedirectResponse
    {
        Gate::allowIf(auth()->user()->is_admin || auth()->id() == $user->id);
        $interests = $request->only('interests');

        $user->update(array_merge($request->validated()));

        $user->interests()->sync($interests['interests']);

        $request->session()->flash('status', 'Kontak changes updated successully!');

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        Gate::allowIf(auth()->user()->is_admin || auth()->id() == $user->id);
        $user->delete();
        session()->flash('status', 'Kontak Deleted Successfully!');
        return redirect()->route('dashboard');
    }
}
