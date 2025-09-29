@extends('frontend.template.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<section class="banner-part">
    <div class="container">
        <div class="banner-content">
            <h1>The One Stop Shop.</h1>
            <p>Buy & Sell Everything - from used cars to computers and phones to properties. Even...get jobs! And, much
                more!
            </p>
            <a href="{{ route('adsList') }}" class="btn btn-outline"><i class="fas fa-eye"></i><span>Show all
                    ads</span></a>
        </div>
    </div>
</section>


<section class="suggest-part"> 
    <div class="container">
        <div class="suggest-slider slider-arrow">

            <a href="ads-post/list" class="suggest-card">
                <div>
                    <img src="{{ asset('assets/images/banner_cards/ads.png') }}" alt="Ads">
                    <h6>Ads</h6>
                    <!-- <p>(4)</p> -->
                </div>
            </a>
            <a href="shop/products" class="suggest-card">
                <img src="{{ asset('assets/images/banner_cards/product.png') }}" alt="Products">
                <h6>Products</h6>
                <!-- <p>(8)</p> -->
            </a>
            <a href="business/list" class="suggest-card">
                <img src="{{ asset('assets/images/banner_cards/business.png') }}" alt="Business">
                <h6>Business</h6>
                <!-- <p>(8)</p> -->
            </a>
            <a href="events/events-list" class="suggest-card">
                <img src="{{ asset('assets/images/banner_cards/event.png') }}" alt="Events">
                <h6>Events</h6>
                <!-- <p>(0)</p> -->
            </a>

        </div>
    </div>
</section>
<section class="section feature-part d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <div class="section-side-heading">
                    <h2>Trendy Needs. Curated Ads.<span> Only For You.</span></h2>
                    <p>Easy find exactly what you need with our top featured ads. From essentials to special finds,
                        we've got you covered. Start your easy shopping journey now!
                    </p>
                    <a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>view
                            all featured</span></a>
                </div>
            </div>
            <div class="col-md-7 col-lg-7">
                <div class="feature-card-slider slider-arrow">
                    <div class="feature-card">
                        <a href="#" class="feature-img"><img src="assets/images/product/10.jpg" alt="feature"></a>
                        <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                class="fas fa-book-open"></i></div>
                        <button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                        <div class="feature-content">
                            <ol class="breadcrumb feature-category">
                                <li><span class="flat-badge rent">rent</span></li>
                                <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">private car</li>
                            </ol>
                            <h3 class="feature-title"><a href="#">Unde eveniet ducimus nostrum
                                    maiores soluta temporibus ipsum dolor sit amet.</a>
                            </h3>
                            <div class="feature-meta"><span
                                    class="feature-price">$1200<small>/Monthly</small></span><span
                                    class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <a href="#" class="feature-img"><img src="assets/images/product/01.jpg" alt="feature"></a>
                        <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                class="fas fa-book-open"></i></div>
                        <button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                        <div class="feature-content">
                            <ol class="breadcrumb feature-category">
                                <li><span class="flat-badge booking">booking</span></li>
                                <li class="breadcrumb-item"><a href="#">Property</a></li>
                                <li class="breadcrumb-item active" aria-current="page">House</li>
                            </ol>
                            <h3 class="feature-title"><a href="#">Unde eveniet ducimus nostrum
                                    maiores soluta temporibus ipsum dolor sit amet.</a>
                            </h3>
                            <div class="feature-meta"><span class="feature-price">$800<small>/perday</small></span><span
                                    class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <a href="#" class="feature-img"><img src="assets/images/product/08.jpg" alt="feature"></a>
                        <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                class="fas fa-book-open"></i></div>
                        <button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                        <div class="feature-content">
                            <ol class="breadcrumb feature-category">
                                <li><span class="flat-badge sale">sale</span></li>
                                <li class="breadcrumb-item"><a href="#">gadget</a></li>
                                <li class="breadcrumb-item active" aria-current="page">iphone</li>
                            </ol>
                            <h3 class="feature-title"><a href="#">Unde eveniet ducimus nostrum
                                    maiores soluta temporibus ipsum dolor sit amet.</a>
                            </h3>
                            <div class="feature-meta"><span
                                    class="feature-price">$1150<small>/Negotiable</small></span><span
                                    class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                        </div>
                    </div>
                    <div class="feature-card">
                        <a href="#" class="feature-img"><img src="assets/images/product/06.jpg" alt="feature"></a>
                        <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                class="fas fa-book-open"></i></div>
                        <button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                        <div class="feature-content">
                            <ol class="breadcrumb feature-category">
                                <li><span class="flat-badge sale">sale</span></li>
                                <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cycle</li>
                            </ol>
                            <h3 class="feature-title"><a href="#">Unde eveniet ducimus nostrum
                                    maiores soluta temporibus ipsum dolor sit amet.</a>
                            </h3>
                            <div class="feature-meta"><span class="feature-price">$455<small>/fixed</small></span><span
                                    class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                        </div>
                    </div>
                </div>
                <div class="feature-thumb-slider">
                    <div class="feature-thumb"><img src="assets/images/product/10.jpg" alt="feature"></div>
                    <div class="feature-thumb"><img src="assets/images/product/01.jpg" alt="feature"></div>
                    <div class="feature-thumb"><img src="assets/images/product/08.jpg" alt="feature"></div>
                    <div class="feature-thumb"><img src="assets/images/product/06.jpg" alt="feature"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section recomend-part" id="ads">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Our Top <span>Ads</span></h2>
                    <p>Latest. Legit. Loved by all.</p>

                    @if($posts->isNotEmpty())
                    <a href="{{ route('adsList', ['section' => 'recommended']) }}" class="btn btn-inline"><i
                            class="fas fa-eye"></i><span>view
                            all Top Ads</span></a>

                    @endif
                </div>
            </div>
        </div>
        {{-- Product --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="recomend-slider slider-arrow">
                    @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                    @php
                    $image = !empty($post->primaryImage->url) ? $post->primaryImage->url : 'no-image.jpg';
                    @endphp
                    <x-product-card :post="$post" />
                    @endforeach
                    @else
                    <p class="no-found-homepage">No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- @if($posts->isNotEmpty())
      <div class="row">
         <div class="col-lg-12">
            <div class="center-50"><a href="{{ route('adsList', ['section' => 'recommended']) }}" class="btn btn-inline"><i
               class="fas fa-eye"></i><span>view
               all Top Ads</span></a>
            </div>
         </div>
      </div>
      @endif -->
    </div>
</section>

{{-- Business Product --}}
<section class="section recomend-part" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Our Top <span>Products</span></h2>
                    <p>Shop Smart, Shop Online for Unbeatable Quality</p>
                    @if($topProducts->isNotEmpty())
                    <a href="{{ route('adsList', ['section' => 'recommended']) }}" class="btn btn-inline"><i
                            class="fas fa-eye"></i><span>view
                            all Top Products</span></a>

                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="recomend-slider product slider-arrow">
                    @if($topProducts->isNotEmpty())
                    @foreach($topProducts as $product)
                    @php
                    $image = !empty($product->main_image) ? $product->main_image : 'no-image.jpg';
                    @endphp
                    <x-business-product-card :product="$product" />
                    @endforeach
                    @else
                    <p class="no-found-homepage">No products found.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- @if($viewed_posts->isNotEmpty())
      <div class="row">
         <div class="col-lg-12">
            <div class="center-50"><a href="{{ route('adsList', ['section' => 'recommended']) }}" class="btn btn-inline"><i
               class="fas fa-eye"></i><span>view
               all Top Products</span></a>
            </div>
         </div>
      </div>
      @endif -->
    </div>
</section>

<section class="section recomend-part" id="business">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Our Top <span>Business</span></h2>
                    <p>Find Your Perfect Business Solutions with Our Premium Online Offerings</p>
                    @if($topBusinesses->isNotEmpty())
                    <a href="{{ asset ('business/list') }}" class="btn btn-inline"><i class="fas fa-eye"></i><span>view
                            all Top Business</span></a>

                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="recomend-slider slider-arrow">
                    @if($topBusinesses->isNotEmpty())
                    @foreach($topBusinesses as $post)
                    @php
                    $image = !empty($post->logo_path) ? $post->logo_path : 'no-image.jpg';
                    @endphp
                    <x-business-card :post="$post" />
                    @endforeach
                    @else
                    <p class="no-found-homepage">No business found.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- @if($topBusinesses->isNotEmpty())
      <div class="row">
         <div class="col-lg-12">
            <div class="center-50"><a href="{{ asset ('business/list') }}" class="btn btn-inline"><i
               class="fas fa-eye"></i><span>view
               all Top Business</span></a>
            </div>
         </div>
      </div>
      @endif -->
    </div>
</section>

<section class="section recomend-part" id="events">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Our Top <span>Events</span></h2>
                    <p>Plan Smart, Plan Online for Unforgettable Events</p>

                    @if($topEvents->isNotEmpty())
                    <a href="{{ route ('events.list') }}" class="btn btn-inline"><i class="fas fa-eye"></i><span>view
                            all Top Events</span></a>

                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="recomend-slider slider-arrow events12">
                    @if($topEvents->isNotEmpty())
                    @foreach($topEvents as $event)
                    <x-event-card :event="$event" />
                    @endforeach
                    @else
                    <p class="no-found-homepage">No events found.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- @if($topEvents->isNotEmpty())
      <div class="row">
         <div class="col-lg-12">
            <div class="center-50"><a href="{{ route ('events.list') }}" class="btn btn-inline"><i
               class="fas fa-eye"></i><span>view
               all Top Events</span></a>
            </div>
         </div>
      </div>
      @endif -->
    </div>
</section>
<section class="section trend-part d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Making Rounds On The <span>Internet.</span></h2>
                    <!-- <p>Ads More Popular than The Pope.</p> -->
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if($featured->isNotEmpty())
            @foreach($featured as $post)
            @php
            $image = !empty($post->primaryImage->url) ? $post->primaryImage->url : 'no-image.jpg';
            @endphp
            <div class="col-md-11 col-lg-8 col-xl-6 col-6 making-product-card-column ">
                <x-product-card class="standard making-round-products" :post="$post" />
            </div>
            @endforeach
            @else
            <p>No posts found.</p>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center-20"><a href="{{ route('adsList', ['section' => 'featured']) }}"
                        class="btn btn-inline"><i class="fas fa-eye"></i><span>view
                            all trends</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section niche-part d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Browse Our Top <span>Niche</span></h2>
                    <p>Everything Top. Don't Miss Out.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="niche-nav">
                    <ul class="nav nav-tabs">
                        <li><a href="#populars" class="nav-link active" data-toggle="tab">popular post</a></li>
                        <li><a href="#advertiser" class="nav-link" data-toggle="tab">top businesses</a></li>
                        <li><a href="#engaged" class="nav-link" data-toggle="tab">top events</a></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- Top Ad Post --}}
        <div class="tab-pane active" id="populars">
            <div class="row">
                @if($viewed_posts->isNotEmpty())
                @foreach($viewed_posts as $post)
                @php
                $image = !empty($post->primaryImage->url) ? $post->primaryImage->url : 'no-image.jpg';
                @endphp
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <x-product-card :post="$post" />
                </div>
                @endforeach
                @else
                <p>No posts found.</p>
                @endif
            </div>
        </div>
        {{-- Top Business --}}
        <div class="tab-pane " id="advertiser">
            <div class="row">
                @if($topBusinesses->isNotEmpty())
                @foreach($topBusinesses as $post)
                @php
                $image = !empty($post->logo_path) ? $post->logo_path : 'no-image.jpg';
                @endphp
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <x-business-card :post="$post" />
                </div>
                @endforeach
                @else
                <p>No Business found.</p>
                @endif
            </div>
        </div>
        {{-- top events in $topEvents --}}
        <div class="tab-pane" id="engaged">
            <div class="row">
                @if($topEvents->isNotEmpty())
                @foreach($topEvents as $event)
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <x-event-card :event="$event" />
                </div>
                @endforeach
                @else
                <p>No posts found.</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center-20"><a href="{{ route('adsList', ['section' => 'top_engaged']) }}"
                        class="btn btn-inline">
                        <i class="fas fa-eye"></i><span>view all ads</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section city-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Booming Locations. <span>The Best Deals.</span></h2>
                    <p>Your Dire Need, Just Round The Corner.</p>
                    <a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>view all
                            Cities</span></a>
                </div>
            </div>
        </div>

        <!-- <div class="row">

            @foreach ($topCities as $city)
            <div class="col-sm-6 col-md-6 col-lg-3">
                @php
                $cityName = $city->city;

                $cityImage = isset($cityImages[$cityName]) ? $cityImages[$cityName] :
                'assets/images/cities/default.jpg';
                @endphp
                <a href="#" class="city-card"
                    style="background: url({{ asset($cityImage) }}) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>{{ $city->city }}</h4>
                        <p>({{ $city->total }}) ads</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div> -->


        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-5 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/newsouthwales.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>New South Wales</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/victoria.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>Victoria</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>

            <div class="col-sm-6 col-md-6 col-lg-3 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/queensland.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>Queensland</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>

            <div class="col-sm-6 col-md-6 col-lg-3 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/westernaustralia.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>Western Australia</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>

            <div class="col-sm-6 col-md-6 col-lg-3 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/southaustralia.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>South Australia</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>

            <div class="col-sm-6 col-md-6 col-lg-3 col-6"><a href="" class="city-card"
                    style="background: url(assets/images/cities/northernaustralia.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>Northern Australia</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>


            <div class="col-sm-6 col-md-6 col-lg-3"><a href="" class="city-card"
                    style="background: url(assets/images/cities/tasmania.jpg) no-repeat center; background-size: cover">
                    <div class="city-content">
                        <h4>Tasmania</h4>
                        <!-- <p>(25) ads</p> -->
                    </div>
                </a></div>


        </div>
        <!-- <div class="row">
         <div class="col-lg-12">
            <div class="center-20"><a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>view all
               Cities</span></a>
            </div>
         </div>
      </div> -->
    </div>
</section>
<section class="section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Trending Segments by <span>Categories</span></h2>
                    <p>Sorted By Categories. Curated For You.</p>
                    <a href="{{ route('products.category_list') }}" class="btn btn-inline"><i
                            class="fas fa-eye"></i><span>view all categories</span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="category-carousel" class="owl-carousel">
                @foreach($categories as $category)
                <div class="product-card">
                    <div class="category-card">
                        <div class="category-head">
                            <img src="{{ asset('storage/'.$category->icon) }}" alt="{{ $category->name }}">
                            <a href="{{ route('products.by_category', ['category' => $category->slug]) }}"
                                class="category-content">
                                <h4>{{ $category->name }}</h4>
                                <p>({{ $category->ad_posts_count }})</p>
                            </a>
                        </div>
                        <ul class="category-list">
                            @foreach($subcategories[$category->id] as $subcategory)
                            <li>
                                <a
                                    href="{{ route('products.by_category', ['category' => $category->slug,'subcategory' => $subcategory->slug]) }}">
                                    <h6>{{ $subcategory->name }}</h6>
                                    <p>({{ $subcategory->ad_posts_count }})</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- <div class="row">
         <div class="col-lg-12">
            <div class="center-30"><a href="{{ route('products.category_list') }}" class="btn btn-inline"><i
               class="fas fa-eye"></i><span>view all categories</span></a></div>
         </div>
      </div> -->
    </div>
</section>
<br />
{{--
<section class="intro-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-center-heading">
               <h2>No Better Place to Sell & Earn.</h2>
               <p>Come Advertise With Us.</p>
               <a href="#" class="btn btn-outline"><i class="fas fa-plus-circle"></i><span>post
               your ad</span></a>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="price-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-center-heading">
               <h2>Best Reliable Pricing Plans</h2>
               <p>Fair. Reliable. Transparent.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-lg-4">
            <div class="price-card">
               <div class="price-head">
                  <i class="flaticon-bicycle"></i>
                  <h3>$00</h3>
                  <h4>Free Plan</h4>
               </div>
               <ul class="price-list">
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>1 Regular Ad for 7 days</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Credit card required</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Top or Featured Ad</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Ad will be bumped up</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>Limited Support</p>
                  </li>
               </ul>
               <div class="price-btn"><a href="login" class="btn btn-inline"><i class="fas fa-sign-in-alt"></i><span>Register
                  Now</span></a>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4">
            <div class="price-card price-active">
               <div class="price-head">
                  <i class="flaticon-car-wash"></i>
                  <h3>$23</h3>
                  <h4>Standard Plan</h4>
               </div>
               <ul class="price-list">
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>1 Recom Ad for 30 days</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Featured Ad Available</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Ad will be bumped up</p>
                  </li>
                  <li>
                     <i class="fas fa-times"></i>
                     <p>No Top Ad Available</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>Basic Support</p>
                  </li>
               </ul>
               <div class="price-btn"><a href="login" class="btn btn-inline"><i class="fas fa-sign-in-alt"></i><span>Register
                  Now</span></a>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4">
            <div class="price-card">
               <div class="price-head">
                  <i class="flaticon-airplane"></i>
                  <h3>$49</h3>
                  <h4>Premium Plan</h4>
               </div>
               <ul class="price-list">
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>1 Featured Ad for 60 days</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>Access to All features</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>With Recommended</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>Ad Top Category</p>
                  </li>
                  <li>
                     <i class="fas fa-plus"></i>
                     <p>Priority Support</p>
                  </li>
               </ul>
               <div class="price-btn"><a href="login" class="btn btn-inline"><i class="fas fa-sign-in-alt"></i><span>Register
                  Now</span></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="blog-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-center-heading">
               <h2>Read Our <span>Recent Blogs</span></h2>
               <p>A short read. A sweet tale.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="blog-slider slider-arrow">
               <div class="blog-card">
                  <div class="blog-img">
                     <img src="assets/images/blog/01.jpg" alt="blog">
                     <div class="blog-overlay"><span class="marketing">Marketing</span></div>
                  </div>
                  <div class="blog-content">
                     <a href="#" class="blog-avatar"><img src="assets/images/avatar/01.jpg"
                        alt="avatar"></a>
                     <ul class="blog-meta">
                        <li>
                           <i class="fas fa-user"></i>
                           <p><a href="#">MironMahmud</a></p>
                        </li>
                        <li>
                           <i class="fas fa-clock"></i>
                           <p>02 Feb 2021</p>
                        </li>
                     </ul>
                     <div class="blog-text">
                        <h4><a href="#">Lorem ipsum dolor sit amet eius minus elit cum
                           quaerat volupt.</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad
                           dolore labore laborum perspiciatis...
                        </p>
                     </div>
                     <a href="#" class="blog-read"><span>read more</span><i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>
               </div>
               <div class="blog-card">
                  <div class="blog-img">
                     <img src="assets/images/blog/02.jpg" alt="blog">
                     <div class="blog-overlay"><span class="advertise">advertise</span></div>
                  </div>
                  <div class="blog-content">
                     <a href="#" class="blog-avatar"><img src="assets/images/avatar/02.jpg"
                        alt="avatar"></a>
                     <ul class="blog-meta">
                        <li>
                           <i class="fas fa-user"></i>
                           <p><a href="#">LabonnoKhan</a></p>
                        </li>
                        <li>
                           <i class="fas fa-clock"></i>
                           <p>02 Feb 2021</p>
                        </li>
                     </ul>
                     <div class="blog-text">
                        <h4><a href="#">Lorem ipsum dolor sit amet eius minus elit cum
                           quaerat volupt.</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad
                           dolore labore laborum perspiciatis...
                        </p>
                     </div>
                     <a href="#" class="blog-read"><span>read more</span><i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>
               </div>
               <div class="blog-card">
                  <div class="blog-img">
                     <img src="assets/images/blog/03.jpg" alt="blog">
                     <div class="blog-overlay"><span class="safety">safety</span></div>
                  </div>
                  <div class="blog-content">
                     <a href="#" class="blog-avatar"><img src="assets/images/avatar/03.jpg"
                        alt="avatar"></a>
                     <ul class="blog-meta">
                        <li>
                           <i class="fas fa-user"></i>
                           <p><a href="#">MironMahmud</a></p>
                        </li>
                        <li>
                           <i class="fas fa-clock"></i>
                           <p>02 Feb 2021</p>
                        </li>
                     </ul>
                     <div class="blog-text">
                        <h4><a href="#">Lorem ipsum dolor sit amet eius minus elit cum
                           quaerat volupt.</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad
                           dolore labore laborum perspiciatis...
                        </p>
                     </div>
                     <a href="#" class="blog-read"><span>read more</span><i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>
               </div>
               <div class="blog-card">
                  <div class="blog-img">
                     <img src="assets/images/blog/04.jpg" alt="blog">
                     <div class="blog-overlay"><span class="security">security</span></div>
                  </div>
                  <div class="blog-content">
                     <a href="#" class="blog-avatar"><img src="assets/images/avatar/04.jpg"
                        alt="avatar"></a>
                     <ul class="blog-meta">
                        <li>
                           <i class="fas fa-user"></i>
                           <p><a href="#">TahminaBonny</a></p>
                        </li>
                        <li>
                           <i class="fas fa-clock"></i>
                           <p>02 Feb 2021</p>
                        </li>
                     </ul>
                     <div class="blog-text">
                        <h4><a href="#">Lorem ipsum dolor sit amet eius minus elit cum
                           quaerat volupt.</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad
                           dolore labore laborum perspiciatis...
                        </p>
                     </div>
                     <a href="#" class="blog-read"><span>read more</span><i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="blog-btn"><a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>view all
               blogs</span></a>
            </div>
         </div>
      </div>
   </div>
</section>
--}}
<style>
.dandik,
.bamdik {
    opacity: unset !important;
    visibility: visible !important;
    display: block  !important;
}
.dandik, .bamdik {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 26px ! IMPORTANT;
    width: 34px;
    height: 34px;
    line-height: 33px ! IMPORTANT;
    border-radius: 50%;
    text-align: center;
    color: var(--primary);
    background: var(--white);
    text-shadow: var(--primary-tshadow);
    box-shadow: var(--primary-bshadow);
    visibility: hidden;
    opacity: 0;
    cursor: pointer;
    z-index: 1;
    transition: all linear .3s;
    -webkit-transition: all linear .3s;
    -moz-transition: all linear .3s;
    -ms-transition: all linear .3s;
    -o-transition: all linear .3s;
}

.suggest-card img {
    height: 100px;
}

.suggest-card {
    margin: 0px 8px;
    border-radius: 8px;
    padding: 50px 0px;
    text-align: center;
    border-bottom: 2px solid var(--primary);
    background: #dffbff;
}

.recommend-product-img {
    height: 200px;
}

.recommend-product-img img {
    height: 100% !important;
    object-fit: contain;
    background: white;
}

.category-head {
    position: relative;
    height: 150px;
}

.category-head img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

#category-carousel .product-card {
    margin-right: 15px;
    margin-bottom: 0px;
}

