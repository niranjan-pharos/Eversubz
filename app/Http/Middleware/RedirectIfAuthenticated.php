<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        Log::debug('RedirectIfAuthenticated: Starting middleware', [
            'guards' => $guards,
            'request_path' => $request->path(),
            'session_started' => $request->session()->isStarted(),
            'intended_url' => session('url.intended'),
        ]);

        // Log session details for debugging
        Log::debug('Session Data', ['session' => session()->all()]);

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            Log::debug('RedirectIfAuthenticated: Checking guard', [
                'guard' => $guard ?: 'web',
                'is_authenticated' => Auth::guard($guard)->check(),
                'user_id' => Auth::guard($guard)->id(),
            ]);

            // Check if the user is authenticated and the session is active
            if (Auth::guard($guard)->check() && $request->session()->isStarted()) {
                // Clear intended URL early
                $intendedUrl = session('url.intended', RouteServiceProvider::HOME);
                $request->session()->forget('url.intended');

                Log::info('RedirectIfAuthenticated: Authenticated and session active, preparing redirect', [
                    'guard' => $guard ?: 'web',
                    'intended_url' => $intendedUrl,
                    'default_url' => RouteServiceProvider::HOME,
                    'user_id' => Auth::guard($guard)->id(),
                ]);

                // If the user is already on the verification page, prevent any further redirects
                if ($request->routeIs('verification.notice')) {
                    Log::info('RedirectIfAuthenticated: User is already on verification page, skipping redirect', [
                        'user_id' => Auth::guard($guard)->id(),
                    ]);
                    return $next($request); // Let the user stay on the verification page
                }

                $user = Auth::guard($guard)->user();

                // If user has not verified email, redirect to the verification page
                if (!$user->hasVerifiedEmail()) {
                    Log::info('RedirectIfAuthenticated: User not verified, redirecting to verification page', [
                        'user_id' => $user->id,
                    ]);
                    return redirect()->route('verification.notice'); // Redirect to the verification page
                }

                // After verification, handle redirection (user is verified)
                if ($guard === 'admin') {
                    Log::debug('RedirectIfAuthenticated: Redirecting to admin dashboard', ['url' => '/admin/dashboard']);
                    return redirect('/admin/dashboard');
                } elseif ($guard === null || $guard === 'web') {
                    Log::info('RedirectIfAuthenticated: Redirecting for web guard', [
                        'redirect_url' => $intendedUrl,
                        'intended_url' => $intendedUrl,
                        'home_url' => RouteServiceProvider::HOME,
                    ]);
                    return redirect($intendedUrl); // Redirect to intended URL or home
                } else {
                    Log::debug('RedirectIfAuthenticated: Redirecting to root', ['url' => '/']);
                    return redirect('/'); // Default fallback
                }
            }
        }

        Log::debug('RedirectIfAuthenticated: No redirect needed, proceeding to next middleware', [
            'guards_checked' => $guards,
            'request_path' => $request->path(),
        ]);

        return $next($request); // Proceed to next middleware if no redirect needed
    }
}














