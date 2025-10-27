@extends('frontend.template.master')

@section('content')
    <link rel="stylesheet" href="assets/css/custom/category-list.css">


    <section class="inner-section single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>Category list</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">category-list</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section category-part">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="category-card">
                            <div class="category-head"><img src="{{ asset('storage/'.$category->icon) }}" alt="{{$category->name }}"><a
                                href="{{ route('products.by_category', strtolower($category->name)) }}" class="category-content">
                                    <h4>{{ $category->name }}</h4>
                                    <p>({{ $category->subCategories->sum('ad_posts_count') }} )</p>
                                </a></div>
                            @if ($category->subCategories->count() > 0)
                                <ul class="category-list">
                                    @foreach ($category->subCategories as $subCategory)
                                        <li>
                                        <a href="{{ route('products.by_subcategory', [$category->slug, strtolower($subCategory->slug)]) }}">
                                                <h6>{{ $subCategory->name }}</h6>
                                                <p>({{ $subCategory->ad_posts_count }})</p>
                                            </a></li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-20">
                        {{-- <a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>show
                                more
                                categories</span></a> --}}
                            </div>
                </div>
            </div>
        </div>
    </section>
    <section class="intro-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Do you have something to advertise?</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                            voluptatum repudiandae veniam maxime tenetur.</p><a href="ad-post.html"
                            class="btn btn-outline"><i class="fas fa-plus-circle"></i><span>post your ad</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inner-section price-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Best Reliable Pricing Plans</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                            voluptatum repudiandae veniam maxime tenetur.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="price-card">
                        <div class="price-head"><i class="flaticon-bicycle"></i>
                            <h3>$00</h3>
                            <h4>Basic Plan</h4>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li class="disable"><i class="fas fa-times"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li class="disable"><i class="fas fa-times"></i>
                                <p>Access to limited features</p>
                            </li>
                        </ul>
                        <div class="price-btn"><a href="user-form.html" class="btn btn-inline"><i
                                    class="fas fa-sign-in-alt"></i><span>Register Now</span></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="price-card price-active">
                        <div class="price-head"><i class="flaticon-car-wash"></i>
                            <h3>$23</h3>
                            <h4>Standard Plan</h4>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li class="disable"><i class="fas fa-times"></i>
                                <p>Access to limited features</p>
                            </li>
                        </ul>
                        <div class="price-btn"><a href="user-form.html" class="btn btn-inline"><i
                                    class="fas fa-sign-in-alt"></i><span>Register Now</span></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="price-card">
                        <div class="price-head"><i class="flaticon-airplane"></i>
                            <h3>$49</h3>
                            <h4>Premium Plan</h4>
                        </div>
                        <ul class="price-list">
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                            <li><i class="fas fa-plus"></i>
                                <p>Access to limited features</p>
                            </li>
                        </ul>
                        <div class="price-btn"><a href="user-form.html" class="btn btn-inline"><i
                                    class="fas fa-sign-in-alt"></i><span>Register Now</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
