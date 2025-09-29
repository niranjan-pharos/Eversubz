@extends('layouts.main')


@section('content')
<style>
.fa{font-size:20px}.card-title{font-size:.875rem;line-height:1.5rem}.page-heading{display:flex;justify-content:space-between}.btn.btn-inline{padding:0 10px 0 8px;line-height:28px;height:30px;width:30px;border-radius:50%;font-size:13px;color:#fff;background:#04b;border-color:#04b}.category-images{width:50px}.site__sidebar.mobile{display:none}@media only screen and (max-width:767px){.right-sidebar-1{margin-top:50px;border-top:2px solid #ddd;padding-top:30px;padding-bottom:40px}.site__sidebar.desktop{display:none}.site__sidebar.mobile{display:block}main{padding:0 30px}}body{display:flex;flex-direction:column}#wrapper{flex:1;display:flex;flex-direction:column}main{flex:1;display:flex;height:100vh}@media (max-width:768px){main{display:block}}
</style>
<main id="site__main" class="2xl:ml-[--w-side]  xl:ml-[--w-side-sm]  h-[calc(100vh-var(--m-top))] mt-[--m-top]">

    <div id="site__sidebar"
        class="site__sidebar desktop fixed top-0 left-0 z-[99] pt-[--m-top] overflow-hidden transition-transform xl:duration-500 max-xl:w-full max-xl:-translate-x-full">

        <div
            class="p-2 max-xl:bg-white shadow-sm 2xl:w-72 sm:w-64 w-[80%] h-[calc(100vh-64px)] relative z-30 max-lg:border-r">

            <div class="pr-4" data-simplebar>

                <nav id="side">
                    <ul>
                        <li>
                            <a href="{{ asset ('/') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('main_assets/images/icons/home.png') }}" alt="feeds" class="w-6">
                                <span> Home </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route ('products.category_list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/category-list.png') }}" alt="messages"
                                    class="w-5">
                                <span> Category List </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('business/list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/business-list.png') }}" alt="messages"
                                    class="w-5">
                                <span> Business List </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('adsList') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/market.png') }}" alt="messages" class="w-5">
                                <span> Marketplace </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('shop/products') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/shop.png') }}" alt="messages" class="w-5">
                                <span>Shop Now </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route ('events.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/event-2.png') }}" alt="messages" class="w-5">
                                <span> Events List </span>
                            </a>
                        </li>

                        <li class="navbar-item ">
                            <a class="flex items-center gap-2 p-2 rounded hover:bg-gray-100"
                                href="{{ route ('blogs') }}">

                                <img class="w-5" src="{{ asset('assets/images/icons/blog.png') }}" alt="user"><span>
                                    blogs</span></a>

                        </li>


                    </ul>

                    <hr>

                    <ul>
                        <p class="navbar-link" style="font-size: 14px;padding: 10px 15px;">Pages</p>

                        <li>
                            <a href="{{ asset ('about-us') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/aboutus.png') }}" alt="feeds" class="w-6">
                                <span> About Us </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route ('show.contact-us') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/contactus.png') }}" alt="messages" class="w-5">
                                <span> Contact Us </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('terms-of-use') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/terms-condition.png') }}" alt="messages"
                                    class="w-5">
                                <span>Terms of Use</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset ('privacy-policy') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/privacy-policy.png') }}" alt="messages"
                                    class="w-5">
                                <span> Privacy Policy </span>
                            </a>
                        </li>



                    </ul>
                </nav>
                <div class="text-xs font-medium flex flex-wrap gap-2 gap-y-0.5 p-2 mt-2">
                    <p>© Eversabz 2024. All Rights Reserved.</p>
                </div>



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

                    <h1 class="page-title test"> Featured Business </h1>
                    <a href="{{ asset ('business/list') }}" class="btn btn-inline"><i
                            class="fas fa-eye"></i><span></span></a>
                </div>


                <div class="relative" tabindex="-1" uk-slider="auto play: true;finite: true">

                    <div class="uk-slider-container pb-1">

                        <ul class="uk-slider-items w-[calc(100%+14px)]"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 1;repeat:true">

                            @foreach($businesses as $business)
                            <li class="pr-3 md:w-1/3 w-1/2" uk-scrollspy-class="uk-animation-fade">
                                <div class="card">
                                    <a href="{{ route('business.show', ['slug' => $business->slug]) }}">
                                        <div class="card-media sm:aspect-[2/1.7] h-36">
                                            <img src="{{ asset("storage/".$business->logo_path) }}" alt="">
                                            <div class="card-overly"></div>
                                        </div>
                                    </a>
                                    <div class="card-body relative">
                                        <span
                                                class="text-teal-600 font-semibold text-xs">{{ $business->businessCategory->name }}</span>
                                        <a href="{{ route('business.show', ['slug' => $business->slug]) }}">
                                            <p class="card-text line-clamp-1 text-black mt-0.5">
                                                {{ $business->business_name }}
                                            </p>
                                        </a>
                                        @if ($business->price)

                                        <div
                                            class="-top-3 absolute bg-blue-100 font-medium px-2  py-0.5 right-2 rounded-full text text-blue-500 text-sm z-20">
                                            ${{ $business->price }}
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>

                    </div>


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

                    <div class="flex justify-center">
                        <ul class="inline-flex flex-wrap justify-center my-5 gap-2 uk-dotnav uk-slider-nav"></ul>
                    </div>

                </div>


                <div class="relative" tabindex="-1" uk-slider="auto play: true;finite: true">

                    <div class="sm:my-6 my-3 flex items-center justify-between border-t pt-3">
                        <div>
                            <h2 class="text-xl font-semibold text-black"> Featured Products </h2>
                            <p class="font-normal text-sm text-gray-500 leading-6 hidden"> Find a group by browsing top
                                businesses. </p>
                        </div>
                        <div class="flex items-center gap-2 [&:has(a.uk-invisible)][&*>a]:bg-red-600">
                            <a href="#" class="!block [&:has(.uk-invisible)]:opacity-20" uk-slider-item="previous">
                                <ion-icon name="chevron-back-outline"></ion-icon>
                            </a>
                            <a href="#" class="!block" uk-slider-item="next">
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                            </a>
                            <a href="{{ asset ('shop/products') }}"
                                class="btn btn-inline text-blue-500 sm:block  text-sm"><i
                                    class="fas fa-eye"></i><span></span></a>
                        </div>
                    </div>

                    <div class="uk-slider-container pb-1">


                        @if($topProducts->isNotEmpty())
                        <ul class="uk-slider-items w-[calc(100%+14px)]"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 20;repeat:true">
                            @foreach ($topProducts as $product)
                            @php
                            $image = !empty($product->main_image) ? $product->main_image : 'no-image.jpg';
                            @endphp
                            <li class="pr-4 sm:w-1/2 w-full" uk-scrollspy-class="uk-animation-fade">
                                <div class="card flex gap-1">
                                    {{-- <a href=""> --}}
                                        <div class="card-media w-32 max-h-full h-full shrink-0">
                                            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('storage/no-image.jpg') }}"
                                                alt="">
                                            <div class="card-overly"></div>
                                        </div>
                                    {{-- </a> --}}
                                    <div class="card-body flex-1 py-4">
                                        @php
                                        $viewUrl = route('BusinessProduct.view', ['item_url' => $product->item_url]);
                                        @endphp
                                        <a href="{{ $viewUrl }}">
                                            <h4 class="card-title">
                                                {{ strlen($product->title) > 18 ? substr($product->title, 0, 18) . '...' : $product->title }}
                                            </h4>
                                        </a>
                                        <a
                                            href="{{ route('products.by_subcategory', [$product->category->slug, $product->subcategory->slug]) }}">
                                            <p class="card-text">{{ $product->subcategory->name }}</p>
                                        </a>
                                        <div class="text-xl flex items-center justify-between mt-2">
                                            <h4 class="card-title">${{ $product->price }} /
                                                <span>${{ $product->mrp }}</span></h4>
                                            <button type="button"
                                                class="button bg-secondery !w-auto rounded-fulld hidden">View</button>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ $viewUrl }}" title="Compare"
                                                class="button bg-primary-soft text-primary flex-1">View</a>
                                            <button type="button" title="Wishlist"
                                                aria-label="{{ $product->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
                                                class="fa-heart wishlistButton {{ $product->isInWishlist ? 'fas' : 'far' }} button bg-secondery !w-auto"
                                                data-wishable-id="{{ Crypt::encryptString($product->id) }}"
                                                data-wishable-type="App\Models\BusinessProduct">
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

                        </ul>


                    </div>

                </div>

                <div class="sm:mt-6 mt-3 flex items-center justify-between border-t pt-3">
                    <div>
                        <h2 class="text-xl font-semibold text-black"> Categories
                            <p class="font-normal text-sm text-gray-500 leading-6"> Find a group by browsing top
                                categories. </p>
                    </div>
                </div>

                <div class="relative" tabindex="-1" uk-slider="auto play: true;finite: true">

                    <div class="py-5 uk-slider-container">

                        <ul class="uk-slider-items w-[calc(100%+12px)]"
                            uk-scrollspy="target: > li; cls: uk-animation-scale-up; delay: 20;repeat:true">

                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('ads-post/list') }}" class="suggest-card">
                                    <div class="p-4 flex gap-3 justify-between bg-sky-600 rounded-md">
                                        <div>
                                            <h4 class="font-medium !text-white whitespace-nowrap"> All Ads </h4>
                                           
                                        </div>
                                        <img src="{{ asset('assets/images/banner_cards/ads.png') }}"
                                            class="category-images" alt="Ads">

                                    </div>
                                </a>
                            </li>
                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset ('shop/products') }}" class="suggest-card">

                                    <div class="p-4 flex gap-3 item-center justify-between bg-rose-500 rounded-md">
                                        <div>
                                            <h4 class="font-medium !text-white"> All Products </h4>
                                        </div>
                                        <img src="{{ asset('assets/images/banner_cards/product.png') }}"
                                            class="category-images" alt="Products">

                                    </div>
                                </a>
                            </li>
                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('business/list') }}" class="suggest-card">

                                    <div class="p-4 flex gap-3 item-center justify-between bg-teal-600 rounded-md">
                                        <div>
                                            <h4 class="font-medium !text-white"> All Businesses </h4>
                                        </div>
                                        <img src="{{ asset('assets/images/banner_cards/business.png') }}"
                                            class="category-images" alt="Business">

                                    </div>
                                </a>
                            </li>
                            <li class="pr-3 md:w-1/3 w-auto" uk-scrollspy-class="uk-animation-fade">
                                <a href="{{ asset('events/events-list') }}" class="suggest-card">

                                    <div class="p-4 flex gap-3 item-center justify-between bg-sky-600 rounded-md">
                                        <div>
                                            <h4 class="font-medium !text-white"> All Events </h4>
                                        </div>
                                        <img src="{{ asset('assets/images/banner_cards/event.png') }}"
                                            class="category-images" alt="Events">

                                    </div>
                                </a>
                            </li>
                           
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

                        <div class="flex justify-center">
                            <ul class="inline-flex flex-wrap justify-center my-5 gap-2 uk-dotnav uk-slider-nav"> </ul>
                        </div>

                    </div>

                </div>

                <div class="sm:my-6 my-3 flex items-center justify-between border-t pt-3">
                    <div>
                        <h2 class="text-xl font-semibold text-black"> Marketplace </h2>
                        <p class="font-normal text-sm text-gray-500 leading-6 hidden"> Find a group by browsing top
                            categories. </p>
                    </div>
                    <a href="{{ route ('adsList') }}" class="btn btn-inline text-blue-500 sm:block  text-sm"><i
                            class="fas fa-eye"></i><span></span></a>
                </div>


                <div class="grid sm:grid-cols-3 grid-cols-2 gap-3"
                    data-uk-scrollspy="target: > div; cls: uk-animation-scale-up; delay: 100; repeat: true">
                    @foreach($posts as $post)

                    <div class="card uk-transition-toggle">
                        <a href="#">
                            <div class="card-media sm:aspect-[2/1.7] h-36">
                                <img src="{{ asset("storage/".$post->primaryImage->url) }}" alt="{{ $product->title}}">
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
                                <button type="button" class="button bg-primary text-white flex-1" title="Wishlist"
                                    aria-label="{{ $post->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
                                    class="far fa-heart wishlistButton {{ $post->isInWishlist ? 'fas' : 'far' }}"
                                    data-wishable-id="{{ Crypt::encryptString($post->id) }}"
                                    data-wishable-type="{{ get_class($post) }}">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('product.show', $post->item_url) }}" title="Compare"
                                    class="button border bg-white !w-auto">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>


        </div>

        <div class="2xl:w-[380px] lg:w-[330px] w-full right-sidebar-1">

            <div class="lg:space-y-6 space-y-4 lg:pb-8 sm:grid-cols-2 max-lg:gap-6"
                uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                <div class="box p-5 px-6">

                    <div class="flex items-baseline justify-between text-black">
                        <h3 class="font-bold text-base"> Top Ads </h3>
                        <a href="{{ route ('adsList') }}" class="text-sm text-blue-500">
                            <ion-icon name="sync-outline" class="text-xl"></ion-icon>
                        </a>
                    </div>



                    <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2   uk-slider-items">
                                @foreach ($featured as $feature)
                                <li class="w-full pr-2">


                                    <div class="relative overflow-hidden rounded-lg">
                                        <div class="relative w-full h-40 card-media1">
                                            <img src="{{ asset('storage/'. $feature->primaryImage->url) }}"
                                                alt="{{ $feature->title}}"
                                                class="object-contain  w-full h-full inset-0">
                                        </div>
                                        <div
                                            class="absolute right-0 top-0 m-2 bg-white/60 rounded-full py-0.5 px-2 text-sm font-semibold">
                                            ${{ $feature->price }} </div>
                                    </div>
                                    <a href="{{ route('product.show', $feature->item_url) }}">
                                        <div class="mt-3 w-full"> {{ $feature->title }}</div>
                                    </a>

                                    <div class="mt-1 w-full"> <span
                                            class="text-teal-600 font-semibold text-xs">{{ $feature->city }},
                                            {{ $feature->state }}</span></div>

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

                <div class="box p-5 px-6 border1">

                    <div class="flex justify-between text-black">
                        <h3 class="font-bold text-base">Upcoming Events </h3>

                        <a href="{{ route ('events.list') }}" class="text-sm text-blue-500">
                            <ion-icon name="sync-outline" class="text-xl"></ion-icon>
                        </a>
                    </div>

                    <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2   uk-slider-items">
                                @foreach ($events as $event)
                                <li class="w-full pr-2">


                                    <div class="relative overflow-hidden rounded-lg">
                                        <div class="relative w-full h-40 card-media1">
                                            <img src="{{ asset('storage/' . $event->main_image) }}"
                                                alt="{{ $product->title}}" alt=""
                                                class="object-contain  w-full h-full inset-0">
                                        </div>
                                        <div
                                            class="absolute right-0 top-0 m-2 bg-white/60 rounded-full py-0.5 px-2 text-sm font-semibold">
                                            ${{ $event->price }} </div>
                                    </div>
                                    <a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                        <div class="mt-3 w-full"> {{ $event->title }}</div>
                                    </a>

                                    <div class="mt-1 w-full"> <span
                                            class="text-teal-600 font-semibold text-xs">{{ $event->city }},
                                            {{ $event->state }}</span></div>

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

                

                <div class="box p-5 px-6 border1">
                    <div class="flex justify-between text-black">
                        <h3 class="font-bold text-base">Top Users</h3>
                    </div>

                    <div class="relative capitalize font-normal text-sm mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                                @foreach ($users as $user)


                                <li class="w-1/5 pr-2">
                                    {{-- <a href=""> --}}
                                        <div class="w-10 h-10 relative">
                                            <img src="{{ asset('storage/'.$user->image ) }}" alt="{{ $user->name }}"
                                                class="w-full h-full absolute inset-0 rounded-full">
                                            <div
                                                class="absolute bottom-0 right-0 m-0.5 bg-green-500 rounded-full w-2 h-2">
                                            </div>
                                        </div>
                                    {{-- </a> --}}

                                </li>
                                @endforeach

                            </ul>

                            <button type="button"
                                class="absolute -translate-y-1/2 bg-slate-100 rounded-full top-1/2 -left-4 grid w-9 h-9 place-items-center"
                                uk-slider-item="previous">
                                <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                            </button>
                            <button type="button"
                                class="absolute -right-4 -translate-y-1/2 bg-slate-100 rounded-full top-1/2 grid w-9 h-9 place-items-center"
                                uk-slider-item="next">
                                <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                            </button>

                        </div>

                    </div>


                </div>

                <div class="box p-5 px-6 border1">
                    <div class="flex justify-between text-black">
                        <h3 class="font-bold text-base">Top Cities</h3>
                    </div>

                    <div class="relative capitalize font-normal text-sm mt-4 mb-2" tabindex="-1"
                        uk-slider="autoplay: true;finite: true">

                        <div class="overflow-hidden uk-slider-container">

                            <ul class="-ml-2 uk-slider-items w-[calc(100%+0.5rem)]">
                                @foreach ($topCities as $city)

                                <li class="w-1/3 pr-2">
                                    {{-- <a href=""> --}}
                                        <div
                                            class="flex flex-col items-center shadow-sm p-2  rounded-xl border1">

                                            <div class="mt-5 text-center w-full">
                                                {{-- <a href=""> --}}
                                                    <h5 class="font-semibold"> {{ $city->city }}</h5>
                                                {{-- </a> --}}
                                                <div class="text-xs text-gray-400 mt-0.5 font-medium">
                                                    ({{ $city->total }})
                                                </div>

                                            </div>
                                        </div>

                                </li>
                                @endforeach

                            </ul>

                            <button type="button"
                                class="absolute -translate-y-1/2 bg-slate-100 rounded-full top-1/2 -left-4 grid w-9 h-9 place-items-center"
                                uk-slider-item="previous">
                                <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                            </button>
                            <button type="button"
                                class="absolute -right-4 -translate-y-1/2 bg-slate-100 rounded-full top-1/2 grid w-9 h-9 place-items-center"
                                uk-slider-item="next">
                                <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                            </button>

                        </div>

                    </div>


                </div>

                <div class="box p-5 px-6 border1">

                    <div class="flex justify-between text-black">
                        <h3 class="font-bold text-base"> Trends for you </h3>

                    </div>

                    <div class="space-y-3.5 capitalize text-xs font-normal mt-5 mb-2 text-gray-600">
                        <a href="#">
                            <div class="flex items-center gap-3 p">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-black text-sm"> Registered Business
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
                                    <h4 class="font-semibold text-black text-sm"> Products</h4>
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
                                    <h4 class="font-semibold text-black text-sm"> Ads published</h4>
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



@include('layouts.wishlist-script')


@endsection