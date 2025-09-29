@extends('frontend.template.master')
@section('title', $product->title)  
@section('description', Str::limit(html_entity_decode($product->meta_description ?? $product->description), 160))
@section('content')
<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/css/lightgallery-bundle.min.css" rel="stylesheet">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    
<style>
    .ad-details-action{display:flex;}
    .owl-carousel.owl-drag .owl-item {
        touch-action: auto !important;
    }
    .add-to-cart-button{justify-content: center;}
    .price i{color: #fff;}
    .item.thumbnail-image img {
            width: 80% !important;
        object-fit: contain;
        height: 120px;
    } 
    .price-cart.mobile{display:none}
    .price-cart.desktop{display:block}
    .price-cart h3{font-size: 30px !important;
        color: #000;text-align: center;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;}
        .price-cart h3 span{   font-size: 18px;
        text-decoration: line-through;
        font-weight: 500;}
    .price-cart a{width: 160px;
        border: 1px solid #2d6ab3;
        background: #1c721c;
        color: #fff;
        padding: 10px 15px;
        margin: auto;
        display: flex
    ;
        border-radius: 7px;
        align-items: center;}
        .price-cart a i{margin-left: 15px;}
    .ad-details-action a, .ad-details-action button{width: 30%;}
    h2, h3, h4, h5, h6{font-size: 18px !important;} .h61{font-size: 15px !important} .single-content h2{font-size: 38px !important} .ad-details-desc p, .ad-details-safety p{font-size: 15px;} #sync1 .item { margin: 5px; color: #fff; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; text-align: center; } #sync2 .item { /* padding: 10px 0px; */ margin: 5px; color: #fff; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; text-align: center; cursor: pointer; } #sync2 .item h1 { font-size: 18px; } .owl-theme .owl-nav [class*="owl-"] { transition: all 0.3s ease; } .owl-theme .owl-nav [class*="owl-"].disabled:hover { background-color: #d6d6d6; } #sync1.owl-theme { position: relative; } #sync1 .owl-item img { height: 475px; object-fit: contain; } .owl-carousel .animated { animation-duration: 1.5s !important; } .dandik, .bamdik { opacity: unset !important; visibility: visible; display: flex; align-items: center; justify-content: center; } .ad-details-author .author-img img { height: 100px; } .wishlistButton.fas{background: var(--primary); color: #fff;} .breadcrumb-item+.breadcrumb-item::before { content: none; } .ad-details-breadcrumb { margin-bottom: 18px; position: static; } .tag-list { width: 100%; padding: 10px 15px; border-radius: 8px; background: var(--chalk); text-transform: capitalize; display: flex; align-items: center; justify-content: space-between; margin-top: 10px; } .tag-list p { margin-right: 10px; background-color: #007bff; color: #fff; padding: 5px 10px; border-radius: 5px; margin-bottom: 5px; } .ad-details-meta .rating i { background: var(--rating); } .ad-details-slider div {} .ad-details-slider div img {} .form-group1 { margin-bottom: 20px; } .form-group1 .label { font-weight: bold; } .form-group1 .input-field, .form-group1 .select-field, .form-group1 .textarea-field { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; } .form-group1 .textarea-field { height: 100px; } .form-group1 .submit-button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; } .form-group1 .submit-button:hover { background-color: #45a049; } .video-list { width: 100%; padding: 10px 15px; border-radius: 8px; background: #f9fafb; column-gap: 10px; text-transform: capitalize; display: flex; align-items: center; justify-content: space-between; margin-top: 10px; column-gap: 10px; } .video-list p { text-align: right; } .ad-details-specific { grid-template-columns: repeat(1, 1fr); } .ad-details-specific p { text-align: end; } .ad-details-specific1 { display: grid; grid-gap: 20px; grid-template-columns: repeat(2, 1fr); grid-template-rows: auto; margin-bottom: 20px; margin-top: 20px; } @media only screen and (max-width: 600px) { h2, h3, h4, h5, h6{font-size: 17px !important;} .ad-details-title { font-size: 19px !important;} .single-content h2{font-size: 18px !important;} #sync1 .owl-item img { height: 225px; object-fit: contain; } .ad-details-specific1 { display: grid; grid-gap: 20px; grid-template-columns: repeat(1, 1fr); grid-template-rows: auto; margin-bottom: 20px; } .video-list { overflow: scroll; }.rating.mobile{display: none;} 
    .price-cart.mobile{display:block}
    .price-cart.desktop{display:none}}

    .contactSellder{

        background-color: #eb3f33;
        border-radius: 5px;
        text-transform: uppercase;
        display: flex;
        justify-content: center;
    margin: auto;}
</style>


<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Product Details</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home /</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('product.list') }}">Product List /</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                    </ol>
                </div>
            </div> 
        </div>
    </div>
