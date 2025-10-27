@extends('layouts.eventlayout')

@section('title', 'Fundraising')
@section('description', 'Welcome to Eversubz')
@section('canonical', 'https://eversabz.com/')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/css/lightgallery-bundle.min.css" rel="stylesheet">
<style>
    .nav__underline ul {
        gap: 0
    }

    .card-list-media img {
        object-fit: contain
    }

    .nav__underline ul li a {
        padding: 10px !important
    }

    .joined-button {
        background: #04b;
        color: #fff
    }

    .card-body .button:hover {
        background: #04b
    }

    .custom-ngo-description {
        font-family: 'Arial, sans-serif';
        color: #333
    }

    .custom-ngo-description {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center
    }

    .custom-ngo-description div {
        margin: 1em 0;
        line-height: 1.5
    }

    .custom-ngo-description h1,
    .custom-ngo-description h2,
    .custom-ngo-description h3 {
        font-size: 20px;
        margin-top: 1em;
        margin-bottom: .5em;
        color: #222
    }

    .custom-ngo-description img {
        width: 300px;
        height: 200px;
        object-fit: contain;
        border-radius: 8px;
        background: #f9fafb;
        margin: auto
    }

    .custom-ngo-description a {
        color: #007bff;
        text-decoration: underline
    }

    .custom-ngo-description ul,
    .custom-ngo-description ol {
        margin-left: 20px;
        list-style: disc outside none
    }

    .custom-ngo-description table {
        width: 100%;
        border-collapse: collapse
    }

    .custom-ngo-description table,
    .custom-ngo-description th,
    .custom-ngo-description td {
        border: 1px solid #ddd;
        padding: 8px
    }

    .custom-ngo-description th {
        background-color: #f2f2f2;
        color: #333
    }

    .side-list-item img {
        padding: 1px;
        border: 1px solid #bbb;
        object-fit: contain;
    }

    .extra-height-2 {
        height: 100px
    }

    .fl-main-container[data-position$=-right] {
        z-index: 99999999
    }

    .lg-container.lg-show.lg-show-in {
        position: relative;
        z-index: 999999999999;
    }

    .organization-media1 {
        object-fit: contain;
    }

    @media only screen and (max-width:767px) {
        #joinModal .bg-white {
            width: 90%
        }
    }
