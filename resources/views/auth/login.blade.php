<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <meta name="name" content="Classicads">
    <meta name="type" content="Classified Advertising">
    <meta name="title" content="Classicads - Eversubz">
    <meta name="keywords"
        content="classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
    <title>@yield('title', 'User Login')</title>
    <!-- {{-- @include('layouts.common-header') --}} -->
    @section('title', "User Login")
    <meta name="description" content="@yield('description', config('app.description'))">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom/user-form.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async defer rel="stylesheet" />

    <style>
        
        @media only screen and (max-width: 767px) {
            * {
                user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            input,
            textarea,
            select {
                user-select: text;
                -webkit-user-select: text;
                -moz-user-select: text;
                -ms-user-select: text;
            }
        }


        .user-form-category .user-form-header .back-button {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            border-radius: 50%;
            font-size: 16px;
            color: var(--primary);
            background: var(--white);
            text-shadow: var(--primary-tshadow);
            box-shadow: var(--primary-bshadow);
        }

        .user-form-header .back-button:hover {
            color: var(--white);
            background: #cfcfcf;
        }

        .spriticon {
            background: url(https://eversabz.com/assets/images/icons/spriticon.png);
            width: 35px;
            height: 25px;
            margin-right: 17px
        }

        .spriticon-home {
            background-position: -6px 0
        }

        .spriticon-category {
            background-position: -47px 0
        }

        .spriticon-business {
            background-position: -91px 0
        }

        .spriticon-market {
            background-position: -133px 0
        }

        .spriticon-shop {
            background-position: -177px 0
        }

        .spriticon-event {
            background-position: -219px 0
        }

        .spriticon-ngo {
            background-position: -528px 0
        }

        .spriticon-blog {
            background-position: -309px 0
        }

        .spriticon-about {
            background-position: -354px 0
        }

        .spriticon-contact {
            background-position: -400px 0
        }

        .spriticon-terms {
            background-position: -442px 0
        }

        .spriticon-privacy {
            background-position: -486px 0
        }

        .navbar-link:hover {
            color: var(--primary);
            background: var(--chalk);
            display: flex;
            align-items: center;
            border-radius: .375rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: .625rem;
            padding-right: .625rem
        }

        .navbar-link img {
            width: 1.5rem;
            height: auto;
            margin-right: 10px;
            margin-left: 5px;
            width: 35px;
        }

        .user-form-direction p {
            width: 100%;
            font-size: 16px;
        }

        .user-form-direction p span {
            cursor: pointer;
        }

        .sidebar-part.active {
            display: block;
        }

        @media only screen and (max-width: 737px) {
            .user-form-header {
                z-index: 2;
            }

            .mobile-widget.search-btn {
                display: flex
            }

            .mobile-nav {
                padding: 10px 0;
            }

            .mobile-widget {
                color: #000;
            }

            .mobile-widget svg {
                height: 20px;
            }



            .user-form-category-btn {
                margin-top: 100px;
            }

            .navbar-link {
                font-size: 14px;
                padding: 10px 15px;
                display: flex;
                align-items: center;
                justify-content: left;
            }

            .navbar-item {
                border-bottom: none;
            }

            .header-form {
                margin-top: 100px;
            }

            .bottom-footer-height {
                height: 7rem
            }

            .sidebar-content {
                overflow-y: scroll;
            }

            .fl-main-container.fl-no-cache {
                display: none;
            }
        }

        .hidden {
            display: none;
        }

        .register-tab1 {
            padding-bottom: 100px;
        }
        .tab-pane{margin-bottom: 100px;}
    </style>
</head>

<body>

    <section class="user-form-part">
        <div class="user-form-banner">
            <div class="user-form-content">
                <a href="{{ asset('/') }}"><img src="{{ asset('assets/images/logo.png')}}" alt="logo"></a>
                <h1>Advertise your assets <span>Buy what are you needs.</span></h1>
                <p>Biggest Online Advertising Marketplace in the World.</p>
            </div>
        </div>
        <div class="user-form-category">
            <div class="user-form-header">
                <a href="{{ asset('/')}}"><img src="{{ asset('assets/images/logo.png')}}" alt="logo"></a>
                <a href="{{ asset('/')}}" class="back-button">
                    <svg fill="#0044bb" width="24px" height="24px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M34,256,210,80l21.21,21.2L91.4,241H478v30H91.4L231.25,410.84,210,432Z"></path>
                    </svg>
                </a>
            </div>
            <div class="user-form-category-btn">
                <ul class="nav nav-tabs">
                    <li><a href="#login-tab" class="nav-link active" data-toggle="tab">sign in</a></li>
                    <li><a href="#register-tab" class="nav-link" data-toggle="tab">sign up</a></li>
                </ul>
            </div>
            <div class="tab-pane active" id="login-tab">
                <div class="user-form-title">
                    <h2>Welcome!</h2>
                    <p>Use credentials to access your account.</p>
                </div>
                <form method="POST" action="{{ route('loginprocess') }}" id="loginForm">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request()->input('redirect', $redirect ?? url()->previous()) }}">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="login_pass" placeholder="Password" required>
                        <button type="button" class="form-icon login-eye"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="form-group text-right">
                        <a href="{{ route('user.password.request') }}" class="form-forgot">Forgot password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-inline">
                            <i class="fas fa-unlock"></i> Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="register-tab">
                <div class="user-form-title">
                    <h2>Register</h2>
                    <p>Setup a new account in a minute.</p>
                </div>
                <form method="POST" action="{{ route('registrationProcess') }}" id="signup-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="passs" placeholder="Password" required>
                        <button type="button" class="form-icon register-eye"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" id="passss" placeholder="Repeat Password" required>
                        <button type="button" class="form-icon register-eye"><i class="fas fa-eye"></i></button>
                        <span id="password-mismatch" style="color: red; display: none;"></span>
                    </div>
                    <div class="form-group">
                        <label for="account_type">Account Type</label>
                        <select class="custom-select" id="account_type" name="account_type" required>
                            <option value="1">Normal User</option>
                            <option value="2">Business</option>
                            <option value="3">NGO</option>
                            <option value="4">Candidate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="signup-check" name="signup_check" required>
                            <label class="custom-control-label" for="signup-check">I agree to the <a href="{{ asset('terms-of-use') }}">terms of use</a>.</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-inline">
                            <i class="fas fa-user-check"></i> Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <aside class="sidebar-part hidden">
        <div class="sidebar-body">
            <div class="sidebar-header">
                <h4>Menu</h4>

                <button class="sidebar-cross"><svg fill="#000000" width="20px" height="20px" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">

                        <g data-name="Layer 2">

                            <g data-name="close">

                                <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0"></rect>

                                <path
                                    d="M13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29-4.3 4.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l4.29-4.3 4.29 4.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z">
                                </path>

                            </g>

                        </g>

                    </svg></button>
            </div>

            <div class="sidebar-content">

                <div class="sidebar-menu">
                    <ul class="nav nav-tabs">


                    </ul>
                    <div class="tab-pane active" id="main-menu">
                        <ul class="navbar-list">
                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/">
                                    <span class="spriticon spriticon-home"></span>
                                    Home
                                </a></li>

                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/category/list">
                                    <span class="spriticon spriticon-category"></span>
                                    Category List
                                </a></li>

                            <!-- Business Menu -->
                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/business/list">
                                    <span class="spriticon spriticon-business"></span>
                                    Business List
                                </a></li>
                            <!-- NGO Menu -->
                            <!-- <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/events/events-list">
                                    <span class="spriticon spriticon-event"></span>
                                    NGO 
                                </a></li> -->
                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/sabz-future">
                                    <span class="spriticon spriticon-ngo"></span>
                                    <!-- <img loading="eager"
                                        src="https://sabzfuture.com/wp-content/uploads/2023/08/Sabz-Future2-01-01-1.png"
                                        alt="Fundraiser" class="w-10"> -->

                                    Sabz-Future
                                </a></li>

                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/ads-post/list">
                                    <span class="spriticon spriticon-market"></span>
                                    MarketPlace
                                </a></li>
                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/shop/products">
                                    <span class="spriticon spriticon-shop"></span>
                                    Shop Now
                                </a></li>
                            <li class="navbar-item"><a class="navbar-link"
                                    href="https://eversabz.com/events/events-list">
                                    <span class="spriticon spriticon-event"></span>
                                    Events List
                                </a></li>


                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/blogs">
                                    <span class="spriticon spriticon-blog"></span>
                                    Blogs
                                </a></li>
                        </ul>

                        <hr>

                        <ul class="navbar-list">
                            <p class="navbar-link">Quick Links</p>

                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/about-us">
                                    <!-- <img loading="eager" src="https://eversabz.com/assets/images/icons/aboutus.png" alt="About Us"> -->
                                    <span class="spriticon spriticon-about"></span>
                                    About Us
                                </a>
                            </li>

                            <li class="navbar-item"><a class="navbar-link" href="https://eversabz.com/contactus">
                                    <!-- <img loading="eager" src="https://eversabz.com/assets/images/icons/contactus.png" alt="Contact"> -->
                                    <span class="spriticon spriticon-contact"></span>
                                    Contact
                                </a></li>
                            <li class="navbar-item">
                                <a class="navbar-link" href="{{ asset('terms-of-use') }}">Terms of Use</a>
                            </li>
                            <li class="navbar-item">
                                <a class="navbar-link" href="https://eversabz.com/privacy-policy">
                                    <!-- <img loading="eager" src="https://eversabz.com/assets/images/icons/privacy-policy.png" alt="Privacy -->

                                    <span class="spriticon spriticon-privacy"></span>
                                    Privacy
                                    Policy
                                </a></li>


                        </ul>
                    </div>

                </div>
                <div class="sidebar-footer">
                    <hr>
                    <p>© Eversabz 2024.<br> All Rights Reserved.</p>
                    <div class="bottom-footer-height"></div>
                </div>
            </div>
        </div>
    </aside>
    <nav class="mobile-nav">
        <div class="container">

            <div class="mobile-group">
                <a href="{{ asset ('/') }}" class="mobile-widget"><svg class="w-5 h-5 text-gray-800 dark:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                    </svg>
                    <span>home</span>
                </a>

                <a href="{{ asset('ad-post/create') }}" class="mobile-widget "> <svg
                        class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                    <span>Ad
                        Post</span>
                </a>
                <a href="{{ route ('adsList') }}" class="mobile-widget "><svg
                        class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    <span>Market</span>
                </a>


                <button type="button" class="mobile-widget sidebar-btn">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 6h8M6 10h12M8 14h8M6 18h12" />
                    </svg><span>Menu</span>
                </button>



            </div>
        </div>
    </nav>
    
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/custom/main.js"></script>
    <script src="https://eversabz.com/assets/js/vendor/slick.min.js"></script>
    <script src="https://eversabz.com/assets/js/custom/slick.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.login-eye').on('click', function () {
                const inputField = $('#login_pass');
                const inputType = inputField.attr('type') === 'password' ? 'text' : 'password';
                inputField.attr('type', inputType);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            $('.register-eye').on('click', function () {
                const inputField = $(this).siblings('input');
                const inputType = inputField.attr('type') === 'password' ? 'text' : 'password';
                inputField.attr('type', inputType);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            $('#passss').on('input', function () {
                const password = $('#passs').val();
                const confirmPassword = $(this).val();
                const mismatchSpan = $('#password-mismatch');
                if (password !== confirmPassword) {
                    mismatchSpan.text('Passwords do not match.').show();
                } else {
                    mismatchSpan.text('').hide();
                }
            });

            $('.nav-tabs a').on('click', function () {
                $('.tab-pane').removeClass('active');
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).addClass('active');
            });

            $('#loginForm').submit(function (e) {
                e.preventDefault();
                const $submitButton = $(this).find('button[type="submit"]');
                const formData = $(this).serialize();

                $submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Logging in...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message || 'Login successful!');
                            window.location.href = response.redirect || '/dashboard';
                        } else {
                            toastr.error(response.message || 'Invalid email or password.');
                            $submitButton.prop('disabled', false).html('<i class="fas fa-unlock"></i> Login');
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON;
                        if (errors && errors.message) {
                            toastr.error(errors.message);
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                        $submitButton.prop('disabled', false).html('<i class="fas fa-unlock"></i> Login');
                    }
                });
            });

            $('#signup-form').submit(function (e) {
                e.preventDefault();
                const password = $('#passs').val();
                const confirmPassword = $('#passss').val();
                const mismatchSpan = $('#password-mismatch');
                const $submitButton = $(this).find('button[type="submit"]');

                if (password.length < 8) {
                    mismatchSpan.text('Password must be at least 8 characters long.').css('color', 'red').show();
                    $('#passs').focus();
                    return;
                }

                if (password !== confirmPassword) {
                    mismatchSpan.text('Passwords do not match.').show();
                    $('#passss').focus();
                    return;
                }

                $submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Signing up...');

                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message || 'Signup successful!');
                            window.location.href = response.redirect || '/dashboard';
                        } else {
                            toastr.error(response.message || 'Signup failed.');
                            $submitButton.prop('disabled', false).html('<i class="fas fa-user-check"></i> Sign Up');
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON;
                        if (errors && errors.errors) {
                            for (const field in errors.errors) {
                                toastr.error(errors.errors[field][0]);
                            }
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                        $submitButton.prop('disabled', false).html('<i class="fas fa-user-check"></i> Sign Up');
                    }
                });
            });
        });

</script>

</body>


</html>