<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::check()) {
            if(Auth::user()->role == 1) {
                return redirect()->route('dashboard');
            }else {
                return view('pages.user.home');
            }
        } else {
            return view('pages.user.home');
        }
    }
}
