<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="name" content="Eversabz">
  <meta name="type" content="Classified Advertising">
  <meta name="title" content="Eversabz - Classified Ads">
  <meta name="keywords"
    content="classicadssss, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
  <title>@yield('title', config('app.name'))</title>
  @include('layouts.common-header')
  <meta name="description" content="@yield('description', config('app.description'))">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <link rel="canonical" href="{{ generateCanonicalUrl() }}">

  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon.css') }}" async defer>
  <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.min.css') }}" async defer>
  <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" async defer>
  <link rel="stylesheet" href="{{ asset('assets/css/custom/main.css') }}" async defer>
  <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css') }}" async defer>
  <link rel="stylesheet" href="{{ asset('assets/css/custom/my_style.css') }}" async defer>



  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async defer rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" async defer>


  @stack('style')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <style>
    .sidebar-header h4 {
      font-size: 19px;
      font-weight: 1.75rem
    }

    .sabz-future {
      margin-left: -11px
    }

    .header-right {
      gap: 1rem
    }

    .header-widget.svg1 {
      height: 40px;
      color: #000;
      padding: 5px 2px 5px 10px;
      background-color: #f1f5f9;
      border-radius: 9999px;
      position: relative
    }

    .header-widget.svg1 svg {
      width: 1.25rem
    }

    .header-search input {
      width: 100%;
      height: 45px;
      background: 0 0;
      color: rgb(75 85 99 / var(--tw-text-opacity)) !important;
      font-size: .875rem !important;
      line-height: 1.25rem !important
    }

    .header-right.mobile {
      display: none
    }

    .sidebar-content {
      height: 100vh
    }

    .sidebar-content:hover {
      overflow-y: scroll
    }

    .sidebar-part {
      background: 0 0;
      width: 250px;
    }

    .sidebar-body {
      width: 250px;
      background: #fff;
      box-shadow: 0 0 0 1px rgb(0 0 0 / .1), 0 0 3px rgb(0 0 0 / .2)
    }

    .header-widget .dropdown-toggle {
      border: none;
      padding: 0 0 0 8px
    }

    .header-widget ul {
      position: absolute;
      transform: translate3d(-160px, 30px, 0) !important;
      top: 10px !important;
      min-width: 260px;
      will-change: transform;
      padding: 10px !important;
      border: none !important;
      height: auto;
      left: -40px !important;
      box-shadow: 0 0 1px;
      top: 17px !important
    }

    .header-widget ul h4 {
      font-size: 14px !important
    }

    .header-widget ul li {
      padding: .4rem .625rem;
      font-size: .875rem
    }

    .header-widget ul hr {
      margin-top: .5rem;
      margin-bottom: .5rem
    }

    .dropdown-menu.show .d-flex {
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
      column-gap: 15px;
      margin-bottom: 5px;
      align-items: center
    }

    .dropdown-menu.show p {
      font-size: 15px
    }

    .header-widget ul li a {
      color: #000
    }

    .dropdown-menu.show li i {
      background: 0 0;
      font-size: 15px;
      height: auto;
      line-height: 30px
    }

    .header-widget i:hover {
      color: var(--primary);
      background: var(--primary);
      background: var(--chalk);
      text-shadow: var(--primary-tshadow)
    }

    .product-meta span {
      font-size: 13px;
      margin-right: 15px;
      white-space: normal
    }

    .header-fixed .header-widget .dropdown-toggle {
      color: var(--chalk)
    }

    .sidebar-content::-webkit-scrollbar {
      width: 5px;
      height: 5px
    }

    .sidebar-content::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / .3);
      -webkit-border-radius: 10px;
      border-radius: 10px
    }

    .sidebar-content::-webkit-scrollbar-thumb {
      -webkit-border-radius: 10px;
      border-radius: 10px;
      background: rgb(255 255 255 / .3);
      -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / .5)
    }

    .sidebar-content::-webkit-scrollbar-thumb:window-inactive {
      background: rgb(255 255 255 / .3)
    }

    .navbar-link {
      font-weight: 500;
      font-size: 14px;
      padding: .75rem 1rem;
      display: flex;
      align-items: center;
      justify-content: left;
      text-decoration:none;
    }

    .navbar-link img {
      width: 1.5rem;
      height: auto;
      margin-right: 10px;
      margin-left: 5px;
      width: 35px
    }

    .navbar-item {
      border-bottom: none
    }

    .navbar-link i {
      font-size: 17px;
      color: #6f7285;
      margin-right: 10px
    }

    .navbar-item .active {
      color: #07399c;
      background: #eee
    }

    .navbar-item .active i {
      color: #07399c
    }

    .header-logo img {
      height: 45px
    }

    .header-fixed {
      background: #fff
    }

    .header-logo {
      margin: 0 0 0 5px
    }

    .header-form {
      width: 100%;
      margin: 0 40px
    }

    .header-search {
      border-radius: 8px;
      background: #f1f5f9;
      width: 93%
    }

    .mobile-widget {
      color: #000
    }


    .page-item.active .page-link {
      z-index: 0
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

    .footer-widget li a,
    .footer-info p,
    .footer-count li p {
      color: #bebebe
    }

    .footer-social svg {
      height: auto
    }

    .footer-count li {
      margin-bottom: 30px;
      color: #fff;
      display: flex;
      column-gap: 10px;
    }

    .footer-count li h5 {
      margin-bottom: 3px;
      font-size: 16px;
      letter-spacing: .3px;
      color: #fff !important;
    }

    .header-widget span {
      color: #000;
    }

    .header-fixed .header-widget span {
      color: #000000;
    }

    .header-fixed .header-widget .dropdown-toggle {
      color: #000;
    }

    .dropdown-menu-cart.show {
      min-width: 360px;
      top: 15px !important;
      left: -70px !important;
    }

    .dropdown-menu-cart p {
      color: #000;
      white-space: normal;
      font-size: 14px !important;
      font-weight: 500;
    }

    .dropdown-menu-cart .qty-item1 {
      font-size: 12px !important;
    }

    .dropdown-menu-cart .dropdown-item img {
      margin-right: 20px;
      /* Add space between image and text */
      border-radius: 5px;
      height: 80px !important;
      width: 80px !important;
      object-fit: contain;
    }

    .dropdown-menu-cart .dropdown-item.active,
    .dropdown-menu-cart .dropdown-item:active {
      color: #000;
      text-decoration: none;
      background-color: transparent;
    }

    .dropdown-menu-cart li {
      padding: .4rem .625rem;
      font-size: .875rem;
      display: flex;
      align-items: center;
    }

    .dropdown-menu-cart li button {
      justify-content: end;
      display: flex;
      margin-left: auto;
    }

    .dropdown-item.total-price {
      display: block;
      border-top: 1px solid;
    }

    .dropdown-item.total-price strong {
      display: flex;
      justify-content: space-between;
    }

    .dropdown-menu-cart .dropdown-item.total-price span {
      font-size: 14px
    }

    #menu2::after {
      content: none;
    }

    .dropdown-toggle1 {
      color: #000;
      padding: 5px 10px 5px 10px !important;
      background-color: #f1f5f9;
      border-radius: 9999px;
      position: relative;
      height: 40px;
    }

    .checkout-btns1 {
      display: flex;
      justify-content: space-between;
      margin-top: 0px;
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

    .product-listing-button {
      font-size: 13px;
      align-items: center;
      column-gap: 5px;
      width: 100%;
      justify-content: center;
      text-align: center;
      color: #ffffff;
      background: #1c721c;

      padding: 2px 10px;
      border-radius: 5px;
      border: 1px solid #2d6ab3;
    }

    .product-listing-button:hover {
      color: #fff;
      background: #135013;
    }

    .product-listing-button i {
      font-size: 11px;
    }

    .ad-details-author img {
      width: 50%;
      border-radius: 50%;
      border: 3px solid var(--primary);
    }

    .news-content h2 {
      margin-bottom: 15px;
      color: #fff !important;
      font-size: 30px;
      line-height: 46px;
      font-weight: 700
    }
    .navbar-link:hover{
      padding: .75rem 1rem;
    }

    /* Base pagination */
      .dataTables_wrapper .dataTables_paginate .paginate_button {
          background: transparent !important;
          color: #333 !important;
          padding: 6px 10px;
          margin: 0 2px;
          cursor: pointer;
          border: none !important;
          border-radius: 0 !important;
      }

      /* Hover (grey bg + blue text) */
      .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
          background: #e9ecef !important;
          color: #007bff !important;
      }

      /* Active page */
      .dataTables_wrapper .dataTables_paginate .paginate_button.current {
          background: #007bff !important;
          color: #fff !important;
          font-weight: bold;
      }

      /* Disabled buttons */
      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
          color: #6c757d !important;
          cursor: not-allowed;
          background: transparent !important;
      }

      /* Replace "Previous" with left chevron */
      .dataTables_wrapper .dataTables_paginate .previous a {
          font-size: 0; /* hide text */
      }
      .dataTables_wrapper .dataTables_paginate .previous a::before {
          content: "◀"; /* or use "\f053" with FontAwesome */
          font-size: 14px;
          color: #333;
      }

      /* Replace "Next" with right chevron */
      .dataTables_wrapper .dataTables_paginate .next a {
          font-size: 0; /* hide text */
      }
      .dataTables_wrapper .dataTables_paginate .next a::before {
          content: "▶"; /* or use "\f054" with FontAwesome */
          font-size: 14px;
          color: #333;
      }

      /* Hover effect */
      .dataTables_wrapper .dataTables_paginate .paginate_button:hover::before {
          color: #007bff; /* blue on hover */
      }

      /* Active page */
      .dataTables_wrapper .dataTables_paginate .paginate_button.current {
          background: #007bff !important;
          color: #fff !important;
          font-weight: bold;
      }

      .page-link, .team-card ul li a i {
          width: 25px !important;
          height: 25px !important;
          line-height: 28px !important;
      }

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

      .dropdown-menu-cart .dropdown-item img {
        margin-right: 20px;
        border-radius: 5px;
        height: 55px ! IMPORTANT;
        width: 55px ! IMPORTANT;
        object-fit: fill;
      }

      .checkout-btns1 {
        column-gap: 10px;
      }

      .checkout-btns1 .btn-inline {
        width: 155px;
      }

      .dropdown-menu-cart.show {
        box-shadow: 0px 0px 3px #000;
        min-width: 293px;
        top: 15px !important;
        left: -92px !important;
      }

      .header-part .container {
        padding: 10px
      }

      .header-widget ul {
        top: 8px !important
      }

      .header-widget i,
      .header-widget img {
        width: 35px;
        height: 35px
      }

      .section-body .content-reverse .col-xl-9 nav {
        margin: 0 auto 20px
      }

      .header-search {
        border-radius: 8px;
        background: #f1f5f9;
        width: 100%
      }

      .header-form {
        margin: 10px 0 0
      }

      .header-left {
        width: 100%;
        justify-content: normal
      }

      .header-right.mobile {
        display: flex;
        float: right;
        margin-left: auto;
        display: flex
      }

      .sidebar-content {
        overflow-y: scroll
      }

      .search-btn {
        display: block;
        margin-left: 10px
      }

      .col-md-2 {
        padding: 0
      }

      .header-logo img {
        width: auto;
        height: 45px
      }

      .header-widget .dropdown-toggle {
        border: none;
        padding: 0 0 0 8px;
        font-size: 12px
      }

      .footer-part {
        display: none
      }

      .section-body {
        margin-bottom: 75px !important
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

      .bottom-footer-height {
        height: 7rem
      }

      header {
        position: relative;
        z-index: 9
      }

      .hidden {
        display: none
      }

      .visible {
        display: block
      }
    }
  </style>
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
  <header class="header-part">
    <div class="container">
      <div class="header-content">
        <div class="col-md-2">
          <div class="header-left">
            <button type="button" class="header-widget mobile-menu sidebar-btn">
              <i class="fas fa-align-left"></i>
            </button>
            <a href="/" class="header-logo">
              <img loading="eager" src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </a>


            <div class="header-right mobile">
              <button type="button" class="dropdown-toggle1  search-btn">
                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
                <span></span>
              </button>
              <div class="dropdown header-widget">
                <button class="btn btn-default dropdown-toggle dropdown-toggle1" type="button" id="menu2"
                  data-toggle="dropdown">
                  <svg fill="#000000" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M 5 7 C 4.449219 7 4 7.449219 4 8 C 4 8.550781 4.449219 9 5 9 L 7.21875 9 L 9.84375 19.5 C 10.066406 20.390625 10.863281 21 11.78125 21 L 23.25 21 C 24.152344 21 24.917969 20.402344 25.15625 19.53125 L 27.75 10 L 11 10 L 11.5 12 L 25.15625 12 L 23.25 19 L 11.78125 19 L 9.15625 8.5 C 8.933594 7.609375 8.136719 7 7.21875 7 Z M 22 21 C 20.355469 21 19 22.355469 19 24 C 19 25.644531 20.355469 27 22 27 C 23.644531 27 25 25.644531 25 24 C 25 22.355469 23.644531 21 22 21 Z M 13 21 C 11.355469 21 10 22.355469 10 24 C 10 25.644531 11.355469 27 13 27 C 14.644531 27 16 25.644531 16 24 C 16 22.355469 14.644531 21 13 21 Z M 13 23 C 13.5625 23 14 23.4375 14 24 C 14 24.5625 13.5625 25 13 25 C 12.4375 25 12 24.5625 12 24 C 12 23.4375 12.4375 23 13 23 Z M 22 23 C 22.5625 23 23 23.4375 23 24 C 23 24.5625 22.5625 25 22 25 C 21.4375 25 21 24.5625 21 24 C 21 23.4375 21.4375 23 22 23 Z">
                    </path>
                  </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-cart" role="menu" aria-labelledby="menu2">

                </ul>
              </div>

              @if(!empty(Auth::user()))

              <div class="dropdown header-widget">
                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                  @if(!empty(Auth::user()->image))
                  <img loading="eager" src="{{ asset('storage/'.Auth::user()->image) }}"
                    alt="{{ Auth::user()->username }}">
                  @else
                  <img loading="eager" src="{{ asset('assets/images/user-image1.png') }}"
                    alt="{{ Auth::user()->username }}">
                  @endif
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation">
                    <div class="d-flex">
                      <div>
                        @if(!empty(Auth::user()->image))
                        <img loading="eager" src="{{ asset('storage/'.Auth::user()->image) }}"
                          alt="{{ Auth::user()->username }}">
                        @else
                        <img loading="eager" src="{{ asset('assets/images/user-image1.png') }}"
                          alt="{{ Auth::user()->username }}">
                        @endif
                      </div>
                      <div>
                        <h4 style="font-size:14px;">{{ Auth::user()->name }}
                        </h4>
                        <div style="color:rgb(37 99 235 / 70%);    margin: 0px;font-size: 0.875rem;">
                          {{ '@' . Auth::user()->username }}</div>
                      </div>
                    </div>
                  </li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('dashboard') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" width="24px" height="24px">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z">
                        </path>
                      </svg> &nbsp;My Dashboard</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('profile') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" width="24px" height="24px">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                      </svg>
                      &nbsp; My Account</a>

                  </li>
                  <li role="presentation">
                    <form id="logout-form1" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="button" onclick="this.form.submit()">
                        <svg class="w-6" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                          </path>
                        </svg>
                        &nbsp; Log Out</button>
                    </form>
                  </li>
                </ul>
              </div>

              @else
              <a href="{{ route('user.login') }}" class="header-widget ">
                <img loading="eager" src="{{ asset('assets/images/icons/user.png') }}" alt="user">

              </a>
              @endif

            </div>


          </div>
        </div>

        <div class="col-md-7">
          <form class="header-form" method="GET" action="{{ route('search.header') }}">
            <div class="header-search">
              <button type="submit" title="Search Submit"><i class="fas fa-search"></i></button>
              <input type="text" name="search_term" placeholder="Search, Whatever you needs..."
                value="{{ request('search_term') }}">
                <div id="searchSuggestionBox"></div>

            </div>
            <div class="header-option">
              <div class="option-grid">
                <div class="option-group">
                  <input type="text" name="search_city" placeholder="City" value="{{ request('search_city') }}">
                </div>
                <div class="option-group">
                  <input type="text" name="search_state" placeholder="State" value="{{ request('search_state') }}">
                </div>
                <div class="option-group">
                  <input type="text" name="search_min_price" placeholder="Min Price"
                    value="{{ request('search_min_price') }}">
                </div>
                <div class="option-group">
                  <input type="text" name="search_max_price" placeholder="Max Price"
                    value="{{ request('search_max_price') }}">
                </div>
                <button type="submit"><i class="fas fa-search"></i><span>Search</span></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <div class="header-right">
            @if((Auth::user()))
            <a href="{{ asset('ad-post/create') }}" class="header-widget svg1"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 max-sm:hidden">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
              </svg><span></span>
            </a>
            @endif
            <div class="dropdown header-widget">
              <button class="btn btn-default dropdown-toggle dropdown-toggle1" type="button" id="menu2"
                data-toggle="dropdown">
                <svg fill="#000000" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M 5 7 C 4.449219 7 4 7.449219 4 8 C 4 8.550781 4.449219 9 5 9 L 7.21875 9 L 9.84375 19.5 C 10.066406 20.390625 10.863281 21 11.78125 21 L 23.25 21 C 24.152344 21 24.917969 20.402344 25.15625 19.53125 L 27.75 10 L 11 10 L 11.5 12 L 25.15625 12 L 23.25 19 L 11.78125 19 L 9.15625 8.5 C 8.933594 7.609375 8.136719 7 7.21875 7 Z M 22 21 C 20.355469 21 19 22.355469 19 24 C 19 25.644531 20.355469 27 22 27 C 23.644531 27 25 25.644531 25 24 C 25 22.355469 23.644531 21 22 21 Z M 13 21 C 11.355469 21 10 22.355469 10 24 C 10 25.644531 11.355469 27 13 27 C 14.644531 27 16 25.644531 16 24 C 16 22.355469 14.644531 21 13 21 Z M 13 23 C 13.5625 23 14 23.4375 14 24 C 14 24.5625 13.5625 25 13 25 C 12.4375 25 12 24.5625 12 24 C 12 23.4375 12.4375 23 13 23 Z M 22 23 C 22.5625 23 23 23.4375 23 24 C 23 24.5625 22.5625 25 22 25 C 21.4375 25 21 24.5625 21 24 C 21 23.4375 21.4375 23 22 23 Z">
                  </path>
                </svg>
              </button>
              <ul class="dropdown-menu dropdown-menu-cart" role="menu" aria-labelledby="menu2">
                /* Cart items will be dynamically inserted here */
              </ul>
            </div>

            @if(!empty(Auth::user()))


            <div class="dropdown header-widget">
              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                @if(!empty(Auth::user()->image))
                <img loading="eager" src="{{ asset('storage/'.Auth::user()->image) }}"
                  alt="{{ Auth::user()->username }}">
                @else
                <img loading="eager" src="{{ asset('assets/images/user-image1.png') }}"
                  alt="{{ Auth::user()->username }}">
                @endif
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <div class="d-flex">
                  <div>
                    @if(!empty(Auth::user()->image))
                    <img loading="eager" src="{{ asset('storage/'.Auth::user()->image) }}"
                      alt="{{ Auth::user()->username }}">
                    @else
                    <img loading="eager" src="{{ asset('assets/images/user-image1.png') }}"
                      alt="{{ Auth::user()->username }}">
                    @endif
                  </div>
                  <div>
                    <h4 style="font-size:14px;">{{ Auth::user()->name }}
                    </h4>
                    <div style="color:rgb(37 99 235 / 70%);    margin: 0px;font-size: 0.875rem;">
                      {{ '@' . Auth::user()->username }}</div>
                  </div>
                </div>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('dashboard') }}"><svg
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6" width="24px" height="24px">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z">
                      </path>
                    </svg> &nbsp; My Dashboard</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('profile') }}"><svg
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6" width="24px" height="24px">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                      </path>
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    &nbsp; My Account</a></li>
                <hr>
                <li role="presentation">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"><svg class="w-6" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                      </svg> &nbsp;
                      Log Out</button>
                  </form>
                </li>
              </ul>
            </div>
            @else
            <a href="{{ route('user.login') }}" class="header-widget header-user">
              <img loading="eager" src="{{ asset('assets/images/icons/user.png') }}" alt="user">

            </a>
            @endif

          </div>
        </div>
      </div>
    </div>
  </header>



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
              <li class="navbar-item"><a class="navbar-link" href="{{ asset ('/') }}">
                  <span class="spriticon spriticon-home"></span>
                  Home
                </a></li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('category-list') ? ' active' : '' }}"
                  href="{{ route ('products.category_list') }}">
                  <span class="spriticon spriticon-category"></span>
                  Category List
                </a></li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('business') ? ' active' : '' }}"
                  href="{{ route ('business.list') }}">
                  <span class="spriticon spriticon-business"></span>
                  Business List
                </a></li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('ngo') ? ' active' : '' }}"
                  href="{{ route('ngo.list') }}">
                  <span class="spriticon spriticon-ngo"></span>


                  Sabz-Future
                </a></li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('ads-list') ? ' active' : '' }}"
                  href="{{ route('adsList') }}">
                  <span class="spriticon spriticon-market"></span>
                  MarketPlace
                </a></li>
              <li class="navbar-item"><a class="navbar-link{{ Request::is('shop/products') ? ' active' : '' }}"
                  href="{{ asset('shop/products') }}">
                  <span class="spriticon spriticon-shop"></span>
                  Shop Now
                </a></li>
              <li class="navbar-item"><a class="navbar-link{{ Request::is('ngo-events') ? ' active' : '' }}"
                  href="{{ route('events.list') }}">
                  <span class="spriticon spriticon-event"></span>
                  Events List
                </a></li>



              <li class="navbar-item"><a class="navbar-link{{ Request::is('jobs') ? ' active' : '' }}"
                  href="{{ route ('jobs.list') }}">
                  <span class="spriticon spriticon-business"></span>
                  Jobs List
                </a></li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('candidates') ? ' active' : '' }}"
                  href="{{ route ('candidates.index') }}">
                  <span class="spriticon spriticon-category"></span>
                  Professionals
                </a></li>


              <li class="navbar-item"><a class="navbar-link{{ Request::is('blogs') ? ' active' : '' }}"
                  href="{{ route('blogs') }}">
                  <span class="spriticon spriticon-blog"></span>
                  Blogs
                </a></li>
            </ul>

            <hr>

            <ul class="navbar-list">
              <p class="navbar-link">Quick Links</p>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('about-us') ? ' active' : '' }}"
                  href="{{ asset ('about-us') }}">

                  <span class="spriticon spriticon-about"></span>
                  About Us
                </a>
              </li>

              <li class="navbar-item"><a class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                  href="{{ asset ('contactus') }}">

                  <span class="spriticon spriticon-contact"></span>
                  Contact Us
                </a></li>
              <li class="navbar-item"><a class="navbar-link{{ Request::is('helpcenter') ? ' active' : '' }}"
                  href="{{ route ('helpcenter.list') }}">

                  <span class="spriticon spriticon-contact"></span>
                  Help Center
                </a></li>
              <li class="navbar-item"><a class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                  href="{{ asset ('terms-of-use') }}">

                  <span class="spriticon spriticon-terms"></span>
                  Terms of Use
                </a></li>
              <li class="navbar-item">
                <a class="navbar-link{{ Request::is('privacy-policy') ? ' active' : '' }}"
                  href="{{ route('privacy-policy') }}">
                  <span class="spriticon spriticon-privacy"></span>
                  Privacy Policy
                </a>
              </li>



            </ul>
          </div>

        </div>
        <div class="sidebar-footer">
          <hr>
          <p>&copy; Eversabz 2025.<br> All Rights Reserved.</p>
          <div class="bottom-footer-height"></div>
        </div>
      </div>
    </div>
  </aside>


  <nav class="mobile-nav">
    <div class="container">

      <div class="mobile-group">
        <a href="{{ asset ('/') }}" class="mobile-widget"><svg class="w-5 h-5 text-gray-800" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
          </svg>
          <span>home</span>
        </a>

        <a href="{{ asset('ad-post/create') }}" class="mobile-widget "> <svg class="w-5 h-5 text-gray-800"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 12h14m-7 7V5" />
          </svg>
          <span>Ad
            Post</span>
        </a>
        <a href="{{ route ('adsList') }}" class="mobile-widget "><svg class="w-5 h-5 text-gray-800" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
          </svg>
          <span>Market</span>
        </a>

        <a href="https://eversabz.com/events/events-list" class="mobile-widget ">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M19 4h-1V2h-2v2H8V2H6v2H5C3.9 4 3 4.9 3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zm-7-8h5v5h-5z" />
          </svg>

          <span>Events</span>
        </a>


        <!--  <button type="button" class="mobile-widget  search-btn">
          <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
              d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
          </svg>
          <span>Search</span>
        </button> -->
        <button type="button" class="mobile-widget sidebar-btn">
          <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 6h8M6 10h12M8 14h8M6 18h12" />
          </svg><span>Menu</span>
        </button>



      </div>
    </div>
  </nav>

  @if(Session::has('success'))
  <div class="alert alert-success">
    {{ Session::get('success') }}
  </div>
  @endif
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      $(document).ready(function() {
        @if(session('message'))
          toastr.success("{{ session('message') }}");
        @endif
      });
    </script>

  <script>
document.querySelector('input[name="search_term"]').addEventListener('input', function () {
    const term = this.value.trim();
    const box = document.getElementById('searchSuggestionBox');

   
    if (term.length < 3) {
        box.style.display = 'none';
        box.innerHTML = '';
        return;
    }

    fetch(`{{ route('search.suggest') }}?search_term=${encodeURIComponent(term) }`)
        .then(response => response.text())
        .then(data => {
            box.innerHTML = data;
            box.style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching suggestions:', error);
        });
});
</script>

