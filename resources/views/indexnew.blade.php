@extends('layouts.newlayouts.master')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/custom/newtheme.css') }}">


<main id="main-content">

    <!-- sidebar start  -->
    <div class="side-part1">
        <aside class="sidebar-part1 home">
            <div class="sidebar-body">
                <div class="sidebar-header">

                    <button class="sidebar-cross"><i class="fas fa-times"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="sidebar-profile d-none">
                        {{-- <a href="#" class="sidebar-avatar"> --}}
                        <img
                                src="assets/images/avatar/01.jpg" alt="avatar">
                            {{-- </a> --}}
                        <h4>
                            {{-- <a href="#" class="sidebar-name"> --}}
                                Jackon Honson
                            {{-- </a> --}}
                        </h4>
                        {{-- <a href="ad-post.html" --}}
                            class="btn btn-inline sidebar-post">
                            <i class="fas fa-plus-circle"></i><span>post
                                your
                                ad</span>
                            {{-- </a> --}}
                    </div>
                    <div class="sidebar-menu">
                        <ul class="nav">
                            <!-- <li><a href="#main-menu" class="nav-link active" data-toggle="tab">Main Menu</a></li> -->
                            <!-- <li><a href="#author-menu" class="nav-link" data-toggle="tab">Author Menu</a></li> -->

                            <!-- @auth
                            <li><a href="#author-menu" class="nav-link" data-toggle="tab">Author Menu</a></li>
                            @else -->
                            <!-- If the user is not authenticated, show the login link -->
                            <!-- <a href="{{ route('user.login') }}" class="mobile-widget">
                                  <i class="fas fa-user"></i><span>Join Me</span>
                                 </a> -->
                            <!-- @endauth -->

                        </ul>
                        <div class="tab-pane active" id="main-menu">
                            <ul class="navbar-list">
                                <li class="navbar-item"><a class="navbar-link" href="{{ asset ('/') }}">
                                        <img src="http://13.211.54.157/assets/images/icons/home.png" alt="user">
                                        Home</a></li>

                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('category-list') ? ' active' : '' }}"
                                        href="{{ route ('products.category_list') }}"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/category-list.png"
                                                alt="user">
                                            Category List</span></a>
                                    <!-- <ul class="dropdown-list">
                                          <li><a class="dropdown-link" href="{{ asset ('category-list') }}">category list</a></li>
                                        <li><a class="dropdown-link" href="{{ asset ('/') }}">category details</a></li>
                                         </ul> -->
                                </li>
                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('business') ? ' active' : '' }}"
                                        href="{{ asset ('business/list') }}"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/business-list.png"
                                                alt="user">
                                            Business List</span></a>
                                </li>

                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('ads-list') ? ' active' : '' }}"
                                        href="{{ route ('adsList') }}"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/market.png" alt="user">
                                            Market
                                            Place</span></a>
                                </li>

                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('ads-list') ? ' active' : '' }}"
                                        href="{{ asset ('shop/products') }}"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/shop.png" alt="user">
                                            Shop
                                            Now</span></a>

                                </li>
                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('events-list') ? ' active' : '' }}"
                                        href="{{ route ('events.list') }}"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/event-2.png" alt="user">
                                            Events
                                            List</span></a>
                                </li>
                                <li class="navbar-item "><a
                                        class="navbar-link{{ Request::is('blogs') ? ' active' : '' }}" href="#"><span>
                                            <img src="http://13.211.54.157/assets/images/icons/blog.png" alt="user">
                                            blogs</span></a>

                                </li>



                            </ul>
                            <hr>

                            <ul class="navbar-list">
                                <p class="navbar-link">Pages</p>

                                <li class="navbar-item"><a
                                        class="navbar-link{{ Request::is('about-us') ? ' active' : '' }}"
                                        href="{{ asset ('about-us') }}">
                                        <img src="http://13.211.54.157/assets/images/icons/aboutus.png" alt="user">
                                        About Us</a>
                                </li>

                                <li class="navbar-item"><a
                                        class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                                        href="contactus">
                                        <img src="http://13.211.54.157/assets/images/icons/contactus.png" alt="user">
                                        Contact</a></li>
                                <li class="navbar-item"><a
                                        class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                                        href="{{ asset ('terms-and-condition') }}">
                                        <img src="http://13.211.54.157/assets/images/icons/terms-condition.png"
                                            alt="user">
                                        Terms & Conditions</a></li>
                                <li class="navbar-item"><a
                                        class="navbar-link{{ Request::is('contactus') ? ' active' : '' }}"
                                        href="{{ asset ('privacy-policy') }}">
                                        <img src="http://13.211.54.157/assets/images/icons/privacy-policy.png"
                                            alt="user">
                                        Privacy
                                        Policy</a></li>


                            </ul>
                        </div>

                    </div>
                    <div class="sidebar-footer">
                        <hr>
                        <p>&copy; Eversabz 2024. All Rights Reserved.</p>

                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- sidebar end  -->

    <!-- main part start  -->
    <div class="main-part">
        <section class="business-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-center-heading">
                            <h2>Our Top <span>Business</span></h2>
                            <a href="http://13.211.54.157/business/list" class="btn btn-inline"><i
                                    class="fas fa-eye"></i><span></span></a>

                        </div>
 
                        <div class="recomend-slider slider-arrow">
                            @if($topBusinesses->isNotEmpty())
                            @foreach($topBusinesses as $post)
                            @php
                            $image = !empty($post->logo_path) ? $post->logo_path : 'no-image.jpg';
                            @endphp

                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img">
                                        <img src="{{ $post->logo_path ? asset('storage/' . $post->logo_path) : asset('storage/no-image.png') }}"
                                            alt="{{ $post->business_name }}">

                                    </div>

                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">

                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ $post->businessCategory->name ?? 'Uncategorized' }}</li>
                                    </ol>
                                    <h5 class="product-title desktop"><a
                                            href="{{ route('business.show', $post->slug) }}">
                                            {{ strlen($post->business_name) > 25 ? substr($post->business_name, 0, 25) . '...' :  $post->business_name }}
                                        </a></h5>
                                    <h5 class="product-title mobile"><a href="{{ route('business.show', $post->slug) }}">
                                            {{ strlen($post->business_name) > 15 ? substr($post->business_name, 0, 15) . '...' :  $post->business_name }}
                                        </a></h5>

                                </div>
                            </div>
                            @endforeach
                            @else
                            <p class="no-found-homepage">No business found.</p>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

        </section>
        <hr>
        <section class="products-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-center-heading">
                            <h2>Our Top <span>Products</span></h2>
                            <a href="{{ route('adsList', ['section' => 'recommended']) }}" class="">See All</a>

                        </div>
                        <div class="slider12 owl-carousel">
                            @php
                            $userId = Auth::id();
                            @endphp

                            @if($topProducts->isNotEmpty())
                            @foreach($topProducts as $product)
                            @php
                            $productOwnerId = $product->user_id;
                            $isOwner = !is_null($userId) && !is_null($productOwnerId) && $userId === $productOwnerId;
                            @endphp

                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img">
                                        <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('storage/no-image.jpg') }}"
                                            alt="{{ $product->title }}">
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h5 class="product-title titles">
                                        <a
                                            href="{{ route('BusinessProduct.view', ['item_url' => $product->item_url])  }}">
                                            {{ strlen($product->title) > 20 ? substr($product->title, 0, 20) . '...' : $product->title }}
                                        </a>
                                    </h5>
                                    <ol class="breadcrumb product-category">
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <a
                                                href="{{ route('products.by_subcategory', [$product->category->slug, $product->subcategory->slug]) }}">{{ $product->subcategory->name }}</a>
                                        </li>
                                    </ol>

                                    <div class="product-info">
                                        <h5 class="product-price">
                                            {{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}<span></span>
                                        </h5>
                                        <div class="product-btn">
                                            <!-- <button type="button" title="Wishlist" class="far fa-heart"></button> -->

                                            <button type="button" title="Wishlist"
                                                aria-label="{{ $product->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
                                                class="fa-heart wishlistButton {{ $product->isInWishlist ? 'fas' : 'far' }}"
                                                data-wishable-id="{{ Crypt::encryptString($product->id) }}"
                                                data-wishable-type="App\Models\BusinessProduct">
                                            </button>
                                            <a href="{{ route('BusinessProduct.view', ['item_url' => $product->item_url])  }}"
                                                title="Compare" class="fas fa-eye"></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif



                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        <section class="category-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-center-heading">
                            <h2>Our <span>Categories</span>
                            </h2>

                        </div>
                        <div class="slider14 owl-carousel">


                            <div class="product-card1 product-card2">
                                <div>
                                    <h4 class="font-weight-medium text-white text-nowrap">All Categories</h4>
                                    <p class="font-weight-medium text-white-50 text-sm mt-1 text-nowrap">14 product</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                                    </path>
                                </svg>

                            </div>

                            <div class="product-card1 product-card3">
                                <div>
                                    <h4 class="font-weight-medium text-white text-nowrap">All Ads</h4>
                                    <p class="font-weight-medium text-white-50 text-sm mt-1 text-nowrap">14 product</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                                    </path>
                                </svg>

                            </div>

                            <div class="product-card1 product-card4">
                                <div>
                                    <h4 class="font-weight-medium text-white text-nowrap">All Products</h4>
                                    <p class="font-weight-medium text-white-50 text-sm mt-1 text-nowrap">14 product</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                                    </path>
                                </svg>

                            </div>

                            <div class="product-card1 product-card5">
                                <div>
                                    <h4 class="font-weight-medium text-white text-nowrap">All Businesses</h4>
                                    <p class="font-weight-medium text-white-50 text-sm mt-1 text-nowrap">14 product</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                                    </path>
                                </svg>

                            </div>

                            <div class="product-card1 product-card6">
                                <div>
                                    <h4 class="font-weight-medium text-white text-nowrap">All Events</h4>
                                    <p class="font-weight-medium text-white-50 text-sm mt-1 text-nowrap">14 product</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                                    </path>
                                </svg>

                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>
        <section class="ads-section">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="section-center-heading">
                            <h2>Our <span>Ads</span>
                            </h2>
                            <a href="{{ route('adsList', ['section' => 'recommended']) }}" class="">See All</a>

                        </div>
                    </div>

                    @foreach($posts as $post)
                    <div class="col-md-4 col-6">



                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="{{ $post instanceof \App\Models\AdPost && $post->primaryImage ? asset('storage/' . $post->primaryImage->url) : ($post instanceof \App\Models\BusinessProduct && $post->main_image ? asset('storage/' . $post->main_image) : asset('storage/no-image.jpg')) }}"
                                        alt="{{ $post->title }}">
                                </div>
                            </div>
                            <div class="product-content">
                                <div>
                                    <ol class="breadcrumb product-category">
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <a
                                                href="{{ route('products.by_subcategory', [$post->category->slug, $post->subcategory->slug]) }}">
                                                {{ $post->subcategory->name }}
                                            </a>
                                        </li>
                                    </ol>
                                    <h5 class="product-title titles">
                                        <a href="{{ route('product.show', $post->item_url) }}">
                                            {{ strlen($post->title) > 15 ? substr($post->title, 0, 15) . '...' : $post->title }}
                                        </a>
                                    </h5>
                                </div>
                                <div>
                                    <h5 class="product-price">
                                        {{ config('constants.CURRENCY_SYMBOL') }}{{ $post->price }}
                                        <span></span>
                                    </h5>

                                </div>
                            </div>
                            <div class="product-info">

                                <div class="product-btn">
                                    <!-- Wishlist button -->
                                    <button type="button" title="Wishlist"
                                        aria-label="{{ $post->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
                                        class="far fa-heart wishlistButton {{ $post->isInWishlist ? 'fas' : 'far' }}"
                                        data-wishable-id="{{ Crypt::encryptString($post->id) }}"
                                        data-wishable-type="{{ get_class($post) }}">
                                    </button>
                                    <!-- Compare button -->
                                    <a href="{{ route('product.show', $post->item_url) }}" title="Compare"
                                        class="fas fa-eye"></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        </section>


        <section class="extra-height-section"></section>
    </div>
    <!-- main part end  -->

    <div class="right-part" id="right-part">
        <section class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box ">

                            <div class="items-baseline">
                                <h3 class="font-bold text-base"> People you may know </h3>
                                {{-- <a href="#" class="text-sm text-blue-500">See all</a> --}}
                            </div>

                            <div class="side-list">

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-2.jpg"
                                            alt="" class="side-list-image rounded-full">
                                    {{-- </a> --}}
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> John Michael </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 125k Following </div>
                                    </div>
                                    <button class="button bg-primary-soft text-primary">follow</button>
                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-3.jpg"
                                            alt="" class="side-list-image rounded-full">
                                    {{-- </a> --}}
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> Monroe Parker </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 320k Following </div>
                                    </div>
                                    <button class="button bg-primary-soft text-primary">follow</button>
                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-5.jpg"
                                            alt="" class="side-list-image rounded-full">
                                    {{-- </a> --}}
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> James Lewis</h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 125k Following </div>
                                    </div>
                                    <button class="button bg-primary-soft text-primary">follow</button>
                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-6.jpg"
                                            alt="" class="side-list-image rounded-full">
                                    {{-- </a> --}}
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> Alexa stella </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 192k Following </div>
                                    </div>
                                    <button class="button bg-primary-soft text-primary">follow</button>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box ">

                            <div class="items-baseline">
                                <h3 class="font-bold text-base"> Events </h3>
                                {{-- <a href="#" class="text-sm text-blue-500">See all</a> --}}
                            </div>
                            <div class="slider13 owl-carousel">

                                @if($topEvents->isNotEmpty())
                                @foreach($topEvents as $event)
                                <div class="product-card">
                                    <div class="product-media">
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $event->main_image) }}" class="img-fluid"
                                                alt="Main Image">

                                        </div>

                                    </div>
                                    <div class="product-content">

                                        <h5 class="product-title titles"><a
                                                href="{{ route('event.show', [$event->slug]) }}">{{ strlen($event->title) > 0 ? substr($event->title, 0, 15) . '...' : $event->title }}
                                            </a></h5>

                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p class="no-found-homepage">No events found.</p>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box ">

                            <div class="items-baseline">
                                <h3 class="font-bold text-base"> Online Freinds </h3>
                                {{-- <a href="#" class="text-sm text-blue-500">See all</a> --}}
                            </div>

                            <div class="side-list side-list1">

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-2.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-3.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-5.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-6.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-6.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>

                                <div class="side-list-item">
                                    {{-- <a href=""> --}}
                                        <img src="https://demo.foxthemes.net/socialite-v3.0/assets/images/avatars/avatar-6.jpg"
                                            alt="" class="side-list-image rounded-full">
                                        <div class="position-absolute bg-success rounded-circle"
                                            style="width: 8px; height: 8px;"></div>

                                    {{-- </a> --}}

                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box ">

                            <div class="items-baseline">
                                <h3 class="font-bold text-base"> Trends For You </h3>
                            </div>

                            <div class="side-list">

                                <div class="side-list-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5">
                                        </path>
                                    </svg>
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> Artificial intelligence </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info">1,245,62 posts</div>
                                    </div>
                                    
                                </div>

                                <div class="side-list-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5">
                                        </path>
                                    </svg>
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title">Web developers </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 1,624 posts </div>
                                    </div>
                                    
                                </div>

                                <div class="side-list-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5">
                                        </path>
                                    </svg>
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title">Ui Designers</h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info"> 820 post </div>
                                    </div>
                                    
                                </div>

                                <div class="side-list-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5">
                                        </path>
                                    </svg>
                                    <div class="flex-1">
                                        {{-- <a href=""> --}}
                                            <h4 class="side-list-title"> affiliate marketing </h4>
                                        {{-- </a> --}}
                                        <div class="side-list-info">  480 post </div>
                                    </div>
                                    
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="extra-height-section"></section>


    </div>


