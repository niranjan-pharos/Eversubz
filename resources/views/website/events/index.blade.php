@extends('layouts.eventlayout')

@section('title', 'Upcoming Events | Eversabz - Discover Exciting Activities & Gatherings')
@section('description', 'Discover upcoming events with Eversabz! Explore our comprehensive list of events and never miss out on exciting opportunities. Stay informed and get involved today!')

@section('content')


<style>
    main{margin-bottom: 50px;}
  .filter-mobile{display:none}.card-list-divider{margin-top:1.25rem;margin-bottom:1.25rem;--tw-border-opacity:1;border-color:#878787}.filter-desktop{display:block}@media only screen and (max-width:767px){.filter-mobile h6 button{font-size:14px;display:flex;column-gap:15px;align-items:center;text-transform:uppercase}.mobile-view-sections{display:none}.filter-mobile{display:block}.filter-desktop{display:none}.mobile-filter form button{width:100%;margin-bottom:10px}.box{margin-bottom:40px}}.rotate-180{transform:rotate(180deg)}.filetr-buttons{background:#0248c340;font-size:14px;font-weight:500;padding:12px 0;letter-spacing:.3px;display:flex;align-items:center;justify-content:center;text-transform:uppercase;width:100%;height:40px;border-radius:6px}
  .button1:hover{background: #d6ebff;}
  .filetr-buttons:hover{    color: #fff;
    background: #0044bb;}
                </style>
<div class="container mx-auto grid grid-cols-1 lg:grid-cols-12 gap-4 lg:flex">
    <div class="2xl:w-[380px] lg:w-[330px] w-full  lg:col-span-3 xl:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">
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

                        <div class="mt-5 flex space-x-2 ">
                            <a href="{{ url('events/events-list') }}" class="filetr-buttons">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit" class="filetr-buttons">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>

                </div>

                <div class="page-heading mb-2">
                    <h1 class="page-title has:[.ww]:text-sky-500 ww  filter-mobile">Events </h1>
                    
                </div>
                <div class="bg-white p-4 rounded  filter-mobile filter-city-mobile"
                    style="border-bottom: 1px solid #e8e8e8;">
                    <h6 class="font-semibold cursor-pointer flex items-center" id="filter-toggle">
                        <button type="button" class="" aria-haspopup="true" aria-expanded="false">
                            <ion-icon name="chevron-down-outline" id="filter-toggle-form1"
                                class="duration-300 -mr-0.5 text-base transition-transform transform"></ion-icon> Filter
                            by cities


                        </button>
                    </h6>
                    <form method="GET" action="{{ url('events/events-list') }}" id="filter-form" class="hidden">
                        <ul class="bg-white p-4 rounded-md ">
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

                        <div class="mt-5 flex space-x-2 ">
                            <a href="{{ url('events/events-list') }}" class="filetr-buttons">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit" class="filetr-buttons">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>
                </div>





                <div class="bg-white p-4 rounded shadow-md filter-desktop">
                    <h6 class="font-semibold mb-4">Filter by Category</h6>
                    <form method="GET" action="{{ url('/events/events-list') }}">
                        <ul class="bg-white p-4 rounded-md shadow-md">

                            @foreach ($categories as $category)
                            @if ($category->events_infos_count > 0)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" id="cat{{ $category->id }}" name="categories[]"
                                    value="{{ $category->slug }}" {{ in_array($category->slug,
                                request()->input('categories', [])) ? 'checked' : '' }}
                                class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="cat{{ $category->id }}"
                                    class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-gray-500">({{ $category->events_infos_count }})</span>
                                </label>
                            </li>
                            @endif
                            @endforeach
                        </ul>

                        <div class="mt-5 flex space-x-2 ">
                            <a href="{{ url('events/events-list') }}" class="filetr-buttons">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit" class="filetr-buttons">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>

                </div>


                <div class="bg-white p-4 rounded filter-mobile">
                    <h6 class="font-semibold  cursor-pointer flex items-center" id="filter-toggle-form">
                        <button type="button" class="" aria-haspopup="true" aria-expanded="false">
                            <ion-icon name="chevron-down-outline" id="filter-icon-form"
                                class="duration-300 -mr-0.5 text-base transition-transform transform"></ion-icon> Filter
                            by Category

                        </button>
                    </h6>
                    <form method="GET" action="{{ url('/events/events-list') }}" id="filter-form-category"
                        class="hidden">
                        <ul class="bg-white p-4 rounded-md ">
                            @foreach ($categories as $category)
                            @if ($category->events_infos_count > 0)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" id="cat{{ $category->id }}" name="categories[]"
                                    value="{{ $category->slug }}" {{ in_array($category->slug,
                                request()->input('categories', [])) ? 'checked' : '' }}
                                class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="cat{{ $category->id }}"
                                    class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-gray-500">({{ $category->events_infos_count }})</span>
                                </label>
                            </li>
                            @endif
                            @endforeach
                        </ul>

                        <div class="mt-5 flex space-x-2 ">
                            <a href="{{ url('events/events-list') }}" class="filetr-buttons">
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            </a>
                            <button type="submit" class="filetr-buttons">
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
                <h1 class="page-title has:[.ww]:text-sky-500 ww filter-desktop">Events </h1>
                <nav class="borde-b  mt-6 pb-3">
                    <ul class="flex gap-2 text-sm text-center text-gray-600 capitalize font-semibold  mobile-filter">
                        <li>
                            <form method="get" action="{{ route('events.list') }}">
                                <button type="button" class="button p-2 px-3 bg-white shadow-sm gap-1 border1  group"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ request('mode') ? ucfirst(request('mode')) : 'Filter Event' }}
                                    <ion-icon name="chevron-down-outline"
                                        class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180">
                                    </ion-icon>
                                </button>
                                <div class="p-3 bg-white rounded-lg drop-shadow-xl border2  w-56 uk-drop uk-transform-origin-top-left"
                                    uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                                    style="max-width: 1349px; top: 104px; left: 1px;">
                                    <div class="max-md:mt-3 w-full text-black font-medium ">
                                        <label style="display:flex; align-items: center;">
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="free" onchange="this.form.submit()" {{ request('mode')=='free'
                                                ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="navigate" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Free </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                        <label style="display:flex; align-items: center;">
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="online" onchange="this.form.submit()" {{
                                                request('mode')=='online' ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="globe" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Online </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                        <label style="display:flex; align-items: center;">
                                            <input type="radio" name="mode" class="peer appearance-none hidden"
                                                value="offline" onchange="this.form.submit()" {{
                                                request('mode')=='offline' ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="home" class="text-lg"></ion-icon>
                                                <div class="text-sm"> Offline </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                    </div>

                                </div>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="{{ route('events.list') }}">
                                <button type="button" class="button p-2 px-3 bg-white shadow-sm gap-1 border1  group"
                                    aria-haspopup="true" aria-expanded="false">
                                    <ion-icon name="chevron-down" class="text-sm" hidden=""></ion-icon>
                                    {{ request('filter_date')
                                    ? \Carbon\Carbon::parse(request('filter_date'))->format('F
                                    j, Y')
                                    : 'Any Date' }}
                                    <ion-icon name="chevron-down-outline"
                                        class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180">
                                    </ion-icon>
                                </button>
                                <div class="p-3 bg-white rounded-lg drop-shadow-xl border2  w-56 uk-drop uk-transform-origin-top-left"
                                    uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                                    style="max-width: 1349px; top: 104px; left: 115.25px;">
                                    <div class="max-md:mt-3 w-full text-black font-medium ">
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span>Show All</span>
                                                <input type="radio" name="filter_date" value="all"
                                                       onchange="resetFilter()" {{ request('filter_date') == 'all' ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span>Today</span>
                                                <input type="radio" name="filter_date" value="{{ \Carbon\Carbon::today()->toDateString() }}"
                                                       onchange="this.form.submit()" {{ request('filter_date') == \Carbon\Carbon::today()->toDateString() ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span>This Week</span>
                                                <input type="radio" name="filter_date" value="{{ \Carbon\Carbon::now()->startOfWeek()->toDateString() }}"
                                                       onchange="this.form.submit()" {{ request('filter_date') == \Carbon\Carbon::now()->startOfWeek()->toDateString() ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span>This Weekend</span>
                                                <input type="radio" name="filter_date" value="{{ \Carbon\Carbon::now()->nextWeekendDay()->toDateString() }}"
                                                       onchange="this.form.submit()" {{ request('filter_date') == \Carbon\Carbon::now()->nextWeekendDay()->toDateString() ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer rounded-md p-2 hover:bg-secondery">
                                                <span>Next Week</span>
                                                <input type="radio" name="filter_date" value="{{ \Carbon\Carbon::now()->addWeek()->startOfWeek()->toDateString() }}"
                                                       onchange="this.form.submit()" {{ request('filter_date') == \Carbon\Carbon::now()->addWeek()->startOfWeek()->toDateString() ? 'checked' : '' }}>
                                            </label>
                                        </div>
                                    </div>
                                    

                                </div>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="{{ route('events.list') }}">
                                <button type="button" class="button p-2 px-3 bg-white shadow-sm gap-1 border1  group"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ request('perPage') ? request('perPage') . ' Results' : 'Show Results' }}
                                    <ion-icon name="chevron-down-outline"
                                        class="duration-300 -mr-0.5 text-base group-aria-expanded:rotate-180"></ion-icon>
                                </button>
                                <div class="p-3 bg-white rounded-lg drop-shadow-xl border2  w-56 uk-drop uk-transform-origin-top-left"
                                    uk-drop="offset:10; mode: click; pos: bottom-left; animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-left"
                                    style="max-width: 1349px; top: 104px; left: 1px;">
                                    <div class="max-md:mt-3 w-full text-black font-medium ">
                                        <label  style="display:flex; align-items: center;">
                                            <input type="radio" name="perPage" class="peer appearance-none hidden"
                                                value="12" onchange="this.form.submit()" {{ request('perPage')=='12'
                                                ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="list" class="text-lg"></ion-icon>
                                                <div class="text-sm"> 12 Results </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                        <label  style="display:flex; align-items: center;">
                                            <input type="radio" name="perPage" class="peer appearance-none hidden"
                                                value="24" onchange="this.form.submit()" {{ request('perPage')=='24'
                                                ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="list" class="text-lg"></ion-icon>
                                                <div class="text-sm"> 24 Results </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                        <label  style="display:flex; align-items: center;">
                                            <input type="radio" name="perPage" class="peer appearance-none hidden"
                                                value="36" onchange="this.form.submit()" {{ request('perPage')=='36'
                                                ? 'checked' : '' }}>
                                            <div
                                                class="relative flex items-center gap-3 cursor-pointer rounded-md p-2 hover:bg-secondery peer-checked:[&amp;_.active]:block ">
                                                <ion-icon name="list" class="text-lg"></ion-icon>
                                                <div class="text-sm"> 36 Results </div>
                                                <!-- <ion-icon name="checkmark-circle"
                                                    class="hidden active absolute -translate-y-1/2 right-2 text-2xl ml-auto text-blue-600 uk-animation-scale-up">
                                                </ion-icon> -->
                                            </div>
                                        </label>
                                    </div>

                                </div>
                            </form>
                        </li>
                    </ul>

                </nav>
                <div class="flex-1">
                    <div class="max-w-[700px] w-full mx-auto">
                        <div class="box p-5">
                            @if($events->count() > 0)
                                @foreach ($events as $event)
                                <?php
                                    $now = \Carbon\Carbon::now();
                                    $fromDateTime = \Carbon\Carbon::parse($event->from_date_time);
                                    $toDateTime = \Carbon\Carbon::parse($event->to_date_time);

                                    $isOngoing = $fromDateTime <= $now && $toDateTime > $now;

                                    $userInterested = Auth::check() && isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->interested;
                                    $userGoing = Auth::check() && isset($userEvents[$event->id]) && $userEvents[$event->id]->pivot->going;
                                ?>
                            
                                <div class="card-list mt-8" data-event-id="{{ $event->id }}">
                                    <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                        <div class="card-list-media md:w-40 md:h-full w-full h-36">
                                            <img class="lazy-load"
                                                data-src="{{ asset('storage/' . App\Helpers\ImageHelper::getThumbnailPath($event->main_image)) }}"
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
                                        <div class="flex items-center gap-2 self-end pt-2 sm:justify-end">
                                            <button type="button" class="button button1 bg-secondery max-sm:flex-1 interested-btn"><ion-icon name="star-outline" class="text-xl md hydrated" role="img" aria-label="star outline"></ion-icon> {{ $userInterested ? 'Uninterested' : 'Interested' }}</button>
                                            <button type="button" class="button button1 bg-secondery max-sm:flex-1 going-btn"><ion-icon name="checkmark-circle-outline" class="text-xl md hydrated" role="img" aria-label="checkmark circle outline"></ion-icon>  {{ $userGoing ? 'Not Going' : 'Going' }}</button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="card-list-divider">
                            @endforeach                        
                            @else
                                <p>No events found.</p>
                            @endif
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

            <div class="box p-5 px-6 border1 ">

                <div class="flex justify-between text-black ">
                    <h3 class="font-bold text-base">Featured Events </h3>
                    <button type="button">
                        <ion-icon name="sync-outline" class="text-xl"></ion-icon>
                    </button>
                </div>

                <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                    uk-slider="autoplay: true;finite: true">

                    <div class="overflow-hidden uk-slider-container">

                        <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                            @if($topEvents->count() > 0)
                            @foreach ($topEvents as $topevent)
                                <li class="w-full pr-2">
                                    <a href="{{ route('event.show', ['slug' => $topevent->slug]) }}">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img class="lazy-load"
                                                data-src="{{ asset('storage/' . App\Helpers\ImageHelper::getThumbnailPath($topevent->main_image)) }}"
                                                alt="{{ $event->title }}">
                                            </div>
                                            <div class="absolute right-0 top-0 m-2 bg-white/60 rounded-full py-0.5 px-2 text-sm font-semibold">
                                                ${{ $topevent->price }} 
                                            </div>
                                        </div>
                                        <div class="mt-3 w-full">{{ $topevent->title }}</div>
                                        <div class="mt-1 w-full"><span class="text-teal-600 font-semibold text-xs">{{ $topevent->city }}, {{ $topevent->state }}</span></div>
                                    </a>
                                </li>
                            @endforeach
                        @endif

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



        </div>
    </div>
</div>

<script>
const isAuthenticated=@json(Auth::check());const loginUrl="{{ route('user.login') }}";document.addEventListener('DOMContentLoaded',function(){document.querySelectorAll('.interested-btn').forEach(button=>{button.addEventListener('click',function(){let eventCard=this.closest('.card-list');let eventId=eventCard.getAttribute('data-event-id');if(!isAuthenticated){localStorage.setItem('intendedUrl',window.location.href);localStorage.setItem('intendedAction',JSON.stringify({type:'interested',eventId:eventId}));toastr.warning('You must be logged in');setTimeout(function(){window.location.href=loginUrl},2000);return}
updateEventCount(eventId,'interested',this)})});document.querySelectorAll('.going-btn').forEach(button=>{button.addEventListener('click',function(){let eventCard=this.closest('.card-list');let eventId=eventCard.getAttribute('data-event-id');if(!isAuthenticated){localStorage.setItem('intendedUrl',window.location.href);localStorage.setItem('intendedAction',JSON.stringify({type:'going',eventId:eventId}));toastr.warning('You must be logged in');setTimeout(function(){window.location.href=loginUrl},2000);return}
updateEventCount(eventId,'going',this)})});const intendedAction=JSON.parse(localStorage.getItem('intendedAction'));if(intendedAction){updateEventCount(intendedAction.eventId,intendedAction.type,document.querySelector(`[data-event-id="${intendedAction.eventId}"] .${intendedAction.type}-btn`));localStorage.removeItem('intendedAction')}});function updateEventCount(eventId,type,button){fetch(`/events/${eventId}/update-count`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},body:JSON.stringify({type:type})}).then(response=>response.json()).then(data=>{if(data.success){let eventCard=document.querySelector(`.card-list[data-event-id="${eventId}"]`);if(type==='interested'){let interestedCount=eventCard.querySelector('.interested-count');interestedCount.textContent=`${data.interested_count} Interested`;let userInterested=eventCard.getAttribute('data-user-interested')==='true';eventCard.setAttribute('data-user-interested',!userInterested);button.textContent=userInterested?'Interested':'Uninterested';toastr.success('Successfully updated interest status.')}else if(type==='going'){let goingCount=eventCard.querySelector('.going-count');goingCount.textContent=`${data.going_count} Going`;let userGoing=eventCard.getAttribute('data-user-going')==='true';eventCard.setAttribute('data-user-going',!userGoing);button.textContent=userGoing?'Going':'Not Going';toastr.success('Successfully updated going status.')}}else{if(data.message==='You must be logged in'){toastr.warning(data.message);setTimeout(function(){window.location.href=loginUrl},2000)}else{toastr.error('Failed to update status.')}}}).catch(error=>{toastr.error('An error occurred. Please try again.');console.error('Error:',error)})}
document.getElementById('filter-toggle-form').addEventListener('click',function(){var form=document.getElementById('filter-form-category');var icon=document.getElementById('filter-icon-form');if(form.classList.contains('hidden')){form.classList.remove('hidden');icon.classList.add('rotate-180')}else{form.classList.add('hidden');icon.classList.remove('rotate-180')}});document.getElementById('filter-toggle').addEventListener('click',function(){var form=document.getElementById('filter-form');var icon=document.getElementById('filter-toggle-form1');if(form.classList.contains('hidden')){form.classList.remove('hidden');icon.classList.add('rotate-180')}else{form.classList.add('hidden');icon.classList.remove('rotate-180')}})
                </script>
<script>document.addEventListener('DOMContentLoaded',function(){const lazyImages=document.querySelectorAll('img.lazy-load'),placeholder='{{ asset("storage/placeholder-image.webp") }}';lazyImages.forEach(img=>{img.setAttribute('loading','lazy'),img.setAttribute('src',placeholder)});if('IntersectionObserver'in window){let lazyImageObserver=new IntersectionObserver(function(entries,observer){entries.forEach(function(entry){if(entry.isIntersecting){let img=entry.target;const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load'),lazyImageObserver.unobserve(img)}})});lazyImages.forEach(function(img){lazyImageObserver.observe(img)})}else lazyImages.forEach(function(img){const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load')})});</script>
<script>function resetFilter() { const url = new URL(window.location.href); url.searchParams.delete('filter_date'); window.location.href = url.href; }</script>


@endsection