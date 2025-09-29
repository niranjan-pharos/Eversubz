<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class CustomPasswordReset extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        // Generate the reset URL
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Calculate the expiration time (default is 60 minutes)
        $expiration = Carbon::now()->addMinutes(config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60));

        return (new MailMessage)
            ->view('vendor.mail.html.message', [
                'url' => $url,
                'expiration' => $expiration, // Pass the expiration variable
            ])
            ->subject(__('Reset Password'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), $url)
            ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}