@extends('layouts.eventlayout')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  .events-para12 .para12{}.swal2-container{z-index:9999999}.swal2-title{text-align:left;font-size:20px;padding:0em 1em .8em;border-bottom:1px solid #dee2e6}.swal2-title h3{font-size:22px}.swal2-html-container div{display:flex;justify-content:center}.swal2-html-container div a{margin:15px 15px;font-size:15px;font-weight:500}.swal2-html-container div a .logo{width:20px;height:20px;font-size:20px;padding:14px;border-radius:50%;margin-bottom:5px;text-align:center;color:#fff;background:#04b}@media only screen and (max-width:767px){.into-para{flex-direction:column}}
</style>

<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 mt-[--m-top]">
 
    <div class="max-w-[1065px] mx-auto">

        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10">

            <div class="relative overflow-hidden lg:h-72 h-36 w-full">
                <img  loading="eager" src="{{ asset('storage/'.$event->main_image)}}" alt="" class="h-full w-full object-cover inset-0">

                <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from -black/60 pt-10 z-10"></div>

                {{-- <div class="absolute bottom-0 right-0 m-4 z-20">
                    <div class="flex items-center gap-3">
                        <button class="button bg-white/20 text-white flex items-center gap-2 backdrop-blur-small">Crop</button>
                        <button class="button bg-black/10 text-white flex items-center gap-2 backdrop-blur-small">Edit</button>
                    </div>
                </div> --}}

            </div>
        @php
            use Carbon\Carbon;
            $fromDateTime = Carbon::parse($event->from_date_time);
            $toDateTime = Carbon::parse($event->to_date_time);
            $currentDateTime = Carbon::now();
            $eventDateTime = Carbon::parse($event->from_date_time);

            // Determine if the event date is in the future
            $isFutureEvent = $eventDateTime->isFuture();
            $countdownDate = $isFutureEvent ? $eventDateTime->format('Y-m-d\TH:i:sP') : null;
        @endphp
            <div class="lg:px-10 md:p-5 p-3">

                <div class="flex flex-col justify-center md:-mt-20 -mt-12">

                    <div class="md:w-20 md:h-20 w-12 h-12 overflow-hidden bg-white shadow-md rounded-md z-10 mb-5">
                        <div class="w-full md:h-5 bg-rose-500 h-3"></div>
                        <div class="grid place-items-center text-black font-semibold md:text-3xl text-lg h-full md:pb-5 pb-3">
                            14
                        </div>
                    </div>
                   
                    <div class="flex lg:items-center justify-between max-lg:flex-col max-lg:gap-2">

                        <div class="flex-1"> 
                            <p class="text-sm font-semibold text-rose-600 mb-1.5">
                                {{ $fromDateTime->format('j M \A\T H:i') }} – {{ $toDateTime->format('j M \A\T H:i') }}
                            </p>
                            <h3 class="md:text-2xl text-base font-bold text-black"> {{ $event->title }} </h3>
                            <p class="events-para12 font-normal text-gray-500 mt-2 flex gap-2 into-para">
                              <strong class="para12">  @if(is_null($event->price) || $event->price == 0 || $event->price == '0.00')
                                    <span> Free </span>
                                @else
                                    <span> {{ config('constants.CURRENCY_SYMBOL') .number_format($event->price, 2) }} </span>
                                @endif
                                <span> {{ ucfirst($event->mode) }} </span></strong>
                                <span class="location12"> {{ ($event->location) }}, {{ ($event->city) }}, {{ ($event->state) }}, {{ ($event->country) }} </span>
                            </p>

                        </div>

                        <div>
                            @if($isFutureEvent)
                                <div uk-countdown="date: {{ $countdownDate }}" 
                                class="flex gap-3 text-2xl font-semibold text-primary max-lg:justify-center">

                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow">
                                    <span class="uk-countdown-days"></span> 
                                    <span class="inline-block text-xs">Days</span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow">
                                    <div class="uk-countdown-hours"></div> 
                                    <span class="inline-block text-xs">Hours</span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow">
                                    <div class="uk-countdown-minutes"></div> 
                                    <span class="inline-block text-xs">min </span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow">
                                    <div class="uk-countdown-seconds"></div> 
                                    <span class="inline-block text-xs">sec </span>
                                </div>

                            </div>
                            @else
                                <p class="text-sm font-semibold text-rose-600 mb-1.5">Event has already started or passed.</p>
                            @endif
                        </div>

                    </div>

                </div>

            </div>

            <div class="flex items-center justify-between px-2 max-md:flex-col">

                <div class="flex items-center gap-2 text-sm py-2 pr-1 lg:order-1">
                    <button onclick="openBookingModal(this, {{$event->available_tickets}}, {{$event->price}})" data-slug="{{$event->slug}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Book Now</button>
                    <button type="button" id="toggle-interested" data-action="{{ $authUserInterested ? 'unmark' : 'mark' }}" class="button bg-secondery flex items-center gap-2 py-2 px-3.5">  
                        <ion-icon name="star-outline" class="text-xl {{ $authUserInterested ? 'text-yellow-500' : '' }}"></ion-icon> 
                        <span class="text-sm">{{ $authUserInterested ? 'Remove Interest' : 'Interested' }}</span>
                    </button>
                    <button type="button" id="toggle-going" data-action="{{ $authUserGoing ? 'unmark' : 'mark' }}" class="button bg-secondery flex items-center gap-2 py-2 px-3.5"> 
                        <ion-icon name="checkmark-circle-outline" class="text-xl {{ $authUserGoing ? 'text-green-500' : '' }}"></ion-icon> 
                        <span class="text-sm">{{ $authUserGoing ? 'Not Going' : 'Going' }}</span>
                    </button>
                    <button type="button" onclick="openShareModal()" class="rounded-lg bg-secondery flex px-2.5 py-2">
                        <ion-icon name="arrow-redo-outline" class="text-xl"></ion-icon>
                    </button>

                    <div> 
                        <button type="button" class="rounded-lg bg-secondery flex px-2.5 py-2"> 
                            <ion-icon name="ellipsis-horizontal" class="text-xl">
                        </button>
                        <div  class="w-[240px]" uk-dropdown="pos: bottom-right; animation: uk-animation-scale-up uk-transform-origin-top-right; animate-out: true; mode: click;offset:10"> 
                            <nav>
                                @auth
                                    <a href="#" class="auth-action" data-url="{{ route('action.save') }}" data-type="App\Models\Event" data-slug="{{ $event->slug }}">
                                        <ion-icon class="text-xl" name="{{ $isFavorite ? 'bookmark' : 'bookmark-outline' }}"></ion-icon> Save
                                    </a>
                                    <a href="#" class="calendar-action"
                                       data-title="{{ $event->title }}"
                                       data-start="{{ $event->from_date_time ? \Carbon\Carbon::parse($event->from_date_time)->format('Y-m-d\TH:i:s\Z') : '' }}"
                                       data-end="{{ $event->to_date_time ? \Carbon\Carbon::parse($event->to_date_time)->format('Y-m-d\TH:i:s\Z') : '' }}"
                                       data-details="{{ $event->description }}"
                                       data-location="{{ $event->location }}">
                                        <ion-icon class="text-xl" name="calendar-number-outline"></ion-icon> Add to calendar
                                    </a>
                                    <a href="#" class="report-action" data-url="{{ route('action.reportEvent') }}" data-slug="{{ $event->slug }}">
                                        <ion-icon class="text-xl" name="information-circle-outline"></ion-icon> Report Event
                                    </a>
                                @else
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="bookmark-outline"></ion-icon> Save
                                    </a>  
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="calendar-number-outline"></ion-icon> Add to calendar
                                    </a>
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="information-circle-outline"></ion-icon> Report Event
                                    </a>  
                                @endauth
                            </nav>                                               
                            
                        </div>
                    </div>
                    
                </div>

                <nav class="flex gap-0.5 rounded-xl overflow-hidden -mb-px text-gray-500 font-medium text-sm overflow-x-auto">
                    <a href="#" class="inline-block py-3 leading-8 px-3.5 border-b-2 border-blue-600 text-blue-600">About </a>
                </nav> 

            </div>


        </div>
        

        <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col" id="js-oversized">

            <div class="flex-1 space-y-4">

                <div class="box p-5 px-6 relative">
                    
                    <h3 class="font-semibold text-lg text-black"> About </h3>
                 
                    <div class="space-y-4 leading-7 tracking-wide mt-4 text-black text-sm"> 
                        <p>{!! $event->event_description !!}</p>
                    </div> 

                </div>  
                

                {{-- <div class="box p-5 px-6 relative">
                    <h3 class="font-semibold text-lg text-black"> Discussions </h3>

                    <div class=" text-sm font-normal space-y-4 relative mt-4"> 
                
                        <div class="flex items-start gap-3 relative">
                            <a href="timeline.html"> <img  loading="eager" src="{{asset('main_assets/images/avatars/avatar-3.jpg')}}" alt="" class="w-6 h-6 mt-1 rounded-full"> </a>
                            <div class="flex-1">
                                <a href="timeline.html" class="text-black font-medium inline-block"> Monroe Parker </a>
                                <p class="mt-0.5">What a beautiful photo! I love it. 😍 </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 relative">
                            <a href="timeline.html"> <img  loading="eager" src="{{asset('main_assets/images/avatars/avatar-2.jpg')}}" alt="" class="w-6 h-6 mt-1 rounded-full"> </a>
                            <div class="flex-1">
                                <a href="timeline.html" class="text-black font-medium inline-block"> John Michael </a>
                                <p class="mt-0.5">   You captured the moment.😎 </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 relative">
                            <a href="timeline.html"> <img  loading="eager" src="{{asset('main_assets/images/avatars/avatar-5.jpg')}}" alt="" class="w-6 h-6 mt-1 rounded-full"> </a>
                            <div class="flex-1">
                                <a href="timeline.html" class="text-black font-medium inline-block"> James Lewis </a>
                                <p class="mt-0.5">What a beautiful photo! I love it. 😍 </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 relative">
                            <a href="timeline.html"> <img  loading="eager" src="{{asset('main_assets/images/avatars/avatar-4.jpg')}}" alt="" class="w-6 h-6 mt-1 rounded-full"> </a>
                            <div class="flex-1">
                                <a href="timeline.html" class="text-black font-medium inline-block"> Martin Gray </a>
                                <p class="mt-0.5">   You captured the moment.😎 </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="flex items-center gap-1.5 text-blue-500 hover:text-blue-500 my-5">
                                <ion-icon name="chevron-down-outline" class="ml-auto duration-200 group-aria-expanded:rotate-180"></ion-icon>
                                More Comment
                            </button>
                        </div>

                    </div>


                </div> --}}

            </div>

            <div class="lg:w-[400px]"> 
  
                <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6" 
                     uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                    <div class="box p-5 px-6 pr-0">

                        <h3 class="font-semibold text-lg text-black"> Status </h3> 

                        <div class="grid grid-cols-2 gap-2 text-sm mt-4">
                            <div class="flex gap-3">
                                <div class="p-2 inline-flex rounded-full bg-rose-50 self-center"> <ion-icon name="heart" class="text-2xl text-rose-600"></ion-icon></div>
                                <div>
                                    <h3 class="sm:text-xl sm:font-semibold mt-1 text-black text-base font-normal">{{ $event->interested_count }}</h3>
                                    <p>Intersted</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="p-2 inline-flex rounded-full bg-rose-50 self-center"> <ion-icon name="leaf-outline" class="text-2xl text-rose-600"></ion-icon></div>
                                <div>
                                    <h3 class="sm:text-xl sm:font-semibold mt-1 text-black text-base font-normal">{{ $event->going_count }}</h3>
                                    <p>Going</p>
                                </div>
                            </div> 
                        </div> 
                        
                        <ul class="mt-6 space-y-4 text-gray-600 text-sm">

                            <li class="flex items-center gap-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                </svg>
                                <div> <span class="font-semibold text-black"> {{ $organizedEventCount }} </span> Events organized by <strong>{{ $user->name }}</strong>  </div>
                            </li>
                            <li class="flex items-center gap-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"></path>
                                </svg>
                                <div><strong> {{$user->name}} </strong> Since <span class="font-semibold text-black"> {{ $userCreationDate }}</span> </div>
                            </li>
                            
                        </ul>
                        
                    </div>

                    <div class="box p-5 px-6 border1">

<div class="flex justify-between text-black">
    <h3 class="font-bold text-base"> Event Gallery </h3>
   
    <a href="{{ route ('main.events_index') }}" class="text-sm text-blue-500"><ion-icon name="sync-outline" class="text-xl"></ion-icon></a>
</div>

<div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
    uk-slider="autoplay: true;finite: true">

    <div class="overflow-hidden uk-slider-container" >

    <ul class="uk-slider-items">
        @if ($event->main_image)
        <li class="w-full pr-2">
            <div class="relative overflow-hidden rounded-lg">
                <div class="relative w-full h-40 card-media1">
                    <img  loading="eager" src="{{ asset('storage/' . $event->main_image) }}" alt="{{ $event->title }}" class="object-contain w-full h-full inset-0">
                </div>
            </div>
        </li>
        @endif

        @foreach ($event->images as $image)
        <li class="w-full pr-2">
            <div class="relative overflow-hidden rounded-lg">
                <div class="relative w-full h-40 card-media1">
                    <img  loading="eager" src="{{ asset('storage/' . $image->image_path) }}" class="object-contain w-full h-full inset-0" alt="details">
                </div>
            </div>
        </li>
        @endforeach
    </ul>

        <button type="button"
            class="absolute bg-white rounded-full top-16 -left-4 grid w-9 h-9 place-items-center shadow"
            uk-slider-item="previous">
            <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
        </button>
        <button type="button"
            class="absolute -right-4 bg-white rounded-full top-16 grid w-9 h-9 place-items-center shadow"
            uk-slider-item="next">
            <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
        </button>

    </div>

</div>


</div>


                    {{-- enquiry form --}}
                    <div class="box p-5 px-6">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">Enquiry Form</h3>
                        </div>
                        <form id="contact-form" class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <input type="hidden" name="slug" id="slug" value="{{$event->slug}}" >
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" id="phone" name="phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
                            </div>
                        </form>
                        <div id="loader" class="hidden mt-4 text-center">
                            <svg class="animate-spin h-5 w-5 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <p class="text-gray-500">Submitting...</p>
                        </div>
                    </div>
                    
                    

                </div>

            </div>

        </div>
        
    </div>
   

</main>
<script>
function openBookingModal(button,availableTickets,ticketPrice){const slug=button.getAttribute('data-slug');Swal.fire({title:'Book Ticket',html:`
            <div class="flex flex-col space-y-2 px-4 w-full max-w-md mx-auto">
                <div class="flex flex-col">
                    <input type="text" id="name" class="swal2-input focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Name*">
                </div>
                <div class="flex flex-col">
                    <input type="email" id="email" class="swal2-input focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Email*">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="phone" class="swal2-input focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Phone Number*">
                </div>
                <div class="flex flex-col">
                    <textarea id="description" class="swal2-textarea focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Description"></textarea>
                </div>
                <div class="flex justify-between items-center space-x-2">
                    <input type="number" id="tickets" class="swal2-input focus:ring-blue-500 focus:border-blue-500 block w-1/2 shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="No. of Tickets">
                    <div id="totalAmount" class="text-gray-800 mt-2 w-1/2 text-right">Total: $0.00</div>
                </div>
                <div id="availableTicketsMessage" class="text-gray-800 text-sm mt-2 hidden"></div>
                <div id="errorMessage" class="text-red-500 text-sm mt-2 hidden"></div>
            </div>
        `,showCancelButton:!0,confirmButtonText:'Submit',customClass:{popup:'swal2-popup rounded-lg p-6',title:'swal2-title font-bold text-xl text-gray-800',confirmButton:'swal2-confirm bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300',cancelButton:'swal2-cancel bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-300'},didOpen:()=>{const ticketsInput=Swal.getPopup().querySelector('#tickets');const totalAmountDiv=Swal.getPopup().querySelector('#totalAmount');const availableTicketsMessage=Swal.getPopup().querySelector('#availableTicketsMessage');const confirmButton=Swal.getPopup().querySelector('.swal2-confirm');const errorMessage=Swal.getPopup().querySelector('#errorMessage');const updateTotalAmount=()=>{const tickets=parseInt(ticketsInput.value)||0;if(tickets>availableTickets){errorMessage.classList.remove('hidden');confirmButton.disabled=!0}else{errorMessage.classList.add('hidden');confirmButton.disabled=!1}
const totalAmount=tickets*ticketPrice;totalAmountDiv.textContent=`Total: $${totalAmount.toFixed(2)}`;if(totalAmount===0){confirmButton.textContent='Book Now'}else{confirmButton.textContent='Pay Now'}
if(availableTickets<=10){availableTicketsMessage.textContent=`${availableTickets} tickets available`;availableTicketsMessage.classList.remove('hidden')}else{availableTicketsMessage.classList.add('hidden')}};ticketsInput.addEventListener('input',updateTotalAmount);updateTotalAmount()},preConfirm:()=>{const name=Swal.getPopup().querySelector('#name').value;const email=Swal.getPopup().querySelector('#email').value;const phone=Swal.getPopup().querySelector('#phone').value;const description=Swal.getPopup().querySelector('#description').value;const tickets=parseInt(Swal.getPopup().querySelector('#tickets').value);const totalAmount=tickets*ticketPrice;if(!name||!email||!phone||!tickets){Swal.showValidationMessage('Please fill required fields')}
if(tickets>availableTickets){Swal.showValidationMessage(`You cannot book more than ${availableTickets} tickets`)}
return{name,email,phone,description,tickets,slug,totalAmount}}}).then((result)=>{if(result.isConfirmed){const{name,email,phone,description,tickets,slug,totalAmount}=result.value;fetch('/book-tickets',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({name,email,phone,description,tickets,slug,totalAmount})}).then(response=>response.json()).then(data=>{if(data.success){if(totalAmount===0){toastr.success('Tickets booked successfully');window.open('/path/to/generated/ticket.pdf','_blank')}else{window.location.href=data.paypal_url}}else{toastr.error(data.message)}}).catch(error=>{toastr.error('An error occurred while booking tickets')})}})}
function openShareModal(){Swal.fire({title:'<h3 class="text-lg font-semibold">Share Event</h3>',html:`<div class="mt-4">
                    <a href="#" onclick="shareToWhatsApp()" class=" items-center mb-2">
                        <ion-icon name="logo-whatsapp" class="logo text-xl mr-2"></ion-icon><br> WhatsApp
                    </a>
                    <a href="#" onclick="shareToFacebook()" class=" items-center mb-2">
                        <ion-icon name="logo-facebook" class="logo text-xl mr-2"></ion-icon><br> Facebook
                    </a>
                    <a href="#" onclick="shareToTwitter()" class=" items-center mb-2">
                        <ion-icon name="logo-twitter" class="logo text-xl mr-2"></ion-icon><br> Twitter
                    </a>
                    <a href="#" onclick="shareToInstagram()" class=" items-center mb-2">
                        <ion-icon name="logo-instagram" class="logo text-xl mr-2"></ion-icon><br> Instagram
                    </a>
                </div>`,showCloseButton:!0,showConfirmButton:!1,customClass:{popup:'rounded-lg shadow-lg p-4',closeButton:'text-gray-600 hover:text-gray-900',}})}
