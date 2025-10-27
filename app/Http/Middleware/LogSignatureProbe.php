<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogSignatureProbe
{
    public function handle(Request $request, Closure $next)
    {
        $valid = $request->hasValidSignature();
        
        Log::info('Email verification attempt', [
            'valid_signature' => $valid,
            'user_id' => $request->user()?->id,
            'route_id' => $request->route('id'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()
        ]);

        if (!$valid) {
            Log::warning('Invalid signature detected', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            abort(403, 'Invalid or expired signature.');
        }

        return $next($request);
    }

}
