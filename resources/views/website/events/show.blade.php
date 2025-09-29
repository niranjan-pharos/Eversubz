@extends('layouts.eventlayout')


@section('content')

<style>
   .swal2-confirm{--tw-bg-opacity:1;background-color:rgb(59 130 246 / var(--tw-bg-opacity))}.swal2-cancel{--tw-bg-opacity:1;background-color:rgb(107 114 128 / var(--tw-bg-opacity))}div:where(.swal2-container) .swal2-input{margin-left:0}div:where(.swal2-container) .swal2-html-container{padding:0}div:where(.swal2-container) .swal2-textarea{margin-left:0}.swal2-popup{padding:1.5rem}.events-para12{column-gap:30px}.events-para12 .location12{color:#000}.events-para13,.events-para14{display:flex;column-gap:5px}.swal2-container{z-index:9999999}.swal2-title{text-align:left;font-size:20px;padding:0 1em .8em;border-bottom:1px solid #dee2e6}.swal2-title h3{font-size:22px}.swal2-html-container div{display:flex;justify-content:center}.swal2-html-container div a{margin:15px;font-size:15px;font-weight:500}.swal2-html-container div a .logo{width:20px;height:20px;font-size:20px;padding:14px;border-radius:50%;margin-bottom:5px;text-align:center;color:#fff;background:#04b}@media only screen and (max-width:767px){.mobile-view-sections{display: none;}.into-para{flex-direction:column}.events-para15{        width: 100%;   display:block;}.events-para14{display:flex;column-gap:5px;margin-top:13px;justify-content:center}.events-para13{display:block}.events-para13 a{margin:auto;width:100%;text-align: center;display:block;margin-bottom:10px;}.events-para13 .flex button{width:50%;}.events-para14 button, .events-para14 div{width:100%;justify-content: center;}#site__main{margin-top:0px; padding: 0px;}}
   .button1:hover{background: #d6ebff;}
</style>
<style>
.filled {
    opacity: 1 !important;
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.text-yellow-500 {
    color: #eab308 !important;
}

.text-green-500 {
    color: #22c55e !important;
}

</style>

<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 mt-[--m-top]">
 
    <div class="max-w-[1065px] mx-auto">

        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

            <div class="relative overflow-hidden lg:h-72 h-36 w-full">
                <img loading="eager" src="{{ asset('storage/'.$event->main_image)}}" alt="Main Image" class="h-full w-full object-cover inset-0">

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
                        <div class="grid place-items-center text-black font-semibold md:text-3l text-lg h-full md:pb-5 pb-3 text-center">
                        {{ $fromDateTime->format('j M ') }}
                        </div>
                    </div>
                   
                    <div class="flex lg:items-center justify-between max-lg:flex-col max-lg:gap-2">

                        <div class="flex-1"> 
                            <p class="text-sm font-semibold text-rose-600 mb-1.5">
                                {{ $fromDateTime->format('j M \A\T H:i') }} – {{ $toDateTime->format('j M \A\T H:i') }}
                            </p>
                            <h3 class="md:text-2xl text-base font-bold text-black "> {{ $event->title }} </h3>
                            <p class="events-para12 font-normal text-gray-500 mt-2 flex gap-2 /80 into-para">
                              <strong class="para12 text-teal-600">  
                                <!-- @if(is_null($event->price) || $event->price == 0 || $event->price == '0.00')
                                    <span> Free </span><br> 
                                @else
                                    <span> {{ config('constants.CURRENCY_SYMBOL') .number_format($event->price, 2) }} </span>
                                @endif -->
                                <span> {{ ucfirst($event->mode) }} </span></strong>
                                <span class="location12"> {{ ($event->location) }}, {{ ($event->city) }}, {{ ($event->state) }}, {{ ($event->country) }} </span>
                            </p>

                        </div>

                        <div>
                            @if($isFutureEvent)
                                <div uk-countdown="date: {{ $countdownDate }}" 
                                class="flex gap-3 text-2xl font-semibold text-primary  max-lg:justify-center">

                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow ">
                                    <span class="uk-countdown-days"></span> 
                                    <span class="inline-block text-xs">Days</span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow ">
                                    <div class="uk-countdown-hours"></div> 
                                    <span class="inline-block text-xs">Hours</span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow ">
                                    <div class="uk-countdown-minutes"></div> 
                                    <span class="inline-block text-xs">min </span>
                                </div>
                                <div class="bg-primary-soft/40 flex flex-col items-center justify-center rounded-lg w-16 h-16 lg:border-4 border-white md:shadow ">
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

            <div class="events-para15 flex items-center gap-2 text-sm py-2 pr-1 lg:order-1">
                    <div class="events-para13">
                        <a href="{{ route('ticket.details', ['encryptedEvent' => Crypt::encryptString($event->id)]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Get Tickets</a>

                        <div class="flex gap-2">
                            <!-- Interested Button -->
                            <button type="button" id="toggle-interested"
                                data-action="{{ $authUserInterested ? 'unmark' : 'mark' }}"
                                class="button button1 bg-secondery flex items-center gap-2 py-2 px-3.5">
                                <ion-icon id="interested-icon" name="star-outline" 
                                    class="text-xl {{ $authUserInterested ? 'text-yellow-500 filled' : '' }}"></ion-icon>
                                <span class="text-sm">{{ $authUserInterested ? 'Remove Interest' : 'Interested' }}</span>
                                <span class="interested-count ml-2">{{ $event->interested_count }} Interested</span>
                            </button>
                        
                            <!-- Going Button -->
                            <button type="button" id="toggle-going"
                                data-action="{{ $authUserGoing ? 'unmark' : 'mark' }}"
                                class="button button1 bg-secondery flex items-center gap-2 py-2 px-3.5">
                                <ion-icon id="going-icon" name="checkmark-circle-outline" 
                                    class="text-xl {{ $authUserGoing ? 'text-green-500 filled' : '' }}"></ion-icon>
                                <span class="text-sm">{{ $authUserGoing ? 'Not Going' : 'Going' }}</span>
                                <span class="going-count ml-2">{{ $event->going_count }} Going</span>
                            </button>
                        </div>
                        
                    </div>
                    <div class="events-para14">
                        <button  id="shareBtn"
                        class="rounded-lg bg-secondery flex px-2.5 py-2 " >
                            <ion-icon name="arrow-redo-outline" class="text-xl"></ion-icon>
                        </button>

                        <div>
                            <button type="button" class="rounded-lg bg-secondery flex px-2.5 py-2 ">
                                <ion-icon name="ellipsis-horizontal" class="text-xl">
                            </button>
                            <div class="w-[240px]"
                                uk-dropdown="pos: bottom-right; animation: uk-animation-scale-up uk-transform-origin-top-right; animate-out: true; mode: click;offset:10">
                                <nav>
                                    @auth
                                    <a href="#" class="auth-action" data-url="{{ route('action.save') }}"
                                        data-type="App\Models\Event" data-slug="{{ $event->slug }}">
                                        <ion-icon class="text-xl"
                                            name="{{ $isFavorite ? 'bookmark' : 'bookmark-outline' }}"></ion-icon> Save
                                    </a>
                                    <a href="#" class="calendar-action" data-title="{{ $event->title }}"
                                        data-start="{{ $event->from_date_time ? \Carbon\Carbon::parse($event->from_date_time)->format('Y-m-d\TH:i:s\Z') : '' }}"
                                        data-end="{{ $event->to_date_time ? \Carbon\Carbon::parse($event->to_date_time)->format('Y-m-d\TH:i:s\Z') : '' }}"
                                        data-details="{{ $event->description }}" data-location="{{ $event->location }}">
                                        <ion-icon class="text-xl" name="calendar-number-outline"></ion-icon> Add to
                                        calendar
                                    </a>
                                    <a href="#" class="report-action" data-url="{{ route('action.reportEvent') }}"
                                        data-slug="{{ $event->slug }}">
                                        <ion-icon class="text-xl" name="information-circle-outline"></ion-icon> Report
                                        Event
                                    </a>
                                    @else
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="bookmark-outline"></ion-icon> Save
                                    </a>
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="calendar-number-outline"></ion-icon> Add to
                                        calendar
                                    </a>
                                    <a href="#" class="guest-action">
                                        <ion-icon class="text-xl" name="information-circle-outline"></ion-icon> Report
                                        Event
                                    </a>
                                    @endauth
                                </nav>

                            </div>
                        </div>
                    </div>

                </div>

                <nav class="flex gap-0.5 rounded-xl overflow-hidden -mb-px text-gray-500 font-medium text-sm overflow-x-auto /80">
                    <a href="#" class="inline-block py-3 leading-8 px-3.5 border-b-2 border-blue-600 text-blue-600">About </a>
                </nav> 

            </div>


        </div>
        

        <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col" id="js-oversized">

            <div class="flex-1 space-y-4">

                <div class="box p-5 px-6 relative">
                    
                    <h3 class="font-semibold text-lg text-black "> About Event</h3>
                 
                    <div class="space-y-4 leading-7 tracking-wide mt-4 text-black text-sm "> 
                        <p>{!! $event->event_description !!}</p>
                    </div> 

                </div>  
                

                

            </div>

            <div class="lg:w-[400px]"> 
  
                <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6" 
                     uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                    <div class="box p-5 px-6 pr-0">

                        <h3 class="font-semibold text-lg text-black "> Status </h3> 

                        <div class="grid grid-cols-2 gap-2 text-sm mt-4">
                            <div class="flex gap-3">
                                <div class="p-2 inline-flex rounded-full bg-rose-50 self-center"> <ion-icon name="heart" class="text-2xl text-rose-600"></ion-icon></div>
                                <div>
                                    <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">{{ $event->interested_count }}</h3>
                                    <p>Intersted</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="p-2 inline-flex rounded-full bg-rose-50 self-center"> <ion-icon name="leaf-outline" class="text-2xl text-rose-600"></ion-icon></div>
                                <div>
                                    <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">{{ $event->going_count }}</h3>
                                    <p>Going</p>
                                </div>
                            </div> 
                        </div> 
                        
                        <ul class="mt-6 space-y-4 text-gray-600 text-sm /80">

                            <li class="flex items-center gap-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                </svg>
                                <div> <span class="font-semibold text-black "> {{ $organizedEventCount }} </span> Events organized by <strong>
                                    <a href="{{ route('Userprofile',['slug'=>Str::slug($user->name)])}}">{{ $user->name }}</a></strong>  </div>
                            </li>
                            <li class="flex items-center gap-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"></path>
                                </svg>
                                <div><strong> <a href="{{ route('Userprofile', ['slug' => Str::slug($user->name)]) }}">{{ $user->name }}</a>
                                </strong> Since <span class="font-semibold text-black "> {{ $userCreationDate }}</span> </div>
                            </li>
                            
                        </ul>
                        
                    </div>

                    <div class="box p-5 px-6 border1 ">

<div class="flex justify-between text-black ">
    <h3 class="font-bold text-base"> Event Gallery </h3>

</div>

<div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
    uk-slider="autoplay: true;finite: true">

    <div class="overflow-hidden uk-slider-container" >

    <ul class="uk-slider-items">
        @if ($event->main_image)
        <li class="w-full pr-2">
            <div class="relative overflow-hidden rounded-lg">
                <div class="relative w-full h-40 card-media1">
                    <img loading="eager" src="{{ asset('storage/' . $event->main_image) }}" alt="{{ $event->title }}" class="object-contain w-full h-full inset-0">
                </div>
            </div>
        </li>
        @endif

        @foreach ($event->images as $image)
        <li class="w-full pr-2">
            <div class="relative overflow-hidden rounded-lg">
                <div class="relative w-full h-40 card-media1">
                    <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}" class="object-contain w-full h-full inset-0" alt="details">
                </div>
            </div>
        </li>
        @endforeach
    </ul>

        <button type="button"
            class="absolute bg-white rounded-full top-16 -left-4 grid w-9 h-9 place-items-center shadow mobile-view-sections"
            uk-slider-item="previous">
            <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
        </button>
        <button type="button"
            class="absolute -right-4 bg-white rounded-full top-16 grid w-9 h-9 place-items-center shadow mobile-view-sections"
            uk-slider-item="next">
            <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
        </button>

    </div>
    <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                        </div>

</div>


</div>


                    {{-- enquiry form --}}
                    <div class="box p-5 px-6">
                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base">Enquiry Form</h3>
                        </div>
                        <form id="contact-form" class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 ">Name</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500  " required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 ">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500  " required>
                            </div>
                            <input type="hidden" id="module" name="module" value="event">
                            <input type="hidden" name="slug" id="slug" value="{{$event->slug}}">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 ">Phone</label>
                                <input type="tel" id="phone" name="phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500  ">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 ">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500  "></textarea>
                            </div>
                            <div class="flex justify-center">
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
        
        {{--Modal popup --}}
        <div id="bookingModal" class="modal hidden fixed z-50 inset-0 overflow-y-auto">
            <div class="modal-dialog max-w-lg mx-auto mt-10">
                <div class="modal-content bg-white rounded-lg shadow-lg p-6">
                    <span class="close-modal cursor-pointer text-right" onclick="closeBookingModal()">&times;</span>
                    <h2 id="event_name" class="text-2xl font-bold mb-4">{{ $event->title }}</h2>
                    <p id="event_date">{{ $event->formatted_from_date_time }} – {{ $event->formatted_to_date_time }}</p>
                    <p id="event_date">{{ $event->location }}</p>
                    <p id="event_summary" class="mb-4">Host By{{ $event->host_name }}</p>
        
                    <form id="bookingForm" method="POST" action="{{ route('event.purchase', ['id' => $event->id]) }}">
                        @csrf
                        <input type="hidden" name="name" id="user_name" value="">
                        <input type="hidden" name="email" id="user_email" value="">
                        <input type="hidden" name="phone" id="user_phone" value="">
                        <input type="hidden" name="tickets" id="tickets_data" value="">
                        <div>
                            <label for="user_name">Full Name</label>
                            <input type="text" id="user_name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        </div>
                        <div>
                            <label for="user_email">Email</label>
                            <input type="email" id="user_email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        </div>
                        <div>
                            <label for="user_phone">Phone</label>
                            <input type="tel" id="user_phone" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        </div>
                        
        
                        <div id="tickets_section">
                            <h3 class="text-xl font-semibold mb-2">Select Tickets</h3>
                            @foreach($tickets as $ticket)
                                <div class="ticket-type mb-4">
                                    <h4 class="font-semibold">{{ $ticket->name }}</h4>
                                    <div class="flex items-center">
                                        <label class="mr-2">Adult ({{ $ticket->adult_price }})</label>
                                        <input type="number" min="0" class="adult-quantity w-16 p-2 border border-gray-300 rounded" data-price="{{ $ticket->adult_price }}" data-type="{{ $ticket->name }}">
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <label class="mr-2">Children ({{ $ticket->children_price }})</label>
                                        <input type="number" min="0" class="children-quantity w-16 p-2 border border-gray-300 rounded" data-price="{{ $ticket->children_price }}" data-type="{{ $ticket->name }}">
                                    </div>
                                </div>
                            @endforeach

                        </div>
        
                        <div id="summary_section" class="mt-4">
                            <h3 class="text-xl font-semibold mb-2">Summary</h3>
                            <ul id="summary_list" class="mb-2"></ul>
                            <p>Total: <span id="total_price" class="font-bold">0.00</span></p>
                        </div>
        
                        <button type="submit" id="payNowButton" class="bg-green-500 text-white px-4 py-2 rounded mt-4 hover:bg-green-600 transition duration-300">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Model --}}
    </div>
   

