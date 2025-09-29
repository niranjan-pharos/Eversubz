@extends('frontend.template.master')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">
<style>
    @media (min-width: 440px) and (max-width: 500px) {
        .ad-details-part {
            overflow-x: hidden;
        }
    };
    .hidden {
        display: none !important;
    }
    .text-center {
        text-align: center;
    }


    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: 18px !important
    }

    .h61 {
        font-size: 15px !important
    }

    .single-content h2 {
        font-size: 38px !important
    }

    .ad-details-desc p,
    .ad-details-safety p {
        font-size: 15px
    }

    #sync1 .item {
        margin: 5px;
        color: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center
    }

    #sync2 .item {
        margin: 5px;
        color: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
        cursor: pointer
    }

    #sync2 .item h1 {
        font-size: 18px
    }

    .owl-theme .owl-nav [class*="owl-"] {
        transition: all 0.3s ease
    }

    .owl-theme .owl-nav [class*="owl-"].disabled:hover {
        background-color: #d6d6d6
    }

    #sync1.owl-theme {
        position: relative
    }

    #sync1 .owl-item img {
        height: 475px;
        object-fit: contain
    }

    .owl-carousel .animated {
        animation-duration: 1.5s !important
    }

    .ad-details-action {
        display: flex;
        grid-gap: 20px;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto;
        column-gap: 33px;
        justify-content: center
    }

    .ad-details-action a,
    .ad-details-action button {
        width: 30%
    }

    .expired {
        background-color: red
    }

    .tag-list {
        width: 100%;
        padding: 10px 15px;
        border-radius: 8px;
        background: var(--chalk);
        text-transform: capitalize;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px
    }

    .tag-list p span {
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 5px
    }

    .card4 .share-list li p span {
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 5px;
        line-height: 50px;
        margin-right: 5px
    }

    .ad-details-specific {
        margin-top: 10px
    }

    .video-list {
        width: 100%;
        padding: 10px 15px;
        border-radius: 8px;
        background: #f9fafb;
        text-transform: capitalize;
        display: flex;
        column-gap: 10px;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px
    }

    .video-list p {
        text-align: right
    }

    .ad-details-slider div {
        height: 475px
    }

    .ad-details-slider div img {
        height: 100%;
        object-fit: contain
    }

    .form-group1 {
        margin-bottom: 20px
    }

    .form-group1 .label {
        font-weight: 700
    }

    .form-group1 .input-field,
    .form-group1 .select-field,
    .form-group1 .textarea-field {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box
    }

    .form-group1 .textarea-field {
        height: 100px
    }

    .form-group1 .submit-button {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px
    }

    .form-group1 .submit-button:hover {
        background-color: #45a049
    }

    .sendreoprt {
        padding: 5px 20px;
        background-color: #00225D;
        color: #fff;
        border: 1px solid #000
    }

    .modal-share1 .form-control {
        border: none;
        width: 100%;
        height: 50px;
        padding: 0 20px;
        border-radius: 5px;
        color: var(--heading);
        background: none;
        border: 1px solid #000;
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        -moz-transition: all linear .3s;
        -ms-transition: all linear .3s;
        -o-transition: all linear .3s
    }

    .modal-share1 {
        text-align: left;
        display: block
    }

    .reportbutton {
        font-weight: 700;
        text-align: center;
        margin-top: 30px;
        background-color: #04b;
        color: #fff;
        padding: 10px;
        width: 50%
    }

    .modal-share {
        text-align: left
    }

    .dandik,
    .bamdik {
        opacity: unset !important;
        visibility: visible;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .ad-details-author .author-img img {
        height: 100px
    }

    .ad-thumb-slider .slick-list .slick-track {
        float: left;
        text-align: left;
        overflow: auto
    }

    .ad-thumb-slider .slick-slide img {
        width: 100%;
        border-radius: 8px;
        height: 100%;
        object-fit: contain
    }

    .ad-details-breadcrumb {
        top: 9%;
        position: relative;
        left: 0%;
        justify-content: space-between
    }

    .ad-details-breadcrumb .published-date {
        background: #04b
    }

    .ad-details-specific {
        grid-template-columns: repeat(1, 1fr)
    }

    .ad-details-specific p {
        text-align: end
    }

    .ad-details-specific1 {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: auto;
        margin-bottom: 10px;
        margin-top: 10px
    }

    @media only screen and (max-width:600px) {
        .ad-details-part {
        padding: 30px 10px;
        margin-bottom: 70px;
    }
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: 17px !important
        }

        .ad-details-title {
            font-size: 19px !important
        }

        .single-content h2 {
            font-size: 18px !important
        }

        #sync1 .owl-item img {
            height: 225px;
            object-fit: contain
        }

        .card4 .share-list li p span {
            line-height: 35px
        }

        .ad-details-specific1 {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(1, 1fr);
            grid-template-rows: auto;
            margin-bottom: 20px
        }

        .card-height {
            height: auto
        }

        .video-list {
            overflow: scroll
        }
    }

    .wishlistButton.fas {
        background: var(--primary);
        color: #fff
    }

    .form-control {
        background: #f1f5f9
    }

    .owl-carousel.owl-drag .owl-item {
        touch-action: auto !important;
    }

    /* end */
