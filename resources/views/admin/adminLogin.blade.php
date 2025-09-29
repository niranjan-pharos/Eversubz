<x-guest-layout>
<!-- <a href="/" class="header-logo"><img src="assets/images/logo.png" alt="logo"></a> -->
<h3 class="admin-login-h3">Eversabz</h3>
<p class="admin-login-p"> Access to our dashboard</p>
<br>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin_login_submit') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <div class="flex items-center  mt-4">

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<style>
    .fill-current{display:none;}
    /* body{
        background: url('assets/images/bg/bg-1.jpg');
    } */
    .admin-login-h3{font-size: 30px;
    font-weight: bold;
    text-align: center;}
    .admin-login-p{    text-align: center;
    font-weight: 600;}
    .min-h-screen{ background: url('http://13.236.11.83/assets/images/bg/bg-1.jpg'); 
        background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background: linear-gradient(to right, #00c5fb 0%, #0253cc 100%);
}

    .header-logo img{width: 150px; margin:20px auto;}
    label{    font-size: 16px !important;
    font-weight: 600 !important;}
    .duration-150 {
    width: 100%;
    text-align: center;
    border: 1px solid #016fd8;
    color: white;
    padding: 18px;
    font-size: 16px;
    justify-content: center;
    margin: 20px 0px;
    background: #0263d3;
    /* background: linear-gradient(to right, #00c5fb 0%, #0253cc 100%); */
}
.duration-150:hover {
    background: #fff !important;
    border:1px solid #0263d3;
    color:#000;
}
    .duration-150:hover{background: #0022aa;}
    .sm\:rounded-lg{
        padding:40px
    }
</style>