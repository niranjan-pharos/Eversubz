<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class CustomEmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            return redirect()->route('verification.expired');
        }

        $request->fulfill();
        return redirect()->route('dashboard')->with('message', 'Email verified successfully');
    }
}