</style>
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
</style>
<div class="max-w-[1065px] mx-auto">
    @if (Auth::check())
    @if (Auth::user()->hasVerifiedEmail())
    
    <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

        <div class="relative overflow-hidden w-full lg:h-72 h-36">
            <img src="{{ asset('storage/' . $ngo->logo_path) }}" alt="" class="h-full w-full object-contain inset-0"
                style="object-fit: contain;">

            <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from -black/60 pt-10 z-10"></div>

            <div class="hidden absolute bottom-0 right-0 m-4 z-20">
                <div class="flex items-center gap-3">
                    <button
                        class="button bg-white/20 text-white flex items-center gap-2 backdrop-blur-small">Crop</button>
                    <button
                        class="button bg-black/10 text-white flex items-center gap-2 backdrop-blur-small">Edit</button>
                </div>
            </div>

        </div>
        <div class="lg:px-10 md:p-5 p-3">

            <div class="flex flex-col justify-center">

                <div class="flex lg:items-center justify-between max-md:flex-col">

                    <div class="flex-1">
                        <h3 class="md:text-2xl text-base font-bold text-black "> {{ $ngo->ngo_name ?? 'N/A' }}
                        </h3>
                        <p class=" font-normal text-gray-500 mt-2 flex gap-2 flex-wrap /80">
                            <span class="max-lg:hidden"> Public group </span>
                            <span class="max-lg:hidden"> • </span>
                            <span> {{ $ngo->category->name ?? 'N/A' }} </span>
                            <span class="max-lg:hidden"> • </span>
                            <span> <b class="font-medium text-black ">{{ $memberCount ?? 'N/A' }}</b> Members
                            </span>
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mt-1">

                            @if($hasJoined)
                            <button id="openModal"
                                class="button bg-primary flex items-center gap-1 text-white py-2 px-3.5 shadow ml-auto joined-button">
                                <ion-icon name="checkmark-done-outline" class="text-xl"></ion-icon>
                                <span class="text-sm">Joined</span>
                            </button>
                            @else
                            <button id="openModal"
                                class="button bg-primary flex items-center gap-1 text-white py-2 px-3.5 shadow ml-auto">
                                <ion-icon name="add-outline" class="text-xl"></ion-icon>
                                <span class="text-sm">Join</span>
                            </button>
                            @endif

                            <div>
                                <button type="button" class="rounded-lg bg-secondery flex px-2.5 py-2 ">
                                    <ion-icon name="ellipsis-horizontal" class="text-xl">
                                </button>
                                <div class="w-[240px]"
                                    uk-dropdown="pos: bottom-right; animation: uk-animation-scale-up uk-transform-origin-top-right; animate-out: true; mode: click;offset:10">
                                    <nav>
                                        <a href="#">
                                            <ion-icon class="text-xl" name="pricetags-outline"></ion-icon>
                                            Unfollow
                                        </a>

                                        <a type="button" id="shareBtn">
                                            <ion-icon class="text-xl" name="share-outline"></ion-icon>Share
                                        </a>
                                        <a href="#">
                                            <ion-icon class="text-xl" name="link-outline"></ion-icon> Copy link
                                        </a>
                                        <a href="#">
                                            <ion-icon class="text-xl" name="chatbubble-ellipses-outline"></ion-icon>
                                            Sort comments
                                        </a>
                                        <a href="#">
                                            <ion-icon class="text-xl" name="flag-outline"></ion-icon> Report
                                            group
                                        </a>
                                        <hr>
                                        <a href="#" class="text-red-400 hover:!bg-red-50 ">
                                            <ion-icon class="text-xl" name="stop-circle-outline"></ion-icon>
                                            Block
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="flex mt-5 items-center justify-between   px-2">

            <div class="relative border-b overflow-hidden" tabindex="-1" uk-slider="finite: true">
                <nav class="uk-slider-container overflow-hidden nav__underline border-transparent -mb-px">
                    <ul class="uk-slider-items w-[calc(100%+110px)] capitalize text-sm font-medium"
                        uk-switcher="connect: #comp_tab ; animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium">
                        <li class="w-auto pr-2"> <a href="#"
                                class="inline-block px-4 py-2 rounded-lg aria-expanded:bg-sky-100/70 aria-expanded:text-sky-600  aria-expanded:">About
                                Organization</a>
                        </li>
                        <li class="w-auto pr-2"> <a href="#"
                                class="inline-block px-4 py-2 rounded-lg aria-expanded:bg-sky-100/70 aria-expanded:text-sky-600  aria-expanded:">Media</a>
                        </li>
                        <li class="w-auto pr-2"> <a href="#"
                                class="inline-block px-4 py-2 rounded-lg aria-expanded:bg-sky-100/70 aria-expanded:text-sky-600  aria-expanded:">Members</a>
                        </li>
                        <li class="w-auto pr-2"> <a href="#"
                                class="inline-block px-4 py-2 rounded-lg aria-expanded:bg-sky-100/70 aria-expanded:text-sky-600  aria-expanded:">Projects</a>
                        </li>

                        <li class="w-auto pr-2"> <a href="#"
                                class="inline-block px-4 py-2 rounded-lg aria-expanded:bg-sky-100/70 aria-expanded:text-sky-600  aria-expanded:">Events</a>
                        </li>


                    </ul>
                </nav>

            </div>

        </div>

    </div>

    <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col" id="js-oversized">

        <div class="flex-1 xl:space-y-6 space-y-3">
            <div class="uk-switcher mb-5" id="comp_tab">


                <div class="space-y-8">


                    <div class="hidden bg-white rounded-xl shadow-sm p-4 space-y-4 text-sm font-medium border1 ">

                        <div class="flex items-center gap-3">
                            <div class="flex-1 bg-slate-100 hover:bg-opacity-80 transition-all rounded-lg cursor-pointer "
                                uk-toggle="target: #create-status">
                                <div class="py-2.5 text-center "> What do you have in mind? </div>
                            </div>
                            <div class="cursor-pointer hover:bg-opacity-80 p-1 px-1.5 rounded-lg transition-all bg-pink-100/60 hover:bg-pink-100"
                                uk-toggle="target: #create-status">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-pink-600 fill-pink-200/70"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 8h.01" />
                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                    <path d="M3.5 15.5l4.5 -4.5c.928 -.893 2.072 -.893 3 0l5 5" />
                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l2.5 2.5" />
                                </svg>
                            </div>
                            <div class="cursor-pointer hover:bg-opacity-80 p-1 px-1.5 rounded-lg transition-all bg-sky-100/60 hover:bg-sky-100"
                                uk-toggle="target: #create-status">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-sky-600 fill-sky-200/70 "
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                    <path
                                        d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white rounded-xl shadow-sm text-sm font-medium border1" style="--tw-space-y-reverse: 1;">
                        <div class="sm:p-4 p-2.5 border-t border-gray-100 font-normal space-y-3 relative">
                            <h4 class="font-bold text-base">About {{ $ngo->ngo_name ?? 'N/A' }} :</h4>

                            <div class="flex items-start gap-3 relative">
                                <div class="flex-1 custom-ngo-description">

                                    {!! removeInlineStyles($ngo->ngo_description) ?? 'N/A' !!}
                                </div>
                            </div>



                        </div>



                    </div>

                </div>


                <div class="space-y-8">


                    <div class="relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Media
                        </h4>
                        <br>
                        <br>
                        <div id="lightbox-gallery"
                            class="grid grid-cols-2 gap-1 text-center text-sm mt-4 mb-2 rounded-lg overflow-hidden">
                            @foreach($ngo->images as $image)
                            <a href="{{ asset('storage/' . $image->image_path) }}">
                                <div class="relative w-full aspect-[4/3]">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="Image {{ $loop->index }}"
                                        class="object-contain w-full h-full inset-0 organization-media1">
                                </div>
                            </a>
                            @endforeach
                        </div>

                    </div>


                </div>


                <div class="space-y-8">


                    <div class=" relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Members
                        </h4>
                        <br>
                        <br>
                        @if($ngo->user->isEmpty())
                        <div class="p-4 rounded-md">
                            <p>No members have joined this NGO yet.</p>
                        </div>
                        @else
                        @foreach($ngo->user as $users)
                        <div class="grid md:grid-cols-2 md:gap-2 gap-3">


                            <div class="flex md:items-center space-x-4 p-4 rounded-md ">
                                <div class="side-list-item">
                                    @php
                                        $imagePath = 'storage/' . $users->image;
                                    @endphp

                                    @if($users->image && file_exists(public_path($imagePath)))
                                        <img src="{{ asset($imagePath) }}" alt="{{ $users->name }}" class="side-list-image rounded-md">
                                    @else
                                        <img loading="eager" src="{{ asset('public/assets/images/user-image1.png') }}" alt="{{ $users->name }}" class="side-list-image rounded-md">
                                    @endif

                                    <div class="flex-1">
                                        <h4 class="side-list-title">{{ $users->name ?? 'N/A' }} </h4>
                                        <div class="side-list-info">Joined -
                                            {{ \Carbon\Carbon::parse($users->created_at)->format('D M j, Y') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endif





                    </div>


                </div>


                <div class="space-y-8">


                    <div class="relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Projects </h4>
                        <br></br>
                        @if($fundraisings->isNotEmpty())
                        @foreach($fundraisings as $fundraising)
                        <div class="card-list pb-4">
                            <a href="{{ route('fundaraising.show', $fundraising->slug) }}">
                                <div class="card-list-media sm:w-56 sm:h-full">
                                    <img src="{{ asset('storage/' . $fundraising->main_image) }}"
                                        alt="{{ $fundraising->title }}">
                                </div>
                            </a>
                            <div class="card-list-body">
                                <a href="{{ route('fundaraising.show', $fundraising->slug) }}">
                                    <h3 class="card-list-title">{{ $fundraising->title ?? 'N/A' }}</h3>
                                </a>
                                <div class="card-list-text">
                                    <p></p>
                                    <p>
                                        <font color="#000000">
                                            <span
                                                style="font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size: 15px;">
                                                For- {{ $fundraising->for ?? 'N/A' }}<br>
                                                Category- {{ $fundraising->category->name ?? 'N/A' }}
                                            </span><br
                                                style="font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size: 15px;">
                                        </font>
                                    </p>

                                </div>
                                <div class="mt-3">
                                    <div class="text-blue-500 font-medium text-sm mb-2">
                                        <span>{{ number_format($fundraising->donations_sum_amount ?? 0, 2) }}</span> 
                                        <span>of</span> 
                                        <span>{{ number_format($fundraising->amount ?? 0, 2) }}</span> Raised
                                    </div>
                                    @php
                                        $goal = $fundraising->amount ?? 0;
                                        $raised = $fundraising->donations_sum_amount ?? 0;
                                        $percent = ($goal > 0) ? min(100, ($raised / $goal) * 100) : 0;
                                    @endphp
                                    <div class="bg-secondery rounded-2xl h-1 w-full relative overflow-hidden">
                                        <div class="bg-blue-600 h-full" style="width: {{ $percent }}%;"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No fundraising campaigns are currently available.</p>
                        @endif



                    </div>


                </div>


                <div class="space-y-8">


                    <div
                        class=" relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Events
                        </h4>
                        <br><br>

                        @if($events->count() > 0)
                                @foreach ($events as $event)
                                <?php
                                    $now = \Carbon\Carbon::now();
                                    $fromDateTime = \Carbon\Carbon::parse($event->from_date_time);
                                    $toDateTime = \Carbon\Carbon::parse($event->to_date_time);

                                    // Check if the event is ongoing
                                    $isOngoing = $fromDateTime <= $now && $toDateTime > $now;

                                    // Check if the user is interested or going
                                    $userInterested = Auth::check() && isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->interested;
                                    $userGoing = Auth::check() && isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->going;
                                ?>
                            
                                <div class="card-list mt-8" data-event-id="{{ $event->id }}">
                                    <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                        <div class="card-list-media md:w-40 md:h-full w-full h-36">
                                            <img class="lazy-load"
                                                 src="{{ asset('storage/' . $event->main_image) }}"
                                                alt="{{ $event->title }}">
                                        </div>
                                    </a>
                                    <div class="md:flex gap-10 md:items-end flex-1">
                                        <div class="card-list-body">
                                            <p class="text-xs font-medium text-red-600 mb-1">{{ $fromDateTime->format('D M j,Y \A\\T ga') }}</p>
                            
                                            <!-- Display Ongoing Label if the event is ongoing -->
                                            @if ($isOngoing)
                                                <p class="text-xs font-medium text-green-600 mb-1">Ongoing</p>
                                            @endif
                            
                                            <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                                <h3 class="card-list-title text-base line-clamp-1">{{ $event->title }}</h3>
                                            </a>
                                            <p class="text-xs font-medium mb-1 mt-3 text-black">{{ $event->city . ', ' . $event->state }}</p>
                                            <div class="card-list-info text-xs">
                                                <div class="interested-count">{{ $event->interested_count }} Interested</div>
                                                <div class="md:block hidden">·</div>
                                                <div class="going-count">{{ $event->going_count }} Going</div>
                                            </div>
                                        </div>
                                        <!-- <div class="flex items-center gap-2 self-end pt-2 sm:justify-end">
                                            <button type="button" class="button button1 bg-secondery max-sm:flex-1 interested-btn"><ion-icon name="star-outline" class="text-xl md hydrated" role="img" aria-label="star outline"></ion-icon> {{ $userInterested ? 'Uninterested' : 'Interested' }}</button>
                                            <button type="button" class="button button1 bg-secondery max-sm:flex-1 going-btn"><ion-icon name="checkmark-circle-outline" class="text-xl md hydrated" role="img" aria-label="checkmark circle outline"></ion-icon>  {{ $userGoing ? 'Not Going' : 'Going' }}</button>
                                        </div> -->
                                    </div>
                                </div>
                                <hr class="card-list-divider">
                            @endforeach                        
                            @else
                                <p>No events found.</p>
                            @endif



                    </div>




                </div>


                <div class="space-y-8">


                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Modal</h4>



                    </div>





                </div>


                <div class="space-y-8">


                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Lightboxx
                        </h4>



                    </div>




                </div>


                <div class="space-y-8">


                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Basic
                        </h4>



                    </div>



                </div>


                <div class="space-y-8">

                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Navigation
                            In</h4>



                    </div>




                </div>


                <div class="space-y-8">


                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Basic
                        </h4>



                    </div>



                </div>


                <div class="space-y-8">

                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Basic
                        </h4>



                    </div>


                </div>

                <div class="space-y-8">


                    <div
                        class="extra-height-2 relative bg-white border border-slate-200 p-1 rounded-xl shadow-sm overflow-hidden  ">

                        <h4 class="text-lg font-medium text-black  absolute top-4 left-4"> Basic
                        </h4>



                    </div>



                </div>


            </div>

        </div>

        <div class="lg:w-[400px]">

            <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6"
                uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                <div class="box p-5 px-6 font-color-1">

                    <div class="flex items-ce justify-between text-black ">
                        <h3 class="font-bold text-lg font-color-2"> Address </h3>
                    </div>

                    <ul class=" space-y-4 mt-2 mb-1 text-sm ">
                        <li>
                            @php
                                $address = array_filter([
                                    $ngo->ngo_address ?? null,
                                    $ngo->ngo_city ?? null,
                                    $ngo->ngo_state ?? null,
                                    $ngo->ngo_country ?? null,
                                ]);
                                echo $address ? e(implode(', ', $address)) : 'No address available';
                            @endphp
                        </li>
                        

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14h-2v-2h2v2zm0-4h-2V7h2v6zm4 4h-2v-2h2v2zm0-4h-2V7h2v6z"
                                    fill="currentColor" />
                            </svg>
                            <div class="flex gap-4">
                                <span class="font-semibold text-black ">ABN - </span>
                                <p class="text-left">@if ($ngo->abn)
                                    {{ $ngo->abn }}
                                    @else
                                    No ABN available.
                                    @endif</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path
                                    d="M19 3h-1V2h-2v1H8V2H6v1H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 0h-4V2h4v1zm-6 0h4V2h-4v1zM5 7h14v12H5V7zm6 3h2v4h-2v-4zm-4 0h2v4H7v-4zm8 0h2v4h-2v-4z"
                                    fill="currentColor" />
                            </svg>
                            <div class="flex gap-4">
                                <span class="font-semibold text-black ">Established - </span>
                                <p class="text-left">@if ($ngo->establishment)
                                    {{ $ngo->establishment }}
                                    @else
                                    No Established year available.
                                    @endif</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <div><span class="font-semibold text-black "> Members - </span>{{ $memberCount }}
                                People </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 5.25a2.25 2.25 0 012.25-2.25h15a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V5.25zM6 8.25h12M6 12h6m-6 3.75h4.5" />
                            </svg>
                            
                            <div>
                                <span class="font-semibold text-black">ID -</span> {{ $uid }}
                            </div>
                        </li>
                        

                    </ul>

                </div>

                <div class="hidden box p-5 px-6">

                    <div class="flex items-baseline justify-between text-black ">
                        <h3 class="font-bold text-base"> Organization Media </h3>
                    </div>

                    <div class="grid grid-cols-2 gap-1 text-center text-sm mt-4 mb-2 rounded-lg overflow-hidden">
                        @foreach($ngo->images as $image)

                        <div class="relative w-full aspect-[4/3]">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt=""
                                class="object-contain w-full h-full inset-0">
                        </div>
                        @endforeach


                    </div>

                </div>

                <div class="box p-5 px-6">
                    <div class="flex items-baseline justify-between text-black ">
                        <h3 class="font-bold text-base"> Team </h3>
                    </div>
                
                    <div class="side-list">
                        @foreach($ngo->members->slice(0, 5) as $member)
                        <div class="side-list-item">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="" class="side-list-image rounded-md">
                            @else
                                <img loading="eager" src="{{ asset('public/assets/images/user-image1.png') }}"
                                    alt="{{ $member->name }}" class="side-list-image rounded-md">
                            @endif
                            <div class="flex-1">
                                <h4 class="side-list-title"> {{ $member->name}} </h4>
                                <div class="side-list-info"> {{ $member->designation}} </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                


            </div>

        </div>


    </div>
    
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
            <div class="row justify-content-center">
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
</div>

<div class="hidden lg:p-20 uk- open" id="create-status" uk-modal="">

    <div class="uk-modal-dialog tt relative overflow-hidden mx-auto bg-white shadow-xl rounded-lg md:w-[520px] w-full">

        <div class="text-center py-4 border-b mb-0">
            <h2 class="text-sm font-medium text-black"> Create Status </h2>

            <button type="button" class="button-icon absolute top-0 right-0 m-2.5 uk-modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>

        <div class="space-y-5 mt-3 p-2">
            <textarea
                class="w-full !text-black placeholder:!text-black !bg-white !border-transparent focus:!border-transparent focus:!ring-transparent !font-normal !text-xl"
                name="" id="" rows="6" placeholder="What do you have in mind?"></textarea>
        </div>

        <div class="flex items-center gap-2 text-sm py-2 px-4 font-medium flex-wrap">
            <button type="button"
                class="flex items-center gap-1.5 bg-sky-50 text-sky-600 rounded-full py-1 px-2 border-2 border-sky-100">
                <ion-icon name="image" class="text-base"></ion-icon>
                Image
            </button>
            <button type="button"
                class="flex items-center gap-1.5 bg-teal-50 text-teal-600 rounded-full py-1 px-2 border-2 border-teal-100">
                <ion-icon name="videocam" class="text-base"></ion-icon>
                Video
            </button>
            <button type="button"
                class="flex items-center gap-1.5 bg-sky-50 text-sky-600 rounded-full py-1 px-2 border-2 border-sky-100">
                <ion-icon name="happy" class="text-base"></ion-icon>
                Feeling
            </button>
            <button type="button"
                class="flex items-center gap-1.5 bg-red-50 text-red-600 rounded-full py-1 px-2 border-2 border-red-100">
                <ion-icon name="location" class="text-base"></ion-icon>
                Check in
            </button>
            <button type="button" class="grid place-items-center w-8 h-8 text-xl rounded-full bg-secondery">
                <ion-icon name="ellipsis-horizontal"></ion-icon>
            </button>
        </div>

        <div class="p-5 flex justify-between items-center">
            <div>
                <button
                    class="inline-flex items-center py-1 px-2.5 gap-1 font-medium text-sm rounded-full bg-slate-50 border-2 border-slate-100 group aria-expanded:bg-slate-100 aria-expanded:"
                    type="button">
                    Everyone
                    <ion-icon name="chevron-down-outline" class="text-base duration-500 group-aria-expanded:rotate-180">
                    </ion-icon>
                </button>

                <div class="p-2 bg-white rounded-lg shadow-lg text-black font-medium border border-slate-100 w-60"
                    uk-drop="offset:10;pos: bottom-left; reveal-left;animate-out: true; animation: uk-animation-scale-up uk-transform-origin-bottom-left ; mode:click">

                    <form>
                        <label>
                            <input type="radio" name="radio-status" id="monthly1" class="peer appearance-none hidden"
                                checked />
                            <div
                                class=" relative flex items-center justify-between cursor-pointer rounded-md p-2 px-3 hover:bg-secondery peer-checked:[&_.active]:block">
                                <div class="text-sm"> Everyone </div>
                                <ion-icon name="checkmark-circle"
                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl text-blue-600 uk-animation-scale-up">
                                </ion-icon>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="radio-status" id="monthly1" class="peer appearance-none hidden" />
                            <div
                                class=" relative flex items-center justify-between cursor-pointer rounded-md p-2 px-3 hover:bg-secondery peer-checked:[&_.active]:block">
                                <div class="text-sm"> Friends </div>
                                <ion-icon name="checkmark-circle"
                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl text-blue-600 uk-animation-scale-up">
                                </ion-icon>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="radio-status" id="monthly" class="peer appearance-none hidden" />
                            <div
                                class=" relative flex items-center justify-between cursor-pointer rounded-md p-2 px-3 hover:bg-secondery peer-checked:[&_.active]:block">
                                <div class="text-sm"> Only me </div>
                                <ion-icon name="checkmark-circle"
                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl text-blue-600 uk-animation-scale-up">
                                </ion-icon>
                            </div>
                        </label>
                    </form>

                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="button bg-blue-500 text-white py-2 px-12 text-[14px]"> Create</button>
            </div>
        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/zoom/lg-zoom.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lightGallery(document.getElementById('lightbox-gallery'), {
            selector: 'a',
            plugins: [lgZoom, lgThumbnail],
            speed: 500,
            thumbnail: true,
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.getElementById('openModal');
        openModalButton.addEventListener('click', function () {
            const modalHTML = `
            <div id="joinModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Join Us</h2>
                        <button id="closeModal" class="text-black text-xl">&times;</button>
                    </div>
                    @if($joinedNgo)
                    @else
                    <p>Do you want to join {{ $ngo->ngo_name }}?</p>
                    @endif

                    <form id="joinForm" action="{{ route('user.join') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ngo_id" value="{{ $decryptedId }}">
                        <div class=" justify-center">
                            @if($joinedNgo && $joinedNgo != $decryptedId)
                            <p>You are already joined with another NGO. Do you want to leave and join {{ $ngo->ngo_name }} instead?</p>
                            <div class="flex justify-center mt-4">
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded" style="background: red;">Switch NGO</button>
                            </div>
                            @elseif(!$joinedNgo)
                            <button type="submit" class="bg-primary text-white py-2 px-4 rounded justify-center">Join</button>
                            @endif
                        </div>
                    </form>

                    @if($hasJoined && $joinedNgo == $decryptedId)
                    <form id="leaveForm" action="{{ route('user.leave') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ngo_id" value="{{ $joinedNgo }}">
                        <p>You want to leave this {{ $ngo->ngo_name }} NGO</p>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded bg-gray" style="    background: #aaa;">Leave NGO</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            const closeModalButton = document.getElementById('closeModal');
            closeModalButton.addEventListener('click', function () {
                const joinModal = document.getElementById('joinModal');
                joinModal.remove();
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        var elements = document.querySelectorAll('.custom-ngo-description [style]');

        elements.forEach(function (element) { var style = element.getAttribute('style'); if (style && style.indexOf('background-image') === -1) { element.removeAttribute('style') } })
    });

    document.querySelector('#shareBtn').addEventListener('click', event => { if (navigator.share) { navigator.share({ title: '{{ $ngo->ngo_name }}', url: '{{ generateCanonicalUrl() }}' }).then(() => { console.log('Thanks for sharing!') }).catch(err => { console.log("Error while using Web share API:"); console.log(err) }) } else { alert("Browser doesn't support this API !") } })
</script>

@endsection