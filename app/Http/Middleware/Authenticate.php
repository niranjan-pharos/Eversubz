<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        Log::debug('Authenticate middleware: Checking authentication', [
            'path' => $request->path(),
            'auth_check' => auth()->check(),
            'user_id' => auth()->check() ? auth()->user()->id : null,
            'session_id' => $request->session()->getId(),
        ]);

        if (!$request->expectsJson()) {
            $middleware = $request->route()->middleware() ?: [];
            $isAdminGuard = in_array('auth:admin', $middleware);
            $loginRoute = $isAdminGuard ? route('adminLogin') : route('user.login');

            // Block suspicious paths from setting intended URL
            if (!preg_match('/\.(php|php7)$/i', $request->path())) {
                $request->session()->put('url.intended', $request->fullUrl());
            }

            Log::info('Authenticate middleware: Redirecting to', [
                'login_route' => $loginRoute,
                'guard' => $isAdminGuard ? 'admin' : 'web',
                'intended_url' => $request->session()->get('url.intended'),
                'session_id' => $request->session()->getId(),
            ]);

            return $loginRoute;
        }

        return null;
    }
}