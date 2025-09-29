<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            \Log::debug('Admin Middleware: Not Authenticated');
            Auth::guard('web')->logout();
            return redirect()->route('adminLogin')->with('error', 'Please log in with an admin account.');
        }
        return $next($request);
    }
}
