<div {{ $attributes->merge(['class' => 'product-card']) }}>
    @php
    $imagePath = null;

    if ($post instanceof \App\Models\AdPost && $post->primaryImage) {
        $directory = dirname($post->primaryImage->url);
        $filename = basename($post->primaryImage->url);
        $imagePath = $directory . '/' . $filename;
    } elseif ($post instanceof \App\Models\BusinessProduct && $post->main_image) {
        $directory = dirname($post->main_image);
        $filename = basename($post->main_image);
        $imagePath = $directory . '/thumb/' . $filename;
    }

    $imageSrc = $imagePath ? asset('storage/' . $imagePath) : asset('storage/no-image.jpg');
@endphp
<div class="product-media">
    @if($post->status == 1)
        <span class="badge badge-success">Active</span>
    @else
        <span class="badge badge-danger">Inactive</span>
    @endif
    <div class="product-img recommend-product-img">
        @if($post instanceof \App\Models\AdPost)
            <a
                href="{{ route('product.show', [$post->item_url]) }}"><img class="lazy-load" loading="lazy" src="{{ $imageSrc }}"
                 data-src="{{ $imageSrc }}" alt="{{ $post->title }}"></a>
        @elseif($post instanceof \App\Models\BusinessProduct)
        <a
            href="{{ route('BusinessProduct.view', [$post->item_url]) }}"><img class="lazy-load" loading="lazy" src="{{ $imageSrc }}"
                data-src="{{ $imageSrc }}" alt="{{ $post->title }}"></a>
        @endif
    </div>


        @if($post instanceof \App\Models\AdPost)
        {{-- @if($post->is_expired)
        <div class="product-type product-type1"><span class="flat-badge expired">Expired</span></div>
        @endif --}}


        @if(!empty($post->recommended))
        <div class="cross-vertical-badge product-badge" style="left: 50px;">
            <i class="fas fa-clipboard-check"></i><span>recommend</span>
        </div>
        @endif
        <div class="product-type"><span
                class="flat-badge {{strtolower($post->ad_category)}}">{{$post->ad_category}}</span></div>
        <ul class="product-action">
            <li class="view"><i class="fas fa-eye"></i><span>{{$post->prview_count}}</span></li>
            <!-- <li class="click"><i class="fas fa-mouse"></i><span>{{$post->clicks_count}}</span></li> -->
            <li class="rating">
                <i class="fas fa-star"></i>
                @if($post->reviews->isNotEmpty())
                <span>{{ round($post->reviews->first()->average_rating) }}/{{ config('constants.MAX_RATING') }}</span>
                @else
                <span>No Ratings/{{ config('constants.MAX_RATING') }}</span>
                @endif
            </li>
        </ul>
        @endif
    </div>
    <div class="product-content">
        <div class="product-content1">
            <div class="product-content2 ">

                @if($post instanceof \App\Models\AdPost)
                <ol class="breadcrumb product-category ">

                    <li class="breadcrumb-item  active" aria-current="page"><a
                            href="{{ route('products.by_subcategory', [$post->category->slug, $post->subcategory->slug]) }}">{{ $post->subcategory->name }}</a>
                    </li>
                </ol>
                @elseif($post instanceof \App\Models\BusinessProduct)
                <ol class="breadcrumb product-category ">

                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('products.by_subcategory', [$post->category->slug, $post->subcategory->slug]) }}">{{ $post->subcategory->name }}</a>
                    </li>
                </ol>
                @endif



            </div>


            <div class="product-content3">
                <div class="product-meta">
                    <h5 class="product-price">
                        {{ config('constants.CURRENCY_SYMBOL') }}{{ $post->price }}<span>/
                            {{ $post->price_condition }}</span>
                    </h5>
                </div>
            </div>
        </div>
        <h5 class="product-title desktop">
            @if($post instanceof \App\Models\AdPost)
            <a
                href="{{ route('product.show', [$post->item_url]) }}">{{ strlen($post->title) > 35 ? substr($post->title, 0, 35) . '...' : $post->title }}</a>
            @elseif($post instanceof \App\Models\BusinessProduct)
            <a
                href="{{ route('BusinessProduct.view', [$post->item_url]) }}">{{ strlen($post->title) >35 ? substr($post->title, 0,35) . '...' : $post->title }}</a>
            @endif
        </h5>
        <h5 class="product-title mobile">
            @if($post instanceof \App\Models\AdPost)
            <a
                href="{{ route('product.show', [$post->item_url]) }}">{{ strlen($post->title) > 20 ? substr($post->title, 0, 15) . '...' : $post->title }}</a>
            @elseif($post instanceof \App\Models\BusinessProduct)
            <a
                href="{{ route('BusinessProduct.view', [$post->item_url]) }}">{{ strlen($post->title) >15 ? substr($post->title, 0,15) . '...' : $post->title }}</a>
            @endif
        </h5>
        @if($post instanceof \App\Models\AdPost && (!empty($post->city) || !empty($post->state)))
        <div class="product-meta product-meta2">
            <span>
                @if(!empty($post->city) && !empty($post->state))
                {{ $post->city . ", " . $post->state }}
                @elseif(!empty($post->city))
                {{ $post->city }}
                @elseif(!empty($post->state))
                {{ $post->state }}
                @endif
            </span>
        </div>
        @endif

        <!-- <div class="product-meta product-meta2">
            @if(($post->price ?? 0) > 0)
                <a href="#" class="d-flex product-listing-button number add-to-cart-button mt-3"
                    data-product-slug="{{ $post->category->slug }}">
                        <p><span>Add To Cart </span></p>
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="color: #fff;"></i>
                    </a>
            @else
                <span class="out-of-stock btn btn-danger btn-sm border rounded-2 py-1">
                    <a href="#" class="contact-seller" style="color: #fff;" data-product-slug="{{ $post->category->slug }}">Contact Seller</a>
                    <i class="fa fa-phone" aria-hidden="true" style="margin-left: 9px; color: #fff;"></i>
                </span>
            @endif
        </div>
 -->
        <div class="product-info product-button12 ">

            @php
            $editUrl = null;

            if (!empty($post->item_url)) {
            $parts = explode('/', $post->item_url);

            if (count($parts) === 3 && $parts[0] && $parts[1] && $parts[2]) {
            // All 3 parts exist
            try {
            $editUrl = route('posts.edit', [
            'category' => $parts[0],
            'slug' => $parts[1],
            'datetime' => $parts[2]
            ]);
            } catch (\Exception $e) {
            $editUrl = null;
            }
            }
            }
            @endphp







            <div class="product-btn">
                @if($post instanceof \App\Models\AdPost)
                <button type="button" title="Wishlist"
                    aria-label="{{ $post->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                    class="fa-heart wishlistButton {{ $post->isInWishlist() ? 'fas' : 'far' }}"
                    data-wishable-id="{{ Crypt::encryptString($post->id) }}" data-wishable-type="App\Models\AdPost">
                </button>
                @elseif($post instanceof \App\Models\BusinessProduct)
                <button type="button" title="Wishlist"
                    aria-label="{{ $post->isInWishlist() ? 'Remove from wishlist' : 'Add to wishlist' }}"
                    class="fa-heart wishlistButton {{ $post->isInWishlist() ? 'fas' : 'far' }}"
                    data-wishable-id="{{ Crypt::encryptString($post->id) }}"
                    data-wishable-type="App\Models\BusinessProduct">
                </button>
                @endif


               
                @auth
                @if(Auth::id() === $post->user_id)
                <a class="events-links"
                    href="{{ route('enquiries.adspost', ['post_slug' => $post->item_url]) }}">Enquiries</a>
                @if($editUrl)
                <button type="button" title="Edit" aria-label="Edit" class="fa fa-edit editButton"
                    onclick="window.location.href='{{ $editUrl }}'">
                </button>
                @endif




                <!-- <button type="button" title="Delete" aria-label="Delete" class="fa fa-trash vishal deleteButton" data-item-url="{{ $post->item_url }}"></button> -->

                <form action="{{ route('posts.destroy', ['item_url' => $post->item_url]) }}" method="POST"
                    class="deleteForm" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete" aria-label="Delete" class="fa fa-trash deleteButton"></button>
                </form>
                <button type="button" title="Details" aria-label="Details" class="fa fa-info-circle detailsButton"
                    onclick="window.location.href='{{ route('product.show', [$post->item_url]) }}'"></button>

                @endif
                @endauth
            </div>


        </div>
    </div>

</div>