</section>
<section class="ad-details-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="common-card">

                    <ol class="breadcrumb ad-details-breadcrumb">
                        @if(!empty($product->ad_category))
                        @foreach(explode(',', $product->ad_category) as $category)
                        <li class="breadcrumb-item"><span class="flat-badge {{ strtolower($category) }}">{{
                                trim($category)
                                }}</span></li>
                        @endforeach
                        @endif

                        <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>&nbsp; /
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->subcategory->name }}</li>

                    </ol>

                    <h5 class="ad-details-address">{{ $product->location }}</h5>
                    <h3 class="ad-details-title">{{ $product->title }}</h3>
                    <div class="ad-details-meta"><a class="view"><i
                                class="fas fa-eye"></i><span><strong>({{ $product->prview_count }})</strong>preview</span></a><a class="click"><i
                                class="fas fa-mouse"></i>
                            <span><strong>({{ $product->prview_count }})</strong>click</span></a>
                        <a href="#review" class="rating mobile">

                            <i class="fas fa-star"></i>
                            @if(!empty($reviewCount))
                            <span><strong>({{ $reviewCount }})</strong> Reviews</span>
                            @else
                            <span>Review</span>
                            @endif
                        </a>


                    </div>

                   
                    <div id="sync1" class="owl-carousel owl-theme">
                        @if(!empty($product->main_image))
                        <div class="item">
                            <a href="{{ asset('storage/' . $product->main_image) }}" data-lg-size="1024-768">
                                <div class="item">
                                    <img loading="eager" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->title }}">
                                </div>
                            </a>
                        </div>

                        @endif
                        @foreach ($product->images as $image)
                        <div class="item">
                            <a href="{{ asset('storage/' . $image->image_path) }}" data-lg-size="1024-768">
                                <div class="item">
                                    <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}" alt="details">
                                </div>
                            </a>
                                </div>

                        @endforeach
                    </div>

                    <div id="sync2" class="owl-carousel owl-theme">

                       
                        @if(!empty($product->main_image))
                        <div class="item thumbnail-image">
                            <img loading="eager" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->title }}">
                        </div>
                        @endif
                        @foreach ($product->images as $image)

                        <div  class="item thumbnail-image">
                            <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}" alt="details">
                        </div>
                        @endforeach


                    </div>
                    <div class="ad-details-action justify-content-center mt-3">
                        {{-- <button type="button" class="wish" ><i
                                class="fas fa-heart"></i>bookmark</button> --}}

                        <button type="button"
                            title="{{ $product->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                            aria-label="{{ $product->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                            class="wishlistButton {{ $product->isInWishlist() ? 'fas fa-heart' : 'far fa-heart' }} button   flex-1 wishlist-button-home-page wish "
                            data-wishable-id="{{ Crypt::encryptString($product->id) }}"
                            data-wishable-type="App\Models\BusinessProduct"> Wishlist 
                        </button>



                        <button id="shareBtn">
                            <i class="fas fa-share-alt"></i> share
                        </button>

                    </div>
                </div>

                <div class="common-card price-cart mobile">
                <h3>{{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}</h3>
                @php
            $availableQty = (int) $product->max_qty - (int) $product->sold_qty;
        @endphp

        @if($availableQty > 0)
                <a href="#" class="add-to-cart-button" data-product-slug="{{ $product->slug }}">
                    Add To Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    
                </a>
                @else
            <span class="out-of-stock">Out of Stock</span>
        @endif
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Specification</h5> 
                    </div>
                    <ul class="ad-details-specific  ad-details-specific1">
                    @if (!empty($product->sku))
                        <li>
                            <h6 class="h61">Product SKU:</h6>
                            <p>
                                {{ strlen($product->sku) > 15 ? substr($product->sku, 0, 15) . '...' : $product->sku }}
                            </p>

                        </li>
                    @endif
                    @if (!empty($product->product_id))
                        <li>
                            <h6 class="h61">Product ID:</h6>
                            <p>
                                {{ $product->product_id }}
                            </p>

                        </li>
                    @endif
                    @if (!empty($product->created_at))

                        <li>
                            <h6 class="h61">published:</h6>
                            <p>{{ $product->created_at->format('d-F-Y') }}</p>
                        </li>
                        @endif
                    </ul>
                    @if (!empty($product->video_url))
                   
                    <div class="video-list">
                        <h6 class="h61">Product URL:</h6>
                        <p><a href="{{ $product->video_url }}" target="_blank">{{ $product->video_url }}</a></p>
                    </div>
                    @endif
                    
                </div>
                <div class="common-card ad-details-desc">
                    <div class="card-header">
                        <h5 class="card-title">description</h5>
                    </div>
                    <p class="ad-details-desc">{!! $product->description !!}</p>
                </div>
                <div class="common-card" id="review">
                    <div class="card-header">
                        @if (empty($reviewCount))
                        <h5 class="card-title">Reviews</h5>
                        @else
                        <h5 class="card-title">Reviews ({{ $reviewCount }})</h5>
                        @endif
                    </div>
                    <div class="ad-details-review">
                        <ul class="review-list">
                            @if (!empty($reviews))
                            @foreach($reviews as $review)
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile">
                                            <a href="#" class="review-avatar">
                                                <img loading="eager" src="{{ asset('storage/profile_images/1_1708507821.png') }}"
                                                    alt="review">
                                            </a>
                                            <div class="review-meta">
                                                <h6 class="h61"><a href="#">{{ $review->name }}</a> -
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
                            @else
                            <li>No reviews yet.</li>
                            @endif
                        </ul>

                        <form class="review-form" id="businessProductReviewForm">
                            @csrf
                            <input type="hidden" name="postId" value="{{ $product->id }}">
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
                                <i class="fas fa-tint"></i><span>Drop Your Review</span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            {{-- {{dd($product)}} --}}
            <div class="col-lg-4">
                <!-- <div class="common-card price">
                    <h3>{{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}</h3><i
                        class="fas fa-tag"></i>
                </div>
                <a href="#" class="common-card number add-to-cart-button" data-product-slug="{{ $product->slug }}">
                    <h3>Add To Cart</h3>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a> -->
                <div class="common-card price-cart desktop">
                <h3>{{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}
                    @if (!empty($product->mrp)) / <span>{{ config('constants.CURRENCY_SYMBOL') }}{{ $product->mrp }}
                        @endif
                    </span></h3>
                    @php
            $availableQty = (int) $product->max_qty - (int) $product->sold_qty;
        @endphp

        @if(($availableQty ?? 0) > 0 && ($product->price ?? 0) > 0)
                <a href="#" class="add-to-cart-button" data-product-slug="{{ $product->slug }}">
                    Add To Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    
                </a>
                @else
                <span class="contactSeller">
                    <a href="#" class="contact-seller" style="color: #fff;" data-bs-toggle="modal" data-bs-target="#contactSellerModal"data-product-slug="{{ $product->slug }}" 
                    data-business-phone="{{ $product->businessInfo->contact_phone }}">
                    Contact Seller
                    <i class="fa fa-phone" aria-hidden="true" style="margin-left: 9px;"></i>
                 </a>     
                </span>
        @endif
                </div>
                
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">author info1</h5>
                    </div>
                    <div class="ad-details-author"> 
                        
                        <a href="{{ route('Userprofile', ['slug'=>$product->UserBusinessInfos->slug])}}"
                                class="author-img active">
                            <img loading="eager" src="{{ $product->UserBusinessInfos->logo_path ? asset('storage/' . $product->UserBusinessInfos->logo_path) : asset('no-image.jpg') }}"
                                alt="{{ $product->title }}">
                                
                        </a>
                        
                        <div class="author-meta">
                            <h4><a
                                    href="{{ route('business.view',['businessInfo' => $product->UserBusinessInfos->slug])}}">{{ $product->UserBusinessInfos->business_name }}</a>
                            </h4>
                            <h5>joined:
                                {{ \Carbon\Carbon::parse($product->UserBusinessInfos->created_at)->format('F d, Y') }}
                            </h5>
                        </div>
                        @php
                        $encryptedId = Crypt::encrypt($product->UserBusinessInfos->id);
                        @endphp
                        <div class="author-widget">
                            <a href="{{ route('business.view',$product->UserBusinessInfos->slug) }}" title="Profile"
                                class="fas fa-eye"></a>
                            {{-- <a href="{{ route('user', ['id' => $encryptedId]) }}" title="Message" class="fas
                            fa-envelope"></a> --}}
                            {{-- <button type="button" title="Follow" class="follow fas fa-heart"></button> --}}
                            <button type="button" title="Number" class="fas fa-phone" data-toggle="modal"
                                data-target="#number"></button>
                           
                        </div>
                        <ul class="author-list">
                            <li>
                                <h6 class="h61">total ads</h6>
                                <p>{{ $totalProductCount ?? 0 }}</p>
                            </li>
                            <li>
                                <h6 class="h61">Total Reviews</h6>
                                <p>{{ $productReviewCount ?? 0 }}</p>
                            </li>
                            <li>
                                <h6 class="h61">total follower</h6>
                                <p>{{ $totalFollowers ?? 0 }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="common-card d-none">
                    <div class="card-header">
                        <h5 class="card-title">Location</h5>
                    </div>
                    <div class="ad-details-safety" id="map" style="width: 100%; height: 500px;"></div>
                </div>
                

                <div class="common-card d-none">
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
                    <form action="{{ route('submit_report', ['postId' => $product->id]) }}" method="post">
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
                <div class="modal-share">
                    <a href="#" id="share-facebook" target="_blank">
                        <i class="facebook fab fa-facebook-f"></i><span>facebook</span>
                    </a>
                    <a href="#" id="share-twitter" target="_blank">
                        <i class="twitter fab fa-twitter"></i><span>twitter</span>
                    </a>
                    <a href="#" id="share-linkedin" target="_blank">
                        <i class="linkedin fab fa-linkedin"></i><span>linkedin</span>
                    </a>
                    <a href="javascript:void(0);" onclick="copyCurrentPageLink()">
                        <i class="link fas fa-link"></i><span>copy link</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profile-share">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Check This Profile</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share"><a href="{{$product->UserBusinessInfos->facebook_url}}"><i
                            class="facebook fab fa-facebook-f"></i><span>facebook</span></a><a
                        href="{{$product->UserBusinessInfos->twitter_url}}"><i
                            class="twitter fab fa-twitter"></i><span>twitter</span></a>
                    <a href="{{$product->UserBusinessInfos->linkedin_url}}"><i
                            class="linkedin fab fa-linkedin"></i><span>linkedin</span></a>
                </div>
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
           <div class="modal-body">
                    <h3 class="modal-number">
                        {{ $product->UserBusinessInfos->contact_phone }}
                    </h3>
                    <h3 class="modal-number">
                        0393113437
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactSellerModal" tabindex="-1" aria-labelledby="contactSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="contactSellerModalLabel">Contact Seller</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactSellerForm">
                    @csrf
                    <input type="hidden" name="product_slug" id="product_slug">
                    <div style="margin-bottom: 15px;">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Name">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="email">Your Email:</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Email">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="phone">Your Phone:</label>
                        <input type="tel" id="phone" name="phone" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Phone Number">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; height: 100px;" placeholder="Enter your message to the seller"></textarea>
                    </div>
                    <div style="text-align: right;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/zoom/lg-zoom.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>

<script>
let map;
let APP_DATA;

function initMap() {
    if (!APP_DATA || !APP_DATA.businessAddress) {
        console.log('No business address available');
        return;
    }

    const geocoder = new google.maps.Geocoder();
    const mapElement = document.getElementById('map');
    
    if (!mapElement) {
        console.log('Map element not found');
        return;
    }

    map = new google.maps.Map(mapElement, {
        zoom: 15,
        center: { lat: -34.397, lng: 150.644 }
    });

    geocoder.geocode({ address: APP_DATA.businessAddress }, function(results, status) {
        if (status === 'OK' && results[0]) {
            map.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            console.log('Geocoding failed:', status);
        }
    });
}

$(document).ready(function() {
    
    APP_DATA = {
        businessAddress: @json($product->UserBusinessInfos->business_city ?? ''),
        productTitle: @json($product->title ?? ''),
        canonicalUrl: @json(generateCanonicalUrl() ?? ''),
        isAuthenticated: {{ auth()->check() ? 'true' : 'false' }},
        csrfToken: $('meta[name="csrf-token"]').attr('content') || ''
    };

    console.log('APP_DATA initialized:', APP_DATA);

    function initializeLightGallery() {
        const galleryElement = document.getElementById('sync1');
        if (galleryElement && typeof lightGallery !== 'undefined') {
            try {
                lightGallery(galleryElement, {
                    selector: 'a',
                    plugins: [lgZoom, lgThumbnail],
                    speed: 500,
                    thumbnail: true,
                });
                console.log('LightGallery initialized');
            } catch (error) {
                console.error('LightGallery initialization failed:', error);
            }
        }
    }

    function showNotification(message, type = 'success') {
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
        } else {
            console.log(`${type.toUpperCase()}: ${message}`);
            alert(message);
        }
    }

    function initializeSocialSharing() {
        try {
            const currentUrl = encodeURIComponent(window.location.href);
            
            const socialLinks = {
                'share-facebook': `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`,
                'share-twitter': `https://twitter.com/intent/tweet?url=${currentUrl}`,
                'share-linkedin': `https://www.linkedin.com/shareArticle?mini=true&url=${currentUrl}`
            };

            Object.entries(socialLinks).forEach(([id, url]) => {
                const element = document.getElementById(id);
                if (element) {
                    element.href = url;
                }
            });
            console.log('Social sharing initialized');
        } catch (error) {
            console.error('Social sharing initialization failed:', error);
        }
    }

    function copyCurrentPageLink() {
        try {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showNotification('Link copied to clipboard!');
                }).catch((err) => {
                    console.error('Clipboard API failed:', err);
                    fallbackCopyTextToClipboard();
                });
            } else {
                fallbackCopyTextToClipboard();
            }
        } catch (error) {
            console.error('Copy link failed:', error);
            showNotification('Failed to copy link', 'error');
        }
    }

    function fallbackCopyTextToClipboard() {
        const textArea = document.createElement("textarea");
        textArea.value = window.location.href;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showNotification('Link copied to clipboard!');
        } catch (err) {
            console.error('Fallback copy failed:', err);
            showNotification('Failed to copy link', 'error');
        }
        
        document.body.removeChild(textArea);
    }

    function initializeContactSeller() {
        const $contactLinks = $('.contact-seller');
        const $modal = $('#contactSellerModal');
        const $form = $('#contactSellerForm');
        const $productSlugInput = $('#product_slug');

        if (!$modal.length) return;

        $contactLinks.on('click', function(e) {
            e.preventDefault();
            const productSlug = $(this).data('product-slug');
            if (productSlug && $productSlugInput.length) {
                $productSlugInput.val(productSlug);
            }
            $modal.show();
        });

        if ($form.length) {
            $form.on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: '/contact-seller',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': APP_DATA.csrfToken,
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            showNotification(response.message);
                            $modal.hide();
                            $form[0].reset();
                        } else {
                            showNotification(response.message || 'An error occurred', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        showNotification('An error occurred. Please try again.', 'error');
                    }
                });
            });
        }

        $modal.on('click', function(e) {
            if (e.target === this) {
                $modal.hide();
                $modal.css('display', 'none');
                if ($form.length) $form[0].reset();
            }
        });

        $(document).on('click', '#closeModal', function(e) {
            e.preventDefault();
            $modal.hide();
            $modal.css('display', 'none');
            if ($form.length) $form[0].reset();
        });
    }



    function initializeWishlist() {
        const storedAdId = localStorage.getItem('wishlistProductId');
        if (storedAdId) {
            const $wishlistButton = $(`.wishlistButton[data-ad-id='${storedAdId}']`);
            if ($wishlistButton.length) {
                $wishlistButton.trigger('click');
            }
            localStorage.removeItem('wishlistProductId');
        }

        $(document).on('click', '.wishlistButton', function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const wishableId = $button.data('wishable-id');
            const wishableType = $button.data('wishable-type');
            const isInWishlist = $button.hasClass('fas');
            
            console.log('Wishlist button clicked:', { wishableId, wishableType, isInWishlist });
            
            const actionUrl = isInWishlist ? '/wishlist/remove' : '/wishlist/add';
            const ajaxMethod = isInWishlist ? 'DELETE' : 'POST';

            $.ajax({
                url: actionUrl,
                type: ajaxMethod,
                data: {
                    _token: APP_DATA.csrfToken,
                    ad_id: wishableId,
                    wishable_type: wishableType
                },
                success: function(response) {
                    console.log('Wishlist response:', response);
                    if (isInWishlist) {
                        $button.removeClass('fas').addClass('far');
                    } else {
                        $button.removeClass('far').addClass('fas');
                    }
                    showNotification(response.message);
                },
                error: function(xhr) {
                    console.error('Wishlist error:', xhr);
                    if (xhr.status === 401) {
                        localStorage.setItem('wishlistProductId', wishableId);
                        window.location.href = `/login?redirect=${encodeURIComponent(window.location.href)}`;
                    } else {
                        const errorMsg = xhr.responseJSON && xhr.responseJSON.message ? 
                                        xhr.responseJSON.message : "An error occurred";
                        showNotification(errorMsg, 'error');
                    }
                }
            });
        });

        console.log('Wishlist initialized');
    }

    function initializeCarousels() {
        const $sync1 = $("#sync1");
        const $sync2 = $("#sync2");
        
        if (!$sync1.length || !$sync2.length) {
            console.log('Carousel elements not found');
            return;
        }

        const slidesPerPage = 4;
        let syncedSecondary = true;

        try {
    
            $sync1.owlCarousel({
                items: 1,
                slideSpeed: 1000,
                nav: true,
                animateIn: "fadeIn",
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                dots: false,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: { items: 1, autoplay: true },
                    600: { items: 1, autoplay: true }
                },
                responsiveRefreshRate: 200,
                navText: [
                    '<i class="fas fa-long-arrow-alt-left bamdik slick-arrow"></i>',
                    '<i class="fas fa-long-arrow-alt-right dandik slick-arrow"></i>'
                ]
            }).on("changed.owl.carousel", syncPosition);

            $sync2.on("initialized.owl.carousel", function() {
                $sync2.find(".owl-item").eq(0).addClass("current");
            }).owlCarousel({
                items: slidesPerPage,
                dots: false,
                smartSpeed: 1000,
                slideSpeed: 1000,
                slideBy: slidesPerPage,
                responsiveRefreshRate: 100
            }).on("changed.owl.carousel", syncPosition2);

            function syncPosition(el) {
                const count = el.item.count - 1;
                let current = Math.round(el.item.index - el.item.count / 2 - 0.5);
                
                if (current < 0) current = count;
                if (current > count) current = 0;

                $sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");

                const onscreen = $sync2.find(".owl-item.active").length - 1;
                const start = $sync2.find(".owl-item.active").first().index();
                const end = $sync2.find(".owl-item.active").last().index();

                if (current > end) {
                    $sync2.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    $sync2.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    const number = el.item.index;
                    $sync1.data("owl.carousel").to(number, 100, true);
                }
            }

            $sync2.on("click", ".owl-item", function(e) {
                e.preventDefault();
                const number = $(this).index();
                $sync1.data("owl.carousel").to(number, 300, true);
            });

            console.log('Carousels initialized');
        } catch (error) {
            console.error('Carousel initialization failed:', error);
        }
    }

    function initializeReviewForm() {
        const reviewForm = document.getElementById('businessProductReviewForm');
        if (!reviewForm) {
            console.log('Review form not found');
            return;
        }

        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const rating = document.querySelector('input[name="rating"]:checked');
            const errorElement = document.getElementById("rating-error");
            
            if (!rating) {
                if (errorElement) errorElement.style.display = "block";
                return;
            } else {
                if (errorElement) errorElement.style.display = "none";
            }

            const formData = new FormData(this);
            const postId = document.querySelector('input[name="postId"]')?.value;

            fetch('/check-if-purchased', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': APP_DATA.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.purchased) {
                    showNotification('You can only leave a review for products you have purchased.', 'warning');
                    return Promise.reject('Not purchased');
                }

                return fetch(reviewForm.action || '/submit-review', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': APP_DATA.csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
            })
            .then(response => {
                if (response) {
                    return response.json();
                }
            })
            .then(data => {
                if (data) {
                    if (data.error) {
                        showNotification(data.error, 'error');
                    } else {
                        showNotification(data.success || 'Review submitted successfully');
                        reviewForm.reset();
                        reviewForm.querySelectorAll('.star-rating input').forEach(input => input.checked = false);
                        const categorySelect = reviewForm.querySelector('select[name="category"]');
                        if (categorySelect) categorySelect.selectedIndex = 0;
                    }
                }
            })
            .catch(error => {
                if (error !== 'Not purchased') {
                    console.error('Review submission error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                }
            });
        });

        console.log('Review form initialized');
    }

    function initializeWebShare() {
        const shareBtn = document.getElementById('shareBtn');
        if (!shareBtn) return;

        shareBtn.addEventListener('click', function(event) {
            event.preventDefault();
            
            if (navigator.share) {
                navigator.share({
                    title: APP_DATA.productTitle,
                    url: APP_DATA.canonicalUrl || window.location.href
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(err => {
                    console.log("Error while sharing:", err);
                });
            } else {
                showNotification("Browser doesn't support Web Share API", 'info');
            }
        });

        console.log('Web share initialized');
    }

    try {
        initializeLightGallery();
        initializeSocialSharing();
        initializeContactSeller();
        initializeWishlist();
        initializeCarousels();
        initializeReviewForm();
        initializeWebShare();

        window.copyCurrentPageLink = copyCurrentPageLink;
        
        console.log('All components initialized successfully');
        
    } catch (error) {
        console.error('Error initializing components:', error);
    }
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap" async defer></script>

@endpush

@endsection