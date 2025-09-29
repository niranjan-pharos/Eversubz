@php
$userId = Auth::id();
$productOwnerId = $product->user_id;
$isOwner = !is_null($userId) && !is_null($productOwnerId) && $userId === $productOwnerId;
@endphp

<div class="product-card"> 
    <div class="product-media">
        <div class="product-img recommend-product-img">
            @php
                $viewUrl = !empty($product->item_url) ? route('BusinessProduct.view', ['item_url' => $product->item_url]) : '#';
            @endphp
            <a href="{{ $viewUrl }}" {{ empty($product->item_url) ? 'onclick="return false;"' : '' }}>
                <img class="lazy-load" loading="lazy"
                    data-src="{{ asset('storage/' . ($product->main_image ?? 'default-image.jpg')) }}"
                    alt="{{ $product->title ?? 'Product Image' }}">
            </a>
        </div>
        
        <ul class="product-action">
            <li class="view"><i class="fas fa-eye"></i><span>{{$product->prview_count}}</span></li>
            <li class="click"><i class="fas fa-mouse"></i><span>{{$product->clicks_count}}</span></li>
            <li class="rating">
                <i class="fas fa-star"></i>
                @if($product->reviews->isNotEmpty())
                <span>{{ round($product->reviews->first()->rating) }}/{{ config('constants.MAX_RATING')
                    }}</span>
                @else
                <span>No Ratings/{{ config('constants.MAX_RATING') }}</span>
                @endif
            </li>
        </ul>
    </div>

    <div class="product-content">
        <div class="product-content1">
            <div class="product-content2">
                <ol class="breadcrumb product-category">

                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('products.by_subcategory', [$product->category->slug, $product->subcategory->slug]) }}">{{
                            $product->subcategory->name }}</a>
                    </li>
                </ol>

            </div>
            <div class="product-content3">


                <div class="product-meta">

                    <h5 class="product-price">
                        {{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}<span>/{{ $product->mrp }}</span>
                    </h5>
                </div>
            </div>
        </div>

       
        <h5 class="product-title"><a href="{{ $viewUrl }}">{{ strlen($product->title) > 40 ?
                substr($product->title, 0, 40) . '...' : $product->title }}</a>
        </h5>
        @php
            $availableQty = (int) $product->max_qty - (int) $product->sold_qty;

            
        @endphp

        @if(($availableQty ?? 0) > 0 && ($product->price ?? 0) > 0)
            <a href="#" class="d-flex product-listing-button number add-to-cart-button mt-3"
            data-product-slug="{{ $product->slug }}">
                <p><span>Add To Cart</span></p>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
        @else
            <span class="out-of-stock btn btn-danger btn-sm border rounded-2 py-1">
                <a href="#" class="contact-seller" style="color: #fff;" data-product-slug="{{ $product->slug }}" data-business-phone="{{ $product->businessInfo->contact_phone }}">Contact Seller</a>
                <i class="fa fa-phone" aria-hidden="true" style="margin-left: 9px;"></i>
            </span>
        @endif

        <div class="product-info  product-button12">
            @if(!empty($userId))
            <div class="product-status">
                @if($isOwner)
                <span class="badge {{ $product->status == 1 ? 'badge-success' : 'badge-danger' }}">
                    {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                </span>
                @else
                @if($product->status == 1)
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-danger">Inactive</span>
                @endif
                @endif
            </div>
            @endif

            <div class="product-btn">
                @if(empty($userId))
                <button type="button"
                    title="{{ $product->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                    aria-label="{{ $product->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                    class="wishlistButton {{ $product->isInWishlist() ? 'fas' : 'far' }} button bg-primary text-white flex-1 wishlist-button-home-page"
                    data-wishable-id="{{ Crypt::encryptString($product->id) }}"
                    data-wishable-type="App\Models\BusinessProduct">
                    <i class="{{ $product->isInWishlist() ? 'fas' : 'far' }} fa-heart"></i>
                </button>
                @endif
                @auth

                @php
                $editUrl = !empty($product->item_url) ? route('business-products.edit', ['item_url' => $product->item_url]) : '#';
                $deleteUrl = !empty($product->item_url) ? route('business-products.destroy', ['item_url' => $product->item_url]) : '#';
                @endphp

                <button type="button" title="Edit" aria-label="Edit" class="fa fa-edit editButton"
                    onclick="window.location.href='{{ $editUrl }}'"></button>
                    
                @if (!empty($product->item_url))
                <form action="{{ $deleteUrl }}" method="POST" class="deleteForm" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete" aria-label="Delete" class="fa fa-trash btn-sm deleteButton"></button>
                </form>
                @else
                    <button type="button" class="btn btn-danger btn-sm" disabled title="Delete Product (Disabled: Missing URL)">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                @endif

                <button type="button" title="Details" aria-label="Details" class="fa fa-info-circle detailsButton"
                    onclick="window.location.href='{{ $viewUrl }}'"></button>
                @endauth

                @guest
                <button type="button" title="Details" aria-label="Details" class="fa fa-info-circle detailsButton"
                    onclick="window.location.href='{{ $viewUrl }}'"></button>
                @endguest
            </div>
        </div>
    </div>
</div>