.category-card {
    margin-bottom: 0px;
}

.section-center-heading {
    /* text-align: center; */
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.section-center-heading p {
    display: none;
}

.section-center-heading h2 {
    margin-bottom: 15px;
    font-size: 33px;
}

.section-center-heading .btn {
    height: 40px;
    font-size: 14px;
    font-weight: 500;
    border: 2px solid;
    padding: 8px 22px;
}

.product-button12 .editButton {
    display: none;
}

.product-button12 .deleteButton {
    display: none;
}
.product-button12{display:none !important;}

body{background: #F9FAFB;}
    .product-widget, .product-card {

        background: #fff;
    }
    .product-img {
    overflow: hidden;
    display: flex;
    justify-content: center;
}

.product-category{    height: auto;
    padding: 0px;
    margin: 0px;}
    .product-content {
    padding: 0.875rem;
}
.product-content1{display: flex;
    justify-content: space-between;
    }
.product-content2{}
.product-content3{}
.product-button12{display:none;}
.product-category .breadcrumb-item a {
    color: rgb(13 148 136);
}
.product-title {
    height: auto;
}

@media only screen and (max-width: 767px) {
    .product-content {
    padding: 0px 10px;
}
.city-card {
        width: 100%;
        margin: 0px auto 22px;
        height:120px;
    }
    .city-content h4 {font-size: 15px;}

    .dandik,
    .bamdik {
        opacity: unset !important;
        visibility: visible;
        display: block !important;
    }

    .section-center-heading h2 {
        margin-bottom: 15px;
        font-size: 28px;
    }

    .section {
        padding: 50px 0px 0px;
    }

    .section-center-heading {
        display: block;
        margin-bottom: 20px;
    }

    .making-round-products {
        width: auto;
        margin: 0px auto 5px;
        height: 100%;
    }

    .making-round-products .product-category .breadcrumb-item {
        font-size: 11px;
    }

    .making-round-products .product-img {
        overflow: hidden;
        height: 130px;
        align-content: center;
        background: white;
    }

    .making-round-products .product-img img {
        width: 100%;
        height: 100%;
    }

    .making-round-products .product-category {
        margin-bottom: 1px;
        line-height: 17px;
    }

    .making-round-products .product-title {
        height: 50px;
        font-weight: 600;
        font-size: 13px;
        line-height: 20px;
    }

    .making-round-products .product-meta {
        margin-bottom: 0px;
        line-height: 20px;
    }

    .making-round-products .product-meta span {
        font-size: 12px;
        margin-right: 0px;
        white-space: normal;
    }

    .making-product-card-column {
        margin-bottom: 25px;
        padding: 0px 5px;
    }

    /* .making-round-products .product-info{        display: block;} */
    .suggest-card img {
        height: 50px;
    }

    .suggest-card {
        margin: 0px 8px;
        border-radius: 8px;
        padding: 30px 0px;
        text-align: center;
        border-bottom: 2px solid var(--primary);
        background: #dffbff;
    }

    .category-card {
        height: 400px;
        overflow: scroll;
    }


}

@media only screen and (max-width: 575px) {
    .category-head {
        position: relative;
        height: 150px;
        width: 175px;
    }

    .category-content h4 {
        text-align: center;
        font-size: 17px !important;
        padding: 0px 10px;
    }

    #category-carousel .product-card {
        margin-right: 5px;
        margin-bottom: 0px;
        margin-left: 5px;
    }

    .category-list li a {
        display: block;
    }

    .dandik,
    .bamdik {
        opacity: unset !important;
        visibility: visible;
        display: block !important;
    }

    .recomend-slider .product-card {
        width: 175px;
    }

    .recommend-product-img {
        height: 130px;
        background: #fff;
    }
    .product-meta i{display:none;}

    .product-category {
        margin-bottom: 1px;
        line-height: 17px;
        height: 50px;
    }

    .events12 .product-category {
        margin-bottom: 1px;
        line-height: 17px;
        height: auto;
    }

    .product-category li i {
        font-size: 11px;
    }

    .product-category .breadcrumb-item {
        font-size: 11px;
    }

    .product-title {
        height: 40px;
        font-weight: 600;
        font-size: 13px;
        line-height: 20px;
    }

    .product-meta {
        margin-bottom: 5px;
        line-height: 20px;
    }

    .product-price {
        font-size: 14px;
    }

    .product-info {
        display: flex;
        padding: 4px 0px;
    }

}

@media only screen and (max-width: 390px) {
    .recomend-slider .product-card {
        width: 155px;
    }

    .dandik,
    .bamdik {
        opacity: unset !important;
        visibility: visible;
        display: block !important;
    }
}
</style>
<script>
$(document).ready(function() {
    $("#category-carousel").owlCarousel({
        items: 4, // Number of items to show at a time
        loop: true, // Infinite loop
        autoplay: true, // Autoplay
        autoplayTimeout: 6000, // Autoplay interval in milliseconds
        responsive: {
            0: {
                items: 2 // Number of items to show on mobile devices (screen width up to 0px)
            },
            576: {
                items: 2 // Number of items to show on devices with screen width 576px and above
            },
            768: {
                items: 3 // Number of items to show on devices with screen width 768px and above
            },
            992: {
                items: 4 // Number of items to show on devices with screen width 992px and above
            }
        }
    });
});
</script>

@include('layouts.wishlist-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endsection