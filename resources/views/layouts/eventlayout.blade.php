<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="version" content="{{ config('app.version') }}">

    <link href="{{ asset('main_assets/images/favicon.png') }}" rel="icon" type="image/png">

    <title>@yield('title', config('app.name'))</title>
    @include('layouts.common-header')
    <meta name="description" content="@yield('description', config('app.description'))">
    <link rel="canonical" href="{{ generateCanonicalUrl() }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/fontawesome.css') }}" async="async" defer="defer">

    <link rel="stylesheet" href="{{ asset('main_assets/css/tailwind_org.css') }}" async="async" defer="defer">
    <link rel="stylesheet" href="{{ asset('main_assets/css/style.css') }}" async="async" defer="defer">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async="async" defer="defer"
        rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">




   
<style>
    header {
        z-index: 999999
    }

    .dropdown-toggle1::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        margin-top: 16px;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid #fff0;
        border-bottom: 0;
        border-left: .3em solid #fff0
    }

    .dropdown-toggle1 {
        background: 0 0;
        display: flex
    }

    .header-widget img {
        width: 40px;
        height: 40px;
        border-radius: 50%
    }

    .header-widget sup {
        position: absolute;
        top: -8px;
        right: -8px;
        height: 24px;
        font-size: 12px;
        padding: 0 6px;
        line-height: 20px;
        border-radius: 50%;
        color: #fff;
        background: #04b;
        border: 2px solid #fff;
        text-shadow: var(--primary-tshadow);
        box-shadow: var(--primary-bshadow);
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear
    }

    #toggle-button .text-2xl,
    .mobile-serach-bar-box {
        color: #555;
        background: #f5f5f5;
        border-radius: 50%
    }

    .mobile-serach-bar-box {
        width: 40px;
        height: 40px;
        font-size: 16px;
        padding: 10px;
        text-align: center
    }

    .header-icons-mobile {
        margin: 0 -18px 0 0;
        float: right;
        column-gap: 19px
    }

    .header12 {
        padding: 15px
    }

    .header12 #logo .img12 {
        width: auto;
        height: 45px
    }

    #toggle-button .text-2xl {
        padding: 5px
    }

    .mobile-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 39999999;
        background: #fff;
        border-radius: 10px 10px 0 0;
        box-shadow: 0 -5px 15px 0 rgb(0 0 0 / .1);
        display: none
    }

    .bottom-footer-height {
        height: 5rem
    }

   

    .simplebar-content {
        overflow: auto !important
    }

    #menu-dropdown {
        z-index: 99999999999;
        width: 250px;
        overflow-y: hidden;
        height: 100vh
    }

    #menu-dropdown:hover {
        overflow-y: hidden;
    }

    #menu-dropdown::-webkit-scrollbar {
        width: 5px;
        height: 5px
    }

    #menu-dropdown::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / .3);
        -webkit-border-radius: 10px;
        border-radius: 10px
    }

    #menu-dropdown::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: rgb(255 255 255 / .3);
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / .5)
    }

    #menu-dropdown::-webkit-scrollbar-thumb:window-inactive {
        background: rgb(255 255 255 / .3)
    }

    .spriticon {
        background: url(https://eversabz.com/assets/images/icons/spriticon.png);
        width: 35px;
        height: 25px
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

    .sabz-future {
        margin-left: -5px
    }

    .sabz-future1 {
        width: 35px
    }

    #side a {
        padding: .75rem .5rem
    }

    #side a:hover,
    .button-icon:hover,
    .focus\:bg-secondery:focus,
    .hover\:bg-secondery:hover,
    .uk-dropdown nav>a {
        display: flex;
        align-items: center;
        gap: .75rem;
        border-radius: .375rem;
        padding-top: .5rem;
        padding-bottom: .5rem;
        padding-left: .625rem;
        padding-right: .625rem
    }
    #side a:hover{
        padding: .75rem .5rem;
        gap: 1rem;
    }
    .news-form,
    footer {
        position: relative
    }

    .footer-end-content p a:hover,
    .footer-widget li a:hover {
        text-decoration: underline
    }

    body,
    html {
        height: 100%
    }

    body {
        display: flex;
        flex-direction: column
    }

    main {
        flex: 1
    }

    .newsletter {
        margin-bottom: 70px;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
        justify-content: space-between
    }

    .news-content h2 {
        margin-bottom: 15px;
        color: #fff !important;
        font-size: 30px;
        line-height: 46px;
        font-weight: 700
    }

    .footer-address li p,
    .footer-address li p a,
    .footer-end-content p,
    .news-content p {
        color: #fff
    }

    .news-form {
        margin-top: 23px
    }

    .news-form input {
        width: 100%;
        height: 60px;
        border: none;
        outline: 0;
        padding: 0 200px 0 20px !important;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 10px 30px 0 rgb(0 0 0 / .15)
    }

    .news-form .btn {
        font-size: 14px;
        font-weight: 500;
        border: 2px solid #04b;
        border-radius: 8px;
        letter-spacing: .5px;
        text-transform: uppercase;
        text-shadow: var(--primary-tshadow);
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear;
        position: absolute;
        top: 5px;
        right: 5px;
        height: 50px;
        width: 175px;
        padding: 10px 30px;
        color: #fff;
        background: #04b
    }

    .footer-part12 {
        display: flex
    }

    footer {
        background: #080229;
        z-index: 99999
    }

    .footer-part {
        background: #080229;
        padding: 80px 0 0
    }

    .footer-part .container-fluide {
        padding: 0 80px 50px
    }

    .footer-part .footer-end .container-fluide {
        padding: 0 80px
    }

    .footer-content h3 {
        color: #fff !important;
        font-weight: 500;
        padding-bottom: 15px;
        margin-bottom: 25px;
        border-bottom: 1px solid #333;
        position: relative;
        font-size: 24px;
        line-height: 32px
    }

    .footer-content h3::before {
        position: absolute;
        content: "";
        bottom: -1px;
        left: 0;
        width: 60px;
        height: 2px;
        background: #fff
    }

    .footer-address li {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        margin-bottom: 21px
    }

    .footer-address li:last-child,
    .footer-count li:last-child,
    .footer-widget li:last-child {
        margin-bottom: 0
    }

    .footer-address li i {
        font-size: 20px;
        margin: 6px 20px 0 0;
        color: #fff
    }

    .footer-info a img,
    .footer-widget li {
        margin-bottom: 20px
    }

    .footer-address li p span {
        display: block;
        line-height: 30px
    }

    .footer-widget li a {
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear
    }

    .footer-widget li a:hover {
        color: #e86121
    }

    .footer-info a img {
        width: auto;
        height: 90px;
        background: #fff;
        border-radius: 10px;
        padding: 13px
    }

    .footer-count li {
        margin-bottom: 30px;
        color: #fff;
        display: flex;
        column-gap: 10px
    }

    .footer-count li h5 {
        margin-bottom: 3px;
        letter-spacing: .3px;
        color: #fff !important
    }

    .footer-card-content {
        padding: 40px 0;
        margin-top: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-evenly;
        border-top: 1px solid #333
    }

    .footer-app a,
    .footer-app button,
    .footer-option a,
    .footer-option button,
    .footer-payment a,
    .footer-payment button {
        margin: 0 5px
    }

    .footer-app a img,
    .footer-payment a img {
        width: auto;
        height: 38px
    }

    .footer-option button {
        border: none;
        outline: 0;
        background: 0 0;
        margin: 0 8px;
        width: 120px;
        padding: 5px 0;
        border-radius: 8px;
        letter-spacing: .3px;
        color: var(--gray);
        border: 1px solid var(--gray);
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear
    }

    .footer-option button:hover {
        color: #fff;
        border: 1px solid #fff
    }

    .footer-option button i {
        margin-right: 8px
    }

    .footer-end {
        background: #0d0633
    }

    .footer-end-content {
        padding: 15px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-between
    }

    .footer-end-content p a {
        color: var(--primary)
    }

    .footer-social li {
        display: inline-block;
        margin: 5px
    }

    .footer-social li a i {
        width: 40px;
        height: 40px;
        background: #f9f9f9;
        font-size: 16px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        color: #000;
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear
    }

    .footer-social li a i:hover {
        color: var(--white);
        background: var(--primary)
    }

    .footer-count li p,
    .footer-info p,
    .footer-widget li a {
        color: #bebebe
    }

    @media (max-width:991px) {
        .newsletter {
            margin-bottom: 60px;
            display: block
        }

        .news-content {
            margin: 0 0 30px
        }

        .news-form {
            margin: 0
        }

        .footer-content {
            margin-bottom: 30px
        }

        .footer-end-content {
            padding: 25px 0;
            flex-direction: column;
            text-align: center
        }

        .footer-end-content p {
            margin-bottom: 10px
        }
    }

    @media (max-width:575px) {
        .spriticon {
            margin-right: 8px
        }

        .news-content h2 {
            font-size: 25px;
            line-height: 32px
        }

        .footer-content h3 {
            margin-top: 30px
        }

        .news-form input {
            padding: 0 75px 0 20px
        }

        .news-form .btn {
            padding: 10px 20px;
            width: 100px
        }

        .news-form .btn i {
            margin-right: 0
        }

        .news-form .btn span {
            display: none
        }

        .footer-part12 {
            display: block
        }

        .footer-part .container-fluide {
            padding: 0 30px
        }

        .footer-part .footer-end .container-fluide {
            padding: 0
        }

        .footer-part {
            padding: 60px 0 0
        }

        .footer-card-content {
            flex-direction: column
        }

        .footer-option,
        .footer-payment {
            margin-bottom: 30px
        }

        .sabz-future {
            margin-left: 0
        }
    }

    @media (min-width:576px) and (max-width:767px) {
        .footer-part {
            padding: 80px 0 60px
        }

        .footer-card-content {
            margin-top: 20px
        }

        .footer-app a,
        .footer-app button,
        .footer-option a,
        .footer-option button,
        .footer-payment a,
        .footer-payment button {
            margin: 5px
        }
    }

    @media (min-width:768px) and (max-width:991px) {
        .footer-part {
            padding: 90px 0 60px
        }

        .footer-card-content {
            margin-top: 20px
        }

        .footer-app,
        .footer-option,
        .footer-payment {
            text-align: center
        }

        .footer-app a,
        .footer-app button,
        .footer-option a,
        .footer-option button,
        .footer-payment a,
        .footer-payment button {
            margin: 5px
        }
    }

    @media (min-width:992px) {

        .col-lg-2,
        .col-lg-3,
        .col-lg-5 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px
        }

        .col-lg-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-lg-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .col-lg-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%
        }
    }

    .simplebar-content div {
        padding-left: 20px;
        font-size: 14px;
        line-height: 25px;
    }

    header{background: #fff;}

    @media only screen and (max-width:767px) {
        * {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none
        }

        input,
        textarea,
        select {
            user-select: text;
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text
        }
    }

    #dropdownMenu {
        width: 360px;
        right: -90px;
        padding: 10px !important;
        box-shadow: 0 0 1px #000;
        border-radius: .25rem;
    }

    #dropdownMenu li {
        padding: .6rem .625rem;
        font-size: .875rem;
    }

    #dropdownMenu li span {
        color: #000;
        font-weight: 500;
    }

    #dropdownMenu li .qty-item1 {
        font-size: 12px;
    }

    #dropdownMenu li img {
        margin-right: 20px;
        border-radius: 5px;
        height: 80px;
        width: 80px;   object-fit: contain;
    }

    .dropdown-item.total-price {
        border-top: 1px solid;
    }

    .dropdown-item.total-price span {
        font-size: 14px;
    }

    .dropdown-item.total-price strong {
        font-weight: 500;
        display: flex;
        justify-content: space-between;
    }

    .checkout-btns1 {
        display: flex;
        justify-content: space-between;
    }

     .checkout-btns1 .btn-inline {
        padding: 3px 8px;
        border-radius: 4px;
        width: 165px;
        text-align: center;
        background: #1c721c;
        color: #fff;
        border: 1px solid #2d6ab3;
    }

    .checkout-btns1 .btn-inline:hover {
        color: #fff;
        background: #135013;
    }


    @media only screen and (max-width:767px) {
        #dropdownMenu {
            width: 330px;
            right: -40px;
        }

        .bottom-footer-height {
            height: 10rem
        }

        main {
            margin-bottom: 80px
        }

        .footer-part {
            display: none
        }

        #menu-dropdown {
            width: 100% !important;
            z-index: 99 !important
        }

        .header-widget img,
        .mobile-serach-bar-box {
            width: 35px;
            height: 35px;
            border-radius: 50%
        }

        #toggle-button .text-2xl,
        .mobile-serach-bar-box {
            color: #555;
            background: #f5f5f5;
            border-radius: 50%
        }

        .mobile-serach-bar-box {
            font-size: 14px;
            padding: 6px;
            text-align: center
        }

        .header-icons-mobile {
            margin: 0 -18px 0 0;
            float: right;
            column-gap: 5px
        }

        .header12 {
            padding: 15px
        }

        .header12 #logo .img12 {
            width: auto;
            height: 45px
        }

        #toggle-button .text-2xl {
            padding: 5px
        }

        #mobile-search-box {
            width: 150%;
            background: #fff;
            padding: 10px;
            top: 15px;
            right: -15px
        }

        .mobile-nav {
            display: block
        }

        .mobile-widget.search-btn {
            display: flex
        }

        .mobile-menu.sidebar-btn {
            display: none
        }

        .mobile-nav {
            padding: 10px 0
        }

        .mobile-nav .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .mobile-group {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .mobile-widget {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 80px;
            padding: 8px 0;
            border-radius: 8px;
            position: relative
        }

        .mobile-widget i {
            font-size: 15px;
            margin-bottom: 5px;
            color: var(--text);
            text-shadow: 2px 3px 8px rgb(0 0 0 / .1)
        }

        .mobile-widget span {
            font-size: 10px;
            line-height: 12px;
            color: var(--text);
            text-transform: uppercase
        }

        #dropdownMenu li img {
    margin-right: 20px;
    border-radius: 5px;
    height: 55px;
    width: 55px;
}.checkout-btns1{column-gap: 20px;}
    }
    </style>
    @if (Route::is('event.show'))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endif

    <meta name="google-site-verification" content="16iZVJqo93zzHfKZU4ba6vHobCjOCpiRtD3ohDv4Djk" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L3MSLNRWTH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-L3MSLNRWTH');
