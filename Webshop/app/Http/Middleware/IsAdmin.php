<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve és admin-e
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Ha nem admin, visszairányítás a főoldalra egy hibaüzenettel
        return redirect('/')->with('error', 'Nincs jogosultságod az admin oldalhoz!');
    }
}
