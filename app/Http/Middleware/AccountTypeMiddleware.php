<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountTypeMiddleware
{
    public function handle(Request $request, Closure $next, $accountType)
    {
        Log::debug('AccountTypeMiddleware', [
            'path' => $request->path(),
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'expected_type' => $accountType,
            'actual_type' => Auth::check() ? Auth::user()->account_type : null,
        ]);

        if ($request->routeIs('verification.notice') || $request->routeIs('verification.send') || $request->routeIs('profile') || $request->routeIs('profile.edit') || $request->routeIs('profile.update') || $request->routeIs('profile.destroy')) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('user.login')->withErrors(['error' => 'You need to log in first.']);
        }

        $user = Auth::user();
        if ($user->account_type != $accountType) {
            Log::warning('Middleware blocked request: Invalid account type.', [
                'expected' => $accountType,
                'actual' => $user->account_type,
            ]);
            return redirect()->route('profile')->withErrors(['error' => 'Access denied.']);
        }

        return $next($request);
    }
}