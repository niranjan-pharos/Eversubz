<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictCreateShowAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $action = $request->route()->getActionMethod();

        // Check if the action is 'create' or 'show'
        if ($action == 'create' || $action == 'show') {
            return redirect()->route('admin.category.index');
        }

        return $next($request);
    }
}