</main>
@push('script')
<script>
    const isAuthenticated = @json(Auth::check());
    const loginUrl = "{{ route('user.login') }}";
    const csrfToken = "{{ csrf_token() }}";

    document.addEventListener('DOMContentLoaded', function() {
        const interestedBtn = document.getElementById('toggle-interested');
        if (interestedBtn) {
            interestedBtn.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');
                const action = this.getAttribute('data-action');

                if (!isAuthenticated) {
                    localStorage.setItem('intendedUrl', window.location.href);
                    localStorage.setItem('intendedAction', JSON.stringify({ type: 'interested', eventId }));
                    toastr.warning('You must be logged in');
                    setTimeout(() => { window.location.href = loginUrl; }, 2000);
                    return;
                }

                toggleEventStatus(eventId, 'interested', this, action);
            });
        }

        const goingBtn = document.getElementById('toggle-going');
        if (goingBtn) {
            goingBtn.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');
                const action = this.getAttribute('data-action');

                if (!isAuthenticated) {
                    localStorage.setItem('intendedUrl', window.location.href);
                    localStorage.setItem('intendedAction', JSON.stringify({ type: 'going', eventId }));
                    toastr.warning('You must be logged in');
                    setTimeout(() => { window.location.href = loginUrl; }, 2000);
                    return;
                }

                toggleEventStatus(eventId, 'going', this, action);
            });
        }
    });

    function toggleEventStatus(eventId, type, button, action) {
        button.disabled = true;

        fetch(`/event/${eventId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ 
                type: type, 
                action: action,
                eventId: eventId 
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateUI(button, type, data);
            } else {
                toastr.error('Something went wrong');
            }
        })
        .catch(error => {
            console.error('Error updating event status:', error);
            toastr.error('Something went wrong');
        })
        .finally(() => {
            button.disabled = false;
        });
    }

    function updateUI(button, type, data) {
        const icon = button.querySelector('ion-icon');
        const textSpan = button.querySelector('.text-sm');
        const countSpan = button.querySelector(`.${type}-count`);

        if (data.action === 'mark') {
            if (type === 'interested') {
                icon.classList.add('text-yellow-500', 'filled');
                icon.name = 'star';
                textSpan.textContent = 'Remove Interest';
            } else {
                icon.classList.add('text-green-500', 'filled');
                icon.name = 'checkmark-circle';
                textSpan.textContent = 'Not Going';
            }
            button.setAttribute('data-action', 'unmark');
        } else {
            if (type === 'interested') {
                icon.classList.remove('text-yellow-500', 'filled');
                icon.name = 'star-outline';
                textSpan.textContent = 'Interested';
            } else {
                icon.classList.remove('text-green-500', 'filled');
                icon.name = 'checkmark-circle-outline';
                textSpan.textContent = 'Going';
            }
            button.setAttribute('data-action', 'mark');
        }

        countSpan.textContent = `${data.count} ${type.charAt(0).toUpperCase() + type.slice(1)}`;
    }
</script>

    
@endpush

@endsection