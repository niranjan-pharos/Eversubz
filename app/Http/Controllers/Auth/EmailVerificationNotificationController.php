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
        session()->flash('status', 'verification-link-sent');
        
        return back()->with('status', 'verification-link-sent');
    }

    public function storeAjaxSubmission(Request $request)
    {
        \Log::debug('EmailVerificationNotificationController@storeAjaxSubmission called', [
            'csrf_token' => $request->input('_token'),
            'session_token' => $request->session()->token(),
            'user_id' => $request->user() ? $request->user()->id : null,
            'all_input' => $request->all(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'is_ajax' => $request->ajax(),
        ]);

        // Check if user email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email already verified. Redirecting...',
                    'redirect' => RouteServiceProvider::HOME
                ]);
            }
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        try {
            // Send verification email
            $request->user()->sendEmailVerificationNotification();
            
            // Flash session for non-AJAX requests
            session()->flash('status', 'verification-link-sent');
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Verification email sent successfully! Please check your inbox.',
                    'status' => 'verification-link-sent'
                ]);
            }
            
            return back()->with('status', 'verification-link-sent');
            
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send verification email. Please try again.'
                ], 500);
            }
            
            return back()->with('error', 'Failed to send verification email. Please try again.');
        }
    }



}