</script>
</head>

<body>
    <div id="wrapper">

        @include('partials.eventheader')

        @include('partials.eventsidebar')



        <main class="pt-20 px-4 pb-10">
            @yield('content')
        </main>
        <footer class="footer-part">
            <div class="container-fluide">
                <div class="row newsletter">
                    <div class="col-lg-7">
                        <div class="news-content">
                            <h2>Unlock Exclusive Deals: Straight to Your Inbox!</h2>
                            <p>Subscribe now to receive unbeatable offers and insider deals directly in your inbox!</p>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <form class="news-form" id="newsletterForm">
                            @csrf
                            <input type="email" name="email" id="email" placeholder="Enter Your Email Address">
                            <button type="submit" class="btn btn-inline"><i
                                    class="fas fa-envelope"></i><span>Subscribe</span></button>
                        </form>
                    </div>
                </div>
                <div class="row footer-part12">

                    <div class="col-sm-6 col-md-6 col-lg-5">
                        <div class="footer-info" style="line-height: 30px;text-align: justify;padding-right: 30px;">

                             <div style="display: flex; align-items: center; gap: 10px;">
                                <a href="/"><img loading="lazy" src="{{ asset('main_assets/images/logo.png') }}" alt="logo"></a>
                                <a href="/"><img loading="lazy" src="{{ asset('assets/images/sub_future_logo.png') }}" alt="logo"></a>
                            </div>
                                    <p>
                        Welcome to EverSabz, your premier online marketplace for a wide array of categories including
                        Electronics, Food &amp; Dining, Entertainment, Sports, Automotive, Fashion &amp; Clothing,
                        Furniture,
                        and much more.
                        At Eversabz, we pride ourselves on being your one-stop destination for all your buying and
                        selling needs across diverse categories.
                    </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <div class="footer-content">
                            <h3>Quick Links</h3>
                            <ul class="footer-widget">
                            <li><a href="{{ route ('products.category_list') }}">Category List</a></li>
                        <li><a href="{{ route ('business.list') }}">Business List</a></li>
                        <li><a href="{{ route('ngo.list') }}">Sabz-Future</a></li>
                        <li><a href="{{ route ('adsList') }}">Market Place</a></li>
                        <li><a href="{{ route ('product.filter') }}">Shop Now</a></li>
                        <li><a href="{{ route ('events.list') }}">Events</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <div class="footer-content">
                            <h3>Information</h3>
                            <ul class="footer-widget">
                        <li><a href="{{ asset ('/') }}">Home</a></li>
                        <li><a href="{{ asset ('about-us') }}">About Us</a></li>
                        <li><a href="{{ asset ('blogs') }}">Blogs</a></li>
                        <li><a href="{{ asset ('pricing-list') }}">Pricing</a></li>
                        <li><a href="{{ asset ('contactus') }}">Contact Us</a></li>
                        <li><a href="{{ asset ('terms-and-condition') }}">Terms of Use</a></li>
                        <li><a href="{{ asset ('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Counters</h3>
                            <!-- <ul class="footer-address">

                                <li><i class="fas fa-envelope"></i>
                                    <p><a href="mailto:eversabz.info@gmail.com">
                                            eversabz.info@gmail.com</a>
                                    </p>
                                </li>

                            </ul> -->
                            <br>
                            <ul class="footer-count">
                            <li>
                            <h5>{{ $footerData['registeredBusinessCount'] }}+</h5>
                            <p>Registered Business</p>
                        </li>
                        <li>
                            <h5>{{ $footerData['productsCount'] }}+</h5>
                            <p>Products</p>
                        </li>
                        <li>
                            <h5>{{ $footerData['productsCount'] }}+</h5>
                            <p>Ads published</p>
                        </li>
                            </ul>
                             <div class="mt-4" style="display: flex;"><a href="https://play.google.com/store/apps/details?id=com.eversabz.twa"><img src="https://eversabz.com/assets/images/play-store.png" alt="play-store"></a>&nbsp;&nbsp;<a href="#"><img src="https://eversabz.com/assets/images/app-store.png" alt="app-store"></a></div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="footer-end">
                <div class="container-fluide">
                    <div class="footer-end-content">
                        <!-- ABN 326 121 886 37 ACN 612 188 637 -->
                        <p>Copyright © 2025, Eversabz Australia Pty Ltd.</p>
                       <div class="footer-app" style="display: flex;">
                        <img src="https://eversabz.com/assets/images/payments.png" alt="playments" class="payments-icon" style="width: 100%;height: auto;float: right;"> </div>
                        <!-- <ul class="footer-social">
                            <li><a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                        viewBox="0 0 48 48">
                                        <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                        <path fill="#fff"
                                            d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                        </path>
                                    </svg>
                                </a></li>
                            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                        height="40" viewBox="0 0 48 48">
                                        <path fill="#03A9F4"
                                            d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429">
                                        </path>
                                    </svg></a></li>
                            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                        height="40" viewBox="0 0 48 48">
                                        <path fill="#0288D1"
                                            d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z">
                                        </path>
                                    </svg></a></li>
                            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                        height="40" viewBox="0 0 48 48">
                                        <path fill="#FF3D00"
                                            d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z">
                                        </path>
                                        <path fill="#FFF" d="M20 31L20 17 32 24z"></path>
                                    </svg></a></li>
                            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                        height="40" viewBox="0 0 48 48">
                                        <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38"
                                            cy="42.035" r="44.899" gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#fd5"></stop>
                                            <stop offset=".328" stop-color="#ff543f"></stop>
                                            <stop offset=".348" stop-color="#fc5245"></stop>
                                            <stop offset=".504" stop-color="#e64771"></stop>
                                            <stop offset=".643" stop-color="#d53e91"></stop>
                                            <stop offset=".761" stop-color="#cc39a4"></stop>
                                            <stop offset=".841" stop-color="#c837ab"></stop>
                                        </radialGradient>
                                        <path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)"
                                            d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                        </path>
                                        <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786"
                                            cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)"
                                            gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#4168c9"></stop>
                                            <stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop>
                                        </radialGradient>
                                        <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)"
                                            d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                        </path>
                                        <path fill="#fff"
                                            d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                        </path>
                                        <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
                                        <path fill="#fff"
                                            d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                        </path>
                                    </svg></a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
   $(document).ready(function () {
        fetchCartContents();

        $('#menu2').click(function () {
            $('#dropdownMenu').toggleClass('hidden');
        });

        $('.add-to-cart-button').click(function (event) {
            event.preventDefault();
            var productSlug = $(this).data('product-slug');
            if (!isAuthenticated) {
                window.location.href = '{{ route("user.login") }}';
                return;
            }
            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_slug: productSlug
                },
                success: function (response) {
                    if (response.message) {
                        toastr.success(response.message);
                        updateCartDropdown(response.cartItems, response.cartItemCount, response.cartTotal);
                        openCartDropdown(); 
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        toastr.error(xhr.responseJSON.error);
                    } else {
                        toastr.error('Error adding product to cart.');
                    }
                }
            });
        });

        function fetchCartContents() {
            $.ajax({
                url: '{{ route('cart.getContents') }}',
                method: 'GET',
                success: function (response) {
                    if (response.cartItems) {
                        updateCartDropdown(response.cartItems, response.cartItemCount, response.cartTotal);
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error fetching cart contents.');
                }
            });
        }

        function updateCartDropdown(cartItems, cartItemCount, cartTotal) {
            var dropdownMenu = $('#dropdownMenu');
            dropdownMenu.empty();

            if (cartItemCount > 0) {
                $.each(cartItems, function (key, item) {
                    var imageUrl = '{{ asset('storage') }}/' + item.attributes.image;
    var truncatedName = item.name.length > 30 ? item.name.substring(0, 30) + '...' : item.name; 

                    dropdownMenu.append(
                        '<li class="flex items-center p-2 ">' +
                        '<img src="' + imageUrl + '" width="50" class="mr-2" alt="' + item.name + '">' +
                        '<div class="flex-1">' +
                        '<span class="block">' + truncatedName + '</span>' +
                        '<span class="text-sm text-gray-600 qty-item1">(' + item.quantity + ' x $' + item.price + ')</span>' +
                        '</div>' +
                        '<button class="btn-sm ml-2 text-red-500" onclick="removeFromCart(' + item.id + ')">' +
                        '<svg width="15px" height="15px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg">' + 

'<g id="layer1">' + 

'<path d="M 8 0 L 7 1 L 7 2 L 2 2 L 2 3 L 3 3 L 3 18 L 5 20 L 14 20 L 16 18 L 16 3 L 17 3 L 17 2 L 12 2 L 12 1 L 11 0 L 8 0 z M 8.4140625 1 L 10.585938 1 L 11 1.4140625 L 11 2 L 8 2 L 8 1.4140625 L 8.4140625 1 z M 4 3 L 15 3 L 15 17.585938 L 13.585938 19 L 5.4140625 19 L 4 17.585938 L 4 3 z M 6 5 L 6 17 L 7 17 L 7 5 L 6 5 z M 9 5 L 9 17 L 10 17 L 10 5 L 9 5 z M 12 5 L 12 17 L 13 17 L 13 5 L 12 5 z " style="fill:#222222; fill-opacity:1; stroke:none; stroke-width:0px;"></path>' + 

'</g>' +

'</svg>' +
                        '</button>' +
                        '</li>'
                    );
                });

                dropdownMenu.append(
                    '<li class="dropdown-item total-price">' +
                    '<strong class=""><span>Total:</span>' +
                    '<span>$' + cartTotal.toFixed(2) + '</span></strong>' +
                    '</li>'
                );

                dropdownMenu.append(
                       
                       ' <div class="checkout-btns1">' + 
                       '<a  class="btn-inline" href="{{ asset('cart') }}"> Cart </a>' + 
                       '<a  class="btn-inline" href="{{ route('checkout') }}"> Checkout </a>'
                   );
            } else {
                dropdownMenu.append('<li class="p-2">No items in cart</li>');
            }
        }

        function openCartDropdown() {
            var $dropdown = $('#dropdownMenu');
            if ($dropdown.hasClass('hidden')) {
                $dropdown.removeClass('hidden');
            } else {
                $dropdown.addClass('hidden');
            }
        }

        window.removeFromCart = function (productId) {
            $.ajax({
                url: '/cart/remove/' + productId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.message) {
                        toastr.success(response.message);
                        $('#cart-item-' + productId).remove();
                        fetchCartContents();
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('Error removing item from cart.');
                }
            });
        }
    });
 
