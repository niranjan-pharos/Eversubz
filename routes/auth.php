<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CustomEmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'register'])->name('register');
    Route::get('login', [AuthenticatedSessionController::class, 'userlogin'])->name('user.login');
    Route::post('login-process', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    // 1. Show “Resend Verification” notice
    Route::get('verify-email', EmailVerificationPromptController::class)
         ->name('verification.notice');

    // 2. Handle verification link click
    Route::get('email/verify/{id}/{hash}', 
        [VerifyEmailController::class, '__invoke']
    )->middleware(['signed','throttle:6,1'])
     ->name('verification.verify');

    // 3. Resend verification link
    Route::post('email/verification-notification', 
        [EmailVerificationNotificationController::class, 'store']
    )->middleware('throttle:6,1')
     ->name('verification.send');

    // 4. Confirm password
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
         ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // 5. Update password
    Route::put('user/password', [PasswordController::class, 'update'])
         ->name('user.password.update');

    // 6. Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');
});


// Route::get('verify-email/{id}/{hash}', [CustomEmailVerificationController::class, 'verify'])
//     ->middleware(['throttle:6,1'])
//     ->name('verification.verify');
