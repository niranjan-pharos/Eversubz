@extends('frontend.template.master')

@section('content')
<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">
<style>
.breadcrumb-item+.breadcrumb-item::before { content: none; } .tag-list { width: 100%; padding: 10px 15px; border-radius: 8px; background: var(--chalk); text-transform: capitalize; display: flex; align-items: center; justify-content: space-between; margin-top: 10px; } .tag-list p { margin-right: 10px; background-color: #007bff; color: #fff; padding: 5px 10px; border-radius: 5px; margin-bottom: 5px; } .ad-details-slider div {} .ad-details-slider div img {} .form-group1 { margin-bottom: 20px; } .form-group1 .label { font-weight: bold; } .form-group1 .input-field, .form-group1 .select-field, .form-group1 .textarea-field { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; } .form-group1 .textarea-field { height: 100px; } .form-group1 .submit-button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; } .form-group1 .submit-button:hover { background-color: #45a049; }.owl-carousel.owl-drag .owl-item{touch-action: auto;}
</style>
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Ad Details</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('ad-post') }}">Ads List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ads Details22 </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="inner-section ad-details-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="common-card">

                    <ol class="breadcrumb ad-details-breadcrumb">
                        @if($adPost->ad_category)
                        @foreach(explode(',', $adPost->ad_category) as $category)
                        <li class="breadcrumb-item"><span class="flat-badge {{ strtolower($category) }}">{{
                                trim($category)
                                }}</span></li>
                        @endforeach
                        @endif
                        <li class="breadcrumb-item"><a href="#">{{ $adPost->category->name }}</a></li>&nbsp; /
                        <li class="breadcrumb-item active" aria-current="page">{{ $adPost->subcategory->name }}</li>

                    </ol>

                    <h5 class="ad-details-address">{{ $adPost->location }}</h5>
                    <h3 class="ad-details-title">{{ $adPost->title }}</h3>
                    <div class="ad-details-meta"><a class="view"><i
                                class="fas fa-eye"></i><span><strong>(134)</strong>preview</span></a><a class="click"><i
                                class="fas fa-mouse"></i>
                            <span><strong>(76)</strong>click</span></a>
                        <a href="#review" class="rating">
                            <i class="fas fa-star"></i><span><strong>({{ $reviewCount }})</strong>Reviews</span></a>
                    </div>
                    <div class="ad-details-slider-group">
                        <div class="ad-details-slider slider-arrow">
                            @if($adPost->images)
                            @foreach($adPost->images as $image)

                            <div>
                                <img loading="eager"  src="{{ asset ('storage/'.$image->url) }}" alt="{{ $adPost->name }}" >

                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="cross-vertical-badge ad-details-badge"><i
                                class="fas fa-clipboard-check"></i><span>recommend</span></div>
                    </div>
                    <div class="ad-thumb-slider">
                        @foreach($adPost->images as $image)

                        <div>
                            <img loading="eager"  src="{{ asset ('storage/'.$image->url) }}" alt="{{ $adPost->name }}">
                        </div>
                        @endforeach

                    </div>
                    <div class="ad-details-action"><button type="button" class="wish"><i
                                class="fas fa-heart"></i>bookmark</button>

                        <button type="button" data-toggle="modal" data-target="#report-ad"><i
                                class="fas fa-exclamation-triangle"></i>report</button>

                        <button type="button" data-toggle="modal" data-target="#ad-share"><i
                                class="fas fa-share-alt"></i>share
                        </button>

                    </div>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Specification</h5>
                    </div>
                    <ul class="ad-details-specific">
                        <li>
                            <h6>price:</h6>
                            <p>{{ config('constants.CURRENCY_SYMBOL') }}{{ $adPost->price }}</p>
                        </li>
                        <li>
                            <h6>seller type:</h6>
                            <p>personal</p>
                        </li>
                        <li>
                            <h6>published:</h6>
                            <p>{{ $adPost->created_at->format('d-m-Y') }}</p>
                        </li>
                        <li>
                            <h6>location:</h6>
                            <p>{{ $adPost->location }}</p>
                        </li>
                        <li>
                            <h6>category:</h6>
                            <p>{{ $adPost->category->name }}</p>
                        </li>
                        <li>
                            <h6>subcategory:</h6>
                            <p>{{ $adPost->subcategory->name }}</p>
                        </li>
                        <li>
                            <h6>product condition:</h6>
                            @foreach(explode(',', $adPost->product_condition) as $condition)
                            <p>{{ trim($condition) }}</p>
                            @endforeach
                        </li>

                        <li>
                            <h6>price type:</h6>
                            @foreach(explode(',', $adPost->price_condition) as $price)
                            <p>{{ trim($price) }}</p>
                            @endforeach
                        </li>
                        <li>
                            <h6>Ad Category:</h6>
                            <p>{{ $adPost->ad_category }}</p>
                        </li>
                        <li>
                            <h6>Post URL:</h6>
                            <p><a href="{{ $adPost->video_url }}" target="_blank">{{ $adPost->video_url }}</a></p>
                        </li>
                    </ul>
                    <ul>
                        <li class="tag-list">
                            <h6>Tags</h6>
                            @foreach($adPost->tags as $tag)
                            <p>{{ $tag->tag_name }}</p>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">description</h5>
                    </div>
                    <p class="ad-details-desc">{{$adPost->description}}</p>
                </div>
                <div class="common-card d-none" id="review">
                    <div class="card-header">
                        <h5 class="card-title">reviews ({{ $reviewCount }})</h5>
                    </div>
                    <div class="ad-details-review">
                        <ul class="review-list">
                            @foreach($reviews as $review)
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile">
                                            <a href="#" class="review-avatar">
                                                <img loading="eager"  src="{{ asset('storage/profile_images/1_1708507821.png') }}"
                                                    alt="review">
                                            </a>
                                            <div class="review-meta">
                                                <h6><a href="#">{{ $review->name }}</a> -
                                                    <br><span>{{ $review->created_at->format('F d, Y') }}</span>
                                                </h6>
                                                <ul>
                                                    @for($i = 1; $i <= $review->rating; $i++)
                                                        <li><i class="fas fa-star active"></i></li>
                                                        @endfor
                                                        <li>
                                                            <h5>- for {{ $review->category }}</h5>
                                                        </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-desc">{{ $review->description }}</p>
                                </div>
                            </li>
                            @endforeach 
                        </ul>
                        <form class="review-form" action="{{ route('submit_review', ['postId' => $postId]) }}"
                            method="POST" id="reviewForm">
                            @csrf
                            <input type="hidden" name="postId" value="{{ $postId }}">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star-1" value="5" required><label
                                    for="star-1"></label>
                                <input type="radio" name="rating" id="star-2" value="4" required><label
                                    for="star-2"></label>
                                <input type="radio" name="rating" id="star-3" value="3" required><label
                                    for="star-3"></label>
                                <input type="radio" name="rating" id="star-4" value="2" required><label
                                    for="star-4"></label>
                                <input type="radio" name="rating" id="star-5" value="1" required><label
                                    for="star-5"></label>
                                <span id="rating-error" class="error text-danger" style="display: none;">Please select a
                                    rating.</span>
                            </div>
                            <div class="review-form-grid">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control custom-select" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Delivery System">Delivery System</option>
                                        <option value="Product Quality">Product Quality</option>
                                        <option value="Payment Issue">Payment Issue</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Describe" name="description"
                                    required></textarea>
                            </div>

                            <button type="submit" class="btn btn-inline review-submit" onclick="validateForm()">
                                <i class="fas fa-tint"></i><span>Submit</span>
                            </button>
                        </form>




                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="common-card price">
                    <h3>{{ config('constants.CURRENCY_SYMBOL') }}{{ $adPost->price }}/<span>@foreach(explode(',',
                            $adPost->price_condition) as $price){{ trim($price) }} @endforeach</span></h3><i
                        class="fas fa-tag"></i>
                </div>
                @if(!empty($user->phone))
                    <a href="tel:{{ $user->phone }}" 
                       class="common-card number d-flex align-items-center justify-content-center text-decoration-none">
                        <h3 class="mb-0 text-center flex-grow-1">
                            {{ $user->phone }}
                        </h3>
                        <i class="fas fa-phone ms-2"></i>
                    </a>
                @endif
                
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">author info</h5>
                    </div>
                    <div class="ad-details-author">
                        <a href="javascript:void()" class="author-img active">                            
                            <img loading="eager"  src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/images/avatar/01.jpg') }}" alt="{{ $user->name }}">
                        </a>
                        <div class="author-meta">
                            <h4><a href="#">{{ $user->name }}</a></h4>
                            <h5>joined: {{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y') }}</h5>
                            <p>{{ $user->tagline }}</p>
                        </div>
                        @php
                        $encryptedId = Crypt::encrypt($user->id);
                        @endphp
                        <div class="author-widget">
                            <a href="#" title="Profile" class="fas fa-eye"></a>
                            <a href="{{ route('user', ['id' => $encryptedId]) }}" title="Message"
                                class="fas fa-envelope"></a>
                            <button type="button" title="Follow" class="follow fas fa-heart"></button>
                            <button type="button" title="Number" class="fas fa-phone" data-toggle="modal"
                                data-target="#number"></button>
                            <button type="button" title="Share" class="fas fa-share-alt" data-toggle="modal"
                                data-target="#profile-share"></button>
                        </div>
                        <ul class="author-list">
                            <li>
                                <h6>total ads</h6>
                                <p>{{ $totalAdsCount }}</p>
                            </li>
                            <li>
                                <h6>Total Reviews</h6>
                                <p>{{ $userReviewCount }}</p>
                            </li>
                            <li>
                                <h6>total follower</h6>
                                <p>56</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">opening hour</h5>
                    </div>
                    <ul class="ad-details-opening">
                        <li>
                            <h6>Saturday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>Sunday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>monday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>tuesday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>wednesday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>thursday</h6>
                            <p>09:00am - 05:00pm</p>
                        </li>
                        <li>
                            <h6>friday</h6>
                            <p>closed</p>
                        </li>
                    </ul>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">area map</h5>
                    </div>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">safety tips</h5>
                    </div>
                    <div class="ad-details-safety">
                        <p>Check the item before you buy</p>
                        <p>Pay only after collecting item</p>
                        <p>Beware of unrealistic offers</p>
                        <p>Meet seller at a safe location</p>
                        <p>Do not make an abrupt decision</p>
                        <p>Be honest with the ad you post</p>
                    </div>

                </div>
                <div class="common-card d-none">
                    <div class="card-header">
                        <h5 class="card-title">featured ads</h5>
                    </div>
                    <div class="ad-details-feature slider-arrow">
                        <div class="feature-card"><a href="#" class="feature-img"><img loading="eager"  src="images/product/10.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i>
                            </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge rent">rent</span></li>
                                    <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">private car</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$1200<small>/Monthly</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                        <div class="feature-card"><a href="#" class="feature-img"><img loading="eager"  src="images/product/01.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i>
                            </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge booking">booking</span></li>
                                    <li class="breadcrumb-item"><a href="#">Property</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">House</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$800<small>/perday</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                        <div class="feature-card"><a href="#" class="feature-img"><img loading="eager"  src="images/product/08.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i>
                            </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge sale">sale</span></li>
                                    <li class="breadcrumb-item"><a href="#">gadget</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">iphone</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$1150<small>/Negotiable</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<section class="inner-section related-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Related This <span>Ads</span></h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                        voluptatum repudiandae veniam maxime tenetur.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="related-slider slider-arrow">
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img"><img loading="eager"  src="{{ asset ('assets/images/product/01.jpg') }}"
                                    alt="product">
                            </div>
                            <div class="product-type"><span class="flat-badge sale">sale</span></div>
                            <ul class="product-action">
                                <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li><i class="fas fa-tags"></i></li>
                                <li class="breadcrumb-item"><a href="#">Luxury</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Duplex House</li>
                            </ol>
                            <h5 class="product-title"><a href="#">Lorem ipsum dolor sit amet consect adipisicing
                                    elit</a></h5>
                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                    Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                            <div class="product-info">
                                <h5 class="product-price">$1500<span>/negotiable</span></h5>
                                <div class="product-btn"><a href="compare.html" title="Compare"
                                        class="fas fa-compress"></a><button type="button" title="Wishlist"
                                        class="far fa-heart"></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img"><img loading="eager"  src="{{ asset ('assets/images/product/03.jpg') }}"
                                    alt="product">
                            </div>
                            <div class="product-type"><span class="flat-badge sale">sale</span></div>
                            <ul class="product-action">
                                <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li><i class="fas fa-tags"></i></li>
                                <li class="breadcrumb-item"><a href="#">stationary</a></li>
                                <li class="breadcrumb-item active" aria-current="page">books</li>
                            </ol>
                            <h5 class="product-title"><a href="#">Lorem ipsum dolor sit amet consect adipisicing
                                    elit</a></h5>
                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                    Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                            <div class="product-info">
                                <h5 class="product-price">$470<span>/fixed</span></h5>
                                <div class="product-btn"><a href="compare.html" title="Compare"
                                        class="fas fa-compress"></a><button type="button" title="Wishlist"
                                        class="far fa-heart"></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img"><img loading="eager"  src="{{ asset ('assets/images/product/10.jpg') }}"
                                    alt="product">
                            </div>
                            <div class="product-type"><span class="flat-badge sale">sale</span></div>
                            <ul class="product-action">
                                <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li><i class="fas fa-tags"></i></li>
                                <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">private car</li>
                            </ol>
                            <h5 class="product-title"><a href="#">Lorem ipsum dolor sit amet consect adipisicing
                                    elit</a></h5>
                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                    Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                            <div class="product-info">
                                <h5 class="product-price">$3300<span>/fixed</span></h5>
                                <div class="product-btn"><a href="compare.html" title="Compare"
                                        class="fas fa-compress"></a><button type="button" title="Wishlist"
                                        class="far fa-heart"></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img"><img loading="eager"  src="{{ asset ('assets/images/product/09.jpg') }}"
                                    alt="product">
                            </div>
                            <div class="product-type"><span class="flat-badge sale">sale</span></div>
                            <ul class="product-action">
                                <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li><i class="fas fa-tags"></i></li>
                                <li class="breadcrumb-item"><a href="#">animals</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cat</li>
                            </ol>
                            <h5 class="product-title"><a href="#">Lorem ipsum dolor sit amet consect adipisicing
                                    elit</a></h5>
                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                    Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                            <div class="product-info">
                                <h5 class="product-price">$900<span>/Negotiable</span></h5>
                                <div class="product-btn"><a href="compare.html" title="Compare"
                                        class="fas fa-compress"></a><button type="button" title="Wishlist"
                                        class="far fa-heart"></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img"><img loading="eager"  src="{{ asset ('assets/images/product/02.jpg') }}"
                                    alt="product">
                            </div>
                            <div class="product-type"><span class="flat-badge sale">sale</span></div>
                            <ul class="product-action">
                                <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                            </ul>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li><i class="fas fa-tags"></i></li>
                                <li class="breadcrumb-item"><a href="#">fashion</a></li>
                                <li class="breadcrumb-item active" aria-current="page">shoes</li>
                            </ol>
                            <h5 class="product-title"><a href="#">Lorem ipsum dolor sit amet consect adipisicing
                                    elit</a></h5>
                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                    Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                            <div class="product-info">
                                <h5 class="product-price">$384<span>/fixed</span></h5>
                                <div class="product-btn"><a href="compare.html" title="Compare"
                                        class="fas fa-compress"></a><button type="button" title="Wishlist"
                                        class="far fa-heart"></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center-50"><a href="ad-list-column3.html" class="btn btn-inline"><i
                            class="fas fa-eye"></i><span>view all related</span></a></div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="report-ad">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Adds</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share">
                    <form action="{{ route('submit_report', ['postId' => $postId]) }}" method="post">
                        @csrf
                        <div class="form-group form-group1">
                            <label for="reason">Reason For Reporting:</label><br>
                            <select id="reason" name="reason" class="select-field" required>
                                @foreach (config('constants.reports_ad') as $key => $value)
                                <option value="{{ $value }}" @if (old('reports_ad')==$value) selected @endif>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group1 ">
                            <label for="details">Additional Details:</label><br>
                            <textarea id="details" name="details" class="textarea-field" rows="4" cols="50"></textarea>
                        </div>

                        <input type="submit" value="Submit" class="submit-button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ad-share">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Ad</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share"><a href="#"><i
                            class="facebook fab fa-facebook-f"></i><span>facebook</span></a><a href="#"><i
                            class="twitter fab fa-twitter"></i><span>twitter</span></a><a href="#"><i
                            class="linkedin fab fa-linkedin"></i><span>linkedin</span></a><a href="#"><i
                            class="link fas fa-link"></i><span>copy link</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="profile-share">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Profile</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share"><a href="#"><i
                            class="facebook fab fa-facebook-f"></i><span>facebook</span></a><a href="#"><i
                            class="twitter fab fa-twitter"></i><span>twitter</span></a><a href="#"><i
                            class="linkedin fab fa-linkedin"></i><span>linkedin</span></a><a href="#"><i
                            class="link fas fa-link"></i><span>copy link</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="number">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Contact this Number</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h3 class="modal-number">{{ $user->phone }}</h3>
            </div>
        </div>
    </div>
</div>



<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap"
    async defer></script>
<script>
var Address = '{!! $adPost->city !!}'; console.log(Address) function initMap() { var geocoder = new google.maps.Geocoder(); var map = new google.maps.Map(document.getElementById('map'), { zoom: 15, center: { lat: -34.397, lng: 150.644 } }); geocoder.geocode({ 'address': Address }, function(results, status) { if (status === 'OK') { map.setCenter(results[0].geometry.location); new google.maps.Marker({ map: map, position: results[0].geometry.location }); var panorama = new google.maps.StreetViewPanorama( document.getElementById('street-view'), { position: results[0].geometry.location, pov: { heading: 34, pitch: 10 } }); map.setStreetView(panorama); } else { console.log('Geocode was not successful for the following reason: ' + status); } }); } function validateForm() { var rating = document.querySelector('input[name="rating"]:checked'); if (!rating) { event.preventDefault(); document.getElementById("rating-error").style.display = "block"; } else { document.getElementById("rating-error").style.display = "none"; } }
</script>

@endsection