document.addEventListener('DOMContentLoaded',function(){document.getElementById('contact-form').addEventListener('submit',function(event){event.preventDefault();const name=document.getElementById('name').value.trim();const email=document.getElementById('email').value.trim();const phone=document.getElementById('phone').value.trim();const slug=document.getElementById('slug').value.trim();const description=document.getElementById('description').value.trim();if(name===""||email===""){alert("Name and Email are required fields.");return}
document.getElementById('loader').classList.remove('hidden');const formData={name,email,phone,slug,description};const url="{{ route('events.enquiry') }}";const csrfToken=document.querySelector('meta[name="csrf-token"]').getAttribute('content');fetch(url,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},body:JSON.stringify(formData)}).then(response=>response.json()).then(data=>{document.getElementById('loader').classList.add('hidden');if(data.success){alert('Form submitted successfully!');document.getElementById('contact-form').reset()}else{alert('An error occurred while submitting the form.')}}).catch(error=>{document.getElementById('loader').classList.add('hidden');console.error('Error:',error);alert('An error occurred while submitting the form.')})})});$(document).ready(function(){$('#toggle-interested').click(function(){@if(!Auth::check())
toastr.warning('Please login first');return;@endif
var action=$(this).data('action');var url=action==='mark'?'{{ route('events.markInterested', $event->id) }}':'{{ route('events.unmarkInterested', $event->id) }}';var button=$(this);$.post(url,{_token:'{{ csrf_token() }}'},function(data){if(data.status==='success'){$('#interested-count').text(data.interested_count);if(action==='mark'){button.data('action','unmark').find('span').text('Remove Interest');button.find('ion-icon').addClass('text-yellow-500')}else{button.data('action','mark').find('span').text('Interested');button.find('ion-icon').removeClass('text-yellow-500')}}else{toastr.error('An error occurred, please try again')}}).fail(function(){toastr.error('An error occurred, please try again')})});$('#toggle-going').click(function(){@if(!Auth::check())
toastr.warning('Please login first');return;@endif
var action=$(this).data('action');var url=action==='mark'?'{{ route('events.markGoing', $event->id) }}':'{{ route('events.unmarkGoing', $event->id) }}';var button=$(this);$.post(url,{_token:'{{ csrf_token() }}'},function(data){if(data.status==='success'){$('#going-count').text(data.going_count);if(action==='mark'){button.data('action','unmark').find('span').text('Not Going');button.find('ion-icon').addClass('text-green-500')}else{button.data('action','mark').find('span').text('Going');button.find('ion-icon').removeClass('text-green-500')}}else{toastr.error('An error occurred, please try again')}}).fail(function(){toastr.error('An error occurred, please try again')})})});function closeShareModal(){document.getElementById('shareModal').classList.add('hidden')}
function shareToWhatsApp(){const url=encodeURIComponent(window.location.href);window.open(`https://wa.me/?text=${url}`,'_blank');toastr.success('Shared to WhatsApp!')}
function shareToFacebook(){const url=encodeURIComponent(window.location.href);window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`,'_blank');toastr.success('Shared to Facebook!')}
function shareToTwitter(){const url=encodeURIComponent(window.location.href);window.open(`https://twitter.com/intent/tweet?url=${url}`,'_blank');toastr.success('Shared to Twitter!')}
function shareToInstagram(){const url=encodeURIComponent(window.location.href);toastr.info('Instagram sharing is not supported via web. Please share manually.')}
document.addEventListener('DOMContentLoaded',function(){const guestActions=document.querySelectorAll('.guest-action');const authActions=document.querySelectorAll('.auth-action');const calendarActions=document.querySelectorAll('.calendar-action');const reportActions=document.querySelectorAll('.report-action');guestActions.forEach(action=>{action.addEventListener('click',function(event){event.preventDefault();toastr.error('Login First')})});authActions.forEach(action=>{action.addEventListener('click',function(event){event.preventDefault();const url=action.getAttribute('data-url');const type=action.getAttribute('data-type');const slug=action.getAttribute('data-slug');const icon=action.querySelector('ion-icon');const isFavorite=icon.getAttribute('name')==='bookmark';fetch(url,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({favoritable_type:type,slug:slug})}).then(response=>response.json()).then(data=>{toastr.success(data.message);icon.setAttribute('name',isFavorite?'bookmark-outline':'bookmark')}).catch(error=>{toastr.error('An error occurred')})})});calendarActions.forEach(action=>{action.addEventListener('click',function(event){event.preventDefault();const title=action.getAttribute('data-title');const start=action.getAttribute('data-start');const end=action.getAttribute('data-end');const details=action.getAttribute('data-details');const location=action.getAttribute('data-location');try{const startDate=new Date(start).toISOString().replace(/-|:|\.\d\d\d/g,"");const endDate=new Date(end).toISOString().replace(/-|:|\.\d\d\d/g,"");const googleCalendarUrl=`https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${startDate}/${endDate}&details=${encodeURIComponent(details)}&location=${encodeURIComponent(location)}`;window.open(googleCalendarUrl,'_blank')}catch(error){toastr.error('Invalid date format');console.error('Error parsing date:',error)}})});reportActions.forEach(action=>{action.addEventListener('click',function(event){event.preventDefault();const url=action.getAttribute('data-url');const slug=action.getAttribute('data-slug');Swal.fire({title:'Report Event',input:'textarea',inputLabel:'Reason for reporting',inputPlaceholder:'Type your reason here...',inputAttributes:{'aria-label':'Type your reason here'},showCancelButton:!0,confirmButtonText:'Submit',preConfirm:(reason)=>{if(!reason){Swal.showValidationMessage('You need to write something!')}else{return fetch(url,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({slug:slug,reason:reason})}).then(response=>response.json()).then(data=>{toastr.success(data.message)}).catch(error=>{toastr.error('An error occurred')})}}})})})})


</script>

@endsection