<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="name" content="Eversabz">
    <meta name="type" content="Classified Advertising">
    <meta name="title" content="Eversabz - Classified Ads">
    <meta name="keywords"
        content="classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
    <title>@yield('title', config('app.name'))</title>
    @include('layouts.common-header');
    <meta name="description" content="@yield('description', config('app.description'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom/my_style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <header class="header-part">
        <div class="container">
            <div class="header-content">
                <div class="col-md-2">
                    <div class="header-left">
                        <button type="button" class="header-widget sidebar-btn">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <a href="/" class="header-logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                        </a>



                        <button type="button" class="header-widget search-btn">
                            <i class="fas fa-search"></i>
                        </button>

                        <div class="header-right mobile">
                            <a href="{{ asset ('ad-post') }}" class="header-widget"><i
                                    class="fas fa-plus-circle"></i><span></span></a>
                            <ul class="header-list">
                                <li class="header-item">
                                    <a href="{{ route('wishlist.index') }}" class="header-widget">
                                        <i class="fas fa-heart"></i>
                                        <sup id="wishlistCount">{{ $wishlistCount }}</sup>
                                    </a>
                                </li>



                            </ul>

                            @if(!empty(Auth::user()))

                            <div class="dropdown header-widget">
                                <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown">
                                    @if(!empty(Auth::user()->image))
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                        alt="{{ Auth::user()->username }}">
                                    @else
                                    <img src="{{ asset('assets/images/no-image.jpg') }}"
                                        alt="{{ Auth::user()->username }}">
                                    @endif
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                            alt="{{ Auth::user()->username }}">
                                        <p>{{ Auth::user()->name }} <br>{{ '@' . Auth::user()->username }}</p>
                                    </div>
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="{{ route('dashboard') }}"><i class="fa fa-address-card-o"
                                                aria-hidden="true"></i> &nbsp; Dashboard</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="{{ route('profile') }}"><i class="fa fa-user" aria-hidden="true"></i>
                                            &nbsp; Profile</a></li>
                                    <li role="presentation">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                                &nbsp; Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            @else
                            
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
                            <button type="button" title="Search Option" class="option-btn"><i
                                    class="fas fa-sliders-h"></i></button>
                        </div>
                        <div class="header-option">
                            <div class="option-grid">
                                <div class="option-group">
                                    <input type="text" name="search_city" placeholder="City"
                                        value="{{ request('search_city') }}">
                                </div>
                                <div class="option-group">
                                    <input type="text" name="search_state" placeholder="State"
                                        value="{{ request('search_state') }}">
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
                        <a href="{{ asset ('ad-post') }}" class="header-widget"><i
                                class="fas fa-plus-circle"></i><span></span></a>
                        <ul class="header-list">
                            <li class="header-item">
                                <a href="{{ route('wishlist.index') }}" class="header-widget">
                                    <i class="fas fa-heart"></i>
                                    <sup id="wishlistCount">{{ $wishlistCount }}</sup>
                                </a>
                            </li>

                            {{-- <li class="header-item"><button type="button" class="header-widget"><i
                                        class="fas fa-envelope"></i><sup>0</sup></button>
                                <div class="dropdown-card">
                                    <div class="dropdown-header">
                                        <h5>message (2)</h5><a href="message.html">view all</a>
                                    </div>
                                    <ul class="message-list">
                                        <li class="message-item unread"><a href="message.html" class="message-link">
                                                <div class="message-img active"><img
                                                        src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>miron mahmud <span>now</span></h6>
                                                    <p>How are you my best frien...</p>
                                                </div><span class="message-count">4</span>
                                            </a></li>
                                        <li class="message-item"><a href="message.html" class="message-link">
                                                <div class="message-img active"><img
                                                        src="{{ asset('assets/images/avatar/03.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>shipu ahmed <span>3m</span></h6>
                                                    <p><span>me:</span>How are you my best frien...</p>
                                                </div>
                                            </a></li>
                                        <li class="message-item unread"><a href="message.html" class="message-link">
                                                <div class="message-img"><img
                                                        src="{{ asset('assets/images/avatar/02.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>tahmina bonny <span>2h</span></h6>
                                                    <p>How are you my best frien...</p>
                                                </div><span class="message-count">12</span>
                                            </a></li>
                                        <li class="message-item"><a href="message.html" class="message-link">
                                                <div class="message-img active"><img
                                                        src="{{ asset('assets/images/avatar/04.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>nasrullah <span>5d</span></h6>
                                                    <p>How are you my best frien...</p>
                                                </div>
                                            </a></li>
                                        <li class="message-item"><a href="message.html" class="message-link">
                                                <div class="message-img"><img
                                                        src="{{ asset('assets/images/user.png') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>saikul azam <span>7w</span></h6>
                                                    <p><span>me:</span>How are you my best frien...</p>
                                                </div>
                                            </a></li>
                                        <li class="message-item"><a href="message.html" class="message-link">
                                                <div class="message-img active"><img
                                                        src="{{ asset('assets/images/avatar/02.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>munni akter <span>9m</span></h6>
                                                    <p>How are you my best frien...</p>
                                                </div>
                                            </a></li>
                                        <li class="message-item"><a href="message.html" class="message-link">
                                                <div class="message-img active"><img
                                                        src="{{ asset('assets/images/avatar/03.jpg') }}" alt="avatar">
                                                </div>
                                                <div class="message-text">
                                                    <h6>shahin alam <span>1y</span></h6>
                                                    <p>How are you my best frien...</p>
                                                </div>
                                            </a></li>
                                    </ul>
                                </div>
                            </li> --}}
                            <!-- <li class="header-item"><button type="button" class="header-widget"><i
                                    class="fas fa-bell"></i><sup>0</sup></button>
                            <div class="dropdown-card">
                               <div class="dropdown-header">
                                    <h5>Notification (1)</h5><a href="notification.html">view all</a>
                                </div> 
                                <ul class="notify-list">
                                    <li class="notify-item active"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>miron mahmud</span>has added the
                                                    advertisement post of your <span>booking</span>to his wishlist.</p>
                                                <span class="notify-time">just now</span>
                                            </div>
                                        </a></li>
                                    <li class="notify-item"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/02.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>tahmina bonny</span>gave you a
                                                    <span>comment</span>and 5 star <span>review.</span>
                                                </p><span class="notify-time">2 hours ago</span>
                                            </div>
                                        </a></li>
                                    <li class="notify-item"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/03.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>shipu ahmed</span>and <span>4
                                                        other</span>have seen your contact number</p><span
                                                    class="notify-time">3 minutes ago</span>
                                            </div>
                                        </a></li>
                                    <li class="notify-item"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/02.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>miron mahmud</span>has added the
                                                    advertisement post of your <span>booking</span>to his wishlist.</p>
                                                <span class="notify-time">5 days ago</span>
                                            </div>
                                        </a></li>
                                    <li class="notify-item"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/04.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>labonno khan</span>gave you a
                                                    <span>comment</span>and 5 star <span>review.</span>
                                                </p><span class="notify-time">4 months ago</span>
                                            </div>
                                        </a></li>
                                    <li class="notify-item"><a href="#" class="notify-link">
                                            <div class="notify-img"><img
                                                    src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar"></div>
                                            <div class="notify-content">
                                                <p class="notify-text"><span>azam khan</span>and <span>4
                                                        other</span>have seen your contact number</p><span
                                                    class="notify-time">1 years ago</span>
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </li> -->
                        </ul>

                        @if(!empty(Auth::user()))

                        <div class="dropdown header-widget">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                                data-toggle="dropdown">
                                @if(!empty(Auth::user()->image))
                                <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                    alt="{{ Auth::user()->username }}">
                                @else
                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="{{ Auth::user()->username }}">
                                @endif
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <div class="d-flex">
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                        alt="{{ Auth::user()->username }}">
                                    <p>{{ Auth::user()->name }} <br>{{ '@' . Auth::user()->username }}</p>
                                </div>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                        href="{{ route('dashboard') }}"><i class="fa fa-address-card-o"
                                            aria-hidden="true"></i> &nbsp; Dashboard</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                        href="{{ route('profile') }}"><i class="fa fa-user" aria-hidden="true"></i>
                                        &nbsp; Profile</a></li>
                                <li role="presentation">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        <a href="{{ route('user.login') }}" class="header-widget header-user">
                            <img src="{{ asset('assets/images/icons/user.png') }}" alt="user">

                        </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </header>


    <aside class="sidebar-part">
        <div class="sidebar-body">
            <div class="sidebar-header">

                <button class="sidebar-cross"><i class="fas fa-times"></i></button>
            </div>

            <div class="sidebar-content">
                <div class="sidebar-profile d-none"><a href="#" class="sidebar-avatar"><img
                            src="assets/images/avatar/01.jpg" alt="avatar"></a>
                    <h4><a href="#" class="sidebar-name">Jackon Honson</a></h4><a href="ad-post.html"
                        class="btn btn-inline sidebar-post"><i class="fas fa-plus-circle"></i><span>post
                            your
                            ad</span></a>
                </div>
                <div class="sidebar-menu">
                    <ul class="nav nav-tabs">
                        <!-- <li><a href="#main-menu" class="nav-link active" data-toggle="tab">Main Menu</a></li> -->
                        <!-- <li><a href="#author-menu" class="nav-link" data-toggle="tab">Author Menu</a></li> -->

                        <!-- @auth
                            <li><a href="#author-menu" class="nav-link" data-toggle="tab">Author Menu</a></li>
                            @else -->
                        <!-- If the user is not authenticated, show the login link -->
                        <!-- <a href="{{ route('user.login') }}" class="mobile-widget">
                                  <i class="fas fa-user"></i><span>Join Me</span>
                                 </a> -->
                        <!-- @endauth -->

                    </ul>
                    <div class="tab-pane active" id="main-menu">
                        <ul class="navbar-list">
                            <li class="navbar-item"><a class="navbar-link" href="{{ asset ('/') }}">
                                    <img src="{{ asset('assets/images/icons/home.png') }}" alt="user">
                                    Home</a></li>

                            <li class="navbar-item "><a
                                    class="navbar-link{{ Request::is('category-list') ? ' active' : '' }}"
                                    href="{{ route ('products.category_list') }}"><span>
                                        <img src="{{ asset('assets/images/icons/category-list.png') }}" alt="user">
                                        Category List</span></a>

                            </li>
                            <li class="navbar-item "><a
                                    class="navbar-link{{ Request::is('business') ? ' active' : '' }}"
                                    href="{{ asset ('business/list') }}"><span>
                                        <img src="{{ asset('assets/images/icons/business-list.png') }}" alt="user">
                                        Business List</span></a>
                            </li>

                            <li class="navbar-item "><a
                                    class="navbar-link{{ Request::is('ads-list') ? ' active' : '' }}"
                                    href="{{ route ('adsList') }}"><span>
                                        <img src="{{ asset('assets/images/icons/market.png') }}" alt="user">
                                        Market
                                        Place</span></a>
                            </li>

                            <li class="navbar-item "><a
                                    class="navbar-link{{ Request::is('ads-list') ? ' active' : '' }}"
                                    href="{{ asset ('shop/products') }}"><span>
                                        <img src="{{ asset('assets/images/icons/shop.png') }}" alt="user">
                                        Shop
                                        Now</span></a>

                            </li>
                            <li class="navbar-item "><a
                                    class="navbar-link{{ Request::is('events-list') ? ' active' : '' }}"
                                    href="{{ route ('events.list') }}"><span>
                                        <img src="{{ asset('assets/images/icons/event-2.png') }}" alt="user">
                                        Events
                                        List</span></a>
                            </li>
                            <li class="navbar-item "><a class="navbar-link{{ Request::is('blogs') ? ' active' : '' }}"
                                    href="#"><span>
                                        <img src="{{ asset('assets/images/icons/blog.png') }}" alt="user">
                                        blogs</span></a>

                            </li>



                        </ul>
                        <hr>

                        <ul class="navbar-list">
                            <p class="navbar-link">Pages</p>

                            <li class="navbar-item"><a class="navbar-link{{ Request::is('about-us') ? ' active' : '' }}"
                                    href="{{ asset ('about-us') }}">
                                    <img src="{{ asset('assets/images/icons/aboutus.png') }}" alt="user">
                                    About Us</a>
                            </li>

                            <li class="navbar-item"><a
                                    class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}" href="contactus">
                                    <img src="{{ asset('assets/images/icons/contactus.png') }}" alt="user">
                                    Contact</a></li>
                            <li class="navbar-item"><a
                                    class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                                    href="{{ asset ('terms-and-condition') }}">
                                    <img src="{{ asset('assets/images/icons/terms-condition.png') }}" alt="user">
                                    Terms & Conditions</a></li>
                            <li class="navbar-item"><a
                                    class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                                    href="{{ asset ('privacy-policy') }}">
                                    <img src="{{ asset('assets/images/icons/privacy-policy.png') }}" alt="user">
                                    Privacy
                                    Policy</a></li>


                        </ul>
                    </div>

                </div>
                <div class="sidebar-footer">
                    <hr>
                    <p>&copy; Eversabz 2024. All Rights Reserved.</p>

                </div>
            </div>
        </div>
    </aside>



    <nav class="mobile-nav">
        <div class="container">
            <div class="mobile-group">
                <a href="{{ route ('user.login') }}" class="mobile-widget"><i class="fas fa-home"></i><span>home</span>
                </a>
                @auth
                <a href="{{ asset ('dashboard') }}" class="mobile-widget">
                    <i class="fas fa-user"></i><span>Dashboard</span>
                </a>
                @else
                <!-- If the user is not authenticated, show the login link -->
                <a href="{{ route('user.login') }}" class="mobile-widget">
                    <i class="fas fa-user"></i><span>Join Me</span>
                </a>
                @endauth
                <a href="{{ asset('ad-post/create') }}" class="mobile-widget plus-btn"><i
                        class="fas fa-plus"></i><span>Ad
                        Post</span>
                </a>
                <!-- <a href="" class="mobile-widget"><i
                        class="fas fa-bell"></i><span>notify</span><sup>0</sup>
                    </a> -->
                {{-- <a href="" class="mobile-widget"> --}}
                    <i class="fas fa-envelope"></i><span>message</span><sup>0</sup>
                {{-- </a> --}}
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function () {
            $('.navbar-link').click(function () {
                $('.navbar-link').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>


    <style>
        header {
            z-index: 1;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            z-index: 1000;
            float: left;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.175);
        }

        .dropdown-menu.show {
            display: block;
        }

        .main-z-index {
            z-index: -1;
            position: relative;
            /* Ensure it works with z-index */
        }

        .dropdown-menu.show div {
            border-bottom: 1px solid;
            padding: 10px 0px;
            column-gap: 15px;
        }

        .dropdown-menu.show p {
            font-size: 15px;
        }


        .dropdown-menu.show li i {
            background: none;
            font-size: 15px;
            /* width: auto; */
            height: auto;
            line-height: 30px;
        }

        .header-widget i:hover {
            color: var(--primary);
            background: var(--primary);
            background: var(--chalk);
            text-shadow: var(--primary-tshadow);
        }

        .header-widget .dropdown-toggle {
            border: none;
            padding: 0px 0px 0px 8px;
        }

        .header-widget ul {
            position: absolute;
            transform: translate3d(40px, 31px, 0px);
            top: 10px !important;
            left: -90px !important;
            min-width: 200px;
            will-change: transform;
            padding: 10px !important;
            border: none !important;
            height: auto;
        }

        .header-widget ul li a {
            color: #000;
        }

        .product-meta span {
            font-size: 13px;
            margin-right: 15px;
            white-space: normal;
        }

        .header-fixed .header-widget .dropdown-toggle {
            color: var(--chalk);
        }

        /* Scrollbar for .sidebar-part */
        .sidebar-content::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.3);
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        .sidebar-content::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(255, 255, 255, 0.3);
        }

        .navbar-link {
            font-size: 14px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: left;
        }

        .navbar-link img {
            width: 1.5rem;
            height: auto;
            margin-right: 25px;
        }


        .navbar-item {
            border-bottom: none;
        }

        .navbar-link i {
            font-size: 17px;
            color: #6f7285;
            margin-right: 10px;
        }

        .navbar-list {
            margin-top: 10px;
            padding-left: 10px;
        }

        .navbar-item .active {
            color: #07399c;
            background: #eee;
        }

        .navbar-item .active i {
            color: #07399c;
        }

        .header-right.mobile {
            display: none;
        }

        @media only screen and (max-width: 767px) {
            .header-right.mobile {
                display: flex;
            }

            .header-user {
                display: block;
            }

            .header-widget i {
                background: none;
                width: 25px;
                height: 25px;
            }

            .header-widget sup {
                position: absolute;
                top: -3px;
                right: -8px;
                height: 18px;
                font-size: 7px;
                padding: 0px 6px;
                line-height: 14px;
            }

            .header-content .col-md-2 {
                padding: 0px;
            }

            .header-logo img {
                width: auto;
                height: 45px;
            }

            .header-widget .dropdown-toggle {
                border: none;
                padding: 0px 0px 0px 8px;
                font-size: 12px;
            }

            .header-widget img {
                width: 31px;
                height: 30px;
                border-radius: 50%;
            }
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: normal;
        }

        .header-form {
            margin: 0px 0px 0px 20px;
        }

        .header-logo {
            margin: 0px;
        }
    </style>

    {{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        toastr.error('{{ $error }}');
    </script>
    @endforeach
    @endif --}}


    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif