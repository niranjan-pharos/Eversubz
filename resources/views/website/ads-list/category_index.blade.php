@extends('frontend.template.master')

@section('content')
@php
$currentType = request('type', 'all');
@endphp
<style>
  body{background: #F9FAFB;} .product-widget, .product-card { background: #fff; } .product-img { overflow: hidden; display: flex; justify-content: center; } .product-category{ height: auto; padding: 0px; margin: 0px;} .product-content { padding: 0.875rem; } .product-content1{display: flex; justify-content: space-between; } .product-content2{} .product-content3{} .product-button12{display:none;} .product-category .breadcrumb-item a { color: rgb(13 148 136); } .product-title { height: auto; font-size: 0.85rem; } .product-card-column{ padding: 0px 5px;} .product-card{margin:0px 0px 10px;} .product-price { font-size: 14px; } .product-title.mobile{display:none;} .inner-section{margin-bottom: 40px;}hr{border-top:1px solid rgba(0,0,0,.5);margin-top:2rem;margin-bottom:2rem;}.no-result{color: #000;font-size: 16px; text-align: center;width: 320px;padding: 13px;border: 1px solid #2d64af;border-radius:7px;background: #fff;}
.filters-column-ads .product-widget.desktop {
    display: block
}.filter-button1 { display: flex; column-gap: 5px }  
.filters-column-ads .product-widget.mobile {
    display: none;
} .filters-column-ads .product-widget { background: none; padding: 5px; border: none; margin-bottom: 10px; } .filters-column-ads .product-widget .product-widget-title { font-size: 15px; } .filters-column-ads .product-widget .product-widget-title a { color: #000; display: flex; column-gap: 15px }
@media only screen and (max-width: 737px) { .filters-column-ads .product-widget.mobile,.product-title.mobile{display:block}.filters-column-ads .product-widget.desktop,
    .product-card:hover .product-action,
    .product-title.desktop {
        display: none
    }.no-result{width: 100%;}.ad-list-part{margin-bottom: 150px;} .product-title.mobile{display:block;} .product-title.desktop{display:none;} .product-content1{flex-direction: column;} .product-meta span{font-size:11px;} nav .hidden { flex-direction: column; margin-bottom: 30px; } .oneline-overflow { text-align: center; } .product-img { overflow: hidden; height: 130px; align-content: center; background: white; } .product-title { /* height: 50px; */ font-weight: 600; font-size: 13px; line-height: 20px; } .product-category { /* margin-bottom: 1px; line-height: 17px;height:50px; */ } .product-category .breadcrumb-item { font-size: 11px; } .product-price { font-size: 14px; } .product-category li i { font-size: 11px; } .product-card-column { margin-bottom: 0px; padding: 0px 5px; } .product-card { width: auto; margin: 0px auto 10px; height: auto; } .product-img img { width: 100%; height: 100%; } .product-btn a, .product-btn button { margin-left: 0px; padding-left: 0px; } .product-meta { /* margin-bottom: 5px; line-height: 20px; height: 40px; */ display:none; } h3 { text-align: center; } .product-card:hover .product-action{display: none;} .product-media::before{content:none;} .product-card:hover .product-img img { transform: none; } }
</style>
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>ads list</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post / Product List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row">
            @include('website.ads-list.filter')
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        @include('website.ads-list.active_filters')
                    </div>
                    <div class="col-lg-12">
                        <div class="header-filter">
                            @include('website.ads-list.sort_and_filter')
                        </div>
                    </div>
                </div>
                @if($currentType === 'all' || $currentType === 'adposts')
                <div class="row">

                    <div class="col-lg-12 mb-4">
                        <h3>Ad Post</h3>
                    </div>

                    @forelse($posts as $item)
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                        <x-product-card :post="$item" />
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="no-result">No ads available at the moment.</p>
                    </div>
                    @endforelse

                    @if($posts->total() > 6)
                    <div class="col-lg-12 text-center">
                        <a href="{{ $posts->appends(['category' => $categorySlug, 'subcategory' => $subcategorySlug, 'type' => 'adposts'])->nextPageUrl() }}"
                            class="btn btn-inline"><i class="fas fa-eye"></i> More Ad Posts</a>

                    </div>
                    @endif


                </div>
                <br />
                @endif

                <hr>

                @if($currentType === 'all' || $currentType === 'products')
                <div class="row mt-4">

                    <div class="col-lg-12 mb-4">
                        <h3>Products </h3>
                    </div>
                    @forelse($products as $item)
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                        <x-business-product-card :product="$item" />
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="no-result">No products available at the moment.</p>
                    </div>
                    @endforelse

                    @if($products->total() > 6)
                    <div class="col-lg-12 text-center">
                        <a href="{{ $products->nextPageUrl() }}" class="btn btn-inline"><i class="fas fa-eye"></i> More
                            Products</a>
                    </div>
                    @endif

                </div>
                @endif

            </div>
        </div>
    </div>
</section> 

<script>document.addEventListener('DOMContentLoaded',function(){const lazyImages=document.querySelectorAll('img.lazy-load'),placeholder='{{ asset("storage/placeholder-image.webp") }}';lazyImages.forEach(img=>{img.setAttribute('loading','lazy'),img.setAttribute('src',placeholder)});if('IntersectionObserver'in window){let lazyImageObserver=new IntersectionObserver(function(entries,observer){entries.forEach(function(entry){if(entry.isIntersecting){let img=entry.target;const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load'),lazyImageObserver.unobserve(img)}})});lazyImages.forEach(function(img){lazyImageObserver.observe(img)})}else lazyImages.forEach(function(img){const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load')})});
document.addEventListener('DOMContentLoaded',function(){function toggleAccordionCategory(element){const content=document.getElementById(element.getAttribute('aria-controls'));const isExpanded=element.getAttribute('aria-expanded')==='true';const icon=element.querySelector('.toggle-icon-category');if(!isExpanded){element.setAttribute('aria-expanded','true');content.style.display='block';icon.classList.replace('fa-chevron-down','fa-chevron-up')}else{element.setAttribute('aria-expanded','false');content.style.display='none';icon.classList.replace('fa-chevron-up','fa-chevron-down')}}
document.querySelectorAll('.accordion-toggle-category').forEach(toggle=>{toggle.addEventListener('click',function(){toggleAccordionCategory(this)})})});
</script>

@include('layouts.wishlist-script')

@endsection