</script>
<script> 
  document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const menuToggle1 = document.getElementById("menu-toggle1");
    const menuClose = document.getElementById("menu-close");
    const menuDropdown = document.getElementById("menu-dropdown");

    function toggleMenu() {
        menuDropdown.classList.toggle("hidden");
        menuDropdown.classList.toggle("-translate-x-full");
        menuDropdown.classList.toggle("translate-x-0");
    }

    if (menuToggle) {
        menuToggle.addEventListener("click", toggleMenu);
    }
    if (menuToggle1) {
        menuToggle1.addEventListener("click", toggleMenu);
    }

    if (menuClose) {
        menuClose.addEventListener("click", function () {
            menuDropdown.classList.add("-translate-x-full");
            menuDropdown.classList.remove("translate-x-0");
            menuDropdown.classList.add("hidden");
        });
    }

    document.addEventListener("click", function (event) {
        if (!menuDropdown.contains(event.target) && !menuToggle.contains(event.target) && (!menuToggle1 || !menuToggle1.contains(event.target))) {
            if (!menuDropdown.classList.contains("-translate-x-full")) {
                menuDropdown.classList.add("-translate-x-full");
                menuDropdown.classList.remove("translate-x-0");
                menuDropdown.classList.add("hidden"); 
            }
        }
    });
});
</script>

