<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Additional security checks
        if (!$request->user()) {
            abort(401, 'Unauthorized');
        }

        // Verify the user ID matches the authenticated user
        if ($request->user()->id != $request->route('id')) {
            abort(403, 'Forbidden');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        $request->fulfill();
        
        Log::info('Email verified successfully', [
            'user_id' => $request->user()->id,
            'verified_at' => now()
        ]);
        
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}