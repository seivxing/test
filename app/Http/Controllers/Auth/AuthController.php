<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
class AuthController extends Controller
{
    // public function register(){
    //     return view('auth.register');
    // }

    // public function register_submit(Request $request){

    //     $request->validate([
    //         'name' => 'required|max:50',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|max:16',
    //         'retype_password' => 'required|same:password',
    //         'g-recaptcha-response' => 'required|captcha',
    //     ]);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);

    //     $user->save();

    //    return redirect('login');

    // }

    public function login(){
        return view('auth.login');
    }

    public function login_submit(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        $maxAttempts = 3; // maximum attempts before lockout
        $decayMinutes = 20; // time to wait before retrying

        // key for rate limiting (typically based on IP and login username)
        $key = $request->ip();

        // check if the user is currently locked out
        if (RateLimiter::tooManyAttempts($key, $maxAttempts-1)) {
            $lockoutDuration = RateLimiter::availableIn($key);
            return redirect()->back()
                ->with('error', 'Too many login attempts. Please try again in ' . $lockoutDuration . ' seconds.');
        }

        // attempt authentication only if the user is not currently locked out
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // clear the rate limiter on successful login
            RateLimiter::clear($key);
            $user = Auth::user();
            if (Auth::user()->role == 1) {
                return view('pages.admin.dashboard');

            } elseif (Auth::user()->role == 2) {
                return view('pages.admin.dashboard');
            } elseif (Auth::user()->role == 0) {
                return redirect()->route('home')->with('success', 'Welcome, ' . $user->name . '!');
            } else {
                return redirect()->back()->with('error', 'Account role not allowed.');
            }
        } else {
            // increment the rate limiter counter on failed login
            RateLimiter::hit($key, $decayMinutes);
            return redirect()->back()->with('error', 'Invalid email and password.');
        }


    }

    public function logout()
    {

        Auth::logout();

        return redirect()->route('home');
    }

}
