<div class="product-card">
    <div class="product-media">
        <div class="product-img recommend-product-img">
            <img loading="eager"
                src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('storage/no-image.jpg') }}"
                alt="{{ $product->title }}">
        </div>

        <div class="product-type"><span
                class="flat-badge {{strtolower($product->category->name)}}">{{$product->category->name}}</span></div>
        <div class="product-type"><span
                class="flat-badge {{strtolower($product->subcategory->name)}}">{{$product->subcategory->name}}</span>
        </div>

    </div>
    <div class="product-content">
        <ol class="breadcrumb product-category">
            <li><i class="fas fa-tags"></i></li>
            <li class="breadcrumb-item"><a
                    href="{{route('products.by_category',[$product->category->slug])}}">{{ $product->category->name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{route('products.by_subcategory',[$product->category->slug,$product->subcategory->slug])}}">{{ $product->subcategory->name }}</a>
            </li>
        </ol>
        <h5 class="product-title"><a
                href="{{ route('product.show',[$product->item_url]) }}">{{ strlen($product->title) > 80 ? substr($product->title, 0, 80) . '...' : $product->title }}
            </a></h5>
        <div class="product-meta">
            @php
            $created_at = $product->created_at;
            @endphp
            <span><i class="fas fa-clock"></i>{{ date('Y-m-d', strtotime($created_at)) }}</span>
        </div>
        <div class="product-info">
            <h5 class="product-price">
                {{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price}}<span>/{{ $product->price }}</span></h5>
            <div class="product-btn">
                <button type="button" title="Wishlist"
                    aria-label="{{ $product->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
                    class="fa-heart wishlistButton {{ $product->isInWishlist ? 'fas' : 'far' }}"
                    data-ad-id="{{ Crypt::encryptString($product->id) }}"></button>
            </div>
        </div>
    </div>
</div>