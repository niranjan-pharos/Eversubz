@extends('layouts.eventlayout')

@section('title', 'Sabz Future: Innovating Sustainable Solutions | Eversabz')
@section('description', 'Explore Sabz Future at Eversabz: Discover innovative solutions for a sustainable tomorrow. Join
    us in creating a greener, more eco-friendly world.')

@section('content')
    <style>
        .main-section2 {
            background: #f1f5f8 !important;
            padding: 70px 0 70px;
        }

        .form-control {
            height: 40px;
            border-radius: 6px;
            width: 100%;
            background: var(--white);
            border: 1px solid #eeeeee;
        }

        .col-lg-4.col-xl-3 {
            padding: 0px;
        }

        .col-xl-4.col-lg-6.col-md-6 {
            padding: 0px 5px;
            margin-bottom: 1.3rem;
        }

        a {
            color: #000;
        }

        .form-1 {
            padding: 20px 20px 30px 20px;
            background: white;
            border-radius: 10px;
        }

        #signup-form {
            background: white;
            padding: 40px;
            border-radius: 22px;
        }

        .custom-input {
            border-radius: 10px;
            padding: 10px 15px;
            height: 56px;
            font-size: 14px;
            background-color: #fff;
            border: 1px solid #2e6ab3;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #3e8ef7;
            border-color: #3e8ef7;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #227be0;
            border-color: #227be0;
        }


        .register-btn {
            background: linear-gradient(135deg, #2c54a4, #28a745);
            padding: 38px;
            height: 47px;
        }

        .row.justify-content-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Full screen height */
        }

        .position-absolute {
            position: absolute !important;
            right: 12px;
            top: 12px;
            display: none;
        }

        #signup-form h5 {
            font-size: 21px;
        }

        .register-btn {
            background: linear-gradient(135deg, #2c54a4, #28a745);
            padding: 21px 10px 50px 10px;
            width: 100%;
            height: 23px;
            color: white;
        }

        .top-50 {
            top: 50% !important;
        }

        .translate-middle-y {
            transform: translateY(-50%) !important;
        }

        .email_not_verified {
            font-size: 18px;
            color: #dc2626;
            /* red-600 */
            font-weight: 600;
            margin-bottom: 12px;
            text-align: center;
        }

        .verify-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            /* blue gradient */
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: block;
            margin: 0 auto;
        }

        .verify-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            /* darker blue */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        /* Card wrapper */
        .col-md-6.mob-pad-0 {
            max-width: 750px;
            /* Set fixed width */
            width: 100%;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        @media only screen and (max-width: 767px) {

            .mob-pad-0 {
                padding: 0px;
            }

            .filter-button{
                margin-top: 34px !important;
            }

            #filterDropdown{
                width: 300px !important;
            }

            #search---box{
                position: sticky;
            }

            .eversubzsearch{
                width: 100% !important; 
                float: right;
                margin-top: 10% !important;
            }
            .svgClearButton{
                margin-left: 19px !important;
            }

            .mobileviewhidesection{
                display: none !important;
            }

            .page-heading{
                margin-top: -24% !important;
            }

            #signup-form {
                background: white;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 50px;
            }

            .padding-left-50 {
                padding-left: 15px;
                margin-top: 30px;
            }

            .main-section2 {
                padding: 70px 20px 70px;
            }

            .col-xl-4.col-lg-6.col-md-6 {
                padding: 0px 0px;
                margin-bottom: 30px;
            }

            .mob-center {
                text-align: center;

                font-size: 21px;

            }
        }
        .category-ngo-list ul li a {
            font-size: 14px;
            color: #000 !important;
            border-bottom: 1px solid !important
        }

        .category-ngo-list ul {}

        .category-ngo-list ul li {
            margin-top: 10px
        }

        .card-body form{width:100%}.aria-expanded\:text-white[aria-expanded="true"] {
            color: #fff !important
        }

        .line-clamp-1 {
            text-align: left
        }

        .joined-button {
            background: #04b;
            color: #fff;
            cursor: not-allowed
        }

        .card-body.button:hover {
            background: #04b;
            color: #fff
        }

        .joined-button:hover {
            background-color: #6c757d;
            color: #ffffff;
            border-color: #5a6268
        }

        @media only screen and(max-width:767px) {
            .mobile-view-sections {
                display: none !important
            }

            .card-list-info {
                display: block;
                text-align: left
            }
        }
    
        .btn-new-one {
            background: linear-gradient(135deg, #2c54a4, #28a745);
            color: #fff !Important;
            border: 1px solid #2e69b2;
            border-radius: 50px;
            padding: 9px 40px;
            margin: 20px;
            transition: transform .3s ease, box-shadow .3s ease
        }

        .btn-new-one:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2)
        }
    
        @media only screen and (max-width:767px) {
            .mob-text-center {
                text-align: center;
                width: 100%;
                display: block;
            }

            .btn-new-one {
                margin: 8px;
            }
        }

        /* Show More Button */
    .load-more-btn {
        margin: 25px auto 10px;
        padding: 12px 28px;
        background: #0285c7; /* blue → light blue */
        color: white;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.8px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Text slide animation */
    .load-more-btn span {
        display: inline-block;
        transition: transform 0.4s ease;
    }

    /* Hover effect */
    .load-more-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }

    .load-more-btn:hover span {
        transform: translateX(-8px); /* text moves right → left */
    }
    </style>
