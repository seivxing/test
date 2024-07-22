<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavbarComponent extends Component
{
    public $userName;

    public function mount()
    {
        $user = Auth::user();
        $this->userName = $user->role;
    }
    public function render(){


        return view('livewire.navbar-component');
    }
}
