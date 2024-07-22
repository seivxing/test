<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class NavbarName extends Component
{
    public $userName;
    public function mount(){
        $user = Auth::user();
        $this->userName = $user->name;
    }
    public function render()
    {
        return view('livewire.navbar-name');
    }
}