</main>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('menu1');
    var dropdownMenu = button.nextElementSibling;
    var mainContent = document.getElementById('main-content');

    button.addEventListener('click', function(event) {
        event.stopPropagation();
        dropdownMenu.classList.toggle('show');
        mainContent.classList.toggle('main-z-index');
        console.log('Button clicked. Dropdown state:', dropdownMenu.classList.contains(
            'show')); // Debug log
    });

    document.addEventListener('click', function(event) {
        if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove('show');
            mainContent.classList.remove('main-z-index');
            console.log('Clicked outside dropdown. Dropdown closed.'); // Debug log
        }
    });

    // Ensure the dropdown menu closes when resizing the window
    window.addEventListener('resize', function() {
        dropdownMenu.classList.remove('show');
        mainContent.classList.remove('main-z-index');
        console.log('Window resized. Dropdown closed.'); // Debug log
    });
});
</script>

<script>
$(".slider12").owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000, // 2000ms = 2s
    autoplayHoverPause: true,
    nav: true, // Enable navigation arrows
    dots: false, // Enable pagination dots
    responsive: {
        0: {
            items: 1, // 1 item between 0px and 599px
            nav: true,
            dots: false
        },
        600: {
            items: 2, // 2 items between 600px and 999px
            nav: true,
            dots: false
        },
        1000: {
            items: 2, // 3 items for 1000px and above
            nav: true,
            dots: false
        }
    }
});



$(".slider13").owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000, // 2000ms = 2s
    autoplayHoverPause: true,
    nav: true, // Enable navigation arrows
    dots: false, // Enable pagination dots
    responsive: {
        0: {
            items: 2, // 1 item between 0px and 599px
            nav: true,
            dots: false
        },
        600: {
            items: 2, // 2 items between 600px and 999px
            nav: true,
            dots: false
        },
        1000: {
            items: 2, // 3 items for 1000px and above
            nav: true,
            dots: false
        }
    }
});


$(".slider14").owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000, // 2000ms = 2s
    autoplayHoverPause: true,
    nav: true, // Enable navigation arrows
    dots: false, // Enable pagination dots
    responsive: {
        0: {
            items: 2, // 1 item between 0px and 599px
            nav: true,
            dots: false
        },
        600: {
            items: 3, // 2 items between 600px and 999px
            nav: true,
            dots: false
        },
        1000: {
            items: 3, // 3 items for 1000px and above
            nav: true,
            dots: false
        }
    }
});
</script>


@endsection