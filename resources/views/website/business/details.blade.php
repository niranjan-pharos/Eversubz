@extends('frontend.template.master')
@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/css/lightgallery-bundle.min.css"
                        rel="stylesheet">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

<style>
    .inner-section {
        margin-bottom: 0
    }

    .owl-carousel.owl-drag .owl-item {
        touch-action: auto !important
    }

    .ad-details-action button {
        width: 50%
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

    .ad-details-specific p {
        text-align: end
    }

    .ad-details-specific li {
        width: 100%;
        padding: 10px 15px;
        border-radius: 8px;
        text-transform: math-auto;
        column-gap: 10px;
        overflow: auto
    }

    .ad-details-specific li ul {
        display: flex
    }

    .ad-details-specific li ul li {
        padding: 0
    }

    .ad-details-specific {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: auto;
        margin-bottom: 10px
    }

    .ad-details-specific1 {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: auto;
        margin-bottom: 10px
    }

    .ad-details-author .author-list li h6 {
        font-size: 14px;
        font-weight: 500;
        text-transform: capitalize
    }

    .ad-details-author .author-img img {
        height: 100px
    }

    .ad-details-author .author-list li p {
        font-size: 14px;
        font-weight: 500;
        text-transform: lowercase
    }

    #map {
        height: 400px;
        width: 100%
    }

    .author-list li p a {
        padding: 5px
    }

    .card3 .share-list {
        display: flex;
        align-items: center;
        justify-content: center
    }

    .card3 .share-list li {
        margin-right: 8px
    }

    .card3 .share-list li a i {
        width: 40px;
        height: 40px;
        font-size: 14px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        color: var(--primary);
        background: var(--chalk);
        text-shadow: 2px 3px 8px rgb(0 0 0 / .1)
    }

    .card3 .share-list li a i:hover {
        color: var(--white);
        background: var(--primary)
    }

    .fa-facebook-f:before {
        content: "\f39e"
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

    .tag-list p {
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 5px
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

    .ad-details-breadcrumb {
        margin-bottom: 18px;
        position: inherit;
        justify-content: space-between
    }

    textarea.form-control {
        height: auto
    }

    .form-control {
        background: #f1f5f9
    }

    label {
        display: inline-block;
        margin-bottom: .5rem;
        font-weight: 500;
        color: #374151
    }


    .h61 {
        font-size: 15px !important;
    }

    .h62 {
        font-size: 13px !important;
    }

    .ad-details-opening li {
        padding: 4px 0;
    }

    .card-header {
        padding: 0 0 8px;
        margin-bottom: 5px;
    }

    .card-header .nav-tabs li .nav-link {
        padding: 10px 20px;
    }

    .card-header::before {
        position: absolute;
        content: none;
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

    .item.thumbnail-image img {
        width: 80% !important;
        object-fit: contain;
        height: 120px;
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

    .ad-details-breadcrumb .breadcrumb-item {
        color: #fff;
        column-gap: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-between
    }

    .ad-details-breadcrumb .breadcrumb-item h6 {
        color: #fff
    }

    .ad-details-breadcrumb .breadcrumb-item a {
        background: #04b;
        font-size: 14px;
        padding: 3px 10px;
        margin-right: 12px;
        color: var(--white);
        border-radius: 3px;
        font-size: 13px;
        line-height: 18px;
        letter-spacing: .3px;
        text-transform: capitalize
    }

    .ad-details-breadcrumb .breadcrumb-item a:hover {
        color: var(--white);
        padding: 4px 11px
    }

    .owl-carousel .animated {
        animation-duration: 1.5s !important
    }

    .dandik,
    .bamdik {
        opacity: unset !important;
        visibility: visible;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .review-form-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    @media (max-width:575px) {
        .ad-details-part {
            padding: 30px 10px;
            margin-bottom: 70px ! IMPORTANT;
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

        .ad-details-specific li ul {
            display: block
        }

        .ad-details-specific {
            margin-bottom: 10px
        }

        #sync1 .owl-item img {
            height: 225px !important;
            object-fit: contain !important
        }

        .ad-details-specific1 {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(1, 1fr);
            grid-template-rows: auto;
            margin-bottom: 10px
        }

        .review-form-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>
@endpush   


<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Business Details - {{ $businessInfo->business_name }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Business Details</li>
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

                    <div class="flex justify-between items-center w-full mt-4 mb-4">
                        {{-- Category badge (dynamic and visible) --}}
                        <span class="inline-block bg-gray-100 text-blue-700 font-semibold px-4 py-2 rounded-md text-base shadow">
                            <a href="{{ route('business.list', ['categories' => [$businessCategory->slug]]) }}" class="hover:underline">
                                {{ $businessCategory->name ?? 'Category' }}
                            </a>
                        </span>
                        
                    
                        {{-- Establish badge right --}}
                        @if (!empty($businessInfo->establish_year))
                            <span class="rent flat-badge bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow ml-2" style="float:right">
                                Establish: <span class="ml-2 text-lg font-semibold">{{ $businessInfo->establish_year }}</span>
                            </span>
                        @endif
                    </div>
                    
                    
                    
                    <h3 class="ad-details-title">{{ $businessInfo->business_name }}</h3>

                    <div id="sync1" class="owl-carousel owl-theme">
                        <div class="item">
                            <a href="{{ $businessInfo->logo_path ? asset('storage/' . $businessInfo->logo_path) : asset('no-image.jpg') }}"
                                data-lg-size="1600-900">
                                <img loading="eager"
                                    src="{{ $businessInfo->logo_path ? asset('storage/' . $businessInfo->logo_path) : asset('no-image.jpg') }}"
                                    alt="{{ $businessInfo->business_name }}">
                            </a>
                        </div>
                        @foreach ($businessInfo->images as $image)
                        <div class="item">
                            <a href="{{ Storage::url($image->image_path) }}" data-lg-size="1600-900">
                                <img loading="eager" src="{{ Storage::url($image->image_path) }}" alt="details">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    

                    <div id="sync2" class="owl-carousel owl-theme">
                        <div class="item  thumbnail-image">
                            <img loading="eager"
                                src="{{ $businessInfo->logo_path ? asset('storage/' . $businessInfo->logo_path) : asset('no-image.jpg') }}"
                                alt="{{ $businessInfo->business_name }}">
                        </div>
                        @foreach ($businessInfo->images as $image)
                        <div class="item thumbnail-image">
                            <img loading="eager" src="{{ Storage::url($image->image_path) }}" alt="details">
                        </div>
                        @endforeach


                    </div>



                </div>
                <div class="common-card">


                    @if (!empty($businessInfo->website_url))

                    <ul class="ad-details-specific">
                        <li>
                            <h6 class="h61">Website:</h6>
                            <p><a href="{{ $businessInfo->website_url }}" target="_blank">
                                    {{ $businessInfo->website_url }}</a></p>
                        </li>
                    </ul>
                    @endif

                    <ul class="ad-details-specific">
                        <li>
                            <h6 class="h61">Address:</h6>
                            <p>{{ $businessInfo->business_address }}, {{ $businessInfo->business_city }},
                                {{ $businessInfo->business_state }}, {{ $businessInfo->business_country }}</p>
                        </li>
                    </ul>

                    <ul class="ad-details-specific">
                        <li class="card4">
                            <h6 class="h61">Language:</h6>
                            @if($languages->isEmpty())
                            <p style="float:right;">No languages available.</p>
                            @else
                            <ul class="share-list">
                                <li>

                                    <p>
                                        @foreach($languages as $language)
                                        <span>{{ $language->name }}</span>
                                        @endforeach
                                    </p>
                                </li>
                            </ul>
                            @endif
                        </li>


                    </ul>

                </div>
                <div class="common-card ad-details-desc">
                    <div class="card-header">
                        <h5 class="card-title">description</h5>
                    </div>
                    <p class="ad-details-desc">{!! $businessInfo->business_description !!}</p>
                    <!-- <p class="ad-details-desc">{!! Purifier::clean($businessInfo->business_description) !!}</p> -->
                </div>

                <div class="common-card">
                    <!-- Tab Buttons -->
                    <div class="card-header card-header1">
                        <ul class="nav nav-tabs" id="formTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link" id="enquiry-tab" data-toggle="tab" role="tab" onclick="showForm('enquiry')">Enquiry</button>
                            </li>
                        </ul>
                    </div>
                
                    <!-- Form -->
                    <form id="contact-form" class="w-full">
                        <input type="hidden" id="slug" name="slug" value="{{ $businessInfo->slug }}">
                
                        <div class="review-form-grid">
                            <div class="form-group">
                                <input type="text" id="name" name="name" placeholder="Name" required class="form-control" value="{{ request('name') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" value="{{ request('last_name') }}">
                            </div>
                        </div>
                        <div class="review-form-grid">
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Email" required class="form-control" value="{{ request('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" placeholder="Phone" class="form-control" value="{{ request('phone') }}">
                            </div>
                        </div>
                
                        <!-- Book Form -->
                        <div class="form-group" id="book-fields">
                            <input type="hidden" id="module" name="module" value="businessappointment">
                            <div class="form-group">
                                <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control" placeholder="dd--mm--yy / hr--min--sec" value="{{ request('appointment_date') }}">
                            </div>
                        </div>
                
                        <!-- Enquiry Form -->
                        <div class="form-group" id="enquiry-fields" style="display: none;">
                            <input type="hidden" id="module" name="module" value="business">
                        </div>
                
                        <div class="form-group">
                            <textarea id="description" name="description" placeholder="Description" class="form-control">{{ request('description') }}</textarea>
                        </div>
                
                        <div class="form-group text-center">
                            <button type="submit" id="submit-button" class="btn btn-inline review-submit">
                                <i class="fas fa-tint"></i><span>Submit</span>
                            </button>
                        </div>
                
                        <!-- Loader -->
                        <div id="loader" class="text-center" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Processing your request...
                        </div>
                    </form>
                </div>
                

            </div>


            <div class="col-lg-4">

                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Owner info</h5>

                    </div>
                    <div class="ad-details-author">

                        {{-- <a href="" class="author-img active"> --}}
                        <img loading="eager"
                            src="{{ $businessInfo->logo_path ? asset('storage/' . $businessInfo->logo_path) : asset('no-image.jpg') }}"
                            alt="{{ $businessInfo->business_name }}">
                        {{-- </a> --}}


                        <div class="card3 mt-3 ">
                            <h4>{{ $businessInfo->business_name }}</h4>
                            <ul class="share-list mb-3 mt-2 d-none">
                                <li>
                                    <a target="_blank"
                                        href="{{ $businessInfo->facebook_url ? $businessInfo->facebook_url : 'javascript:void(0)' }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="{{ $businessInfo->twitter_url ? $businessInfo->twitter_url : 'javascript:void(0)' }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="{{ $businessInfo->instagram_url ? $businessInfo->instagram_url : 'javascript:void(0)' }}">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        href="{{ $businessInfo->linkedin_url ? $businessInfo->linkedin_url : 'javascript:void(0)' }}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="author-widget">
                                <button id="shareBtn">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>


                        </div>
                        <ul class="author-list">
                            <li>
                                <h6 class="h61">Email : </h6>
                                <p>{{ strtolower($businessInfo->contact_email) }}</p>
                            </li>

                            <li>
                                <h6 class="h61">ABN Number:</h6>
                                <p>@if (!empty($businessInfo->abn))
                                    {{ $businessInfo->abn }}
                                    @else
                                    Not Available
                                    @endif</p>
                            </li>


                            <li>
                                <h6 class="h61">No. of Products</h6>
                                <p> {{ $productCount }}</p>
                            </li>
                            <li>
                                <h6 class="h61">Average Ratings</h6>
                                <p> @if ($averageRating > 0)
                                    {{ number_format($averageRating, 2) }}
                                    @else
                                    -
                                    @endif</p>
                            </li>

                            <li>
                                <h6 class="h61"><a target="_blank"
                                        href="{{ route('product.list', $businessInfo->slug) }}"
                                        class="link-primary icon-spacing">View Products / Services</a></h6>

                            </li>
                           <li>
                                <h6 class="h61">
                                    <a href="#" data-toggle="modal" data-target="#claimBusinessModal" class="link-primary icon-spacing">Claim This Business</a>
                                </h6>
                            </li>
                            
                        </ul>

                    </div>

                </div>
                @if(!empty($businessInfo->contact_phone))
                    <a href="tel:{{ $businessInfo->contact_phone }}" 
                       class="common-card number d-flex align-items-center justify-content-center text-decoration-none">
                        <h3 class="mb-0 text-center flex-grow-1">
                            {{ $businessInfo->contact_phone }}
                        </h3>
                        <i class="fas fa-phone ms-2"></i>
                    </a>
                @endif
                
                @if($businessInfo->deals->isNotEmpty())
                <div class="common-card card4">
                    <div class="card-header">
                        <h5 class="card-title">Deals In</h5>
                    </div>
                    <ul class="share-list mb-3 mt-2">
                        <li>
                            <p>
                                @foreach($businessInfo->deals as $deal)
                                <span>{{ $deal->deal }}{{ !$loop->last ? ' ' : '' }}</span>
                                @endforeach
                            </p>
                        </li>
                    </ul>
                </div>
                @endif


                <div class="common-card">

                    <div class="card-header">
                        <h5 class="card-title">opening hour</h5>
                    </div>

                    @if($businessInfo->businessHours->isNotEmpty())
                    <ul class="ad-details-opening">
                        @foreach($businessInfo->businessHours as $businessHour)
                        <li>
                            <h6 class="h62">Monday</h6>
                            <p class="h62">
                                {{ $businessHour->monday_hours === ' - ' ? '...' : $businessHour->monday_hours }}</p>
                        </li>
                        <li>
                            <h6 class="h62">Tuesday</h6>
                            <p class="h62">
                                {{ $businessHour->tuesday_hours === ' - ' ? '...' : $businessHour->tuesday_hours }}
                            </p>
                        </li>
                        <li>
                            <h6 class="h62">Wednesday</h6>
                            <p class="h62">
                                {{ $businessHour->wednesday_hours === ' - ' ? '...' : $businessHour->wednesday_hours }}
                            </p>
                        </li>
                        <li>
                            <h6 class="h62">Thursday</h6>
                            <p class="h62">
                                {{ $businessHour->thursday_hours === ' - ' ? '...' : $businessHour->thursday_hours }}
                            </p>
                        </li>
                        <li>
                            <h6 class="h62">Friday</h6>
                            <p class="h62">
                                {{ $businessHour->friday_hours === ' - ' ? '...' : $businessHour->friday_hours }}</p>
                        </li>
                        <li>
                            <h6 class="h62">Saturday</h6>
                            <p class="h62">
                                {{ $businessHour->saturday_hours === ' - ' ? '...' : $businessHour->saturday_hours }}
                            </p>
                        </li>
                        <li>
                            <h6 class="h62">Sunday</h6>
                            <p class="h62">
                                {{ $businessHour->sunday_hours === ' - ' ? '...' : $businessHour->sunday_hours }}</p>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                </div>

                @if(!empty($businessInfo->business_city))
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Area Map</h5>
                    </div>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                @endif

            </div>


        </div>
    </div>
</section>
<div class="modal fade" id="number">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Contact this Number</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h3 class="modal-number">{{ $businessInfo->contact_phone }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="claimBusinessModal" tabindex="-1" aria-labelledby="claimBusinessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="claimBusinessForm" action="{{ route('claim.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="claimBusinessModalLabel">
                        <i class="fas fa-building me-2"></i>Claim Business: {{ $businessInfo->business_name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="business_id" value="{{ $businessInfo->id }}">

                    <!-- Business Info Display -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <h6><strong>{{ $businessInfo->business_name }}</strong></h6>
                                <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>{{ $businessInfo->business_address }}</p>
                                <p class="mb-0"><i class="fas fa-phone me-2"></i>{{ $businessInfo->contact_phone }}</p>
                            </div>
                            @if($businessInfo->logo_path)
                            <div class="col-md-4 text-end">
                                <img src="{{ asset('storage/' . $businessInfo->logo_path) }}" alt="Business Logo" class="img-thumbnail mt-2" style="max-height: 60px;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Error/Success Messages -->
                    <div id="claimFormMessages"></div>

                    <div class="row">
                        <!-- Claimer Name -->
                        <div class="col-md-6 mb-3">
                            <label for="claimer_name" class="form-label">Your Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="claimer_name" name="claimer_name" required>
                            <div class="invalid-feedback" id="claimer_name_error"></div>
                        </div>

                        <!-- Claimer Email -->
                        <div class="col-md-6 mb-3">
                            <label for="claimer_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="claimer_email" name="claimer_email" required>
                            <div class="invalid-feedback" id="claimer_email_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Claimer Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="claimer_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="claimer_phone" name="claimer_phone" required>
                            <div class="invalid-feedback" id="claimer_phone_error"></div>
                        </div>

                        <!-- Relationship to Business -->
                        <div class="col-md-6 mb-3">
                            <label for="relationship_to_business" class="form-label">Your Relationship to Business</label>
                            <select class="form-control" id="relationship_to_business" name="relationship_to_business">
                                <option value="">Select Relationship</option>
                                <option value="owner">Business Owner</option>
                                <option value="manager">Manager</option>
                                <option value="employee">Employee</option>
                                <option value="partner">Business Partner</option>
                                <option value="representative">Authorized Representative</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="invalid-feedback" id="relationship_to_business_error"></div>
                        </div>
                    </div>

                    <!-- Claim Reason -->
                    <div class="mb-3">
                        <label for="claim_reason" class="form-label">Reason for Claiming <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="claim_reason" name="claim_reason" rows="4" 
                                placeholder="Please explain why you are claiming this business listing and provide any relevant details..." required></textarea>
                        <div class="invalid-feedback" id="claim_reason_error"></div>
                        <small class="form-text text-muted">Maximum 1000 characters</small>
                    </div>

                    <!-- Supporting Documents -->
                    <div class="mb-3">
                        <label for="supporting_documents" class="form-label">Supporting Documents (Optional)</label>
                        <input type="file" class="form-control" id="supporting_documents" name="supporting_documents" 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div class="invalid-feedback" id="supporting_documents_error"></div>
                        <small class="form-text text-muted">
                            Upload documents that prove your relationship to this business (Business license, ID, etc.). 
                            Accepted formats: PDF, DOC, DOCX, JPG, JPEG, PNG. Maximum size: 5MB
                        </small>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms_agreement" required>
                        <label class="form-check-label" for="terms_agreement">
                            I confirm that the information provided is accurate and I have the authority to claim this business listing. <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitClaimBtn">
                        <i class="fas fa-paper-plane me-1"></i>Submit Claim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/zoom/lg-zoom.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap">
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lightGallery(document.getElementById('sync1'), {
                selector: 'a',
                plugins: [lgZoom, lgThumbnail],
                speed: 500,
                thumbnail: true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#claimBusinessForm').on('submit', function(e) {
                e.preventDefault();
        
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('#claimFormMessages').empty();
        
                const submitBtn = $('#submitClaimBtn');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Submitting...');
        
                const formData = new FormData(this);
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#claimFormMessages').html(
                                '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-check-circle me-2"></i>' + response.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                                '</div>'
                            );
        
                            $('#claimBusinessForm')[0].reset();
        
                            setTimeout(function() {
                                $('#claimBusinessModal').modal('hide');
        
                                if (typeof showToast === 'function') {
                                    showToast('success', 'Claim submitted successfully!');
                                }
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
        
                            $.each(errors, function(field, messages) {
                                const fieldElement = $('#' + field);
                                fieldElement.addClass('is-invalid');
                                $('#' + field + '_error').text(messages[0]);
                            });
        
                            $('#claimFormMessages').html(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-exclamation-circle me-2"></i>Please correct the errors below and try again.' +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                                '</div>'
                            );
                        } else {
                            const errorMessage = xhr.responseJSON?.message || 'An error occurred. Please try again.';
                            $('#claimFormMessages').html(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-exclamation-circle me-2"></i>' + errorMessage +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                                '</div>'
                            );
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        
            let emailTimeout;
            $('#claimer_email').on('input', function() {
                const email = $(this).val();
                const businessId = $('input[name="business_id"]').val();
        
                if (email && businessId) {
                    clearTimeout(emailTimeout);
                    emailTimeout = setTimeout(function() {
                        $.ajax({
                            url: "{{ route('claim.check-existing') }}",
                            data: { business_id: businessId, email: email },
                            success: function(response) {
                                if (response.has_existing_claim) {
                                    $('#claimFormMessages').html(
                                        '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                        '<i class="fas fa-exclamation-triangle me-2"></i>' +
                                        'You already have a pending claim for this business with this email address.' +
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                                        '</div>'
                                    );
                                }
                            }
                        });
                    }, 1000);
                }
            });
        
            $('#claim_reason').on('input', function() {
                const maxLength = 1000;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;
        
                let counterColor = 'text-muted';
                if (remaining < 100) counterColor = 'text-warning';
                if (remaining < 50) counterColor = 'text-danger';
        
                $(this).siblings('.form-text').html(
                    `<span class="${counterColor}">Maximum 1000 characters (${remaining} remaining)</span>`
                );
            });
        });
        
        function openClaimModal(businessId) {
            $.ajax({
                url: "{{ route('claim.create') }}",
                data: { business_id: businessId },
                success: function(response) {
                    $('#claimBusinessModal').remove();
                    $('body').append(response);
                    $('#claimBusinessModal').modal('show');
                },
                error: function() {
                    alert('Error loading claim form. Please try again.');
                }
            });
        }
    </script>
        
<script>
function showForm(type) {
        if (type === 'enquiry') {
            document.getElementById('enquiry-fields').style.display = 'block';
            document.getElementById('book-fields').style.display = 'none';
            document.getElementById('module').value = 'business';
            
        } else {
            document.getElementById('book-fields').style.display = 'block';
            document.getElementById('enquiry-fields').style.display = 'none';
            document.getElementById('module').value = 'businessappointment';
        }
    }

   document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('contact-form').addEventListener('submit', function (event) {
      event.preventDefault();

      const name = document.getElementById('name').value.trim();
      const lastName = document.getElementById('last_name').value.trim();
      const email = document.getElementById('email').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const slug = document.getElementById('slug').value.trim();
      const module = document.getElementById('module').value.trim();
      const appointmentDate = document.getElementById('appointment_date') ? document.getElementById('appointment_date').value.trim() : null;
      const description = document.getElementById('description').value.trim();

      if (!name || !email) { 
          toastr.error("Name and Email are required fields.");
          return;
      }

      const submitButton = document.getElementById('submit-button');
      const loader = document.getElementById('loader');
      submitButton.disabled = true;
      loader.style.display = 'block';

      const formData = {
          name,
          last_name: lastName,
          email,
          phone,
          slug,
          module,
          appointment_date: appointmentDate,
          description,
      };

      const url = "{{ route('enquiry.submit') }}";
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      fetch(url, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify(formData),
      })
      .then((response) => {
          if (!response.ok) {
              if (response.status === 422) {
                  return response.json().then((data) => {
                      throw new Error(data.message || "Validation error occurred.");
                  });
              }
              throw new Error("An error occurred while submitting the form.");
          }
          return response.json();
      })
      .then((data) => {
          submitButton.disabled = false;
          loader.style.display = 'none';
          if (data.success) {
              toastr.success("Form submitted successfully!");
              document.getElementById('contact-form').reset();
          } else {
              toastr.error(data.message || "An error occurred while submitting the form.");
          }
      })
      .catch((error) => {
          submitButton.disabled = false;
          loader.style.display = 'none';
          toastr.error(error.message || "An unexpected error occurred.");
      });
  });
});





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

    var businessAddress = {!! json_encode($businessInfo->business_city ?? '') !!};
    console.log("Business Address:", businessAddress);
        window.initMap = function() {
            var mapDiv = document.getElementById('map');
            if (!mapDiv) {
                console.warn("Map div not found!");
                return;
            }

            var geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(mapDiv, {
                zoom: 15,
                center: { lat: -34.397, lng: 150.644 }
            });

            if (!businessAddress) return;

            geocoder.geocode({ address: businessAddress }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    console.error('Geocode failed: ' + status);
                }
            });
        };

    });

    document.querySelector('#shareBtn').addEventListener('click', event => {
        if (navigator.share) {
            navigator.share({
                title: '{{ $businessInfo->business_name }}',
                url: '{{ generateCanonicalUrl() }}'
            }).then(() => {
                console.log('Thanks for sharing!')
            }).catch(err => {
                console.log("Error while using Web share API:");
            })
        } else {
            alert("Browser doesn't support this API !")
        }
    });

</script>
@endpush

@endsection