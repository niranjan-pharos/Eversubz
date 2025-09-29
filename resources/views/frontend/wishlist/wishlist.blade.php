@extends('frontend.template.master')
@section('title',  "My Wishlist")

@section('content')
@include('frontend.template.usermenu')


<section class="bookmark-part">
    <div class="container">
        <div class="row">
                <h5>My Wishlist</h5>

 
        </div>

        <div class="row">
        @if($wishlists->isNotEmpty())
                <div class="header-filter">
                    <form action="{{ request()->url() }}" method="GET">
                        <div class="filter-show">
                            <label for="perPage" class="filter-label">Show:</label>
                            <select name="perPage" id="perPage" class="custom-select filter-select"
                                onchange="this.form.submit()">
                                <option value="12" {{ request('perPage') == "12" ? 'selected' : '' }}>12</option>
                                <option value="24" {{ request('perPage') == "24" ? 'selected' : '' }}>24</option>
                                <option value="36" {{ request('perPage') == "36" ? 'selected' : '' }}>36</option>
                            </select>
                        </div>
                        {{-- Reset the page number to 1 when perPage changes --}}
                        <input type="hidden" name="page" value="1">
                        {{-- Preserve other query parameters, except perPage and page --}}
                        @foreach(request()->except(['perPage', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>

                </div>
            <div class="table-responsive">
               
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                        <tr>
                            <td>
                                <img class="img-thumbnail" style="width:70px"
                                     src="{{ $wishlist->wishable && $wishlist->wishable_type == 'App\Models\AdPost' 
                                        ? asset('storage/' . ($wishlist->wishable->primaryImage->url ?? 'default-image-path.jpg')) 
                                        : ($wishlist->wishable ? asset('storage/' . ($wishlist->wishable->main_image ?? 'default-image-path.jpg')) : asset('storage/default-image-path.jpg')) }}"
                                     class="img-thumbnail"
                                     alt="{{ $wishlist->wishable->title ?? $wishlist->wishable->name ?? 'No Title' }}">
                            </td>
                            <td>
                                @if ($wishlist->wishable)
                                    <a href="{{ $wishlist->wishable_type == 'App\Models\AdPost' 
                                            ? route('posts.showByUrl', [$wishlist->wishable->item_url]) 
                                            : route('BusinessProduct.view', [$wishlist->wishable->item_url]) }}">
                                        {{ $wishlist->wishable->title ?? $wishlist->wishable->name }}
                                    </a>
                                @else
                                    <span>No item found</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-success add-to-cart"
                                        data-product-id="{{ $wishlist->wishable->id }}"
                                        data-wishable-type="{{ $wishlist->wishable_type }}">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                
                                <button class="btn btn-danger remove-from-wishlist"
                                        data-wishable-id="{{ Crypt::encryptString($wishlist->id) }}"
                                        data-wishable-type="{{ $wishlist->wishable_type }}">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                                    
                    
                </table>
                @else
                <div class="alert alert-info" role="alert">
                    Your wishlist is currently empty.
                </div>
                @endif

            </div>

            {{-- pagination --}}
            @include('components.custom_pagination', ['paginator' => $wishlists])

        </div>
</section>

<style>
        .product-card{border-radius:8px;margin-bottom:30px;background:var(--chalk);overflow:hidden;border:1px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}body{background:#fff}.bookmark-part{padding: 50px 20px 30px;    margin-bottom: 50px;} h5{    margin-bottom: 15px;}
        .btn {
    border: 2px solid;
    font-size: 14px;
    text-align: center;
    padding: .375rem .5rem .375rem .75rem;}
    </style>

@include('layouts.wishlist-script')


@endsection