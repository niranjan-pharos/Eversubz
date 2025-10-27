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
                <form method="POST" action="{{ route('verification.sendAjax') }}" class="w-full mt-5" id="verification-form">
                    @csrf
                    <x-primary-button class="w-full verify" id="resend-btn">
                        {{ __('Resend Verification Email') }}
                        <span class="spinner-border spinner-border-sm ml-2" style="display: none;" role="status" aria-hidden="true">
                            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </x-primary-button>
                </form>
            
                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="w-full mt-5" id="logout-form">
                    @csrf
                    <button type="submit" class="verify w-full text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="logout-btn">
                        {{ __('Log Out') }}
                        <span class="spinner-border spinner-border-sm ml-2" style="display: none;" role="status" aria-hidden="true">
                            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
            
        </div>
    </div>

@push('scripts')
    <script>
    $(document).ready(function() {
        $('#verification-form').on('submit', function(e) {
            e.preventDefault();
            
            const $button = $('#resend-btn');
            const $loader = $button.find('.spinner-border');
            const $form = $(this);
            
            $button.prop('disabled', true);
            $button.addClass('opacity-75 cursor-not-allowed');
            $loader.show();
            
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast(response.message, 'success');
                        
                        if (response.redirect) {
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 1500);
                        }
                    } else {
                        showToast(response.message, 'error');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Failed to send verification email. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showToast(errorMessage, 'error');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $button.removeClass('opacity-75 cursor-not-allowed');
                    $loader.hide();
                }
            });
        });
        
        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const toast = $(`
                <div class="fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 toast-message">
                    ${message}
                </div>
            `);
            
            $('body').append(toast);
            
            setTimeout(() => {
                toast.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 4000);
        }
    });

    </script>
@endpush
@endsection
