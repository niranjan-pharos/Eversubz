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

            <div class="box p-5 px-6 relative">
                <h2 class="text-green-600 text-lg font-semibold mb-4">
                    Progress
                </h2>

                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden" 
                     role="progressbar" 
                     aria-valuemin="0" 
                     aria-valuemax="100" 
                     aria-valuenow="{{ $percentage }}">
                    <div class="h-full bg-green-500 rounded-full transition-all duration-500" 
                         style="width: {{ $percentage }}%;">
                    </div>
                </div>

                <div class="flex justify-between items-center mt-2 text-sm font-medium text-gray-700">
                    <p>{{ $percentage }}%</p>
                    <p>{{ $purchesedqty }} / {{ $totalquantity }}</p>
                </div>
            </div>
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

                <!-- <br> -->
                <!-- <div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="72" class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                    @php
                    $progress  = ($donationPackages->quentity)
                    @endphp
                  <div class="h-full rounded-full bg-green-500" style="width:72%"></div>
                </div> -->
                <!-- <br> -->

                <!-- User ID Switch -->
                <div class="mb-4" id="omidIdSection">
                    <!-- Search Field -->
                    <div id="userSearchField" class="mt-3">
                        <div class="relative">
                            <input type="text" id="userSearchInput"
                                class="w-full border border-gray-300 rounded-lg py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Search by NGO Name or Id">
                            <i class="fa fa-search absolute right-3 top-1/2 -translate-y-1/2 text-blue-500"></i>
                        </div>

                        <ul id="userSearchResults" style="max-width: 571px;" 
                            class="absolute w-full bg-white border border-gray-200 rounded-lg mt-1 max-h-52 overflow-y-auto hidden z-50"></ul>

                        <div id="selectedUser" style="margin-top: 30px"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 flex-wrap">
                    <a id="paymentLink" href="{{ route('donation.support', ['id' => $encryptedId, 'price' => $donationPackages->price, 'quantity' => 1]) }}"
                        class="flex-1">
                        <button id="paymentNowBtn" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition" disabled>
                            Payment Now
                        </button>
                    </a>
                </div>
            </div>

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
        <!-- Description Section -->
         <div class="bg-white rounded-xl shadow-lg p-6 box p-5 px-6 relative">
            <h3 class="text-lg font-semibold mb-3">Description</h3>
            <div>{!! $donationPackages->description !!}</div>
        </div>
        </div>
        <div class="lg:w-[400px] top-donors">
            @php
            $shareUrl = urlencode(url()->current());
            $shareText = urlencode('Support this great cause on our Package Donation page!');
        @endphp

        <div class="mb-5 bg-white box p-5 px-6 relative flex justify-between items-center">
            <p class="font-semibold text-black flex items-center gap-2">
                <i class="fa fa-share-alt" aria-hidden="true"></i>
                Share
            </p>

            <div class="flex flex-wrap items-center gap-2">

                {{-- 🔗 Copy Link --}}
                <button id="copyLinkBtn"
                    class="w-10 h-10 bg-[#f2f2f2] hover:bg-white border rounded-md flex items-center justify-center transition duration-300"
                    title="Copy Link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22.75 11.432">
                        <g transform="translate(1 1)">
                            <path d="M14.7,10.5h2.829a4.716,4.716,0,1,1,0,9.432H14.7m-5.659,0H6.216a4.716,4.716,0,1,1,0-9.432H9.045"
                                transform="translate(-1.5 -10.5)"
                                fill="none" stroke="#3295ca" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            <path d="M12,18H22.375"
                                transform="translate(-6.813 -13.284)"
                                fill="none" stroke="#3295ca" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </g>
                    </svg>
                </button>

                {{-- 📘 Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                   target="_blank"
                   class="w-10 h-10 bg-[#f2f2f2] hover:bg-white border rounded-md flex items-center justify-center transition duration-300"
                   title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 11.001 22">
                        <path d="M15.179,3.653h2.008V.155A25.934,25.934,0,0,0,14.262,0c-2.9,0-4.879,1.821-4.879,5.169V8.25h-3.2v3.91h3.2V22H13.3V12.161h3.066l.487-3.91H13.3V5.557c0-1.13.305-1.9,1.88-1.9Z"
                              transform="translate(-6.187)" fill="#4267b2" />
                    </svg>
                </a>

                {{-- 🐦 Twitter / X --}}
                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                   target="_blank"
                   class="w-10 h-10 bg-[#f2f2f2] hover:bg-white border rounded-md flex items-center justify-center transition duration-300"
                   title="Share on Twitter">
                    <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0488 10L17.7713 21.0326L10 30H11.75L18.5518 22.1466L24.0488 30H30L21.8445 18.3485L29.0762 10H27.3293L21.064 17.2313L16.003 10H10.0488Z" fill="#252525"/>
                    </svg>
                </a>

                {{-- 📩 Telegram --}}
                <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareText }}"
                   target="_blank"
                   class="w-10 h-10 bg-[#f2f2f2] hover:bg-white border rounded-md flex items-center justify-center transition duration-300"
                   title="Share on Telegram">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="26" height="26">
                        <path fill="#1b9ce2" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path>
                        <path fill="#fff" d="M11.553,23.717c6.99-3.075,16.035-6.824,17.284-7.343c3.275-1.358,4.28-1.098,3.779,1.91
                        c-0.36,2.162-1.398,9.319-2.226,13.774c-0.491,2.642-1.593,2.955-3.325,1.812c-0.833-0.55-5.038-3.331-5.951-3.984
                        c-0.833-0.595-1.982-1.311-0.541-2.721c0.513-0.502,3.874-3.712,6.493-6.21c0.343-0.328-0.088-0.867-0.484-0.604
                        c-3.53,2.341-8.424,5.59-9.047,6.013c-0.941,0.639-1.845,0.932-3.467,0.466c-1.226-0.352-2.423-0.772-2.889-0.932
                        C9.384,25.282,9.81,24.484,11.553,23.717z"></path>
                    </svg>
                </a>

                {{-- 💬 WhatsApp --}}
                <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}"
                   target="_blank"
                   class="w-10 h-10 bg-[#f2f2f2] hover:bg-white border rounded-md flex items-center justify-center transition duration-300"
                   title="Share on WhatsApp">
                    <svg id="WA_Logo" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 21.537 21.641"><g id="Group_22634" data-name="Group 22634"><path id="Path_12791" data-name="Path 12791" d="M18.457,3.145A10.726,10.726,0,0,0,1.579,16.085L.057,21.641l5.684-1.491a10.713,10.713,0,0,0,5.124,1.306h0a10.729,10.729,0,0,0,7.587-18.31Zm-7.586,16.5h0A8.89,8.89,0,0,1,6.331,18.4l-.326-.193-3.373.885.9-3.289-.212-.337a8.913,8.913,0,1,1,7.55,4.178Zm4.889-6.675c-.268-.134-1.585-.783-1.831-.872s-.424-.134-.6.133-.692.872-.848,1.051-.313.2-.581.067a7.313,7.313,0,0,1-2.155-1.33,8.066,8.066,0,0,1-1.491-1.857c-.156-.269-.016-.413.117-.546s.268-.313.4-.47A1.781,1.781,0,0,0,9.04,8.7a.493.493,0,0,0-.023-.47c-.068-.133-.6-1.453-.826-1.989s-.438-.452-.6-.46-.335-.009-.514-.009a.982.982,0,0,0-.714.335,3.009,3.009,0,0,0-.938,2.235,5.214,5.214,0,0,0,1.094,2.772,11.939,11.939,0,0,0,4.577,4.046,15.5,15.5,0,0,0,1.527.564,3.683,3.683,0,0,0,1.688.106,2.76,2.76,0,0,0,1.809-1.274,2.229,2.229,0,0,0,.156-1.274C16.206,13.169,16.028,13.1,15.76,12.968Z" transform="translate(-0.057)" fill="#00a884" fill-rule="evenodd"></path></g></svg>
                </a>
            </div>
        </div>
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
                                            {{ $donor->anonymous == 1 ? 'Anonymous' : ($donor->user->name ?? 'Unknown') }}
                                        </div>
                                        <div class="side-list-info">
                                            Reference No. {{ $donor->donation_number }}
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="alldonor-amount">Qty: {{ $donor->quantity }}</div>
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
                                <div class="alldonor-amount">Qty: {{ $donor->quantity }}</div>
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
            const baseUrl = "{{ route('donation.support', ['id' => $encryptedId, 'price' => 0, 'quantity' => 0]) }}";

            function updateTotal() {
                const quantity = parseInt(quantityInput.value);
                const total = (price * quantity).toFixed(2);

                totalPrice.textContent = '{{ config("constants.CURRENCY_SYMBOL") }}' + total;

                const newUrl = "{{ route('donation.support', ['id' => $encryptedId, 'price' => 0, 'quantity' => 0]) }}"
                    .replace('/0/0', `/${total}/${quantity}`);

                paymentLink.href = newUrl;
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

            const results = $('#userSearchResults');
            const userSearchInput = $('#userSearchInput');

            userSearchInput.on('input', function () {
                let query = $(this).val().trim();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('searchuserid') }}",
                        method: 'GET',
                        data: { q: query },
                        success: function (response) {
                            results.empty();

                            if (response.length > 0) {
                                response.forEach(function (user) {
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

                                results.removeClass('hidden')
                                    .addClass('block absolute bg-white w-full mt-1 shadow-lg rounded-md z-50 max-h-52 overflow-y-auto');
                            } else {
                                results.addClass('hidden').empty();
                            }
                        },
                        error: function () {
                            results.addClass('hidden');
                        }
                    });
                } else {
                    results.addClass('hidden').empty();
                }
            });

            $(document).on('click', '#userSearchResults li', function () {
                let name = $(this).data('name');
                let uid = $(this).data('uid');
                let email = $(this).data('email');

                let html = `
                    <div class="relative flex items-center gap-4 p-4 bg-white rounded-xl shadow-md mt-2 border border-blue-600">
                        <!-- Red circular close (X) button -->
                        <button type="button" id="removeSelectedUser"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold shadow" style="--tw-shadow: 0 1px 3px 0 #0550f5, 0 1px 2px -1px #004ffd;">
                            &times;
                        </button>

                        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-500 text-white text-xl font-bold">
                            ${name.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <h5 class="font-semibold text-lg" style="font-size: 16px;">${name}</h5>
                            <p class="text-gray-600" style="font-size: 14px;">UID: <span class="font-semibold">${uid}</span></p>
                            ${email ? `<p class="text-gray-600" style="font-size: 14px;">Email: ${email}</p>` : ''}
                        </div>
                    </div>
                `;

                $('#selectedUser').html(html);

                $('#paymentNowBtn').prop('disabled', false);

                results.empty().addClass('hidden');
                userSearchInput.val('').focus();
            });

            $(document).on('click', '#removeSelectedUser', function () {
                $('#selectedUser').empty();
                userSearchInput.val('').focus();
                $('#paymentNowBtn').prop('disabled', true);
            });

            document.getElementById('copyLinkBtn').addEventListener('click', function () {
                const url = window.location.href;
                navigator.clipboard.writeText(url);
                alert('🔗 Link copied to clipboard!');
            });
        });
    </script>

@endsection
