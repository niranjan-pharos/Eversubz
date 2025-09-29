@extends('frontend.template.master')

@section('content')

<style>
 .product-card-column{margin-bottom:30px}
 .product-widget-scroll{overflow-y:auto}
 .inner-section{margin-bottom:70px}
 .product-widget-scroll::-webkit-scrollbar{width:5px;height:5px}
 .product-widget-scroll::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);-webkit-border-radius:10px;border-radius:10px}
 .product-widget-scroll::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:rgba(255,255,255,.3);-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.5)}
 .product-widget-scroll::-webkit-scrollbar-thumb:window-inactive{background:rgba(255,255,255,.3)}
 @media (max-width:575px){
   .expiry-date{float:left}
   .product-meta{margin-bottom:12px;column-gap:17px;display:flex}
   .product-meta span{margin-right:0}
 }
</style>
<section class="inner-section single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="single-content">
               <h2>Business List</h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Businesses</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="inner-section ad-list-part">
   <div class="container">
      <div class="row content-reverse">
         <div class="col-lg-8 col-xl-9">
            <div class="row">
               <div class="col-lg-12 mb-4">
                  @if(!empty($searchTerm) || !empty($searchCity) || !empty($searchState))
                     @if(!empty($searchTerm))
                        <div class="alert alert-warning filter_alert" style="width:auto">
                           Search: {{ $searchTerm }}
                        </div>
                     @endif
                     @if(!empty($searchCity))
                        <div class="alert alert-warning filter_alert" style="width:auto">
                           City: {{ $searchCity }}
                        </div>
                     @endif
                     @if(!empty($searchState))
                        <div class="alert alert-warning filter_alert" style="width:auto">
                           State: {{ $searchState }}
                        </div>
                     @endif
                  @endif
               </div>
               <div class="col-lg-12">
                  <div class="header-filter">
                     <form action="{{ route('search.more_businesses') }}" method="GET" class="d-flex">
                        <div class="filter-show">
                            <label class="filter-label">Show :</label>
                            <select name="perPage" class="custom-select filter-select" onchange="this.form.submit()">
                              <option value="12" {{ request('perPage') == '12' ? 'selected' : '' }}>12</option>
                              <option value="24" {{ request('perPage') == '24' ? 'selected' : '' }}>24</option>
                              <option value="36" {{ request('perPage') == '36' ? 'selected' : '' }}>36</option>
                          </select>
                        </div>
                        <input type="hidden" name="search_term" value="{{ $searchTerm }}">
                        <input type="hidden" name="search_city" value="{{ $searchCity }}">
                        <input type="hidden" name="search_state" value="{{ $searchState }}">
                     </form>
                  </div>
               </div>
            </div>
            <div class="row">
               @forelse($businesses as $business)
                   <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 product-card-column">
                       <div class="card h-100">
                           <div class="card-body">
                               <h5 class="card-title">{{ $business->business_name }}</h5>
                               <p class="card-text mb-1">
                                 <strong>City:</strong> {{ $business->business_city ?? '-' }}<br>
                                 <strong>State:</strong> {{ $business->business_state ?? '-' }}<br>
                                 <strong>Email:</strong> {{ $business->business_email ?? '-' }}
                               </p>
                               <a href="{{ route('business.show', $business->slug) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                           </div>
                       </div>
                   </div>
               @empty
                   <div class="col-12">
                       <p>No businesses found.</p>
                   </div>
               @endforelse
            </div>
            {{-- Pagination --}}
            @include('components.custom_pagination', ['paginator' => $businesses])
         </div>
      </div>
   </div>
</section>

@include('layouts.wishlist-script')

@endsection