<section class="main-section2">
    <div class="2xl:max-w-[1220px] max-w-[1065px] mx-auto  mb-10">
        @if (Auth::check())
            @if (Auth::user()->hasVerifiedEmail())
            
                <div class="page-heading">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 mobileviewhidesection">
                        <!-- Left Side -->
                        <div class="w-full lg:w-1/2 text-left mob-text-center">
                            <h1 class="text-2xl sm:text-3xl font-semibold">Organizations</h1>
                        </div>

                        <!-- Right Side -->
                        <div class="w-full lg:w-1/2 flex justify-end lg:justify-end items-center mob-text-center">
                            <a href="#" class="btn-new-one">Register NGO</a>
                        </div>
                    </div>
                <div style="display: flex;">
                    <div class="card eversubzsearch" style="width: 100%;">
                        <div id="search---box" style="display: flex; background-color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20px" height="20px"
                                 class="absolute left-4 top-1/2 -translate-y-1/2 ionicon s-ion-icon"
                                 viewBox="0 0 512 512">
                                <path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 
                                           126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 
                                           174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 
                                           94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 
                                           0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z">
                                </path>
                            </svg>
                            <input id="liveSearchInputForFuture"
                                   type="text"
                                   name="search_term" maxlength="50" autocomplete="off" 
                                   placeholder="Search NGOs, Categories, Campaigns..."
                                   oninput="performSearch()"
                                   class="!pl-10 !pr-10 !font-normal !bg-transparent h-12 !text-sm" style="width: 100%;">
                        </div>
                    </div>

                    <div class="relative filter-button" style="margin-left: 19px;">
                        <button id="filterBtn" 
                                class="flex items-center px-4 py-2 h-12 border border-gray-300 rounded-md text-sm font-medium text-teal-600 hover:bg-teal-50 transition bg-white">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 34.5C18.7958 34.5002 19.559 34.8165 20.1216 35.3794C20.6842 35.9423 21.0002 36.7057 21 37.5015C20.9998 38.2973 20.6835 39.0605 20.1206 39.6231C19.5577 40.1857 18.7943 40.5017 17.9985 40.5015C17.6044 40.5014 17.2143 40.4237 16.8502 40.2728C16.4862 40.1219 16.1554 39.9008 15.8769 39.6221C15.5983 39.3434 15.3773 39.0125 15.2266 38.6484C15.0759 38.2843 14.9984 37.8941 14.9985 37.5C14.9986 37.1059 15.0763 36.7157 15.2272 36.3517C15.3781 35.9877 15.5992 35.6569 15.8779 35.3784C16.1566 35.0998 16.4875 34.8788 16.8516 34.7281C17.2157 34.5774 17.6059 34.4999 18 34.5ZM12.213 39C12.8835 41.58 15.213 43.5 18 43.5C20.787 43.5 23.1165 41.58 23.787 39H42V36H23.787C23.1165 33.42 20.787 31.5 18 31.5C15.213 31.5 12.8835 33.42 12.213 36L6 36V39L12.213 39ZM18 7.5C18.3941 7.5001 18.7843 7.57781 19.1483 7.7287C19.5123 7.8796 19.8431 8.10071 20.1216 8.37943C20.4002 8.65814 20.6212 8.989 20.7719 9.3531C20.9226 9.71721 21.0001 10.1074 21 10.5015C20.9999 10.8956 20.9222 11.2857 20.7713 11.6498C20.6204 12.0138 20.3993 12.3446 20.1206 12.6231C19.8419 12.9017 19.511 13.1227 19.1469 13.2734C18.7828 13.4241 18.3926 13.5016 17.9985 13.5015C17.2027 13.5013 16.4395 13.185 15.8769 12.6221C15.3143 12.0592 14.9983 11.2958 14.9985 10.5C14.9987 9.70415 15.315 8.94098 15.8779 8.37837C16.4408 7.81576 17.2042 7.4998 18 7.5ZM18 16.5C20.787 16.5 23.1165 14.58 23.787 12L42 12V9H23.787C23.1165 6.42 20.787 4.5 18 4.5C15.213 4.5 12.8835 6.42 12.213 9H6V12H12.213C12.8835 14.58 15.213 16.5 18 16.5ZM30 21C30.3941 21.0001 30.7843 21.0778 31.1483 21.2287C31.5123 21.3796 31.8431 21.6007 32.1216 21.8794C32.4002 22.1581 32.6212 22.489 32.7719 22.8531C32.9226 23.2172 33.0001 23.6074 33 24.0015C32.9999 24.3956 32.9222 24.7858 32.7713 25.1498C32.6204 25.5138 32.3993 25.8446 32.1206 26.1231C31.8419 26.4017 31.511 26.6227 31.1469 26.7734C30.7828 26.9241 30.3926 27.0016 29.9985 27.0015C29.2027 27.0013 28.4395 26.685 27.8769 26.1221C27.3143 25.5592 26.9983 24.7958 26.9985 24C26.9987 23.2042 27.315 22.441 27.8779 21.8784C28.4408 21.3158 29.2042 20.9998 30 21ZM30 30C32.787 30 35.1165 28.08 35.787 25.5H42V22.5H35.787C35.1165 19.92 32.787 18 30 18C27.213 18 24.8835 19.92 24.213 22.5H6V25.5H24.213C24.8835 28.08 27.213 30 30 30Z"></path>
                            </svg>
                            Filter
                        </button>


                        <div id="filterDropdown" style="width: 706px; z-index: 1000000;" 
                             class="hidden absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg p-4">
                            <!-- NGO Names -->
                            <h3 class="text-sm font-semibold mb-2">Location</h3>
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                @foreach($locations as $location)
                                    <label>
                                        <input type="checkbox" name="locations[]" value="{{ $location }}" class="mr-2" style="border: 2px solid black;">
                                        {{ $location }}
                                    </label>
                                @endforeach
                            </div>

                            <!-- Categories -->
                            <h3 class="text-sm font-semibold mb-2">Categories</h3>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($categories as $cat)
                                    <label>
                                        <input type="checkbox" name="categories[]" value="{{ $cat }}" class="mr-2"  style="border: 2px solid black;">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>


                    <nav class="nav__underline hidesearchresult">

                        <ul class="group"
                            uk-switcher="connect: #group-tabs ; animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium">

                            <li> <a href="#"> Recents </a> </li>


                        </ul>

                    </nav>

                </div>

                <div class="uk-switcher hidesearchresult" id="group-tabs">

                    <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container px-0">
                            <ul class="-ml-2 uk-slider-items">
                                @foreach ($ngos as $ngo)
                                    <li class="pr-3 lg:w-1/4 md:w-1/3 sm:w-1/2 w-full" uk-scrollspy-class="uk-animation-fade">
                                        <div class="card">
                                            <a
                                                href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                                <div class="card-media h-24">
                                                    <img loading="eager" src="{{ asset('storage/' . $ngo->logo_path) }}"
                                                        alt="{{ $ngo->ngo_name }}">
                                                    <div class="card-overly"></div>
                                                </div>
                                            </a>
                                            <div class="card-body relative z-10">
                                                <a
                                                    href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                                    <h4 class="card-title line-clamp-1">{{ $ngo->ngo_name }}</h4>
                                                </a>
                                                <div class="card-list-info font-normal mt-1">
                                                    <a href="#">{{ $ngo->category->name ?? 'No Category' }}</a>
                                                    <div class="md:block hidden">·</div>
                                                    <div>{{ $ngo->member_count }} members</div>
                                                </div>
                                                <div class="line-clamp-1">{{ $ngo->ngo_city }}, {{ $ngo->ngo_state }}</div>
                                                <div class="flex gap-2">
                                                    @if (auth()->check() && auth()->user()->ngo_id == $ngo->id)
                                                        <button type="button"
                                                            class="button bg-primary text-white flex-1 joined-button"
                                                            disabled>Joined</button>
                                                    @else
                                                    @php
                                                        $encryptedNgoId = encrypt($ngo->id);
                                                    @endphp
                                                    <form id="join-form-{{ $encryptedNgoId }}" 
                                                        action="{{ route('user.join') }}" 
                                                        method="POST" 
                                                        class="join-form">
                                                        @csrf
                                                        <input type="hidden" name="ngo_id" value="{{ $encryptedNgoId }}">
                                                        <button type="button" 
                                                                class="button bg-primary text-white flex-1 join-button" 
                                                                data-ngo-id="{{ $encryptedNgoId }}"
                                                                title="Join NGO">
                                                            Join
                                                        </button>
                                                    </form>
                                                    @endif
                                                    <a href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}"
                                                        class="button bg-secondery !w-auto">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a class="nav-prev mobile-view-sections" href="#" uk-slider-item="previous">
                            <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                        </a>
                        <a class="nav-next mobile-view-sections" href="#" uk-slider-item="next">
                            <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                        </a>
                        <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                        </div>
                    </div>
                </div>

                <div class="sm:my-6 my-3 flex items-center justify-between hidesearchresult">
                    <div>
                        <h2 class="md:text-lg text-base font-semibold text-black"> Discover NGOs and Community Groups </h2>
                        <p class="font-normal text-sm text-gray-500 leading-6"> Browse organizations creating lasting impact across diverse communities.
                        </p>
                    </div>
                </div>


                <div class="hidden relative capitalize font-medium text-sm text-center mt-4 mb-2 hidesearchresult" tabindex="-1"
                    uk-slider="autoplay: true;finite: true">

                    <div class="overflow-hidden uk-slider-container">

                        <ul class="-ml-2 grid-small  uk-slider-items">
                            @foreach ($ngoCategories as $ngoCategorie)
                                <li class="md:w-1/5 sm:w-1/3 w-1/2" uk-scrollspy-class="uk-animation-fade">
                                    <a href="#">
                                        <div class="relative rounded-lg overflow-hidden">
                                            <img loading="eager" src="{{ asset('storage/' . $ngoCategorie->image) }}"
                                                alt="{{ $ngoCategorie->name }} " class="h-36 w-full object-contain">
                                            <div
                                                class="w-full bottom-0 absolute left-0 bg-gradient-to-t from-black/100 pt-10">
                                                <div class="text-white p-5 text-lg leading-3"> {{ $ngoCategorie->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                    <a class="nav-prev mobile-view-sections" href="#" uk-slider-item="previous">
                        <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                    </a>
                    <a class="nav-next mobile-view-sections" href="#" uk-slider-item="next">
                        <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                    </a>

                </div>


                <nav class="category-ngo-list mt-8 mb-6 hidesearchresult">
                    <ul class="grid md:grid-cols-8 grid-cols-3 flex  text-xs text-center text-gray-600 capitalize font-semibold"
                        uk-switcher="connect: #tabs3; animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium">
                        @foreach ($ngoCategories as $category)
                            <li>
                                <a href="#"
                                    class="inline-flex items-center gap-2 py-2.5 px-4 rounded-full aria-expanded:text-white aria-expanded:bg-black">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>



                <div id="tabs3" class="uk-switcher hidesearchresult">
                    @foreach ($ngoCategories as $category)
                        <div>
                            <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-2.5"
                                uk-scrollspy="target: > div; cls: uk-animation-scale-up; delay: 20; repeat: true">

                                {{-- Filter only NGOs where status is 1 --}}
                                @foreach ($category->ngos->where('status', 1) as $ngo)
                                    <div class="card">
                                        <a
                                            href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                            <div class="card-media h-24">
                                                <img src="{{ asset('storage/' . $ngo->logo_path) }}"
                                                    alt="{{ $ngo->ngo_name }}">
                                                <div class="card-overly"></div>
                                            </div>
                                        </a>
                                        <div class="card-body relative z-10">
                                            <a
                                                href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                                <h4 class="card-title line-clamp-1">{{ $ngo->ngo_name }}</h4>
                                            </a>
                                            <div class="card-text mt-1">
                                                <div class="flex items-center flex-wrap space-x-1">
                                                    <a
                                                        href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                                        <span> {{ $ngo->members->count() }} Members
                                                        </span> </a>
                                                </div>
                                                <div class="line-clamp-1">{{ $ngo->ngo_city }}, {{ $ngo->ngo_state }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="sm:my-6 my-3 flex items-center justify-between lg:mt-10 hidesearchresult">
                    <div>
                        <h2 class="md:text-lg text-base font-semibold text-black"> All Campaigns </h2>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-2 gap-3 hidesearchresult" id="donorList">
                    @foreach ($fundraisings as $fundraising)
                        <div class="flex md:items-center space-x-4 p-4 rounded-md box">
                            <div class="sm:w-20 w-14 sm:h-20 h-14 flex-shrink-0 rounded-lg relative">
                                <img loading="eager" src="{{ asset('storage/' . $fundraising->main_image) }}"
                                     class="absolute w-full h-full inset-0 rounded-md object-cover shadow-sm"
                                     alt="fundraising image">
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('fundaraising.show', $fundraising->slug) }}"
                                   class="md:text-lg text-base font-semibold capitalize text-black">
                                    {{ $fundraising->title }}
                                </a>
                                <div class="items-center text-sm font-normal">
                                    <div>For - {{ $fundraising->for }}</div>
                                    <div>Category - {{ $fundraising->category->name ?? '-' }}</div>
                                </div>
                            </div>
                            <a href="{{ route('fundaraising.show', $fundraising->slug) }}"
                               class="button bg-primary-soft text-primary gap-1 max-md:hidden">
                                <ion-icon name="add-circle" class="text-xl -ml-1"></ion-icon> View
                            </a>
                        </div>
                    @endforeach
                </div>


                <div id="showingsearchresult"></div>

    
        @else
            @if (session('status') === 'verification-link-sent')
                <p class="text-green-500">A new verification link has been sent to your email address.</p>
            @endif
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="email_not_verified">Your email address hasn’t been verified yet.</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="text-blue-500 verify-btn">
                            Click here to verify your email
                        </button>
                    </form>
                </div>
            </div>
            @endif
        @else
            <!-- Signup Form for Non-Authenticated or Unverified Users -->
            <div class="row justify-content-center hidesearchresult">
                <div class="col-md-6 mob-pad-0">
                    <form action="{{ route('register') }}" method="POST" id="signup-form">
                        <h5 class="mb-4 mob-center text-center">Please log in to view Sabz Future listings and details.</h5>
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <input type="text" class="form-control custom-input" placeholder="Name" name="name"
                                    required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control custom-input" placeholder="Username" name="username"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control custom-input" placeholder="Business email" name="email"
                                required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control custom-input" placeholder="Password" id="password"
                                name="password" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                                onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control custom-input" placeholder="Confirm Password"
                                id="password_confirmation" name="password_confirmation" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                                onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>

                        <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="signup_check" name="signup_check" required>
                        <label class="form-check-label small" for="signup_check">
                            By creating this account you accept our 
                            <a href="{{ asset('terms-of-use') }}">Terms of Use</a> 
                            and <a href="{{ asset('privacy-policy') }}">Privacy Policy</a>
                        </label>
                    </div>
                        <input type="hidden" name="account_type" value="4">
                        <div class="mb-3">
                            <div id="signup-error" class="text-danger" style="display: none;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 register-btn">
                            Register Now
                            <span class="spinner-border spinner-border-sm" style="display: none;"></span>
                        </button>
                        <p class="text-center mt-3 small">Already have a Account? <a href="{{ route('user.login') }}">Log in</a>
                        </p>
                    </form>
                </div>
            </div>
        @endif
    {{-- end new code --}}
    
    </div>
    
</section>




@endsection

@push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.join-button').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const encryptedNgoId = button.getAttribute('data-ngo-id');
                        const form = document.getElementById(`join-form-${encryptedNgoId}`);
                        console.log(encryptedNgoId); console.log(form);
                        if (confirm('Are you sure you want to join this NGO?')) {
                            form.submit();
                        }
                    });
                });
            });


            document.addEventListener("DOMContentLoaded", function () {
                let loadMoreBtn = document.getElementById("loadMore");
                let donorList   = document.getElementById("donorList");

                if (loadMoreBtn) {
                    loadMoreBtn.addEventListener("click", function () {
                        let nextPage = this.getAttribute("data-next-page");
                        let url      = this.getAttribute("data-url") + "?page=" + nextPage;

                        this.innerText = "Loading...";

                        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                            .then(res => res.json())
                            .then(data => {
                                donorList.insertAdjacentHTML("beforeend", data.html);
                                this.innerText = "Show More";

                                if (data.hasMore) {
                                    this.setAttribute("data-next-page", data.nextPage);
                                } else {
                                    this.style.display = "none";
                                }
                            })
                            .catch(err => console.error(err));
                    });
                }
            });


        </script>
        <script>
            $(document).ready(function() {
                $('#signup-form').on('submit', function(e) {
                    e.preventDefault();

                    const $button = $('#signup-btn');
                    const $loader = $button.find('.spinner-border');
                    const $errorDiv = $('#signup-error');

                    $button.prop('disabled', true);
                    $loader.show();
                    $errorDiv.hide();

                    const formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                $errorDiv.removeClass('text-danger').addClass('text-success').text(
                                    response.message).show();
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 1000);
                            } else {
                                $errorDiv.text(response.message).show();
                                $button.prop('disabled', false);
                                $loader.hide();
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = 'Registration failed. Please try again.';
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                errorMessage = Object.values(errors).flat().join(' ');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            $errorDiv.text(errorMessage).show();
                            $button.prop('disabled', false);
                            $loader.hide();
                        }
                    });
                });

                function togglePassword(fieldId) {
                    const passwordField = $('#' + fieldId);
                    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                    passwordField.attr('type', type);
                    const icon = passwordField.next('span').find('i');
                    icon.toggleClass('fa-eye fa-eye-slash');
                }
            });

            let timeout = null;
            let currentController = null;

            const hideContainers = document.querySelectorAll('.hidesearchresult');
            const showContainer = document.getElementById('showingsearchresult');
            const input = document.getElementById('liveSearchInputForFuture');

            const initialShowClass = showContainer ? showContainer.className : '';
            const initialShowHTML = showContainer ? showContainer.innerHTML : '';
            const initialShowStyle = showContainer ? showContainer.getAttribute('style') : null;
            const originalHideStyles = Array.from(hideContainers).map(el => el.getAttribute('style'));

            let currentSearch = '';
            let currentFilters = {};

            function resetResults() {
                if (!showContainer) return;
                showContainer.innerHTML = '';
                showContainer.className = initialShowClass;
                if (initialShowStyle !== null) showContainer.setAttribute('style', initialShowStyle);
                else showContainer.removeAttribute('style');
            }

            function showOriginal() {
                hideContainers.forEach((el, i) => {
                    const s = originalHideStyles[i];
                    if (s !== null) el.setAttribute('style', s);
                    else el.removeAttribute('style');
                });
            }

            function hideOriginal() {
                hideContainers.forEach(el => el.style.display = 'none');
            }

            function fetchData(params) {
                if (currentController) currentController.abort();
                currentController = new AbortController();

                const url = new URL(window.location.href);
                for (const key in params) {
                    if (Array.isArray(params[key])) {
                        params[key].forEach(v => url.searchParams.append(key + '[]', v));
                    } else {
                        url.searchParams.set(key, params[key]);
                    }
                }

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    signal: currentController.signal
                })
                .then(r => {
                    if (!r.ok) throw new Error('Network response not ok');
                    return r.json();
                })
                .then(data => {
                    currentController = null;
                    hideOriginal();
                    resetResults();
                    if (!showContainer) return;
                    showContainer.innerHTML = data.html;
                    showContainer.style.display = 'block';
                })
                .catch(err => {
                    if (err.name === 'AbortError') return;
                    currentController = null;
                    resetResults();
                    showOriginal();
                    console.error(err);
                });
            }

            function performSearch() {
                if (!input) return;
                clearTimeout(timeout);
                currentSearch = input.value.trim();
                timeout = setTimeout(() => {
                    if (currentSearch === '' && Object.keys(currentFilters).length > 0) {
                        fetchData({ ...currentFilters });
                    } else if (currentSearch !== '') {
                        fetchData({ ...currentFilters, search: currentSearch });
                    } else {
                        resetResults();
                        showOriginal();
                    }
                }, 300);
            }

            function applyFilter() {
                currentFilters = {};
                document.querySelectorAll('#filterDropdown input[type="checkbox"]:checked').forEach(cb => {
                    if (!currentFilters[cb.name]) currentFilters[cb.name] = [];
                    currentFilters[cb.name].push(cb.value);
                });

                if (currentSearch !== '') {
                    fetchData({ ...currentFilters, search: currentSearch });
                } else if (Object.keys(currentFilters).length > 0) {
                    fetchData({ ...currentFilters });
                } else {
                    resetResults();
                    showOriginal();
                }
            }

            function clearSearch() {
                if (input) input.value = '';
                currentSearch = '';
                if (Object.keys(currentFilters).length > 0) {
                    fetchData({ ...currentFilters });
                } else {
                    resetResults();
                    showOriginal();
                }
            }

            function clearAll() {
                if (input) input.value = '';
                currentSearch = '';
                currentFilters = {};
                document.querySelectorAll('#filterDropdown input[type="checkbox"]').forEach(cb => cb.checked = false);
                resetResults();
                showOriginal();
            }

            document.addEventListener('DOMContentLoaded', () => {
                resetResults();
                showOriginal();
                if (input) input.addEventListener('input', performSearch);
                document.querySelectorAll('#filterDropdown input[type="checkbox"]').forEach(cb => {
                    cb.addEventListener('change', applyFilter);
                });
            });

            const filterBtn = document.getElementById("filterBtn");
            const filterDropdown = document.getElementById("filterDropdown");

            filterBtn.addEventListener("click", function (e) {
                e.stopPropagation();
                filterDropdown.classList.toggle("hidden");

                this.classList.toggle("border-green-600");   
                this.classList.toggle("font-bold");          
                this.classList.toggle("text-green-600");    

                this.classList.toggle("text-teal-600");  
            });

            document.addEventListener("click", function (e) {
                if (!filterDropdown.contains(e.target) && !filterBtn.contains(e.target)) {
                    filterDropdown.classList.add("hidden");

                    filterBtn.classList.remove("border-green-600", "font-bold", "text-green-600");
                    filterBtn.classList.add("text-teal-600")
                }
            });
        </script>
    @endpush
