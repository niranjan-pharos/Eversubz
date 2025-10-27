@extends('layouts.eventlayout')

@section('title', 'Donation Details | Eversabz')
@section('description', 'Welcome to Eversabz')

@section('content')
<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 my-3">

    <div class="max-w-[1065px] mx-auto">

        <!-- Main Card -->
        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

            <div class="relative overflow-hidden lg:h-80 h-44 w-full">
                <img loading="eager" src="{{ asset('storage/' . $donationPackages->image) }}" alt="main image"
                    class="w-full h-full object-cover" style="object-fit: contain"> <!-- use object-cover instead of object-contain -->

                <div class="absolute bottom-0 left-0 w-full h-1/3 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            </div>


            <div class="lg:p-5 p-3 lg:px-10 pb-8">

                <div class="flex flex-col justify-center -mt-20">

                    <div class="relative h-20 w-20 mb-4 z-10">
                        <div
                            class="relative overflow-hidden rounded-full md:border-4 border-gray-100 shrink-0  shadow">
                            <img loading="eager" src="{{ asset('storage/' . $donationPackages->image) }}"
                                alt="main image" class="h-full w-full object-contain inset-0">
                        </div>
                    </div>

                </div>
                <h3 class="text-xl font-semibold mb-2" style="text-align: center">{{ $donationPackages->name }}</h3>

            </div>


        </div>
        <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col">
            <div class="flex-1 space-y-4 all-donors">

        <!-- Donation Card -->
            <div class="box p-5 px-6 relative">
                <h2 class="text-green-600 text-lg font-semibold mb-4">
                    Price - <span style="color:#038107">{{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($donationPackages->price, 2) }}</span>
                </h2>

                <!-- Quantity Counter -->
                <div class="flex items-center gap-4 mb-4">
                    <span class="font-medium">Quantity:</span>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                        <button id="minusBtn"
                            class="w-10 h-10 bg-white-100 hover:bg-blue-500 hover:text-black transition text-lg font-bold">−</button>
                        <input type="text" id="quantityInput" value="1" readonly
                            class="w-16 text-center font-semibold text-gray-700 outline-none">
                        <button id="plusBtn"
                            class="w-10 h-10 bg-white-100 hover:bg-blue-500 hover:text-black transition text-lg font-bold">+</button>
                    </div>
                </div>

                <!-- Total Price -->
                <div class="mb-4 text-lg">
                    <span class="font-medium">Total: </span>
                    <span id="totalPrice" class="text-blue-600 font-semibold">
                        {{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($donationPackages->price, 2) }}
                    </span>
                </div>

                <!-- User ID Switch -->
                <div class="mb-4" id="omidIdSection">
                    <div class="flex items-center gap-4 mb-3">
                        <span class="font-medium">Does the person have a User ID?</span>
                        <div class="flex border rounded-lg overflow-hidden shadow-sm">
                            <button id="omidYes" class="flex-1 py-2 text-sm transition" style="width: 100px">Yes</button>
                            <button id="omidNo" class="flex-1 py-2 text-sm bg-blue-500 text-white transition">No</button>
                        </div>
                    </div>

                    <!-- Search Field -->
                    <div id="userSearchField" class="hidden mt-3">
                        <div class="relative">
                            <input type="text" id="userSearchInput"
                                class="w-full border border-gray-300 rounded-lg py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Search User ID">
                            <i class="fa fa-search absolute right-3 top-1/2 -translate-y-1/2 text-blue-500"></i>
                        </div>

                        <ul id="userSearchResults" style="max-width: 400px;" 
                            class="absolute w-full bg-white border border-gray-200 rounded-lg mt-1 max-h-52 overflow-y-auto hidden z-50"></ul>

                        <div id="selectedUser" class="mt-3"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 flex-wrap">
                    <a id="paymentLink" href="{{ route('donation.support', ['id' => $encryptedId, 'price' => $donationPackages->price]) }}"
                        class="flex-1">
                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Payment Now
                        </button>
                    </a>
                </div>
            </div>

        <div class="mb-8 bg-white my-4  py-4 px-4 rounded-lg flex justify-between box p-5 px-6 relative"><p class="font-semibold text-black" style="margin-top: 7px;"><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Share</p><div class="-mt-4 sm:mt-0"><div class="flex flex-row flex-nowrap items-centerjustify-start &quot; } "><div><div class="relative cursor-pointer w-10 h-10 bg-[#f2f2f2] border hover:bg-white transition duration-300  mobile:mt-[1rem] tablet:mt-0 rounded-md py-1 px-2 mr-1 flex justify-center items-center"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 22.75 11.432"><g id="Icon_feather-link-2" data-name="Icon feather-link-2" transform="translate(1 1)"><path id="Path_889" data-name="Path 889" d="M14.7,10.5h2.829a4.716,4.716,0,1,1,0,9.432H14.7m-5.659,0H6.216a4.716,4.716,0,1,1,0-9.432H9.045" transform="translate(-1.5 -10.5)" fill="none" stroke="#3295ca" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><path id="Path_890" data-name="Path 890" d="M12,18H22.375" transform="translate(-6.813 -13.284)" fill="none" stroke="#3295ca" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></g></svg></div></div><button aria-label="facebook" class="react-share__ShareButton" style="background-color:transparent;border:none;padding:0;font:inherit;color:inherit;cursor:pointer"><div class="w-10 h-10 bg-[#f2f2f2] border hover:bg-white transition duration-300 mobile:mt-[1rem] tablet:mt-0 rounded-md py-[7px] px-2 mr-1 flex justify-center items-center"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 11.001 22"><path id="facebook" d="M15.179,3.653h2.008V.155A25.934,25.934,0,0,0,14.262,0c-2.9,0-4.879,1.821-4.879,5.169V8.25h-3.2v3.91h3.2V22H13.3V12.161h3.066l.487-3.91H13.3V5.557c0-1.13.305-1.9,1.88-1.9Z" transform="translate(-6.187)" fill="#4267b2"></path></svg></div></button><button aria-label="twitter" class="react-share__ShareButton" style="background-color:transparent;border:none;padding:0;font:inherit;color:inherit;cursor:pointer"><div class="w-10 h-10 bg-[#f2f2f2] border hover:bg-white transition duration-300 mobile:mt-[1rem] tablet:mt-0 rounded-md mr-1 flex justify-center items-center"><svg width="35" height="35" viewBox="0 0 40 40" fill="#fff" xmlns="http://www.w3.org/2000/svg"><path d="M32.8568 0H7.14316C3.1981 0 0 3.1981 0 7.14316V32.8568C0 36.8019 3.1981 40 7.14316 40H32.8568C36.8019 40 40 36.8019 40 32.8568V7.14316C40 3.1981 36.8019 0 32.8568 0Z" fill="none"></path><path d="M10.0488 10L17.7713 21.0326L10 30H11.75L18.5518 22.1466L24.0488 30H30L21.8445 18.3485L29.0762 10H27.3293L21.064 17.2313L16.003 10H10.0488ZM12.622 11.3746H15.3567L27.4299 28.6221H24.6951L12.622 11.3746Z" fill="#252525"></path></svg></div></button><button aria-label="telegram" class="react-share__ShareButton" style="background-color:transparent;border:none;padding:0;font:inherit;color:inherit;cursor:pointer"><div class="w-10 h-10 bg-[#f2f2f2] border hover:bg-white transition duration-300 mobile:mt-[1rem] tablet:mt-0 rounded-md mr-1 flex justify-center items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30"><linearGradient id="BiF7D16UlC0RZ_VqXJHnXa" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><path fill="#1b9ce2" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path><path d="M10.119,23.466c8.155-3.695,17.733-7.704,19.208-8.284c3.252-1.279,4.67,0.028,4.448,2.113 c-0.273,2.555-1.567,9.99-2.363,15.317c-0.466,3.117-2.154,4.072-4.059,2.863c-1.445-0.917-6.413-4.17-7.72-5.282 c-0.891-0.758-1.512-1.608-0.88-2.474c0.185-0.253,0.658-0.763,0.921-1.017c1.319-1.278,1.141-1.553-0.454-0.412 c-0.19,0.136-1.292,0.935-1.745,1.237c-1.11,0.74-2.131,0.78-3.862,0.192c-1.416-0.481-2.776-0.852-3.634-1.223 C8.794,25.983,8.34,24.272,10.119,23.466z" opacity=".05"></path><path d="M10.836,23.591c7.572-3.385,16.884-7.264,18.246-7.813c3.264-1.318,4.465-0.536,4.114,2.011 c-0.326,2.358-1.483,9.654-2.294,14.545c-0.478,2.879-1.874,3.513-3.692,2.337c-1.139-0.734-5.723-3.754-6.835-4.633 c-0.86-0.679-1.751-1.463-0.71-2.598c0.348-0.379,2.27-2.234,3.707-3.614c0.833-0.801,0.536-1.196-0.469-0.508 c-1.843,1.263-4.858,3.262-5.396,3.625c-1.025,0.69-1.988,0.856-3.664,0.329c-1.321-0.416-2.597-0.819-3.262-1.078 C9.095,25.618,9.075,24.378,10.836,23.591z" opacity=".07"></path><path fill="#fff" d="M11.553,23.717c6.99-3.075,16.035-6.824,17.284-7.343c3.275-1.358,4.28-1.098,3.779,1.91 c-0.36,2.162-1.398,9.319-2.226,13.774c-0.491,2.642-1.593,2.955-3.325,1.812c-0.833-0.55-5.038-3.331-5.951-3.984 c-0.833-0.595-1.982-1.311-0.541-2.721c0.513-0.502,3.874-3.712,6.493-6.21c0.343-0.328-0.088-0.867-0.484-0.604 c-3.53,2.341-8.424,5.59-9.047,6.013c-0.941,0.639-1.845,0.932-3.467,0.466c-1.226-0.352-2.423-0.772-2.889-0.932 C9.384,25.282,9.81,24.484,11.553,23.717z"></path></svg></div></button><a rel="noreferrer"><button aria-label="whatsapp" class="react-share__ShareButton" style="background-color:transparent;border:none;padding:0;font:inherit;color:inherit;cursor:pointer"><div class="w-10 h-10 bg-[#f2f2f2] border hover:bg-white transition duration-300 mobile:mt-[1rem] tablet:mt-0 rounded-md mr-1 flex justify-center items-center"><svg id="WA_Logo" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 21.537 21.641"><g id="Group_22634" data-name="Group 22634"><path id="Path_12791" data-name="Path 12791" d="M18.457,3.145A10.726,10.726,0,0,0,1.579,16.085L.057,21.641l5.684-1.491a10.713,10.713,0,0,0,5.124,1.306h0a10.729,10.729,0,0,0,7.587-18.31Zm-7.586,16.5h0A8.89,8.89,0,0,1,6.331,18.4l-.326-.193-3.373.885.9-3.289-.212-.337a8.913,8.913,0,1,1,7.55,4.178Zm4.889-6.675c-.268-.134-1.585-.783-1.831-.872s-.424-.134-.6.133-.692.872-.848,1.051-.313.2-.581.067a7.313,7.313,0,0,1-2.155-1.33,8.066,8.066,0,0,1-1.491-1.857c-.156-.269-.016-.413.117-.546s.268-.313.4-.47A1.781,1.781,0,0,0,9.04,8.7a.493.493,0,0,0-.023-.47c-.068-.133-.6-1.453-.826-1.989s-.438-.452-.6-.46-.335-.009-.514-.009a.982.982,0,0,0-.714.335,3.009,3.009,0,0,0-.938,2.235,5.214,5.214,0,0,0,1.094,2.772,11.939,11.939,0,0,0,4.577,4.046,15.5,15.5,0,0,0,1.527.564,3.683,3.683,0,0,0,1.688.106,2.76,2.76,0,0,0,1.809-1.274,2.229,2.229,0,0,0,.156-1.274C16.206,13.169,16.028,13.1,15.76,12.968Z" transform="translate(-0.057)" fill="#00a884" fill-rule="evenodd"></path></g></svg></div></button></a></div></div></div>

        <!-- FAQ Section -->
        <div class="box p-5 px-6 relative">
            <div class="faq-header flex justify-between items-center p-4 cursor-pointer bg-white hover:bg-blue-500 hover:text-white transition">
                    <span style="color:#000; font-weight: 600;">What is in the package?</span>
                    <span class="faq-icon text-green-500 transition" style="color: #000; font-weight: 600;">⌄</span>
                </div>
                <div class="faq-body max-h-0 overflow-hidden bg-white text-gray-700 transition-all duration-300" style="max-height: 0px;">
                    {!! $donationPackages->in_packages !!}
                </div>
        </div>

        <!-- About Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 box p-5 px-6 relative">
            <h3 class="text-lg font-semibold mb-3">Description</h3>
            <div>{!! $donationPackages->description !!}</div>
        </div>
        </div>
        <div class="lg:w-[400px] top-donors">
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
            <div class="box p-5 px-6" style="margin-top: 27px;">

                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base"> Campaign Gallery </h3>
                        </div>

                        <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                            uk-slider="autoplay: true;finite: true">

                            <div class="overflow-hidden uk-slider-container">

                                <ul class="uk-slider-items">
                                    @if ($donationPackages->image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager"
                                                    src="{{ asset('storage/' . $donationPackages->image) }}"
                                                    alt="{{ $donationPackages->name }}"
                                                    class="object-contain w-full h-full inset-0">
                                            </div>
                                        </div>
                                    </li>
                                    @endif

                                    @foreach ($donationPackages->gallery as $image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager" src="{{ asset('storage/' . $image->image) }}"
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
            <div class="box p-5 px-6" style="margin-top: 27px;">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">All Donors</h3>
                        </div>
                    
                        <div id="donorList1" style="margin-top: 19px;">
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
        </div>

    </div>

    <!-- Scripts -->
    
</main>
<style>
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
</style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const price = parseFloat("{{ $donationPackages->price }}");
    const maxQuantity = parseInt("{{ $donationPackages->quantity }}");
    const quantityInput = document.getElementById('quantityInput');
    const totalPrice = document.getElementById('totalPrice');
    const plusBtn = document.getElementById('plusBtn');
    const minusBtn = document.getElementById('minusBtn');
    const paymentLink = document.getElementById('paymentLink');
    const baseUrl = "{{ route('donation.support', ['id' => $encryptedId, 'price' => 0]) }}";

    function updateTotal() {
        const quantity = parseInt(quantityInput.value);
        const total = (price * quantity).toFixed(2);
        totalPrice.textContent = '{{ config("constants.CURRENCY_SYMBOL") }}' + total;
        paymentLink.href = baseUrl.replace('/0', '/' + total);
    }

    plusBtn.addEventListener('click', () => {
        let current = parseInt(quantityInput.value);
        if (current < maxQuantity) {
            quantityInput.value = current + 1;
            updateTotal();
        } else {
            plusBtn.classList.add('animate-shake');
            setTimeout(() => plusBtn.classList.remove('animate-shake'), 400);
        }
    });

    minusBtn.addEventListener('click', () => {
        let current = parseInt(quantityInput.value);
        if (current > 1) {
            quantityInput.value = current - 1;
            updateTotal();
        } else {
            minusBtn.classList.add('animate-shake');
            setTimeout(() => minusBtn.classList.remove('animate-shake'), 400);
        }
    });

    updateTotal();

            document.querySelectorAll('.faq-header').forEach(header => {
                header.addEventListener('click', () => {
                    const parent = header.parentElement;
                    const body = parent.querySelector('.faq-body');

                    parent.classList.toggle('active');

                    if (parent.classList.contains('active')) {
                        body.style.maxHeight = body.scrollHeight + "px";
                    } else {
                        body.style.maxHeight = "0px";
                    }
                });
            });

            const omidYes = document.getElementById('omidYes');
            const omidNo = document.getElementById('omidNo');
            const userSearchField = document.getElementById('userSearchField');

            omidYes.addEventListener('click', () => {
                omidYes.classList.add('bg-blue-500', 'text-white');
                omidNo.classList.remove('bg-blue-500', 'text-white');
                userSearchField.classList.remove('hidden');
            });

            omidNo.addEventListener('click', () => {
                omidNo.classList.add('bg-blue-500', 'text-white');
                omidYes.classList.remove('bg-blue-500', 'text-white');
                userSearchField.classList.add('hidden');
            });
            const results = $('#userSearchResults');

            $('#userSearchInput').on('input', function() {
        let query = $(this).val().trim();

        if (query.length > 0) {
            $.ajax({
                url: "{{ route('searchuserid') }}",
                method: 'GET',
                data: { q: query },
                success: function(response) {
                    results.empty();

                    if (response.length > 0) {
                        response.forEach(function(user) {
                            let initial = user.name ? user.name.charAt(0).toUpperCase() : '?';
                            results.append(`
                                <li class="flex items-center gap-3 p-2 cursor-pointer hover:bg-blue-100 rounded-md"
                                    data-name="${user.name}"
                                    data-uid="${user.uid}"
                                    data-email="${user.email || ''}">
                                    
                                    <div class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 text-white font-semibold text-sm">
                                        ${initial}
                                    </div>

                                    <div class="flex flex-col text-sm">
                                        <span class="font-semibold">${user.name}</span>
                                        <span class="text-gray-500">UID: ${user.uid}</span>
                                    </div>
                                </li>
                            `);
                        });

                        results.removeClass('hidden').addClass('block absolute bg-white w-full mt-1 shadow-lg rounded-md z-50 max-h-52 overflow-y-auto');
                    } else {
                        results.addClass('hidden');
                    }
                },
                error: function() {
                    results.addClass('hidden');
                }
            });
        } else {
            results.addClass('hidden');
        }
    });

    $(document).on('click', '#userSearchResults li', function() {
        let name = $(this).data('name');
        let uid = $(this).data('uid');
        let email = $(this).data('email');

        let html = `
            <div class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-md mt-2">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-500 text-white text-xl font-bold">
                    ${name.charAt(0).toUpperCase()}
                </div>
                <div>
                    <h5 class="font-semibold text-lg">${name}</h5>
                    <p class="text-gray-600">UID: <span class="font-semibold">${uid}</span></p>
                    ${email ? `<p class="text-gray-600">Email: ${email}</p>` : ''}
                </div>
            </div>
        `;

        $('#selectedUser').html(html);
        results.addClass('hidden'); 
        $('#userSearchResults').css('display', 'none');
        $('#userSearchInput').val(''); 
    });
        });
    </script>

@endsection
