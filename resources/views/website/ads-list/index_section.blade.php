@extends('frontend.template.master')
@section('title', 'Ads Listting')
@section('description', 'Ads Listting - Eversubz')
@section('content')

<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>ads list</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ad-list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row content-reverse">
            @include('website.ads-list.filter')
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-filter">
                            <form action="{{ route('adsList') }}" method="GET" class="d-flex">
                                <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select name="perPage" class="custom-select filter-select" onchange="this.form.submit()">
                                      <option value="12" {{ request('perPage') == '12' ? 'selected' : '' }}>12</option>
                                      <option value="24" {{ request('perPage') == '24' ? 'selected' : '' }}>24</option>
                                      <option value="36" {{ request('perPage') == '36' ? 'selected' : '' }}>36</option>
                                  </select>
                                </div>
                                <div class="filter-short ml-3">
                                    <label class="filter-label">Sort by :</label>
                                    <select name="sortBy" class="custom-select filter-select" onchange="this.form.submit()">
                                        <option value="default" {{ request('sortBy') == 'default' ? 'selected' : '' }}>default</option>
                                        <option value="1" {{ request('sortBy') == '1' ? 'selected' : '' }}>featured</option>
                                        <option value="2" {{ request('sortBy') == '2' ? 'selected' : '' }}>recommend</option>
                                        <option value="3" {{ request('sortBy') == '3' ? 'selected' : '' }}>trending</option>
                                    </select>
                                </div>
                            </form>
                            
                            @include('website.ads-list.view_type')
                            
                        </div>
                    </div>
                </div>
                
                <div class="row ">
                    @forelse($posts as $post)
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                            <x-product-card :post="$post" />
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No result found.</p>
                        </div>
                    @endforelse
                </div>
                

                {{-- pagination --}}
                @include('components.custom_pagination', ['paginator' => $posts])

            </div>
        </div>
    </div>
</section>

<style>

 
@media (max-width:575px){.expiry-date{float:left}.product-meta{margin-bottom:12px;column-gap:17px;display:flex}.product-meta span{margin-right:0}.product-category{height:auto;margin-bottom:1px;line-height:17px;height:50px}.product-category li i{font-size:11px}.product-category .breadcrumb-item{font-size:11px}.product-title{height:50px;font-weight:600;font-size:13px;line-height:20px}.product-meta{margin-bottom:5px;line-height:20px;height:40px;display:block}.product-price{font-size:14px}.product-card-column{margin-bottom:0;padding:0 5px}.product-img{overflow:hidden;height:130px;align-content:center;background:#fff;display:flex;justify-content:center}.product-img img{width:100%;height:100%}}
 </style>

    @include('layouts.wishlist-script')
 
 @endsection