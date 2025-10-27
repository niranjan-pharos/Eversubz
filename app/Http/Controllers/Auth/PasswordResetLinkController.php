<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Notifications\CustomPasswordReset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $user->notify(new \App\Notifications\CustomPasswordReset($token));
            }
        );



        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status === Password::RESET_LINK_SENT ? __($status) : null,
                'errors' => $status !== Password::RESET_LINK_SENT ? ['email' => __($status)] : null,
            ]);
        }

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('password.request')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

}
