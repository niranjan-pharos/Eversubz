@extends('layouts.eventlayout')

@section('title', 'Verify Email | Eversabz')
@section('description', 'Welcome to Eversubz')
@section('canonical', 'https://eversubz.com/')

@section('content')
<style>
    /* Styles for Email Verification Container */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Styles for the Email Verification Box */
.bg-white {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 30px;
}

/* Title Styling */
h1.text-2xl {
    color: #2d3748;
    font-size: 1.5rem;
    font-weight: 600;
}

/* Text Styling for Messages */
.text-sm {
    font-size: 0.875rem;
    color: #718096;
    line-height: 1.5;
}

.text-gray-600 {
    color: #718096;
}

.text-green-600 {
    color: #48bb78;
}

/* Styling for Buttons */
.verify {
    width: 100%;
    padding: 10px;
    text-align: center;
    background-color: #3182ce;
    color: #fff;
    font-weight: 600;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}



.verify:focus, .w-full:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.6);
}


    </style>
    <div class="container mx-auto py-12">
        <!-- Email Verification Message -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Email Verification') }}</h1>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between space-x-4">
                <!-- Resend Verification Email Form -->
                <form method="POST" action="{{ route('verification.send') }}" class="w-full mt-5">
                    @csrf
                    <x-primary-button class="w-full verify">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </form>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="w-full mt-5">
                    @csrf
                    <button type="submit" class="verify w-full text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
