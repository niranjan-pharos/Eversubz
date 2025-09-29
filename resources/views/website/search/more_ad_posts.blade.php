@extends('frontend.template.master')

@section('content')
<style>
  .product-card-column{margin-bottom:30px}.product-widget-scroll{overflow-y:auto}.inner-section{margin-bottom:70px}.product-widget-scroll::-webkit-scrollbar{width:5px;height:5px}.product-widget-scroll::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);-webkit-border-radius:10px;border-radius:10px}.product-widget-scroll::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:rgba(255,255,255,.3);-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.5)}.product-widget-scroll::-webkit-scrollbar-thumb:window-inactive{background:rgba(255,255,255,.3)}@media (max-width:575px){.expiry-date{float:left}.product-meta{margin-bottom:12px;column-gap:17px;display:flex}.product-meta span{margin-right:0}}.recommend-product-img{height:200px}.recommend-product-img img{height:100%!important;object-fit:contain;background:#fff}.filter_alert{margin-right:10px;width:100px;height:11px;padding:17px 10px;border-radius:4px;line-height:0;font-size:14px;float:left}.filter_alert .close{padding:7px 10px;font-size:21px}
</style>
<section class="inner-section single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="single-content">
               <h2>ads list</h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="\">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ads List</li>
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
         <div class="col-lg-8 col-xl-9">
            <div class="row">
            <div class="col-lg-12 mb-4">
              
               @if(!empty($activeFilters))
               @foreach($activeFilters as $filter => $value)
                   <div class="alert alert-warning alert-dismissible fade show filter_alert" role="alert" style="width:auto">
                       {{ ucfirst($filter) }}: {{ $value }}
                       <a href="{{ route('adsList', array_merge(request()->query(), [$filter => null])) }}" class="close" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </a>
                   </div>
               @endforeach
           @endif
           

               </div>
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
                     
                     {{-- @include('website.ads-list.view_type') --}}

                  </div>
               </div>
            
            </div>
            
            <div class="row">
               @forelse($posts as $item)
                   <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 product-card-column">
                       <x-product-card :post="$item" />
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



@include('layouts.wishlist-script')

@endsection