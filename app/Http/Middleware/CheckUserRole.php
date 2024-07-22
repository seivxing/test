<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            foreach ($roles as $role) {
                if ($userRole == $role) {
                    return $next($request);
                }
            }
        }
        return abort(404); // Redirect to "Not Found" page
    }
}