<script>

$(document).ready(function(){let storedAdId=localStorage.getItem('wishlistProductId');if(storedAdId){let wishlistButton=$(`.wishlistButton[data-ad-id='${storedAdId}']`);if(wishlistButton.length){wishlistButton.click()}
localStorage.removeItem('wishlistProductId')}
$('.wishlistButton').off('click').on('click',function(e){e.preventDefault();const wishableId=$(this).data('wishable-id');const wishableType=$(this).data('wishable-type');let isInWishlist=$(this).hasClass('fas');const actionUrl=isInWishlist?'/wishlist/remove':'/wishlist/add';const ajaxMethod=isInWishlist?'DELETE':'POST';$.ajax({url:actionUrl,type:ajaxMethod,data:{_token:$('meta[name="csrf-token"]').attr('content'),wishable_id:wishableId,wishable_type:wishableType,},success:function(response){if(isInWishlist){$(this).removeClass('fas').addClass('far')}else{$(this).removeClass('far').addClass('fas')}
isInWishlist=!isInWishlist;displayToastr(response.success,'success');updateWishlistCount()}.bind(this),error:function(xhr){if(xhr.status===401){localStorage.setItem('wishlistProductId',wishableId);window.location.href=`/login?redirect=${encodeURIComponent(window.location.href)}`}else{let errorMsg=xhr.responseJSON&&xhr.responseJSON.error?xhr.responseJSON.error:"An error occurred";displayToastr(errorMsg,'error')}}})});function displayToastr(message,type){if(type==='success'){toastr.success(message)}else if(type==='error'){toastr.error(message)}else if(type==='warning'){toastr.warning(message)}else if(type==='info'){toastr.info(message)}}
function updateWishlistCount(){$.ajax({url:'/wishlist/count',type:'GET',success:function(response){$('#wishlistCount').text(response.count)}})}});document.addEventListener('DOMContentLoaded',function(){document.getElementById('newsletterForm').addEventListener('submit',function(event){event.preventDefault();var emailInput=document.getElementById('email').value.trim();console.log('Email Input:',emailInput);if(emailInput===''){toastr.error('Please enter your email address.');return}
var formData=new FormData(this);fetch('{{ route("newsletter-form.submit") }}',{method:'POST',body:formData,headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(response=>{if(!response.ok){throw new Error('Network response was not ok')}
return response.json()}).then(data=>{toastr.success(data.message);this.reset()}).catch(error=>{toastr.error('Email ID already exists.')})})})
    </script>

    
    @if(Route::is('event.show')) 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" >
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const getTicketsButton = document.getElementById('getTicketsBtn');
        
        if (getTicketsButton) {
            getTicketsButton.addEventListener('click', function () {
                window.location.href = '{{ route("ticket.details", ["encryptedEvent" => Crypt::encryptString($event->id)]) }}';
            });
        }
    });

    const isUserLoggedIn = @json(Auth::check());

    $(document).ready(function () {
        const event_id = '{{ $event->id }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateSummary() {
            let summary = '';
            let totalPrice = 0;

            $('.ticket-type').each(function () {
                let type = $(this).find('.adult-quantity').data('type');
                let adultQty = parseInt($(this).find('.adult-quantity').val()) || 0;
                let childrenQty = parseInt($(this).find('.children-quantity').val()) || 0;
                let adultPrice = parseFloat($(this).find('.adult-quantity').data('price'));
                let childrenPrice = parseFloat($(this).find('.children-quantity').data('price'));

                if (adultQty > 0 || childrenQty > 0) {
                    summary += `<li>${type} - Adults: ${adultQty}, Children: ${childrenQty}</li>`;
                    totalPrice += (adultQty * adultPrice) + (childrenQty * childrenPrice);
                }
            });

            $('#summary_list').html(summary);
            $('#total_price').text(totalPrice.toFixed(2));
        }

        $('.adult-quantity, .children-quantity').on('change', updateSummary);
    });

    function openBookingModal(button, availableTickets) {
        $('#bookingModal').removeClass('hidden');
    }

    function closeBookingModal() {
        $('#bookingModal').addClass('hidden');
    }

    $('#payNowButton').on('click', function (e) {
        e.preventDefault();

        let tickets = [];

        $('.ticket-type').each(function () {
            let type = $(this).find('.adult-quantity').data('type');
            let adultQty = parseInt($(this).find('.adult-quantity').val()) || 0;
            let childrenQty = parseInt($(this).find('.children-quantity').val()) || 0;

            if (adultQty > 0 || childrenQty > 0) {
                tickets.push({ type, adultQty, childrenQty });
            }
        });

        $('#user_name').val($('#user_name_input').val());
        $('#user_email').val($('#user_email_input').val());
        $('#user_phone').val($('#user_phone_input').val());
        $('#tickets_data').val(JSON.stringify(tickets));

        if (!isUserLoggedIn) {
            toastr.error('Please log in to continue.');
            setTimeout(() => {
                window.location.href = '{{ route("user.login") }}';
            }, 4000);
        } else {
            $('#bookingForm').submit();
        }
    });

    function openShareModal() {
        Swal.fire({
            title: '<h3 class="text-lg font-semibold">Share Event</h3>',
            html: `
                <div class="mt-4">
                    <a href="#" onclick="shareToWhatsApp()">WhatsApp</a>
                    <a href="#" onclick="shareToFacebook()">Facebook</a>
                    <a href="#" onclick="shareToTwitter()">Twitter</a>
                    <a href="#" onclick="shareToInstagram()">Instagram</a>
                </div>
            `,
            showCloseButton: true,
            showConfirmButton: false
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('contact-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const slug = document.getElementById('slug').value.trim();
            const module = document.getElementById('module').value.trim();
            const description = document.getElementById('description').value.trim();

            if (!name || !email) {
                toastr.error("Name and Email are required fields.");
                return;
            }

            document.getElementById('loader').classList.remove('hidden');

            fetch("{{ route('enquiry.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ name, email, phone, slug, module, description })
            })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            return response.json().then(data => {
                                let message = data.message || 'Validation error occurred.';
                                throw new Error(message);
                            });
                        }
                        throw new Error('An error occurred while submitting the form.');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('loader').classList.add('hidden');

                    if (data.success) {
                        toastr.success('Form submitted successfully!');
                        document.getElementById('contact-form').reset(); 
                    } else {
                        toastr.error(data.message || 'An error occurred while submitting the form.');
                    }
                })
                .catch(error => {
                    document.getElementById('loader').classList.add('hidden');
                    toastr.error(error.message || 'An unexpected error occurred.');
                });
        });
    });


    function shareToWhatsApp() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://wa.me/?text=${url}`, '_blank');
        toastr.success('Shared to WhatsApp!');
    }

    function shareToFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        toastr.success('Shared to Facebook!');
    }

    function shareToTwitter() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://twitter.com/intent/tweet?url=${url}`, '_blank');
        toastr.success('Shared to Twitter!');
    }

    function shareToInstagram() {
        toastr.info('Instagram sharing is not supported via web. Please share manually.');
    }

    document.querySelector('#shareBtn').addEventListener('click', event => {
        if (navigator.share) {
            navigator.share({
                title: '{{ $event->title }}',
                url: '{{ generateCanonicalUrl() }}'
            }).then(() => {
                console.log('Thanks for sharing!');
            }).catch(err => {
                console.log("Error while using Web share API:", err);
            });
        } else {
            alert("Browser doesn't support this API!");
        }
    });

    </script>

    @endif


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" async defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" async defer></script>
   

    <script src="{{ asset('main_assets/js/uikit.min.js') }}" async defer></script>
    <script src="{{ asset('main_assets/js/simplebar.js') }}" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" async defer></script>
    <script src="{{ asset('main_assets/js/script.js') }}" async defer></script>

    @stack('scripts')

</body>

</html>