</style>

<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/css/lightgallery-bundle.min.css" rel="stylesheet">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
@endpush
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Ad details</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('ad-post') }}">Ads List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ad-details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ad-details-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ">

                <div class="common-card">
                    {{-- @if($post->is_expired)
                    <div class="product-type"><span class="flat-badge expired">Expired</span></div>
                    @endif --}}
                    <ol class="breadcrumb ad-details-breadcrumb">
                        <li><span class="flat-badge {{ strtolower($post->ad_category) }}">{{
                                $post->ad_category}}</span></li>
                        <li><span class="flat-badge published-date">Published-
                                {{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</span></li>
                    </ol>
                    <h3 class="ad-details-title">{{ $post->title }}</h3>
                    <hr>
                    <div class="ad-details-meta"><a class="view">
                            <i class="fas fa-eye"></i><span><strong>({{ $post->prview_count }}
                                    )</strong>preview</span></a>
                        <a class="click"><i class="fas fa-mouse"></i><span><strong>({{ $post->clicks_count
                                    }})</strong>click</span></a>




                    </div>

                    

                    <div id="sync1" class="owl-carousel owl-theme">
    @if ($post->images->isNotEmpty())
        @foreach ($post->images as $image)
            <div class="item">
                <a href="{{ asset('storage/'.$image->url) }}">
                    <img loading="eager" src="{{ asset('storage/'.$image->url) }}" alt="{{ $post->title }}" data-lg-size="1024-768">
                </a>
            </div>
        @endforeach
    @else
        <div class="item">
            <a href="{{ asset('storage/no-image.jpg') }}">
                <img loading="eager" src="{{ asset('storage/no-image.jpg') }}" alt="{{ $post->title }}" data-lg-size="1024-768">
            </a>
        </div>
    @endif
</div>

                    <div id="sync2" class="owl-carousel owl-theme">

                        @if ($post->images->isNotEmpty())
                        @foreach ($post->images as $image)
                        <div class="item">
                            <img loading="eager" src="{{ asset('storage/'.$image->url) }}" alt="{{$post->title}}">
                        </div>
                        @endforeach
                        @else
                        <div class="thumbnail-item">
                            <img loading="eager" src="{{ asset('storage/no-image.jpg') }}" alt="{{$post->title}}">
                        </div>
                        @endif


                    </div>


                    <div class="ad-details-action">
                        @if (Auth::id() !== $post->user_id)
                        <button type="button" title="Wishlist"
                            aria-label="{{ $post->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                            class="wishlistButton {{ $post->isInWishlist() ? 'fas fa-heart' : 'far fa-heart' }} wish"
                            data-wishable-id="{{ Crypt::encryptString($post->id) }}"
                            data-wishable-type="App\Models\AdPost">
                            Wishlist
                        </button>


                        @endif


                        <button id="shareBtn"> <i class="fas fa-share-alt"></i> Share</button>
                    </div>

                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Specification</h5>
                    </div>
                    <ul class="ad-details-specific  ad-details-specific1">
                        <li>
                            <h6 class="h61">category:</h6>
                            <p>{{ $post->category->name }}</p>
                        </li>
                        <li>
                            <h6 class="h61">subcategory:</h6>
                            <p>{{ $post->subcategory->name }}</p>
                        </li>
                        <li>
                            <h6 class="h61">price:</h6>
                            <p>{{ config('constants.CURRENCY_SYMBOL') }}{{ $post->price }}</p>
                        </li>

                        <li>
                            <h6 class="h61">condition:</h6>
                            <p>{{$post->product_condition}}</p>
                        </li>

                        <li>
                            <h6 class="h61">price type:</h6>
                            <p>{{$post->price_condition}}</p>
                        </li>
                        <li>
                            <h6 class="h61">ad type:</h6>
                            <p>{{$post->ad_category}}</p>
                        </li>
                    </ul>
                    <ul class="ad-details-specific">
                        <li>
                            <h6 class="h61">location:</h6>
                            <p>{{$post->location}}, {{$post->city}}, {{$post->state}}, {{$post->country}}</p>
                        </li>
                    </ul>

                    <div class="video-list">
                        <h6 class="h61">Languages:</h6>
                        @if($post->languages && $post->languages->isNotEmpty())
    <ul class="d-flex">
        @foreach($post->languages as $language)
            <li><span style="background-color: #007bff;color: #fff;padding: 5px 10px;border-radius: 5px;margin-bottom: 5px;line-height: 50px;margin-right: 5px;">{{ $language->name }}</span></li>
        @endforeach
    </ul>
@else
    <p>No language found.</p>
@endif

                    </div>

                    <div class="video-list">
                        <h6 class="h61">Post URL:</h6>
                        @if(!empty($post->video_url))
                        <p><a href="{{ $post->video_url }}" target="_blank">{{ $post->video_url }}</a></p>
                        @else
                        <p>No url found.</p>
                        @endif
                    </div>

                 
                    


                    <ul class="ad-details-specific">
                        <li class="card4">
                            <h6 class="h61">Tags:</h6>
                            @if($post->tags->isNotEmpty())


                            <ul class="share-list">
                                <li>

                                    <p>
                                        @foreach($post->tags as $tag)
                                        <span>{{ $tag->tag_name }}@if(!$loop->last) @endif</span>
                                        @endforeach
                                    </p>
                                </li>
                            </ul>
                            @else
                            <p>No tags found.</p>
                            @endif
                        </li>
                    </ul>

                    <div class="video-list">
                        <h6 class="h61">Post Id:</h6>
                        <p>{{ $post->ad_id ?? '-' }}</p>
                    </div>


                </div>
                <div class="common-card ad-details-desc">
                    <div class="card-header">
                        <h5 class="card-title">description</h5>
                    </div>
                    <p class="ad-details-desc">{!! $post->description !!}</p>
                </div>





                <div class="common-card d-none" id="review">
                    <div class="card-header">
                        <h5 class="card-title">reviews ({{ $reviewCountForPost ?: 0 }})
                        </h5>
                    </div>
                    <div class="ad-details-review">
                        <ul class="review-list">
                            @foreach($post->reviews as $review)
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile">
                                            <a href="javascript:void(0)" class="review-avatar">
                                                @if(!empty($review->user->image))
                                                <img loading="eager" src="{{ asset('storage/'.$review->user->image) }}"
                                                    alt="{{ $review->user->username }}">
                                                @else
                                                <img loading="eager" src="{{ asset('assets/images/no-image.jpg') }}"
                                                    alt="{{ $review->user->username }}">
                                                @endif
                                            </a>
                                            <div class="review-meta">
                                                <h6 class="h61">
                                                    <a href="javascript:void(0)">{{ $review->user->username }}</a> -
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

                        @if(!$isOwner)

                        <form class="review-form" id="adPostReviewForm">
                            @csrf
                            <input type="hidden" name="postId" value="{{ $post->item_url }}">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star-1" value="5"><label for="star-1"></label>
                                <input type="radio" name="rating" id="star-2" value="4"><label for="star-2"></label>
                                <input type="radio" name="rating" id="star-3" value="3"><label for="star-3"></label>
                                <input type="radio" name="rating" id="star-4" value="2"><label for="star-4"></label>
                                <input type="radio" name="rating" id="star-5" value="1"><label for="star-5"></label>
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

                            <button type="submit" class="btn btn-inline review-submit">
                                <i class="fas fa-tint"></i><span>Submit</span>
                            </button>
                        </form>
                        @endif

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="common-card price">
                    <h3>{{ config('constants.CURRENCY_SYMBOL') }} {{ $post->price }}<span>/
                            {{$post->price_condition
                            }}</span></h3><i class="fas fa-tag"></i>
                </div>

                @if(!empty($user->phone))
                    <a href="tel:{{ $user->phone }}" 
                       class="common-card number d-flex align-items-center justify-content-center text-decoration-none">
                        <h3 class="mb-0 text-center flex-grow-1">
                            {{ $user->phone }}
                        </h3>
                        <i class="fas fa-phone ms-2"></i>
                    </a>
                @elseif(!empty($post->author_phone))
                    <a href="tel:{{ $post->author_phone }}" 
                       class="common-card number d-flex align-items-center justify-content-center text-decoration-none">
                        <h3 class="mb-0 text-center flex-grow-1">
                            {{ $post->author_phone }}
                        </h3>
                        <i class="fas fa-phone ms-2"></i>
                    </a>
                @endif

                <!-- <button type="button" class="common-card number" @if(!empty($user->phone) ||
                    !empty($post->author_phone))
                    data-toggle="modal" data-target="#number"
                    @endif>
                    @if(!empty($user->phone))
                    <h3>({{ substr($user->phone, 0, 3) }}*******)<span>Click to show</span></h3>
                    @elseif(!empty($post->author_phone))
                    <h3>({{ substr($post->author_phone, 0, 3) }}*******)<span>Click to show</span></h3>
                    @else
                    <h3><span>Contact info not found</span></h3>
                    @endif
                    <i class="fas fa-phone"></i>
                </button> -->

                <div class="common-card card-height">
                    <div class="card-header">
                        <h5 class="card-title">author info</h5>
                    </div>

                    @php
                    use Illuminate\Support\Str;
                    if (!empty($user->businessInfos)) {
                    // $encryptedId = Crypt::encrypt($user->businessInfos->id);
                    $encryptedId = Str::slug($user->businessInfos->slug ?? $user->businessInfos->business_name);
                    $image = $user->businessInfos->logo_path;
                    $name = $user->businessInfos->business_name;
                    $created = $user->businessInfos->created_at;
                    $profile_url = 'seller.profile';

                    } else { 
                    // $encryptedId = Crypt::encrypt($user->id);
                    $encryptedId = Str::slug($user->name);
                    $image = $user->image;
                    $name = $user->username;
                    $created = $user->created_at;
                    $profile_url = 'Userprofile';
                    }
                    @endphp

                    <div class="ad-details-author">
                        <a href="{{ route($profile_url, ['slug' => $encryptedId]) }}" class="author-img active">
                            <img loading="eager"
                                src="{{ !empty($image) ? asset('storage/' . $image) : asset('storage/no-image.jpg') }}"
                                alt="{{ $name }}">
                        </a>


                        <div class="author-meta">
                            <h4>{{$name}}</h4>
                            <h5>joined: {{ \Carbon\Carbon::parse($created)->format('F d, Y') }}

                            </h5>
                            <p></p>
                        </div>
 
                        <div class="author-widget">

                            <a href="{{ route('Userprofile',['slug'=>$encryptedId])}}" title="{{ $name }}Profile"
                                class="fas fa-eye"></a>

                            <button type="button" title="Number" class="fas fa-phone" data-toggle="modal"
                                data-target="#number"></button>
                            
                        </div>
                        <ul class="author-list">
                            <li>
                                <h6 class="h61">total ads</h6>
                                <p>{{ $adPostCountForUser}}</p>
                            </li>
                            <li>
                                <h6 class="h61">total ratings</h6>
                                <p>{{ $userReviewCount}}</p>
                            </li>

                        </ul>


                    </div>

                </div>

                @if (!empty($user->businessInfos))
                <div class="common-card d-none">
                    <div class="card-header">
                        <h5 class="card-title">opening hour</h5>
                    </div>

                    <ul class="ad-details-opening">
                        @foreach ($hours as $hour)
                        <li>
                            <h6 class="h61">Monday</h6>
                            <p>{{ $hour->monday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Tuesday</h6>
                            <p>{{ $hour->tuesday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Wednesday</h6>
                            <p>{{ $hour->wednesday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Thursday</h6>
                            <p>{{ $hour->thursday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Friday</h6>
                            <p>{{ $hour->friday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Saturday</h6>
                            <p>{{ $hour->saturday ?? 'Closed' }}</p>
                        </li>
                        <li>
                            <h6 class="h61">Sunday</h6>
                            <p>{{ $hour->sunday ?? 'Closed' }}</p>
                        </li>
                        @endforeach

                    </ul>
                </div>
                @endif

                @if(!empty($post->city))
                    <div class="common-card" id="map-card" style="display:none;">
                        <div class="card-header">
                            <h5 class="card-title">Area Map</h5>
                        </div>
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                @endif
 
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Enquiry</h5>
                    </div>
                    <form id="contact-form" class="w-full">
                        <input type="hidden" id="module" name="module" value="adpost">
                        <input type="hidden" id="slug" name="slug" value="{{ $post->item_url }}">
                
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder="Phone" required class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea id="description" name="description" placeholder="Description" required class="form-control"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="submit-button" class="btn btn-inline review-submit">
                                <i class="fas fa-tint"></i><span>Submit</span>
                            </button>
                        </div>
                        <!-- Loader -->
                        <!-- Loader (Ensure it's properly hidden initially) -->
<div id="loader" style="display: none;">
    <i class="fas fa-spinner fa-spin"></i> Submitting your form...
</div>

                    </form>
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
                        <p>Never share your financial info</p>
                        <p>Always inspect items before paying</p>
                        <p>Avoid to wire money onlin</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<div class="modal fade" id="errorReport">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Claim your reports</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share">
                    <form class="claim-form" id="errReport" method="post" action="{{ route('submitReport') }}">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="item_url" value="{{ $post->item_url }}">
                            <div class="form-group col-lg-6">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="phoneno">Phone No:</label>
                                <input type="text" id="phoneno" name="phoneno" class="form-control"
                                    value="{{ old('phoneno') }}" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="reason">Reason:</label>
                                <textarea name="reason" rows="4" class="form-control"
                                    required>{{ old('reason') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-inline ml-3">
                                <i class="fas fa-tint"></i><span>Submit</span>
                            </button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="report-ad">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Adds</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share">
                    <form action="{{ route('submitReport') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_url" value="{{ $post->item_url }}">
                        <div class="form-group form-group1">
                            <label for="reason">Reason For Reporting:</label><br>
                            <select id="reason" name="reason" class="select-field" required>
                                @foreach (config('constants.reports_ad') as $key => $value)
                                <option value="{{ $value }}" @if (old('reason')==$value) selected @endif>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group1">
                            <label for="details">Additional Details:</label><br>
                            <textarea id="details" name="details" class="textarea-field" rows="4" cols="50"></textarea>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Submit" class="submit-button btn btn-primary">
                        </div>
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
                    <a class="facebook" href="#" target="_blank">
                        <i class="facebook fab fa-facebook-f"></i><span>Facebook</span>
                    </a>
                    <a class="twitter" href="#" target="_blank">
                        <i class="twitter fab fa-twitter"></i><span>Twitter</span>
                    </a>
                    <a class="linkedin" href="#" target="_blank">
                        <i class="linkedin fab fa-linkedin"></i><span>LinkedIn</span>
                    </a>
                    <a class="link" href="#" onclick="return false;">
                        <i class="link fas fa-link"></i><span>Copy Link</span>
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
                <h3 class="modal-number">{{ !empty($user->phone) ? $user->phone : $post->author_phone }}</h3>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/zoom/lg-zoom.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap">
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    lightGallery(document.getElementById('sync1'), {
        selector: 'a', 
        plugins: [lgZoom, lgThumbnail],
        speed: 500,
        thumbnail: true,
    });

    var sync1 = jQuery("#sync1");
    var sync2 = jQuery("#sync2");
    var slidesPerPage = 4;
    var syncedSecondary = true;

    sync1.owlCarousel({
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

    sync2.on("initialized.owl.carousel", function () {
        sync2.find(".owl-item").eq(0).addClass("current");
    }).owlCarousel({
        items: slidesPerPage,
        dots: false,
        smartSpeed: 1000,
        slideSpeed: 1000,
        slideBy: slidesPerPage,
        responsiveRefreshRate: 100
    }).on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
        if (current < 0) current = count;
        if (current > count) current = 0;

        sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");

        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();

        if (current > end) sync2.data("owl.carousel").to(current, 100, true);
        if (current < start) sync2.data("owl.carousel").to(current - onscreen, 100, true);
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = jQuery(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
    });

    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        const submitButton = document.getElementById('submit-button');
        const loader = document.getElementById('loader');
        let isSubmitting = false;
        const validateSlug = (slug) => /^[\p{L}\p{N}\-\/]+$/u.test(slug);

        contactForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (isSubmitting) return;
            isSubmitting = true;

            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);
            const name = data.name.trim();
            const email = data.email.trim();
            const phone = data.phone.trim();
            const slug = data.slug.trim();
            const module = data.module.trim();
            const description = data.description.trim();

            if (!name || !email) {
                toastr.error('Name and Email are required fields.');
                isSubmitting = false;
                return;
            }

            if (!validateSlug(slug)) {
                toastr.error('Slug format is invalid. Use letters, numbers, hyphens, or slashes.');
                isSubmitting = false;
                return;
            }

            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            loader.classList.remove('hidden');

            try {
                const url = "{{ route('enquiry.submit') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ name, email, phone, slug, module, description }),
                });

                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'An error occurred while submitting the form.');

                toastr.success(result.message || 'Form submitted successfully!');
                contactForm.reset();
            } catch (error) {
                toastr.error(error.message || 'An unexpected error occurred.');
            } finally {
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                loader.classList.add('hidden');
                isSubmitting = false;
            }
        });
    }

    var isLoggedIn = @json(Auth::check());

    $('#errReport').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                toastr.success(response.message);
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                for (const key in errors) {
                    toastr.error(errors[key]);
                }
            }
        });
    });

    $('#ad-share').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var itemUrl = button.data('item-url');
        $(this).find('.facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(itemUrl));
        $(this).find('.twitter').attr('href', 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(itemUrl) + '&text=Check+out+this+product!');
        $(this).find('.linkedin').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(itemUrl));
        $(this).find('.link').attr('onclick', 'copyToClipboard(\'' + itemUrl + '\')');
    });

    function copyToClipboard(url) {
        const el = document.createElement('textarea');
        el.value = url;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert('Link copied to clipboard!');
    }

    function validateForm(event) {
        var rating = document.querySelector('input[name="rating"]:checked');
        if (!rating) {
            event.preventDefault();
            document.getElementById("rating-error").style.display = "block";
        } else {
            document.getElementById("rating-error").style.display = "none";
        }
    }

    document.getElementById('adPostReviewForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);
        let action = "{{ route('submit_ad_post_review', ['item_url' => $post->item_url]) }}";
        let ratingSelected = form.querySelector('input[name="rating"]:checked');

        if (!ratingSelected) {
            document.getElementById('rating-error').style.display = 'block';
            return;
        } else {
            document.getElementById('rating-error').style.display = 'none';
        }

        fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        }).then(response => {
            if (response.redirected) {
                window.location.href = `/login?redirect=${encodeURIComponent(window.location.href)}`;
                return;
            }
            return response.json();
        }).then(data => {
            if (data.error) {
                toastr.error(data.error);
            } else {
                toastr.success(data.success);
                form.reset();
                form.querySelectorAll('.star-rating input').forEach(input => input.checked = false);
                form.querySelector('select[name="category"]').selectedIndex = 0;
            }
        }).catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred. Please try again.');
        });
    });

    var Address = '{!! $post->city !!}';

    window.initMap = function () {
        if (!Address) return;

        var geocoder = new google.maps.Geocoder();
        var mapElement = document.getElementById('map-card');

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: { lat: -34.397, lng: 150.644 }
        });

        geocoder.geocode({ 'address': Address }, function (results, status) {
            if (status === 'OK') {
                mapElement.style.display = 'block';
                map.setCenter(results[0].geometry.location);
                new google.maps.Marker({ map: map, position: results[0].geometry.location });

                var streetViewElement = document.getElementById('street-view');
                if (streetViewElement) {
                    var panorama = new google.maps.StreetViewPanorama(streetViewElement, {
                        position: results[0].geometry.location,
                        pov: { heading: 34, pitch: 10 }
                    });
                    map.setStreetView(panorama);
                }
            } else {
                console.log('Geocode was not successful: ' + status);
            }
        });
    };

    
});

const shareBtn = document.querySelector('#shareBtn');
    if (shareBtn) {
        shareBtn.addEventListener('click', event => {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $post->title }}',
                    url: '{{ generateCanonicalUrl() }}'
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(err => {
                    console.log("Error while using Web share API:", err);
                });
            } else {
                alert("Browser doesn't support this API !");
            }
        });
    }
</script>

@endpush

@endsection