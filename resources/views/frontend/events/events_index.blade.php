@extends('layouts.eventlayout')

@section('title', 'Home')
@section('description', 'Welcome to Eversubz')

@section('content')


<style>
    .filter-mobile{display:none}.filter-desktop{display:block}@media only screen and (max-width:767px){.mobile-filter{display:block}.filter-mobile{display:block}.filter-desktop{display:none}.mobile-filter form button{width:100%;margin-bottom:10px}}
</style>

<div class="container mx-auto grid grid-cols-1 md:grid-cols-12 gap-4">
    <div class="lg:col-span-3 xl:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
            <div>
                <div class="bg-white p-4 rounded shadow-md filter-desktop">
                    <h6 class="font-semibold mb-4">Filter by cities</h6>
                    <form method="GET" action="{{ url('/events/events-list') }}">
                        <ul class="bg-white p-4 rounded-md shadow-md">
                            @foreach ($topCities as $index => $city)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" name="cities[]" id="city-{{ $index }}" value="{{ $city->city }}"
                                    {{ in_array($city->city, request()->input('cities', [])) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="city-{{ $index }}"
                                    class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $city->city }}</span>
                                    <span class="text-gray-500">({{ $city->city_count }})</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-5 flex space-x-2">
                            <a href="{{ url('/main/events') }}"
                                class="bg-gray-300 text-black px-3 py-1.5 rounded-md flex items-center shadow hover:bg-gray-400 transition duration-300 text-sm">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit"
                                class="bg-blue-500 text-white px-3 py-1.5 rounded-md flex items-center shadow hover:bg-blue-600 transition duration-300 text-sm">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>

                </div>

                <div class="bg-white p-4 rounded shadow-md filter-mobile">
                    <h6 class="font-semibold mb-4 cursor-pointer flex items-center" id="filter-toggle">
                        Filter by cities
                        <i id="filter-icon" class="ml-2 fas fa-chevron-down"></i>
                    </h6>
                    <form method="GET" action="{{ url('/events/events-list') }}" id="filter-form" class="hidden">
                        <ul class="bg-white p-4 rounded-md shadow-md">
                            @foreach ($topCities as $index => $city)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" name="cities[]" id="city-{{ $index }}" value="{{ $city->city }}"
                                    {{ in_array($city->city, request()->input('cities', [])) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="city-{{ $index }}"
                                    class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $city->city }}</span>
                                    <span class="text-gray-500">({{ $city->city_count }})</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-5 flex space-x-2">
                            <a href="{{ url('/main/events') }}"
                                class="bg-gray-300 text-black px-3 py-1.5 rounded-md flex items-center shadow hover:bg-gray-400 transition duration-300 text-sm">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit"
                                class="bg-blue-500 text-white px-3 py-1.5 rounded-md flex items-center shadow hover:bg-blue-600 transition duration-300 text-sm">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>
                </div>

               


            </div>
            <div>
                <div class="bg-white p-4 rounded shadow-md filter-desktop">
                    <h6 class="font-semibold mb-4">Filter by Category</h6>
                    <form method="GET" action="{{ url('/events/events-list') }}">
                        <ul class="bg-white p-4 rounded-md shadow-md">
                            @foreach ($categories as $category)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" id="cat{{ $category->id }}" name="categories[]"
                                    value="{{ $category->slug }}"
                                    {{ in_array($category->slug, request()->input('categories', [])) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="cat{{ $category->id }}"
                                    class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-gray-500">({{ $category->events_infos_count }})</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-5 flex space-x-2">
                            <a href="{{ url('/main/events') }}"
                                class="bg-gray-300 text-black px-3 py-1.5 rounded-md flex items-center shadow hover:bg-gray-400 transition duration-300 text-sm">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit"
                                class="bg-blue-500 text-white px-3 py-1.5 rounded-md flex items-center shadow hover:bg-blue-600 transition duration-300 text-sm">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>

                </div>


<div class="bg-white p-4 rounded shadow-md filter-mobile">
    <h6 class="font-semibold mb-4 cursor-pointer flex items-center" id="filter-toggle-form">
        Filter by Category
        <i id="filter-icon" class="ml-2 fas fa-chevron-down"></i>
    </h6>
    <form method="GET" action="{{ url('/events/events-list') }}" id="filter-form-category" class="hidden">
        <ul class="bg-white p-4 rounded-md shadow-md">
            @foreach ($categories as $category)
            <li class="flex items-center space-x-2 mb-2 ml-1">
                <input type="checkbox" id="cat{{ $category->id }}" name="categories[]" value="{{ $category->slug }}" {{
                    in_array($category->slug, request()->input('categories', [])) ? 'checked' : '' }}
                class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                <label for="cat{{ $category->id }}" class="flex-1 flex items-center justify-between text-gray-700">
                    <span>{{ $category->name }}</span>
                    <span class="text-gray-500">({{ $category->events_infos_count }})</span>
                </label>
            </li>
            @endforeach
        </ul>

        <div class="mt-5 flex space-x-2">
            <a href="{{ url('/main/events') }}"
                class="bg-gray-300 text-black px-3 py-1.5 rounded-md flex items-center shadow hover:bg-gray-400 transition duration-300 text-sm">
                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
            </a>
            <button type="submit"
                class="bg-blue-500 text-white px-3 py-1.5 rounded-md flex items-center shadow hover:bg-blue-600 transition duration-300 text-sm">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

</div>

            </div>
        </div>

    </div>


    <?php
        use Carbon\Carbon;
        ?>

    <div class="lg:col-span-5 xl:col-span-6">
        <div class="max-w-[900px] w-full mx-auto" id="js-oversized">
            <div class="page-heading mb-2">
                <h1 class="page-title has:[.ww]:text-sky-500 ww">Events </h1>
                <nav class="borde-b mt-6 pb-3">
                    <ul
                        class="flex gap-3 text-sm text-center text-gray-600 capitalize font-semibold mobile-filter">
                        <li>
                            <form method="get" action="{{ route('events.list') }}">
                                <button type="button"
                                    class="button p-2 px-3 bg-white shadow-sm gap-1 border1 group"
                                    aria-haspopup="true" aria-expanded="false">
                                    <ion-icon name="location-outline" class="text-lg"></ion-icon>
                                    {{ request('mode') ? ucfirst(request('mode')) : 'Filter Event' }}
                                    <ion-icon name="chevron-down-outline"
                                        class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180">
                                    </ion-icon>
                                </button>
                                <div class="p-3 bg-white rounded-lg drop-shadow-xl border2 w-64 uk-drop uk-transform-origin-top-left"
                                    uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                                    style="max-width: 1349px; top: 104px; left: 1px;">
                                    <div class="max-md:mt-3 w-full text-black font-medium">
                                        <label>
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="free" onchange="this.form.submit()"
                                                {{ request('mode') == 'free' ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                                <ion-icon name="navigate" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Free </div>
                                                <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon>
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="online" onchange="this.form.submit()"
                                                {{ request('mode') == 'online' ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                                <ion-icon name="globe" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Online </div>
                                                <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon>
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="offline" onchange="this.form.submit()"
                                                {{ request('mode') == 'offline' ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                                <ion-icon name="home" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Offline </div>
                                                <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon>
                                            </div>
                                        </label>
                                    </div>
                                    <div
                                        class="w-3 h-3 absolute -top-1.5 left-3 bg-white rotate-45 border-l border-t">
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="{{ route('events.list') }}">
                                <button type="button"
                                    class="button p-2 px-3 bg-white shadow-sm gap-1 border1 group"
                                    aria-haspopup="true" aria-expanded="false">
                                    <ion-icon name="chevron-down" class="text-sm" hidden=""></ion-icon>
                                    <ion-icon name="calendar-clear-outline" class="text-sm"></ion-icon>
                                    {{ request('filter_date')
                                            ? \Carbon\Carbon::parse(request('filter_date'))->format('F
                                                                            j, Y')
                                            : 'Any Date' }}
                                    <ion-icon name="chevron-down-outline"
                                        class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180">
                                    </ion-icon>
                                </button>
                                <div class="p-3 bg-white rounded-lg drop-shadow-xl border2 w-72 uk-drop uk-transform-origin-top-left"
                                    uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                                    style="max-width: 1349px; top: 104px; left: 115.25px;">
                                    <div class="max-md:mt-3 w-full text-black font-medium">
                                        <div>
                                            <label
                                                class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span> Today</span>
                                                <input type="radio" name="filter_date"
                                                    value="{{ \Carbon\Carbon::today()->toDateString() }}"
                                                    onchange="this.form.submit()"
                                                    {{ request('filter_date') == \Carbon\Carbon::today()->toDateString() ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                        {{-- <div>
                                            <label
                                                class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span> Tomorrow </span>
                                                <input type="radio" name="filter_date"
                                                    value="{{ \Carbon\Carbon::tomorrow()->toDateString() }}"
                                        onchange="this.form.submit()" {{
                                                    request('filter_date')==\Carbon\Carbon::tomorrow()->toDateString() ?
                                                'checked' : '' }}>
                                        </label>
                                    </div> --}}
                                    <div>
                                        <label
                                            class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                            <span> This week </span>
                                            <input type="radio" name="filter_date"
                                                value="{{ \Carbon\Carbon::now()->startOfWeek()->toDateString() }}"
                                                onchange="this.form.submit()"
                                                {{ request('filter_date') == \Carbon\Carbon::now()->startOfWeek()->toDateString() ? 'checked' : '' }}>
                                        </label>
                                    </div>
                                    <div>
                                        <label
                                            class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                            <span> This weekend </span>
                                            <input type="radio" name="filter_date"
                                                value="{{ \Carbon\Carbon::now()->nextWeekendDay()->toDateString() }}"
                                                onchange="this.form.submit()"
                                                {{ request('filter_date') == \Carbon\Carbon::now()->nextWeekendDay()->toDateString() ? 'checked' : '' }}>
                                        </label>
                                    </div>
                                    <div>
                                        <label
                                            class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                            <span> Next week </span>
                                            <input type="radio" name="filter_date"
                                                value="{{ \Carbon\Carbon::now()->addWeek()->startOfWeek()->toDateString() }}"
                                                onchange="this.form.submit()"
                                                {{ request('filter_date') == \Carbon\Carbon::now()->addWeek()->startOfWeek()->toDateString() ? 'checked' : '' }}>
                                        </label>
                                    </div>
                                </div>
                                <div
                                    class="w-3 h-3 absolute -top-1.5 left-3 bg-white rotate-45 border-l border-t">
                                </div>
            </div>
            </form>
            </li>
            <li>
                <form method="get" action="{{ route('events.list') }}">
                    <button type="button"
                        class="button p-2 px-3 bg-white shadow-sm gap-1 border1 group"
                        aria-haspopup="true" aria-expanded="false">
                        <ion-icon name="options-outline" class="text-lg"></ion-icon>
                        {{ request('perPage') ? request('perPage') . ' Results' : 'Show Results' }}
                        <ion-icon name="chevron-down-outline"
                            class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180"></ion-icon>
                    </button>
                    <div class="p-3 bg-white rounded-lg drop-shadow-xl border2 w-64 uk-drop uk-transform-origin-top-left"
                        uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                        style="max-width: 1349px; top: 104px; left: 1px;">
                        <div class="max-md:mt-3 w-full text-black font-medium">
                            <label>
                                <input type="radio" name="perPage" class="peer appearance-none hidden" value="12"
                                    onchange="this.form.submit()" {{ request('perPage') == '12' ? 'checked' : '' }}>
                                <div
                                    class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                    <ion-icon name="list" class="text-lg"></ion-icon>
                                    <div class="text-sm"> 12 Results </div>
                                    <ion-icon name="checkmark-circle"
                                        class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                    </ion-icon>
                                </div>
                            </label>
                            <label>
                                <input type="radio" name="perPage" class="peer appearance-none hidden" value="24"
                                    onchange="this.form.submit()" {{ request('perPage') == '24' ? 'checked' : '' }}>
                                <div
                                    class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                    <ion-icon name="list" class="text-lg"></ion-icon>
                                    <div class="text-sm"> 24 Results </div>
                                    <ion-icon name="checkmark-circle"
                                        class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                    </ion-icon>
                                </div>
                            </label>
                            <label>
                                <input type="radio" name="perPage" class="peer appearance-none hidden" value="36"
                                    onchange="this.form.submit()" {{ request('perPage') == '36' ? 'checked' : '' }}>
                                <div
                                    class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block">
                                    <ion-icon name="list" class="text-lg"></ion-icon>
                                    <div class="text-sm"> 36 Results </div>
                                    <ion-icon name="checkmark-circle"
                                        class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                    </ion-icon>
                                </div>
                            </label>
                        </div>
                        <div
                            class="w-3 h-3 absolute -top-1.5 left-3 bg-white rotate-45 border-l border-t">
                        </div>
                    </div>
                </form>
            </li>
            </ul>

            </nav>
            <div class="flex-1">
                <div class="max-w-[700px] w-full mx-auto">
                    <div class="box p-5">
                        @foreach ($events as $event)
                        <?php
                                    $date = Carbon::parse($event->from_date_time)->format('D M j,Y \A\\T ga');
                                    $date = strtoupper($date);
                                    $date = str_replace('AM', 'AM', $date);
                                    $date = str_replace('PM', 'PM', $date);
                                    
                                    $userInterested = isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->interested;
                                    $userGoing = isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->going;
                                    ?>
                        <div class="card-list mt-8" data-event-id="{{ $event->id }}"
                            data-user-interested="{{ $userInterested ? 'true' : 'false' }}"
                            data-user-going="{{ $userGoing ? 'true' : 'false' }}">
                            <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                <div class="card-list-media md:w-40 md:h-full w-full h-36">
                                    <img src="{{ asset('storage/' . $event->main_image) }}" alt="{{ $event->title }}">
                                </div>
                            </a>
                            <div class="md:flex gap-10 md:items-end flex-1">
                                <div class="card-list-body">
                                    <p class="text-xs font-medium text-red-600 mb-1">{{ $date }} </p>
                                    <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                        <h3 class="card-list-title text-base line-clamp-1">{{ $event->title }}
                                        </h3>
                                    </a>
                                    <p class="text-xs font-medium mb-1 mt-3 text-black">
                                        {{ $event->city . ', ' . $event->state }}</p>
                                    <div class="card-list-info text-xs">
                                        <div class="interested-count">{{ $event->interested_count }}
                                            Interested</div>
                                        <div class="md:block hidden">·</div>
                                        <div class="going-count">{{ $event->going_count }} Going</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 self-end pt-2 sm:justify-end">
                                    <button type="button"
                                        class="button bg-secondery max-sm:flex-1 interested-btn">{{ $userInterested ? 'Uninterested' : 'Interested' }}</button>
                                    <button type="button"
                                        class="button bg-secondery max-sm:flex-1 going-btn">{{ $userGoing ? 'Not Going' : 'Going' }}</button>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <hr class="card-list-divider">
                    </div>

                    <div class="flex justify-center my-6">
                        {{ $events->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="2xl:w-[380px] lg:w-[330px] w-full lg:col-span-4 xl:col-span-3">
    <div class="lg:space-y-6 space-y-4 lg:pb-8  sm:grid-cols-2 max-lg:gap-6"
        uk-sticky="media: 1024; end: #js-oversized; offset: 80">

        <div class="box p-5 px-6 border1">

            <div class="flex justify-between text-black">
                <h3 class="font-bold text-base">Featured Events </h3>
                <button type="button">
                    <ion-icon name="sync-outline" class="text-xl"></ion-icon>
                </button>
            </div>

            <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                uk-slider="autoplay: true;finite: true">

                <div class="overflow-hidden uk-slider-container">

                    <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                        @foreach ($topEvents as $topevent)
                        <li class="w-full pr-2">

                            <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                <div class="relative overflow-hidden rounded-lg">
                                    <div class="relative w-full h-40 card-media1">
                                        <img src="{{ asset('storage/' . $topevent->main_image) }}"
                                            alt="{{ $topevent->title }}" alt=""
                                            class="object-contain  w-full h-full inset-0">
                                    </div>
                                    <div
                                        class="absolute right-0 top-0 m-2 bg-white/60 rounded-full py-0.5 px-2 text-sm font-semibold">
                                        ${{ $topevent->price }} </div>
                                </div>
                                <div class="mt-3 w-full"> {{ $topevent->title }}</div>
                                <div class="mt-1 w-full"><span
                                        class="text-teal-600 font-semibold text-xs">{{ $topevent->city }},
                                        {{ $topevent->state }}</span></div>
                            </a>

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

    



    </div>
</div>
</div>

<script>
document.getElementById('filter-toggle').addEventListener('click',function(){var form=document.getElementById('filter-form');var icon=document.getElementById('filter-icon');form.classList.toggle('hidden');icon.classList.toggle('fa-chevron-down');icon.classList.toggle('fa-chevron-up')});document.getElementById('filter-toggle-form').addEventListener('click',function(){var form=document.getElementById('filter-form-category');var icon=document.getElementById('filter-icon');form.classList.toggle('hidden');icon.classList.toggle('fa-chevron-down');icon.classList.toggle('fa-chevron-up')});const isAuthenticated={{Auth::check()?'true':'false'}};const loginUrl="{{ route('user.login') }}";document.addEventListener('DOMContentLoaded',function(){document.querySelectorAll('.interested-btn').forEach(button=>{button.addEventListener('click',function(){let eventCard=this.closest('.card-list');let eventId=eventCard.getAttribute('data-event-id');if(!isAuthenticated){localStorage.setItem('intendedUrl',window.location.href);localStorage.setItem('intendedAction',JSON.stringify({type:'interested',eventId:eventId}));toastr.warning('Please log in to mark your interest.');setTimeout(function(){window.location.href=loginUrl},2000);return}
updateEventCount(eventId,'interested',this)})});document.querySelectorAll('.going-btn').forEach(button=>{button.addEventListener('click',function(){let eventCard=this.closest('.card-list');let eventId=eventCard.getAttribute('data-event-id');if(!isAuthenticated){localStorage.setItem('intendedUrl',window.location.href);localStorage.setItem('intendedAction',JSON.stringify({type:'going',eventId:eventId}));toastr.warning('Please log in to mark your attendance.');setTimeout(function(){window.location.href=loginUrl},2000);return}
updateEventCount(eventId,'going',this)})});const intendedAction=JSON.parse(localStorage.getItem('intendedAction'));if(intendedAction){updateEventCount(intendedAction.eventId,intendedAction.type,document.querySelector(`[data-event-id="${intendedAction.eventId}"] .${intendedAction.type}-btn`));localStorage.removeItem('intendedAction')}});function updateEventCount(eventId,type,button){fetch(`/events/${eventId}/update-count`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({type:type})}).then(response=>response.json()).then(data=>{if(data.success){let eventCard=document.querySelector(`.card-list[data-event-id="${eventId}"]`);if(type==='interested'){let interestedCount=eventCard.querySelector('.interested-count');interestedCount.textContent=`${data.interested_count} Interested`;let userInterested=eventCard.getAttribute('data-user-interested')==='true';eventCard.setAttribute('data-user-interested',!userInterested);button.textContent=userInterested?'Interested':'Uninterested';toastr.success('Successfully updated interest status.')}else if(type==='going'){let goingCount=eventCard.querySelector('.going-count');goingCount.textContent=`${data.going_count} Going`;let userGoing=eventCard.getAttribute('data-user-going')==='true';eventCard.setAttribute('data-user-going',!userGoing);button.textContent=userGoing?'Going':'Not Going';toastr.success('Successfully updated going status.')}}else{toastr.error('Failed to update status.')}}).catch(error=>{toastr.error('An error occurred. Please try again.');console.error('Error:',error)})}
</script>
@endsection