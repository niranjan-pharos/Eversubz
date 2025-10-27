<x-guest-layout>
<a href="/" class="header-logo"><img
src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div> 

    <!-- Session Status --> 
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    
    <style>
    .overflow-hidden{background:#fff}
    .bg-gray-100{    background: linear-gradient(to right, #00c5fb 0%, #0253cc 100%);}
    label{    font-size: 20px ! IMPORTANT;
    font-weight: 700 !IMPORTANT;
    margin: 0px 0px 12px;}
    .text-justify{text-align:justify;font-weight: 800;
        }
    svg{display:none;}
    .header-logo img{width:150px; margin:20px auto;}
    .btn12 button {
    border: none;
    font-size: 14px;
    font-weight: 500;
    border: 2px solid;
    padding: 14px 32px;
    border-radius: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    text-shadow: var(--primary-tshadow);
    transition: all linear .3s;
    -webkit-transition: all linear .3s;
    -moz-transition: all linear .3s;
    -ms-transition: all linear .3s;
    -o-transition: all linear .3s;
    background:#0044bb;
}
</style>
</x-guest-layout>
