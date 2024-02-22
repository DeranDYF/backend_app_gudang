<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeeperMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role->role_name === 'admin' or Auth::user()->role->role_name === 'keeper')) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
