@extends('layouts.main')
@section('title', 'EverSabz: Sustainable Living Solutions & Eco-Friendly Products')
@section('description', 'Discover Eversabz: Your go-to destination for eco-friendly products and sustainable living tips. Embrace a greener lifestyle with our curated selection.')
@section('content')


<style>
    .desktop-view-sections .card:hover{    box-shadow: 0px 0px 4px;}

</style>
<main id="site__main" class="2xl:ml-[--w-side]  xl:ml-[--w-side-sm]  h-[calc(100vh-var(--m-top))] ">

    <div id="site__sidebar"
        class="site__sidebar desktop fixed top-0 left-0 z-[99] pt-[--m-top] overflow-hidden transition-transform xl:duration-500 max-xl:w-full max-xl:-translate-x-full">

        <div
            class="p-2 max-xl:bg-white shadow-sm 2xl:w-72 sm:w-64 w-[80%] h-[calc(100vh-64px)] relative z-30 max-lg:border-r">

            <div class="pr-4" data-simplebar>

                <nav id="side">
                    <ul>
                        <li>
                            <a href="{{ asset ('/') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-home"></span>
                                <span> Home </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route ('products.category_list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-category"></span>

                                <span> Category List </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('business/list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-business"></span>

                                <span> Business List </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route ('ngo.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-ngo"></span>

                                <span class="">Sabz-Future </span>
                            </a>

                        </li>
                        <li>
                            <a href="{{ route ('adsList') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-market"></span>

                                <span> Marketplace </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('shop/products') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-shop"></span>

                                <span>Shop Now </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('events.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-event"></span>

                                <span> Events List </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('jobs.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-business"></span>

                                <span> Jobs List </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('candidates.index') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-category"></span>

                                <span> Professionals </span>
                            </a>
                        </li>




                        <li class="navbar-item ">
                            <a class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 "
                                href="{{ route ('blogs') }}">


                                <span class="spriticon spriticon-blog"></span>


                                <span>
                                    Blogs</span>
                            </a>

                        </li>

                        <li class="navbar-item " style="margin-top: -18px;">
                            <a class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 "
                                href="{{ route ('blogs') }}">


                                <span class="spriticon spriticon-category"></span>


                                <span>
                                    Quick Track</span>
                            </a>

                        </li>


                    </ul>

                    <hr>

                    <ul>
                        <p class="navbar-link" style="font-size: 14px;padding: 10px 15px;">Quick Links</p>

                        <li>
                            <a href="{{ asset ('about-us') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-about"></span>

                                <span> About Us </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route ('show.contact-us') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-contact"></span>

                                <span> Contact Us </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('helpcenter.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-contact"></span>

                                <span> Help Center </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('terms-of-use') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-terms"></span>

                                <span> Terms of Use </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('privacy-policy') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                                <span class="spriticon spriticon-privacy"></span>

                                <span> Privacy Policy </span>
                            </a>
                        </li>



                    </ul>
                </nav>
                <div class="text-xs font-medium flex flex-wrap gap-2 gap-y-0.5 p-2 mt-2">
                    <p>© Eversabz 2025.<br> All Rights Reserved.</p>
                </div>
                <div class="bottom-footer-height"></div>



            </div>

        </div>

        <div id="site__sidebar__overly" class="absolute top-0 left-0 z-20 w-screen h-screen xl:hidden backdrop-blur-sm"
            uk-toggle="target: #site__sidebar ; cls :!-translate-x-0">
        </div>
    </div>




    <div class="lg:flex 2xl:gap-12 gap-10 2xl:max-w-[1220px] max-w-[1065px] mx-auto" id="js-oversized">

        <div class="flex-1">

            <div class="lg:max-w-[680px] w-full">

                <div class="page-heading">

                    <h1 class="text-xl font-semibold text-black"> Featured Business </h1>
                    <a href="{{ asset ('business/list') }}" class="btn btn-inline">
                        <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <span></span></a>
                </div>


                <div class="relative" tabindex="-1" uk-slider="autoplay: true; autoplay-interval: 2500; autoplay-velocity: 0.3; finite: false; pause-on-hover: true">
                    <div class="uk-slider-container pb-1">
                        <ul class="uk-slider-items w-[calc(100%+14px)]"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 1;repeat:true">

                            @foreach($businesses as $business)
                            <li class="pr-3 md:w-1/3 w-1/2" uk-scrollspy-class="uk-animation-fade">
                                <div class="card">
                                    <a href="{{ route('business.show', ['slug' => $business->slug]) }}">
                                        <div class="card-media sm:aspect-[2/1.7] h-36">
                                            <img class="lazy-load"
                                                src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                data-src="{{ $business->logo_path ? asset('storage/' . $business->logo_path) : asset('storage/no-image.png') }}"
                                                alt="{{ $business->business_name }}">
                                            <div class="card-overly"></div>
                                        </div>
                                    </a>
                                    <div class="card-body relative">
                                        <span class="text-teal-600 font-semibold text-xs">
                                            {{ $business->businessCategory->name }}
                                        </span>
                                        <a href="{{ route('business.show', ['slug' => $business->slug]) }}">
                                            <p class="card-text line-clamp-1 text-black mt-0.5">
                                                {{ $business->business_name }}
                                            </p>
                                        </a>
                                        @if ($business->price)
                                        <div class="-top-3 absolute bg-blue-100 font-medium px-2 py-0.5 right-2 rounded-full text text-blue-500 text-sm z-20">
                                            ${{ $business->price }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>

                        <!-- Navigation -->
                        <button type="button"
                            class="absolute bg-white rounded-full top-16 -left-4 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                            uk-slider-item="previous">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <polyline fill="none" stroke="#000000" stroke-width="2"
                                    points="9 6 15 12 9 18" transform="matrix(-1 0 0 1 24 0)">
                                </polyline>
                            </svg>
                        </button>
                        <button type="button"
                            class="absolute -right-4 bg-white rounded-full top-16 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                            uk-slider-item="next">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <polyline fill="none" stroke="#000000" stroke-width="2"
                                    points="9 6 15 12 9 18">
                                </polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Dots -->
                    <div class="flex justify-center">
                        <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                    </div>
                </div>



                <div class="relative" tabindex="-1" 
                     uk-slider="autoplay: true; autoplay-interval: 2500; finite: false; sets: true; pause-on-hover: true">

                    <div class="sm:my-6 my-3 flex items-center justify-between border-t pt-3 ">
                        <div>
                            <h2 class="text-xl font-semibold text-black"> Featured Products </h2>
                            <p class="font-normal text-sm text-gray-500 leading-6 hidden"> Find a group by browsing top
                                businesses. </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="#" class="absolute bg-white rounded-full grid w-7 h-7 place-items-center shadow mobile-view-sections featured-products-view-sections1"
                               uk-slider-item="previous">
                                <svg width="20px" height="20px" viewBox="0 0 24 24">
                                    <polyline fill="none" stroke="#000000" stroke-width="2"
                                        points="9 6 15 12 9 18"
                                        transform="matrix(-1 0 0 1 24 0)"></polyline>
                                </svg>
                            </a>
                            <a href="#" class="absolute bg-white rounded-full grid w-7 h-7 place-items-center shadow mobile-view-sections featured-products-view-sections2"
                               uk-slider-item="next">
                                <svg width="20px" height="20px" viewBox="0 0 24 24">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="uk-slider-container pb-1">
                        @if($topProducts->isNotEmpty())
                        <ul class="uk-slider-items w-[calc(100%+14px)] transition-transform duration-700 ease-linear"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 20; repeat: true">

                            @foreach ($topProducts as $product)
                            <li class="pr-4 sm:w-1/2 w-full" uk-scrollspy-class="uk-animation-fade">
                                <div class="card flex gap-1">
                                    <a href="{{ route('BusinessProduct.view', ['item_url' => $product->item_url]) }}">
                                        <div class="card-media w-32 max-h-full h-full shrink-0">
                                            <img class="lazy-load"
                                                src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                data-src="{{ asset('storage/' . $product->main_image) }}"
                                                alt="{{ $product->title }}">
                                            <div class="card-overly"></div>
                                        </div>
                                    </a>
                                    <div class="card-body flex-1 py-4">
                                        <a href="{{ route('BusinessProduct.view', ['item_url' => $product->item_url]) }}">
                                            <h4 class="card-title">
                                                {{ strlen($product->title) > 18 ? substr($product->title, 0, 18) . '...' : $product->title }}
                                            </h4>
                                        </a>
                                        <a href="{{ route('products.by_subcategory', [$product->category->slug, $product->subcategory->slug]) }}">
                                            <p class="card-text">{{ $product->subcategory->name }}</p>
                                        </a>
                                        <div class="text-xl flex items-center justify-between mt-2">
                                            <h4 class="card-title">${{ $product->price }} / <span>${{ $product->mrp }}</span></h4>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('BusinessProduct.view', ['item_url' => $product->item_url]) }}" class="button border bg-white !w-auto">View</a>
                                            <button type="button"
                                                class="wishlistButton {{ $product->isInWishlist() ? 'fas' : 'far' }} button bg-primary text-white flex-1 wishlist-button-home-page"
                                                data-wishable-id="{{ Crypt::encryptString($product->id) }}"
                                                data-wishable-type="App\Models\BusinessProduct">
                                                <i class="{{ $product->isInWishlist() ? 'fas' : 'far' }} fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p class="no-found-homepage">No products found.</p>
                        @endif
                    </div>
                </div>


                <div class="sm:mt-6 mt-3 flex items-center justify-between border-t pt-3 ">
                    <div>
                        <h2 class="text-xl font-semibold text-black"> Categories
                            <p class="font-normal text-sm text-gray-500 leading-6"> Find a group by browsing top
                                categories. </p>
                    </div>
                </div>

                <div class="relative" tabindex="-1" 
                     uk-slider="autoplay: true; autoplay-interval: 2500; autoplay-velocity: 0.3; finite: false; pause-on-hover: true">

                    <div class="py-5 uk-slider-container">
                        <ul class="uk-slider-items w-[calc(100%+12px)]"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 20;repeat:true">

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('ads-post/list') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 justify-between bg-sky-600 rounded-md">
                                        <div><h4 class="font-medium !text-white whitespace-nowrap">Marketplace</h4></div>
                                        <span class="spriticoncategory spriticon-ads"></span>
                                    </div>
                                </a>
                            </li>

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('shop/products') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 item-center justify-between bg-rose-500 rounded-md">
                                        <div><h4 class="font-medium !text-white">Shop Now</h4></div>
                                        <span class="spriticoncategory spriticon-products"></span>
                                    </div>
                                </a>
                            </li>

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('business/list') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 item-center justify-between bg-teal-600 rounded-md">
                                        <div><h4 class="font-medium !text-white">Businesses</h4></div>
                                        <span class="spriticoncategory spriticon-businesses"></span>
                                    </div>
                                </a>
                            </li>

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('events/events-list') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 item-center justify-between bg-sky-600 rounded-md">
                                        <div><h4 class="font-medium !text-white">Events</h4></div>
                                        <span class="spriticoncategory spriticon-events"></span>
                                    </div>
                                </a>
                            </li>

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ route('ngo.list') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 item-center justify-between bg-rose-500 rounded-md">
                                        <div><h4 class="font-medium !text-white">Sabz-Future</h4></div>
                                        <span class="spriticoncategory spriticon-ngos"></span>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <!-- Prev / Next -->
                        <button type="button"
                            class="absolute bg-white rounded-full top-16 -left-4 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                            uk-slider-item="previous">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <polyline fill="none" stroke="#000000" stroke-width="2"
                                          points="9 6 15 12 9 18"
                                          transform="matrix(-1 0 0 1 24 0)"></polyline>
                            </svg>
                        </button>
                        <button type="button"
                            class="absolute -right-4 bg-white rounded-full top-16 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                            uk-slider-item="next">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"></polyline>
                            </svg>
                        </button>

                        <!-- Dots -->
                        <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                        </div>
                    </div>
                </div>


                <div class="sm:my-6 my-3 flex items-center justify-between border-t pt-3 ">
                    <div>
                        <h2 class="text-xl font-semibold text-black"> Marketplace </h2>
                        <p class="font-normal text-sm text-gray-500 leading-6 hidden"> Find a group by browsing top
                            categories. </p>
                    </div>
                    <a href="{{ route ('adsList') }}" class="btn btn-inline text-blue-500 sm:block  text-sm"> <svg
                            class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg><span></span></a>
                </div>


                <div class="grid sm:grid-cols-3 grid-cols-2 gap-3"
                    data-uk-scrollspy="target: > div; cls: uk-animation-scale-up; delay: 100; repeat: true">
                    @if($posts->isEmpty())
                    <div class="text-center text-gray-500 mt-10">
                        <p>No posts available at the moment. Please check back later!</p>
                    </div>
                    @else
                    @foreach($posts as $post)
                    <div class="card uk-transition-toggle">
                        <a href="{{ route('product.show', $post->item_url) }}" title="{{$post->title}}">
                            <div class="card-media sm:aspect-[2/1.7] h-36">
                                <img class="lazy-load" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                    data-src="{{ $post->primaryImage ? asset('storage/' . App\Helpers\ImageHelper::getThumbnailPath($post->primaryImage->url)) : asset('storage/no-image.jpg') }}"
                                    alt="{{ $post->title }}">
                                <div class="card-overly"></div>
                            </div>
                        </a>
                        <div class="card-body">
                            <div class="flex-1  flex justify-between">
                                <p class="text-xs line-clamp-1 mt-1">
                                    {{ $post->subcategory->name }}</p>
                                <h4 class="card-title">${{ $post->price }}</h4>
                            </div>
                            <div class="card-text text-black font-medium line-clamp-1">{{ $post->title }}</div>
                        </div>
                        <div
                            class="absolute w-full bottom-0 bg-white/20 backdrop-blur-sm uk-transition-slide-bottom-small max-xl:h-full z-[2] flex flex-col justify-center">
                            <div class="flex gap-3 py-4 px-3">
                                <button
                                    class="wishlistButton {{ $post->isInWishlist ? 'fas' : 'far' }}  button bg-primary text-white flex-1 wishlist-button-home-pag"
                                    data-wishable-id="{{ Crypt::encryptString($post->id) }}"
                                    data-wishable-type="App\Models\AdPost">
                                    <i class="{{ $post->isInWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                    <!-- <svg class="w-6 h-6 text-white-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                    </svg> -->
                                </button>
                                <a href="{{ route('product.show', $post->item_url) }}" title="{{$post->title}}"
                                    class="button border bg-white !w-auto">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>



            </div>


        </div>

        <div class="2xl:w-[380px] lg:w-[330px] w-full right-sidebar-1">

            <div class="lg:space-y-6 space-y-4 lg:pb-8 sm:grid-cols-2 max-lg:gap-6"
                uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                <div class="box p-5 px-6">

                    <div class="flex items-baseline justify-between text-black ">
                        <h3 class="font-bold text-base"> Top Organizations </h3>
                        <a href="{{ route ('ngo.list') }}" class="btn btn-inline text-blue-500 sm:block  text-sm">
                            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z">
                                </path>
                            </svg>
                        </a>
                    </div>



                    <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2   uk-slider-items">

                                @foreach ($ngos as $ngo)
                                <li class="w-full pr-2">


                                    <div class="relative overflow-hidden rounded-lg">
                                        <div class="relative w-full card-media1 media-image1">
                                             <a href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                            <img class="lazy-load"
                                                src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                data-src="{{ asset('storage/' . $ngo->logo_path) }}"
                                                alt="{{ $ngo->ngo_name }}">
                                            </a>
                                        </div>

                                    </div>
                                    <a href="{{ route('ngo.show', ['id' => urlencode(Crypt::encryptString($ngo->id))]) }}">
                                    <div class="card-text line-clamp-1 text-black mt-0.5">{{ $ngo->ngo_name }}</div>
                                    </a>

                                    <div class="mt-1 w-full"> <span class="text-teal-600 font-semibold text-xs">{{
                                            $ngo->category->name ?? 'No Category' }}</span></div>

                                </li>
                                @endforeach


                            </ul>

                            <button type="button"
                                class="absolute bg-white rounded-full top-16 -left-4 grid w-7 h-7 place-items-center shadow  mobile-view-sections"
                                uk-slider-item="previous">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"
                                        transform="matrix(-1 0 0 1 24 0)"></polyline>
                                </svg>
                            </button>
                            <button type="button"
                                class="absolute -right-4 bg-white rounded-full top-16 grid w-7 h-7 place-items-center shadow  mobile-view-sections"
                                uk-slider-item="next">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18">
                                    </polyline>
                                </svg>
                            </button>

                        </div>
                        <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                        </div>

                    </div>


                </div>

                <div class="box p-5 px-6 border1 ">

                    <div class="flex justify-between text-black ">
                        <h3 class="font-bold text-base">Upcoming Events </h3>

                        <a href="{{ route ('events.list') }}" class="btn btn-inline text-blue-500 sm:block  text-sm">
                            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z">
                                </path>
                            </svg>
                        </a>
                    </div> 

                    <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">
                            <ul class="-ml-2 uk-slider-items">
                                @if($events->isNotEmpty())
                                @foreach ($events as $event) 
                                <li class="w-full pr-2">
                                    <div class="relative overflow-hidden rounded-lg">
                                        <div class="relative w-full card-media1 media-image1">
                                            <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                                <img class="lazy-load"
                                                    src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                    data-src="{{ asset('storage/' . App\Helpers\ImageHelper::getThumbnailPath($event->main_image)) }}"
                                                    alt="{{ $event->title }}">
                                            </a>
                                        </div>
                                        <!-- <div
                                            class="absolute right-0 top-0 m-2 bg-white/60 rounded-full py-0.5 px-2 text-sm font-semibold">
                                            ${{ $event->price }}
                                        </div> -->
                                    </div>
                                    <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                        <div class="card-text line-clamp-1 text-black mt-0.5">{{ $event->title }}</div>
                                    </a>
                                    <div class="mt-1 w-full">
                                        <span class="text-teal-600 font-semibold text-xs">{{ $event->city }}, {{
                                            $event->state }}</span>
                                    </div>
                                </li>
                                @endforeach
                                @else
                                <p>No events available.</p>
                                @endif

                            </ul>

                            @if($events->isNotEmpty())
                            <button type="button"
                                class="absolute bg-white rounded-full top-16 -left-4 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                                uk-slider-item="previous">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"
                                        transform="matrix(-1 0 0 1 24 0)"></polyline>
                                </svg>
                            </button>
                            <button type="button"
                                class="absolute -right-4 bg-white rounded-full top-16 grid w-7 h-7 place-items-center shadow mobile-view-sections"
                                uk-slider-item="next">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18">
                                    </polyline>
                                </svg>
                            </button>
                            @endif
                        </div>

                        <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center mt-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                        </div>

                    </div>



                </div>

                <div class="box p-5 px-6 border1  mobile-view-sections">
                    <div class="flex justify-between text-black ">
                        <h3 class="font-bold text-base">Top Users</h3>
                    </div>

                    <div class="relative capitalize font-normal text-sm mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                               @foreach ($users as $user)
                                @php
                                if (!empty($user->businessInfos)) {
                                    // $encryptedId = Crypt::encrypt($user->businessInfos->id);
                                    $encryptedId = $user->businessInfos->slug;
                                    $image = $user->businessInfos->logo_path;
                                    $name = $user->businessInfos->business_name;
                                    $created = $user->businessInfos->created_at;
                                    $profile_url = 'seller.profile';
                                    
                                } else {
                                    // $encryptedId = Crypt::encrypt($user->id);
                                    $encryptedId = $user->name;
                                    $image = $user->image;
                                    $name = $user->username;
                                    $created = $user->created_at;
                                    $profile_url = 'Userprofile';
                                }
                                @endphp
                                <li class="w-1/5 pr-2 profile-image-section">
                                    <a href="{{ route($profile_url, ['slug' => $encryptedId]) }}" class="author-img active">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                             data-src="{{ $image ? asset('storage/' . $image) : asset('storage/no-image.jpg') }}"
                                             alt="{{ $name }}" uk-img>
                                    </a>
                                </li>
                                @endforeach
                            </ul>


                            <button type="button"
                                class="absolute -translate-y-1/2 bg-slate-100 rounded-full top-1/2 -left-4 grid w-7 h-7 place-items-center "
                                uk-slider-item="previous">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"
                                        transform="matrix(-1 0 0 1 24 0)"></polyline>
                                </svg>
                            </button>
                            <button type="button"
                                class="absolute -right-4 -translate-y-1/2 bg-slate-100 rounded-full top-1/2 grid w-7 h-7 place-items-center "
                                uk-slider-item="next">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18">
                                    </polyline>
                                </svg>
                            </button>

                        </div>

                    </div>
                </div>


                <div class="box p-5 px-6 border1 ">
                    <div class="flex justify-between text-black ">
                        <h3 class="font-bold text-base">Top Cities</h3>
                    </div>

                    <div class="relative capitalize font-normal text-sm mt-4 mb-2 mobile-view-sections1" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                                @foreach ($topCities as $city)
                                <li class="w-1/3 pr-2">
                                    <form action="{{ route('home') }}" method="GET">
                                        <input type="hidden" name="city" value="{{ $city->city }}">
                                        <button type="submit" class="w-full">
                                            <div class="flex flex-col items-center shadow-sm p-2 rounded-xl border1">
                                                <div class="mt-5 text-center w-full">
                                                    <h5 class="font-semibold">{{ $city->city }}</h5>
                                                    <div class="text-xs text-gray-400 mt-0.5 font-medium">
                                                        ({{ $city->total }})
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                                @endforeach
                            </ul>

                            <button type="button"
                                class="absolute -translate-y-1/2 bg-slate-100 rounded-full top-1/2 -left-4 grid w-7 h-7 place-items-center "
                                uk-slider-item="previous">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18"
                                        transform="matrix(-1 0 0 1 24 0)"></polyline>
                                </svg>
                            </button>
                            <button type="button"
                                class="absolute -right-4 -translate-y-1/2 bg-slate-100 rounded-full top-1/2 grid w-7 h-7 place-items-center "
                                uk-slider-item="next">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline fill="none" stroke="#000000" stroke-width="2" points="9 6 15 12 9 18">
                                    </polyline>
                                </svg>
                            </button>

                        </div>

                    </div>

                    <div class="grid sm:grid-cols-3 grid-cols-2 gap-3 desktop-view-sections"
                        data-uk-scrollspy="target: > div; cls: uk-animation-scale-up; delay: 100; repeat: true">
                        @foreach ($topCities as $city)
                        <div class="card uk-transition-toggle">


                            <div class="">

                                <div class="card-text text-black font-medium line-clamp-1">
                                    <form action="{{ route('home') }}" method="GET">
                                        <input type="hidden" name="city" value="{{ $city->city }}">
                                        <button type="submit" class="w-full">
                                            <div class="flex flex-col items-center ">
                                                <div class="my-3 text-center w-full">
                                                    <h5 class="font-semibold">{{ $city->city }}</h5>
                                                    <div class="text-xs text-gray-400 mt-0.5 font-medium">
                                                        ({{ $city->total }})
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </div>

                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="box p-5 px-6 border1  mobile-view-sections">

                    <div class="flex justify-between text-black ">
                        <h3 class="font-bold text-base"> Trends for you </h3>

                    </div>

                    <div class="space-y-3.5 capitalize text-xs font-normal mt-5 mb-2 text-gray-600 /80">
                        <a href="#">
                            <div class="flex items-center gap-3 p">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-black  text-sm"> Registered Business
                                    </h4>
                                    <div class="mt-0.5"> {{ $footerData['registeredBusinessCount'] }}+ </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-black  text-sm"> Products</h4>
                                    <div class="mt-0.5"> {{ $footerData['productsCount'] }}+ </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-black  text-sm"> Ads published</h4>
                                    <div class="mt-0.5">{{ $footerData['productsCount'] }}+</div>
                                </div>
                            </div>
                        </a>

                    </div>


                </div>

            </div>
        </div>

    </div>
</main>

@endsection