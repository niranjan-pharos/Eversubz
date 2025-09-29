
<div {{ $attributes->merge(['class' => 'product-card']) }}>
    <div class="product-media">
        <div class="product-img recommend-product-img">
            <img src="{{ $post->primaryImage ? asset('storage/' . $post->primaryImage) : asset('storage/no-image.jpg') }}" alt="{{ $post->title }}">
        </div>
      @if($post->is_expired)
        <div class="product-type product-type1"><span class="flat-badge expired">Expired</span></div>
      @endif

      @if(!empty($post->recommended))
        <div class="cross-vertical-badge product-badge">
          <i class="fas fa-clipboard-check"></i><span>recommend</span>
        </div>
      @endif
      <div class="product-type"><span class="flat-badge {{strtolower($post->ad_category)}}">{{$post->ad_category}}</span></div>
      <ul class="product-action">
        <li class="view"><i class="fas fa-eye"></i><span>{{$post->prview_count}}</span></li>
        <li class="click"><i class="fas fa-mouse"></i><span>{{$post->clicks_count}}</span></li>
        <li class="rating"><i class="fas fa-star"></i><span>{{round($post->average_rating)}}/{{
            config('constants.MAX_RATING') }}</span></li>
      </ul>
    </div> 
    <div class="product-content">
      <ol class="breadcrumb product-category">
        <li><i class="fas fa-tags"></i></li> 
        <li class="breadcrumb-item"><a href="{{route('products.by_category',[$post->category->slug])}}">{{ $post->category->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('products.by_subcategory',[$post->category->slug,$post->subcategory->slug])}}">{{ $post->subcategory->name }}</a></li>
      </ol>
      <h5 class="product-title"><a href="{{ route('product.show',[$post->item_url]) }}">{{ strlen($post->title) > 50 ? substr($post->title, 0, 50) . '...' : $post->title }}
      </a></h5>
      <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>{{ $post->location }}{{$post->isInWishlist}}</span>
      </div>
      <div class="product-meta">
        @php
          $created_at = $post->created_at;
        @endphp
        <span><i class="fas fa-clock"></i>{{ date('Y-m-d', strtotime($created_at)) }}</span>
      </div>
      <div class="product-info"> 
        <h5 class="product-price">{{ config('constants.CURRENCY_SYMBOL') }}{{ $post->price}}<span>/{{ $post->price_condition }}</span></h5>
        <div class="product-btn">
          <button type="button" title="Wishlist"
            aria-label="{{ $post->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}"
            class="fa-heart wishlistButton {{ $post->isInWishlist ? 'fas' : 'far' }}"
            data-ad-id="{{ Crypt::encryptString($post->id) }}"></button>
        </div>
      </div>
    </div>
  </div>


 