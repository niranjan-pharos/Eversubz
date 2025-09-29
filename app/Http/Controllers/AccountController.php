<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class AccountController extends Controller
{
    public function deleteAccount(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Check if the provided email matches the logged-in user's email
            if ($validated['email'] !== $request->user()->email) {
                return response()->json([
                    'success' => false,
                    'message' => 'The provided email does not match the email of the logged-in account.',
                ], 422);
            }

            if (!Hash::check($validated['password'], $request->user()->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password.',
                ], 422);
            }

            // soft delete
            $request->user()->delete();

            Mail::send('emails.account_deleted', ['user' => $request->user()], function ($message) use ($request) {
                $message->to($request->user()->email);
                $message->subject('Account Deletion Confirmation');
            });

            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Your account has been successfully deleted. Check your email for confirmation.',
                'redirect' => url('/'),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Validation failed. Please correct the errors and try again.',
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error deleting account:', [
                'message' => $e->getMessage(),
                'user_id' => $request->user()->id ?? 'guest',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting your account. Please try again later.',
            ], 500);
        }
    }

}
