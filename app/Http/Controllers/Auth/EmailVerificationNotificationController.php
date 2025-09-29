<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::debug('EmailVerificationNotificationController@store called', [
            'csrf_token' => $request->input('_token'),
            'session_token' => $request->session()->token(),
            'user_id' => $request->user() ? $request->user()->id : null,
            'all_input' => $request->all(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
        ]);
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();
        session()->flash('status', 'verification-link-sent'); // Explicitly flash the session
        
        return back()->with('status', 'verification-link-sent');
    }
}
