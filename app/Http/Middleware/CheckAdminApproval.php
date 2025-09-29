<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminApproval
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail() && Auth::user()->is_admin_approved != 1) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
