<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function dashboard(): View
    {
        $users = User::contactsOnly()
            ->select('language_id','id','name','surname','za_id_number','mobile_number','email', 'created_at')
            ->with(['interests','language'])
            ->paginate(5);

        return view('dashboard', compact('users'));
    }
}
