@extends('frontend.template.master')
@section('title', 'Ads Listting')
@section('description', 'Ads Listting - Eversubz')
@section('content')
<style>
  .expiry-date{float:right}@media (max-width:575px){.expiry-date{float:left}.product-meta{margin-bottom:12px;column-gap:17px;display:flex}.product-meta span{margin-right:0}}
</style>
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Ads list</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ad-list - Product List</li>
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
                
                <div class="row">
                    @forelse($interleaved as $item)
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <x-product-card class="standard" :post="$item" />
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