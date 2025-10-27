<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\BlockSuspiciousRequests::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\MinifyHtml::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':100,1',
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth:admin' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'auth.user' => \App\Http\Middleware\RedirectIfNotUserAuthenticated::class,
        'log.incoming' => \App\Http\Middleware\LogIncomingRequest::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        'check.business.product.creation' => \App\Http\Middleware\CheckBusinessProductCreation::class,
        'no.cache' => \App\Http\Middleware\PreventCacheForCertainRoutes::class,
        'account.type' => \App\Http\Middleware\AccountTypeMiddleware::class,
        'admin.approved' => \App\Http\Middleware\CheckAdminApproval::class,
        'signed.lenient' => \App\Http\Middleware\ValidateSignatureLenient::class,
        'signed.flex' => \App\Http\Middleware\ValidateSignatureFlexible::class,
        'probe' => \App\Http\Middleware\LogSignatureProbe::class
    ];

    
}
