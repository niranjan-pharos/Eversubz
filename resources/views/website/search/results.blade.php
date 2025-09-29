@extends('frontend.template.master')

@section('content')

<style>
  .product-card-column{margin-bottom:30px}.product-widget-scroll{overflow-y:auto}.product-category .breadcrumb-item{font-size:12px}.product-widget-scroll::-webkit-scrollbar{width:5px;height:5px}.product-widget-scroll::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);-webkit-border-radius:10px;border-radius:10px}.product-widget-scroll::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:rgba(255,255,255,.3);-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.5)}.product-widget-scroll::-webkit-scrollbar-thumb:window-inactive{background:rgba(255,255,255,.3)}@media (max-width:575px){.expiry-date{float:left}.product-meta{margin-bottom:12px;column-gap:17px;display:flex}.product-meta span{margin-right:0}}.recommend-product-img{height:200px}.recommend-product-img img{height:100%!important;object-fit:contain;background:#fff}.filter_alert{margin-right:10px;width:100px;height:11px;padding:17px 10px;border-radius:4px;line-height:0;font-size:14px;float:left}.filter_alert .close{padding:7px 10px;font-size:21px}body{background:#f9fafb}.product-card,.product-widget{background:#fff}.product-img{overflow:hidden;display:flex;justify-content:center}.product-category{height:auto;padding:0;margin:0}.product-content{padding:.875rem}.product-content1{display:flex;justify-content:space-between}.product-button12,.product-title.mobile{display:none}.product-category .breadcrumb-item a{color:rgb(13 148 136)}.product-title{height:auto;font-size:.85rem}.product-card-column{padding:0 5px}.product-card{margin:0 0 10px}.product-price{font-size:14px}.inner-section{margin-bottom:40px;}.no-result{color: #000;font-size: 16px; text-align: center;width: 320px;padding: 13px;border: 1px solid #2d64af;border-radius:7px;background: #fff;}hr{border-top:1px solid rgba(0,0,0,.5);margin-top:2rem;margin-bottom:2rem;}@media only screen and (max-width:737px){.product-title.mobile{display:block}.product-title.desktop{display:none}.product-content1{flex-direction:column}.product-category .breadcrumb-item,.product-category li i,.product-meta span{font-size:11px}nav .hidden{flex-direction:column;margin-bottom:30px}.oneline-overflow,h3{font-size: 20px;text-align:center}.product-img{overflow:hidden;height:130px;align-content:center;background:#fff}.product-title{font-weight:600;font-size:13px;line-height:20px}.product-price{font-size:14px}.product-card-column{margin-bottom:0;padding:0 5px}.product-card{width:auto;margin:0 auto 10px;height:auto}.product-img img{width:100%;height:100%}.product-info{display:flex;padding:4px 0}.product-btn a,.product-btn button{margin-left:0;padding-left:0}.no-result{width: 100%;}.ad-list-part{margin-bottom: 100px;}}
</style>

<section class="inner-section single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12"> 
            <div class="single-content">
               <h2>Global Search</h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Global Search</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="inner-section ad-list-part">
   <div class="container">
      <div class="row content-reverse">
         {{-- @include('website.ads-list.filter') --}}
         <div class="col-lg-12 col-xl-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="header-filter"> 
                     <form action="{{ route('adsList') }}" method="GET" style="display:contents;">
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
                     {{-- @include('website.ads-list.view_type') --}}
                  </div>
               </div>
            </div>  
            
            {{-- Ad Posts --}}
            <div class="row">
               <div class="col-lg-12 mb-4">
                  <h3>Ad Posts : Search Results for "{{ $searchTerm }}"</h3>
               </div> 
               @forelse($posts->take(8) as $item) 
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 product-card-column">
                     <x-product-card :post="$item" />
                  </div>
               @empty
                  <div class="col-12">
                     <p class="no-result">No result found.</p>
                  </div>
               @endforelse
            
               @if($posts->count() > 8) 
               <div class="col-lg-12 text-center">
                  <a href="{{ route('search.more_ad_posts', ['search_term' => $searchTerm]) }}" class="btn btn-inline"><i class="fas fa-eye"></i> More Ad Posts</a>
               </div>
               @endif
            </div>
            
            <hr>

            {{-- Business Products --}}
            <div class="row">
               <div class="col-lg-12 mb-4">
                  <h3>Business Product : Search Results for "{{ $searchTerm }}"</h3>
               </div>

               @forelse($businessProducts->take(8) as $item)  
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 product-card-column">
                     <x-product-card :post="$item" />
                  </div>
               @empty
                  <div class="col-12">
                     <p class="no-result">No result found.</p>
                  </div>
               @endforelse
         
               @if($businessProducts->count() > 8)  
               <div class="col-lg-12 text-center">
                  <a href="{{ route('search.more_business_products', ['search_term' => $searchTerm]) }}" class="btn btn-inline"><i class="fas fa-eye"></i> More Business Posts</a>
               </div>
               @endif
            </div>

            <hr>

            {{-- Businesses --}}
            <div class="row">
               <div class="col-lg-12 mb-4">
                  <h3>Businesses : Search Results for "{{ $searchTerm }}"</h3>
               </div>

               @forelse($businesses->take(8) as $business)  
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 product-card-column">
                     <div class="business-card">
                        <div class="card border p-3 h-100">
                           <h5 class="mb-2">{{ $business->business_name }}</h5>
                           <p class="mb-1">{{ $business->business_city }}, {{ $business->business_state }}</p>
                           <a href="{{ route('business.view', $business->slug ?? $business->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                        </div>
                     </div>
                  </div>
               @empty
                  <div class="col-12">
                     <p class="no-result">No result found.</p>
                  </div>
               @endforelse

               @if($businesses->count() > 8)  
               <div class="col-lg-12 text-center">
                  <a href="{{ route('search.more_businesses', ['search_term' => $searchTerm]) }}" class="btn btn-inline"><i class="fas fa-eye"></i> More Businesses</a>
               </div>
               @endif
            </div>

         </div>
      </div>
   </div>
</section>



@include('layouts.wishlist-script')

@endsection