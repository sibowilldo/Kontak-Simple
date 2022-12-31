<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class KontakTable extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.kontak-table', [
            'users' =>  User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%')
                ->contactsOnly()
                ->select('language_id','id','name','surname','mobile_number','email', 'created_at')
                ->with(['interests','language'])
                ->paginate(5)
            ]);
    }
}
