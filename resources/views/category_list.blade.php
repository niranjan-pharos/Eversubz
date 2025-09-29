@extends('frontend.template.master')
@section('title', 'Explore Our Comprehensive Product List | Eversabz')
@section('description', 'Explore a diverse range of categories at Eversabz, your go-to destination for quality products and services. Discover, shop, and enjoy seamless online experiences.')

@section('content')

<style>
    .category-head{position:relative;height:150px}.category-head img{width:100%;height:100%;object-fit:contain}.category-part{padding:0 0 80px 0;margin-bottom:0;margin-top:-30px}body{background:#F9FAFB}
    </style>
 
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>category list</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
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
            @foreach($categories as $category)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="category-card">
                        <div class="category-head">
                            <img loading="eager" src="{{ asset('storage/'.$category->icon) }}" alt="{{ $category->name }}">
                            <a href="{{ route('products.by_category', ['category' => $category->slug]) }}" class="category-content">
                                <h4>{{ $category->name }}</h4>
                                <p>({{ $category->total_count }})</p>
                            </a>
                        </div>
                        <ul class="category-list">
                            @foreach($subcategories as $subcategory)
                                @if($subcategory->category_id === $category->id)
                                    <li>
                                        <a href="{{ route('products.by_subcategory', ['category' => $category->slug,'subcategory' => $subcategory->slug]) }}">
                                            <h6>{{ $subcategory->name }}</h6>
                                            <p>({{ $subcategory->total_count }})</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                

            </div>
            @endforeach
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="center-20"><a href="#" class="btn btn-inline"><i class="fas fa-eye"></i><span>show more
                            categories</span></a></div>
            </div>
        </div> --}}
    </div>
</section>
<section class="intro-part d-none">
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
<section class="inner-section price-part d-none">
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
  