<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUserAuthenticated
{
    public function handle($request, Closure $next, $guard = 'web')
    {
        
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('user.login')->with('error', 'Please login first.');
        }

        return $next($request);
    }
}
