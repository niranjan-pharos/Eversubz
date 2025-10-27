<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSignatureLenient
{
    public function handle(Request $request, Closure $next)
    {
        $ignore = ['t','utm_source','utm_medium','utm_campaign','utm_term','utm_content','mc_eid','mc_cid'];

        if (! $request->hasValidSignatureWhileIgnoring($ignore)) {
            abort(401, 'Invalid signature.');
        }

        return $next($request);
    }
}
