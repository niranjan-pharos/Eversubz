<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::debug('EmailVerificationPromptController: Accessing /verify-email', [
            'user_id' => $request->user() ? $request->user()->id : null,
            'has_verified_email' => $request->user() ? $request->user()->hasVerifiedEmail() : false,
            'intended_url' => $request->session()->get('url.intended'),
            'session_id' => $request->session()->getId(),
        ]);

        if (!$request->user()) {
            Log::warning('EmailVerificationPromptController: No authenticated user', [
                'path' => $request->path(),
                'session_id' => $request->session()->getId(),
            ]);
            return redirect()->route('user.login');
        }

        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.verify-email');
    }
}
