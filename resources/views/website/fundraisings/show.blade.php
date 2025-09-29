@extends('layouts.eventlayout')

@section('title', 'Fundraiser Details | Eversabz')
@section('description', 'Welcome to Eversabz')

@section('content')
<style>
    .text-md{
        font-weight: bold;
    }
    #myModal, #myModal1 {
        z-index: 99999999;    background: rgba(0, 0, 0, 0.6);
    }

    .tab-content {
        display: none
    }

    .tab-content.active {
        display: block
    }

    #myModal .custom-width,
    #myModal1 .custom-width {
        width: 33%;    height: 400px;
        overflow-y: scroll;
    }

    #myModal h3 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px
    }

    .dropdown-menu {
        display: none
    }

    .dropdown-menu.show {
        display: block
    }

    .dropdown-menu1 {
        display: none
    }

    .dropdown-menu1.show {
        display: block
    }

    #closeModal,
    #closeModal1 {
        padding: 0 8px;
        height: 30px
    }

    #dropdownButton,
    #dropdownMenu,
    #dropdownMenu button {
        width: 200px
    }

    #dropdownButton1,
    #dropdownMenu1,
    #dropdownMenu1 button {
        width: 200px
    }

    .tabs-buttons .btn-primary {
        background: #2b6db5;
        padding: 10px;
        color: #fff
    }

    .tabs-buttons .btn-secondary-text {
        background: #2b6db554;
        padding: 10px;
        color: #000
    }

    @media only screen and (max-width:767px) {
        #myModal .custom-width {
            width: 95%
        }

          /* Force Top Donors first */
          .top-donors {
            order: 1;
          }

        .button-group-mobile {
            flex-wrap: nowrap !important; /* stay in one line */
          }

          .button-group-mobile > a,
          .button-group-mobile > button {
            flex: 1 1 0% !important;
            max-width: 33.33% !important; /* 3 buttons in one line */
          }

          .button-group-mobile button {
            width: 100% !important;
          }
          /* Force All Donors second */
          .all-donors {
            order: 2;
          }

        .alldonor-amount{
            font-size: 14px !important;
            padding: 8px 16px !important;
            margin-right: 8px !important;
            min-width: 75px !important;
        }

        .alldonor-item {
            padding: 8px 6px 2px 4px !important;
        }

        .alldonor-left {
            gap: 0px !important;
        }

        .alldonor-avatar {
            width: 40px !important;
            height: 40px !important;
        }

        .alldonor-left {
            margin-bottom: 13px !important;
        }

        .alldonor-date {
            font-size: 12px !important;
        }
        .alldonor-name {
            font-size: 14px !important;
        }

        .alldonor-reference {
            font-size: 12px !important;
        }

        .alldonor-message {
            font-size: 12px !important;
        }

        .abouteversbuz {
        max-height: 300px;       /* limit height on mobile */
        overflow-y: auto;        /* enable vertical scroll */
        -webkit-overflow-scrolling: touch; /* smooth scrolling on iOS */
        border-radius: 8px;
        background: #fff;
    }

    .abouteversbuz::-webkit-scrollbar {
        width: 6px;
    }

    .abouteversbuz::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
    }

    .alldonors {
        display: flex;
        flex-direction: column;
        gap: 20px; /* space between rows */
        padding: 10px 0;
    }

    /* Donor row */
    .alldonor-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 15px 6px;
        /*border-radius: 12px;*/
        background: #e0e0e0;
        color: #333;
        /*box-shadow: 0 4px 8px rgba(0,0,0,0.08);*/
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 4px;
    }


    /* Left (avatar + info) */
    .alldonor-left {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    /* Avatar */
    .alldonor-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 12px;
        border: 4px solid #2a6db5; /* Light green broad border */
        box-shadow: 0 2px 6px #2563eb78; /* Soft glow */
    }


    /* Info */
    .alldonor-info {
        display: flex;
        flex-direction: column;
        line-height: 1.4;
    }

    /* Date */
    .alldonor-date {
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }

    /* Reference Number */
    .alldonor-reference {
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }

    /* Name */
    .alldonor-name {
        font-weight: 600;
        font-size: 16px;
        color: #0285c7;
    }

    /* Message */
    .alldonor-message {
        font-size: 13px;
        color: #444;
        margin-top: 3px;
    }

    /* Amount badge (right side) */
    .alldonor-amount {
        font-weight: 700;
        font-size: 16px;
        color: #2f2f2f;
        background: #fff;
        padding: 8px 16px;
        border-radius: 25px;
        min-width: 90px;
        text-align: center;
        margin-left: auto;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        align-self: center;
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

    .abouteversbuz h1{
        background: #fff;
    }
    .abouteversbuz h2{
        background: #fff;
    }

    .abouteversbuz h3{
        background: #fff;
    }

    .abouteversbuz h4{
        background: #fff;
    }

    .abouteversbuz h5{
        background: #fff;
    }

    .abouteversbuz h6{
        background: #fff;
    }

    .abouteversbuz p{
        background: #fff;
    }

    .abouteversbuz span{
        background: #fff;
    }

    .abouteversbuz div{
        background: #fff !important;
    }

    .abouteversbuz li{
        background: #fff !important;
    }

    .abouteversbuz div span p{
        background: #fff;
    }

    .font-semibold.text-xl{
        background: #fff !important;
    }

    .abouteversbuz div.overflow-hidden{
        overflow: visible !important;
    }
</style>
<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 my-3">

    <div class="max-w-[1065px] mx-auto">

        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

            <div class="relative overflow-hidden lg:h-80 h-44 w-full">
                <img loading="eager" src="{{ asset('storage/' . $fundraiser->main_image) }}" alt="main image"
                    class="h-full w-full object-contain inset-0">

                <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from -black/60 pt-10 z-10"></div>

            </div>

            <div class="lg:p-5 p-3 lg:px-10 pb-8">

                <div class="flex flex-col justify-center -mt-20">

                    <div class="relative h-20 w-20 mb-4 z-10">
                        <div
                            class="relative overflow-hidden rounded-full md:border-4 border-gray-100 shrink-0  shadow">
                            <img loading="eager" src="{{ asset('storage/' . $fundraiser->main_image) }}"
                                alt="main image" class="h-full w-full object-contain inset-0">
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col" id="js-oversized">

            <div class="flex-1 space-y-4  all-donors">

                <div class="box p-5 px-6 relative">

                    <h3 class="font-semibold text-lg text-black "> {{ $fundraiser->title }} </h3>

                    @php
                        $goalAmount = $goalAmount ?? 0;
                        $totalRaised = $totalRaised ?? 0;
                        $percent = ($goalAmount > 0) ? min(100, ($totalRaised / $goalAmount) * 100) : 0;
                    @endphp

                    <div class="mt-3">
                        <div class="bg-gray-100 rounded-2xl h-2 w-full relative overflow-hidden">
                            <div class="bg-blue-600 h-full" style="width: {{ $percent }}%;"></div>
                        </div>
                    </div>

                    <h2 class="text-md mt-3 mb-5">
                        {{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($totalRaised, 2) }} Raised of 
                        {{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($goalAmount, 2) }}
                    </h2>

                    <div class="button-group button-group-mobile flex gap-3 flex-wrap md:flex-nowrap mt-3">
                        <a href="{{ route('fundaraising.support', $fundraiser->slug) }}" class="flex-1 md:flex-initial">
                            <button class="button bg-primary text-white text-sm py-2 !px-6 shadow w-full">
                                Support Now
                            </button>
                        </a>

                        @if($fundraiser->category_id == 2)
                            <a href="{{ route('fundaraising.apply', $fundraiser->slug) }}" class="flex-1 md:flex-initial">
                                <button class="button bg-primary text-white text-sm py-2 !px-6 shadow w-full">
                                    Apply Now
                                </button>
                            </a>
                        @endif

                        <button id="shareBtn" class="button bg-secondery text-sm py-2 !px-6 flex-1 md:flex-initial w-full">
                            <i class="fa fa-share-alt"></i>
                        </button>
                    </div>
                </div>

                <div class="box p-5 px-6 relative abouteversbuz">

                    <h3 class="font-semibold text-lg text-black "> About </h3>

                    <div class="space-y-4 leading-7 tracking-wide mt-4 text-black text-sm" style="overflow: visible !important;">
                        <p style="overflow: visible !important;">{!! $fundraiser->fundraising_description !!} </p>
                    </div>

                </div>

                <div class="box p-5 px-6">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">All Donors</h3>
                        </div>
                    
                        <div id="donorList" style="margin-top: 19px;">
                            @foreach($allDonors as $donor)
                                <div class="alldonor-item">
                                    <div class="alldonor-left">
                                        <img src="https://eversabz.com/assets/images/avatar/eversabz-charity.png"
                                             class="alldonor-avatar">
                                        <div>
                                            <div class="alldonor-date">{{ $donor->created_at->format('D, j M Y') }}</div>
                                            <div class="alldonor-name">
                                                {{ $donor->anonymous ? 'Anonymous' : ($donor->user->name ?? 'Unknown') }}
                                            </div>
                                            @if(!empty($donor->donation_number))
                                                <div class="alldonor-reference">Reference No. {{ $donor->donation_number }}</div>
                                            @endif
                                            @if(!empty($donor->message))
                                                <div class="alldonor-message">{{ $donor->message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="alldonor-amount">${{ number_format($donor->amount, 2) }}</div>
                                </div>
                            @endforeach
                        </div>

                        @if ($allDonors->hasMorePages())
                            <div class="text-center mt-4">
                                <button id="loadMore"
                                        class="load-more-btn"
                                        data-next-page="2"
                                        data-url="{{ request()->url() }}">
                                    Show More
                                </button>
                            </div>
                        @endif

                        {{-- JS --}}
                        <script>
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
                </div>
            </div>

            <div class="lg:w-[400px] top-donors">

                <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6"
                    uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                    <div class="hidden box p-5 px-6 pr-0">

                        <h3 class="font-semibold text-lg text-black "> Fundraiser Progress</h3>

                        <div class="grid grid-cols-3 gap-2 text-sm mt-4">
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    162</h3>
                                <p class="mt-0.5">Donated</p>
                            </div>
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    4,6K</h3>
                                <p class="mt-0.5">Invited</p>
                            </div>
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    1,4K</h3>
                                <p class="mt-0.5">Shared</p>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="box p-5 px-6">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base"> Live Donations</h3>
                            <a href="#" class="text-sm text-blue-500" id="openModal">See all</a>
                        </div>
                    
                        <div class="side-list">
                            @foreach ($liveDonations as $donation)
                                <div class="side-list-item">
                                    <img src="https://eversabz.com/assets/images/avatar/eversabz-charity.png" alt="" class="side-list-image rounded-full">
                                    <div class="flex-1">
                                        <h4 class="side-list-title">
                                            @if ($donation->anonymous == 1)
                                                Anonymous
                                            @else
                                                {{ $donation->user->name ?? 'Unknown' }}
                                            @endif
                                        </h4>
                                        <div class="side-list-info">{{ $donation->created_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="">{{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($donation->amount, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <div class="box p-5 px-6" style="margin-top: 2px;">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">Top Donors</h3>
                        </div>
                    
                        <div id="donorList1" style="margin-top: 19px;">
                            @foreach($topDonors as $donor)
                                <div class="alldonor-item">
                                    <div class="alldonor-left">
                                        <img src="https://eversabz.com/assets/images/avatar/eversabz-charity.png"
                                             class="alldonor-avatar">
                                        <div>
                                            <div class="alldonor-date">{{ $donor->created_at->format('D, j M Y') }}</div>
                                            <div class="alldonor-name">
                                                {{ $donor->is_anonymous == 1 ? 'Anonymous' : ($donor->user->name ?? 'Unknown') }}
                                            </div>
                                            <div class="side-list-info">
                                                Reference No. {{ $donor->latest_donation_number }}
                                                <br>
                                                {{-- Show relative donation time --}}
                                                <!-- @if($donor->last_donation_time)
                                                    <span class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($donor->last_donation_time)->diffForHumans() }}
                                                    </span>
                                                @endif -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alldonor-amount">${{ number_format($donor->total_amount, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                </div>
                    
                    <!-- <div class="box p-5 px-6">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">Top Donors</h3>
                        </div>
                    
                        <div class="flex flex-col gap-5">
                            <div class="side-list">
                                @foreach($topDonors as $donor)
                                    <div class="side-list-item">
                                        <img src="https://eversabz.com/assets/images/avatar/eversabz-charity.png" alt="" class="side-list-image rounded-full">
                                        <div class="flex-1">
                                            <h4 class="side-list-title">
                                                @if($donor->is_anonymous == 1)
                                                    Anonymous
                                                @else
                                                    {{ $donor->user->name ?? 'Unknown' }}
                                                @endif
                                            </h4>
                                            <div class="side-list-info">
                                                Reference No. {{ $donor->latest_donation_number }}
                                                <br>
                                                @if($donor->last_donation_time)
                                                    <span class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($donor->last_donation_time)->diffForHumans() }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="">${{ number_format($donor->total_amount, 2) }}</span>
                                    </div>
                                @endforeach


                            </div>
                    
                            {{-- <div class="flex justify-center">
                                <a href="#" class="text-sm text-blue-500" id="showAllRecords">Show all records</a>
                            </div> --}}
                        </div>
                    </div> -->
                    
                    <div class="box p-5 px-6">

                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base"> Campaign Gallery </h3>
                        </div>

                        <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                            uk-slider="autoplay: true;finite: true">

                            <div class="overflow-hidden uk-slider-container">

                                <ul class="uk-slider-items">
                                    @if ($fundraiser->main_image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager"
                                                    src="{{ asset('storage/' . $fundraiser->main_image) }}"
                                                    alt="{{ $fundraiser->title }}"
                                                    class="object-contain w-full h-full inset-0">
                                            </div>
                                        </div>
                                    </li>
                                    @endif

                                    @foreach ($fundraiser->fundraisingImages as $image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}"
                                                    class="object-contain w-full h-full inset-0" alt="details">
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <button type="button"
                                    class="absolute bg-white rounded-full top-16 -left-4 grid w-9 h-9 place-items-center shadow "
                                    uk-slider-item="previous">
                                    <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                                </button>
                                <button type="button"
                                    class="absolute -right-4 bg-white rounded-full top-16 grid w-9 h-9 place-items-center shadow "
                                    uk-slider-item="next">
                                    <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="box p-5 px-6 space-y-4">

                        <h3 class="font-bold text-base text-black"> Created by </h3>

                        <div class="side-list-item">
                            <a href="#">
                                <img loading="eager" src="{{ asset('storage/' . $fundraiser->ngo->logo_path) }}"
                                    alt="user image" class="side-list-image rounded-full">

                            </a>
                            <div class="flex-1">
                                <a href="{{ route('ngo.show', ['id' => $encryptedNgoId]) }}">
                                    <h4 class="side-list-title">
                                        {{ !empty(trim(optional($fundraiser->ngo)->ngo_name)) ? optional($fundraiser->ngo)->ngo_name : 'N/A' }}
                                    </h4>
                                </a>
                                
                                <div class="side-list-info">
                                    @php
                                        $city = trim(optional($fundraiser->ngo)->ngo_city ?? '');
                                        $state = trim(optional($fundraiser->ngo)->ngo_state ?? '');
                                        
                                        $location = '';
                                        if (!empty($city) && !empty($state)) {
                                            $location = $city . ', ' . $state;
                                        } elseif (!empty($city)) {
                                            $location = $city;
                                        } elseif (!empty($state)) {
                                            $location = $state;
                                        } else {
                                            $location = 'N/A';
                                        }
                                    @endphp
                                
                                    {{ $location }}
                                </div>
                                                               
                            </div>
                        </div>

                        <ul class="text-gray-600 space-y-4 text-sm /80">
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" 
                                    viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="2" fill="#f3f4f6" stroke="currentColor"/>
                                    <polyline points="3,7 12,13 21,7" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span class="font-semibold text-black">Contact Email - </span>
                                <span>
                                    @php
                                        $contactEmail = trim(optional($fundraiser->ngo)->contact_email ?? '');
                                    @endphp
                                    {{ !empty($contactEmail) ? $contactEmail : 'N/A' }}
                                </span>
                            </li>
                            
                            
                            <li class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-black">Members</span> {{ $memberCount }} People
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path
                                        d="M19 3h-1V2h-2v1H8V2H6v1H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 0h-4V2h4v1zm-6 0h4V2h-4v1zM5 7h14v12H5V7zm6 3h2v4h-2v-4zm-4 0h2v4H7v-4zm8 0h2v4h-2v-4z"
                                        fill="currentColor" />
                                </svg>
                                <div class="flex gap-4">
                                    <span class="font-semibold text-black">Established - </span>
                                    <p class="text-left">
                                        @if (!empty($fundraiser->ngo) && !empty($fundraiser->ngo->establishment))
                                            {{ $fundraiser->ngo->establishment }}
                                        @else
                                            No Established year available.
                                        @endif
                                    </p>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <!-- <div class="box p-5 px-6 hidden">

                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base"> Related funds</h3>
                            <a href="#" class="text-sm text-blue-500">See all</a>
                        </div>

                        <div>

                            <div class="flex space-x-5 mt-5">
                                <div class="w-28 max-h-ful l h-20 flex-shrink-0 rounded-lg relative">
                                    <img loading="eager"
                                        src="https://eversabz.com/main_assets/images/funding/funder-3.jpg"
                                        class="absolute w-full h-full inset-0 rounded-lg object-cover" alt="funder">
                                </div>
                                <div class="flex-1">
                                    <a href="timeline-group.html"
                                        class="font-medium capitalize line-clamp-2 text-black text-sm ">
                                        Naveen's Boston Marathon Charles River Marathon </a>

                                    <div class="flex items-center gap-2  mt-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="text-yellow-500 w-5">
                                            <path fill-rule="evenodd"
                                                d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-xs text-gray-500"> 421 People donated </p>
                                    </div>

                                    <div class="bg-secondery rounded-2xl h-1 w-full relative overflow-hidden mt-3 .5">
                                        <div class="bg-blue-600 w-1/3 h-full"></div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div> -->

                </div>


            </div>

        </div>

    </div>

</main>
<div id="myModal" class="fixed inset-0  items-center justify-center bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="custom-width bg-white p-4 rounded-lg">
        <div class="flex  justify-between">
            <h3>Live Donations</h3>
            <button id="closeModal" class="bg-blue-500 text-white rounded">X</button>
        </div>

        <div class="flex justify-between gap-3">

            <div class="flex justify-between gap-3 mt-4">
                <div class="flex items-center gap-4">
                    <label for="sortBy" class="text-sm font-bold hidden sm:flex !mb-0 hide-xs">Sort:</label>
                    <div class="relative ">
                        <button id="dropdownButton"
                            class="text-sm font-medium text-neutral-800 -full py-1.5 px-4 border shadow-card border-neutral-300 rounded-lg flex items-center justify-between">
                            <span class="block truncate">Select</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 16 16" class="ml-2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6l4 4 4-4"></path>
                            </svg>
                        </button>
                        <div id="dropdownMenu"
                            class="dropdown-menu absolute right-0 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">A - Z
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Z - A
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Low to
                                High</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">High to
                                Low</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div
            class="side-list flex flex-col gap-3 max-h-[calc(100vh-20rem)] sm:max-h-[calc(100vh-20rem)] overflow-auto pr-4">

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

        </div>

    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');

  
    modal.classList.add('hidden');

    
    openModalBtn.addEventListener('click', function(event) {
        event.preventDefault(); 
        modal.classList.remove('hidden'); 
        modal.classList.add('flex');
    });

    
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden'); 
        modal.classList.remove('flex');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal1');
    const openModalBtn1 = document.getElementById('openModal1');
    const closeModalBtn1 = document.getElementById('closeModal1');

  
    modal.classList.add('hidden');

    
    openModalBtn1.addEventListener('click', function(event) {
        event.preventDefault(); 
        modal.classList.remove('hidden'); 
        modal.classList.add('flex');
    });

    
    closeModalBtn1.addEventListener('click', function() {
        modal.classList.add('hidden'); 
        modal.classList.remove('flex');
    });
});
const dropdownButton = document.getElementById('dropdownButton');
const dropdownMenu = document.getElementById('dropdownMenu');
dropdownButton.addEventListener('click', function() {
    dropdownMenu.classList.toggle('show')
});
window.addEventListener('click', function(event) {
    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove('show')
    }
});
const dropdownButton1 = document.getElementById('dropdownButton1');
const dropdownMenu1 = document.getElementById('dropdownMenu1');
dropdownButton1.addEventListener('click', function() {
    dropdownMenu1.classList.toggle('show')
});
window.addEventListener('click', function(event) {
    if (!dropdownButton1.contains(event.target) && !dropdownMenu1.contains(event.target)) {
        dropdownMenu1.classList.remove('show')
    }
});
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab');
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active')
        });
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-secondary-text')
        });
        document.getElementById(tabId).classList.add('active');
        this.classList.remove('btn-secondary-text');
        this.classList.add('btn-primary')
    })
});
document.querySelector('.tab-btn').click();
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn1');
    const tabContents = document.querySelectorAll('.tab-content1');
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab1');
            tabButtons.forEach(btn => btn.classList.remove('btn-primary'));
            tabButtons.forEach(btn => btn.classList.add('btn-secondary-text'));
            this.classList.add('btn-primary');
            this.classList.remove('btn-secondary-text');
            tabContents.forEach(content => content.style.display = 'none');
            document.getElementById(tabId).style.display = 'block'
        })
    });
    tabButtons[0].click()
})
</script>
<script>
document.querySelector('#shareBtn').addEventListener('click', event => {
    if (navigator.share) {
        navigator.share({
            title: '{{ $fundraiser->title }}',
            url: '{{ generateCanonicalUrl() }}'
        }).then(() => {
            console.log('Thanks for sharing!')
        }).catch(err => {
            console.log("Error while using Web share API:");
            console.log(err)
        })
    } else {
        alert("Browser doesn't support this API !")
    }
})
</script>
@endsection