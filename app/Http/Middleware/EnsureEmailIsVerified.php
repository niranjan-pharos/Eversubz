<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        Log::debug('EnsureEmailIsVerified middleware', [
            'path' => $request->path(),
            'route_name' => $request->route() ? $request->route()->getName() : null,
            'user_id' => auth()->check() ? auth()->user()->id : null,
            'has_verified_email' => auth()->check() ? auth()->user()->hasVerifiedEmail() : false,
            'session_id' => $request->session()->getId(),
        ]);

        // Skip verification for verification-related routes
        $allowedRoutes = ['verification.notice', 'verification.send', 'verification.verify'];
        if ($request->route() && in_array($request->route()->getName(), $allowedRoutes)) {
            Log::debug('EnsureEmailIsVerified: Skipping verification check for allowed route', [
                'route_name' => $request->route()->getName(),
            ]);
            return $next($request);
        }

        return $next($request);
    }
}