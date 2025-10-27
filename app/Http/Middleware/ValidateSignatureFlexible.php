<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ValidateSignature;

class ValidateSignatureFlexible
{
    public function handle(Request $request, Closure $next)
    {
        // Add/remove params your ESP/CDN appends
        $ignore = ['t','utm_source','utm_medium','utm_campaign','utm_term','utm_content','mc_eid','mc_cid'];

        // 1) Try strict (absolute) while ignoring known params
        if (method_exists($request, 'hasValidSignatureWhileIgnoring')
            && $request->hasValidSignatureWhileIgnoring($ignore)) {
            return $next($request);
        }

        // 2) Try relative (ignores host & scheme) with the same ignores
        $validator = new ValidateSignature();

        // Laravel 10/11/12: hasValidSignature($request, $absolute = true, $ignoreQuery = [])
        if (method_exists($validator, 'hasValidSignature')
            && $validator->hasValidSignature($request, false, $ignore)) {
            return $next($request);
        }

        abort(401, 'Invalid signature.');
    }
}
