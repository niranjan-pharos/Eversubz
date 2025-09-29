<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="version" content="{{ config('app.version') }}">

    <link href="{{ asset('main_assets/images/favicon.png')}}" rel="icon" type="image/png">
    @php
    $start=hrtime(true);
    @endphp
    <title>@yield('title', config('app.name'))</title>
    @include('layouts.common-header')
    <meta name="description"
        content="@yield('description', 'A premier online marketplace for a wide array of categories including Electronics, Food & Dining, Entertainment, Sports, Automotive, Fashion & Clothing, Furniture, and much more.')">

    <link rel="canonical" href="{{ generateCanonicalUrl() }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/fontawesome.css') }}" async="async" defer="defer">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('main_assets/css/tailwind_org.css') }}" async="async" defer="defer">
    <link rel="stylesheet" href="{{ asset('main_assets/css/style.css') }}" async="async" defer="defer">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async="async" defer="defer"
        rel="stylesheet" />

<style>
    .spriticoncategory {
        background: url(https://eversabz.com/assets/images/icons/spriticoncategory.png);
        width: 70px;
        height: 70px
    }

    .spriticon-products {
        background-position: -70px 0
    }

    .spriticon-businesses {
        background-position: -140px 0
    }

    .spriticon-events {
        background-position: -210px 0
    }

    .spriticon-ngos {
        background-position: -280px 0
    }

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

    .mobile-serach-bar-box {
        width: 40px;
        height: 40px;
        font-size: 16px;
        background: #f5f5f5;
        padding: 10px;
        border-radius: 50%;
        text-align: center;
        color: #555
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

  

    #wrapper,
    body,
    main {
        display: flex
    }

    .btn.btn-inline,
    .wishlistButton.fas {
        background: #04b;
        color: #fff
    }

    .fa {
        font-size: 20px
    }

    .card-title {
        font-size: .875rem;
        line-height: 1.5rem
    }

    .page-heading {
        display: flex;
        justify-content: space-between
    }

    .btn.btn-inline {
        padding: 2px 10px 0 3px;
        line-height: 28px;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        font-size: 13px;
        border-color: #04b
    }

    .category-images {
        width: 50px
    }

    .site__sidebar.mobile {}

    body {
        flex-direction: column
    }

    .top-users-images {
        inset: 0;
        z-index: 1;
        height: 40px !important;
        border: 1px solid;
        -o-object-fit: contain;
        object-fit: contain;
        border-radius: 50%;
        width: 40px !important
    }

    #wrapper {
        flex: 1;
        flex-direction: column
    }

    main {
        flex: 1;
        height: 100vh;
        padding-bottom: 50px;
        margin-top: 90px
    }

    .desktop-view-sections {
        display: none !important
    }

 

    .card-media img {
        background: #fff
    }

    .fl-main-container.fl-no-cache {
        z-index: 99999999
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
    #side a:hover {
        padding: .75rem .5rem;
        gap: 1rem;
    }
    #site__sidebar{
        background:white;
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

    .news-form,
    footer {
        position: relative
    }

    .footer-end-content p a:hover,
    .footer-widget li a:hover {
        text-decoration: underline
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
        padding: 0 200px 0 20px;
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
.simplebar-content{
    padding:0px;
}

    .simplebar-content div {
        padding-left: 20px;
        font-size: 14px;
        line-height: 25px
    }

    ;

    .fa,
    .fab,
    .fad,
    .fal,
    .far,
    .fas {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1
    }

    ;


    .lazy-load {
        background: #eee !important;
    }

    .lazy-load::after {
        display: flex;
        content: "Loading...";
        justify-content: center;
        align-items: center;

    }

    .lazy-load::before {
        content: 'Loading...';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        color: #555;
        z-index: 2;
        pointer-events: none;
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
    .profile-image-section{}
    .profile-image-section img{height: 40px}
    .card-media1.media-image1 img{height: 150px; margin: auto;}
    .featured-products-view-sections1{ left: -13px;
                    top: 58%;
                    z-index: 9;
                    padding-top: 4px;}
    .featured-products-view-sections2{ right: -13px;
                    top: 58%;
                    z-index: 9;
                    padding-top: 4px;}
    header{background: #fff;}

        @media only screen and (max-width:767px) {
            #dropdownMenu {
        width: 330px;
        right: -40px;}
        #dropdownMenu li img {
        margin-right: 20px;
        border-radius: 5px;
        height: 55px;
        width: 55px;
    }
    .checkout-btns1{column-gap: 20px;}
        .bottom-footer-height {
            height: 10rem
        }

        .sidebar-inner {
            padding-bottom: 6rem
        }

        .mobile-nav {
            display: block
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

        .mobile-widget.search-btn {
            display: flex
        }

        .tab-toggle-button {
            display: none !important;
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

        .mobile-widget svg {
            z-index: 999999999999999
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

        main {
            margin-bottom: 80px
        }

        .footer-part {
            display: none
        }

        .spriticon {
            margin-right: 10px
        }
   
        .desktop-view-sections {
            display: grid
        }

        main {
            display: block;
            padding: 25px 20px;
            margin-top: 60px
        }

        .right-sidebar-1 {
            margin-top: 50px;
            border-top: 2px solid #ddd;
            padding-top: 30px
        }

        .site__sidebar.desktop {
            display: none
        }

        .site__sidebar.mobile {
            display: block
        }

        .desktop-view-sections {
            display: grid !important
        }

        .mobile-view-sections1 {
            display: none !important
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

    
   

    @media (min-width: 1280px) {
        .site__sidebar.mobile {
            display: none;
        }
    }

    @media (min-width:768px) and (max-width:1023px) {
        .sm\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            display: grid;
        }
    }
    </style>
</head>

<body>

    <div id="wrapper">

        @include('partials.header')

        @yield('content')

        @include('partials.footer')

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="text/javascript" language="JavaScript"></script>
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
   document.addEventListener('DOMContentLoaded',function(){const lazyImages=document.querySelectorAll('img.lazy-load');if('IntersectionObserver' in window){let lazyImageObserver=new IntersectionObserver(function(entries,observer){entries.forEach(function(entry){if(entry.isIntersecting){let img=entry.target;const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='{{ asset("storage/no-image.jpg") }}'},img.classList.remove('lazy-load'),lazyImageObserver.unobserve(img)}})});lazyImages.forEach(function(img){lazyImageObserver.observe(img)})}else lazyImages.forEach(function(img){const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='{{ asset("storage/no-image.jpg") }}'},img.classList.remove('lazy-load')})})
    </script>
    <script>
$(document).ready(function(){let storedAdId=localStorage.getItem('wishlistProductId');if(storedAdId){let wishlistButton=$(`.wishlistButton[data-ad-id='${storedAdId}']`);if(wishlistButton.length){wishlistButton.click()}localStorage.removeItem('wishlistProductId')}$('.wishlistButton').off('click').on('click',function(e){e.preventDefault();const $button=$(this);const wishableId=$button.data('wishable-id');const wishableType=$button.data('wishable-type');let isInWishlist=$button.hasClass('fas');const actionUrl=isInWishlist?'/wishlist/remove':'/wishlist/add';const ajaxMethod=isInWishlist?'DELETE':'POST';$.ajax({url:actionUrl,type:ajaxMethod,data:{_token:$('meta[name="csrf-token"]').attr('content'),wishable_id:wishableId,wishable_type:wishableType,},success:function(response){if(isInWishlist){$button.removeClass('fas').addClass('far')}else{$button.removeClass('far').addClass('fas')}isInWishlist=!isInWishlist;displayToastr(response.message,'success');updateWishlistCount()},error:function(xhr){if(xhr.status===401){localStorage.setItem('wishlistProductId',wishableId);displayToastr('You must be logged in','warning');setTimeout(function(){window.location.href=`/login?redirect=${encodeURIComponent(window.location.href)}`},3000)}else{let errorMsg=xhr.responseJSON&&xhr.responseJSON.message?xhr.responseJSON.message:"An error occurred";displayToastr(errorMsg,'error')}}})});function displayToastr(message,type){if(type==='success'){toastr.success(message)}else if(type==='error'){toastr.error(message)}else if(type==='warning'){toastr.warning(message)}else if(type==='info'){toastr.info(message)}}function updateWishlistCount(){$.ajax({url:'/wishlist/count',type:'GET',success:function(response){$('#wishlistCount').text(response.count)}})}});
document.addEventListener('DOMContentLoaded',function(){document.getElementById('newsletterForm').addEventListener('submit',function(event){event.preventDefault();var emailInput=document.getElementById('email').value.trim();console.log('Email Input:',emailInput);if(emailInput===''){toastr.error('Please enter your email address.');return}
var formData=new FormData(this);fetch('{{ route("newsletter-form.submit") }}',{method:'POST',body:formData,headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(response=>{if(!response.ok){throw new Error('Network response was not ok')}
return response.json()}).then(data=>{toastr.success(data.message);this.reset()}).catch(error=>{toastr.error('Email ID already exists.')})})})
    </script>
    <script>
  document.addEventListener('DOMContentLoaded',function(){var toggleButton=document.getElementById('toggle-button1');var menuIcon=document.getElementById('menu-icon');var closeIcon=document.getElementById('close-icon');var sidebar=document.getElementById('site__sidebar');toggleButton.addEventListener('click',function(){sidebar.classList.toggle('hidden');sidebar.classList.toggle('!-translate-x-0');if (menuIcon && closeIcon) {
menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
}})})
    </script>
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggle-button');
    var sidebar = document.getElementById('site__sidebar');

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('!-translate-x-0');
    });
});
    </script>
  
   
    <script src="{{ asset('main_assets/js/uikit.min.js') }}" async defer></script>
    <script src="{{ asset('main_assets/js/simplebar.js') }}" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" async defer></script>



    @include('layouts.common-footer')


</body>

</html>