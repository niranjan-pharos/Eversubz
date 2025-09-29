@extends('layouts.eventlayout')

@section('title', 'Verify Email')
@section('description', 'Welcome to Eversubz, Email verification process')
@section('canonical', 'https://eversubz.com/')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen px-4">
    <div class="w-full max-w-md space-y-6 p-6 bg-white shadow-lg rounded-lg">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.342 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h2 class="mt-4 text-2xl font-bold text-gray-900">Verification Link Expired</h2>
            <p class="mt-2 text-gray-600">The email verification link you used has expired or is invalid. Please request a new link to verify your email address.</p>
        </div>

        @if (session('status'))
            <div class="p-3 text-green-700 bg-green-100 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Resend Verification Email
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('user.login') }}" class="text-blue-500 hover:underline">Back to login</a>
        </div>
    </div>
</div>
@endsection
