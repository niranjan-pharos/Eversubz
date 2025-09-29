<div class="dropdown-search-results p-2 border rounded">
    {{-- Ad Posts --}}
    @if($posts->isNotEmpty())
    <div class="suggestion-group">
        <strong>Ad Posts</strong>
        @foreach($posts as $post)
        <div class="suggestion-item d-flex align-items-center">
            <img src="{{ asset('storage/' . optional($post->primaryImage)->url ?? 'no-image.jpg') }}" width="40"
                height="40" class="me-2 rounded" alt="{{ $post->title }}">
            <div class="suggestion-items1">
                <div> <a href="{{ route('product.show', [$post->item_url]) }}">
                        {{ Str::limit($post->title, 40) }}
                    </a><br>
                    <small class="text-muted">
                        {{ optional($post->category)->name ?? 'No Category' }}

                    </small>
                </div>
                <div>
                    <small class="text-muted">
                        <b> {{ config('constants.CURRENCY_SYMBOL') }}{{ $post->price }}</b>
                    </small>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Products --}}
    @if($products->isNotEmpty())
    <div class="suggestion-group">
        <strong>Products</strong>
        @foreach($products as $product)
        @php $img = $product->main_image ? 'storage/' . $product->main_image : 'storage/no-image.jpg'; @endphp
        <div class="suggestion-item d-flex align-items-center">
            <img src="{{ asset($img) }}" width="40" height="40" class="me-2 rounded" alt="{{ $product->title }}">
            <div class="suggestion-items1">
                <div>

                    <a href="{{ route('BusinessProduct.view', [$product->item_url]) }}">
                        {{ Str::limit($product->title, 40) }}
                    </a><br>
                    <small class="text-muted">
                        {{ $product->category->name ?? 'No Category' }}
                    </small>
                </div>
                <div>
                    <small class="text-muted">
                        <b> {{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}</b>
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Businesses --}}
    @if($businesses->isNotEmpty())
    <div class="suggestion-group">
        <strong>Businesses</strong>
        @foreach($businesses as $business)
        @php $img = $business->logo_path ? 'storage/' . $business->logo_path : 'storage/no-image.jpg'; @endphp
        <div class="suggestion-item d-flex align-items-center">
            <img src="{{ asset($img) }}" width="40" height="40" class="me-2 rounded"
                alt="{{ $business->business_name }}">
            <div>
                <a href="{{ route('business.view', $business->slug ?? $business->id) }}">
                    {{ Str::limit($business->business_name, 40) }}
                </a><br>
                <small class="text-muted">
                    {{ $business->category->name ?? 'No Category' }}
                </small>
            </div>
        </div>
        @endforeach
    </div>
    @endif


    @if($posts->isEmpty() && $products->isEmpty() && $businesses->isEmpty())
    <div class="text-muted px-3 py-2">No results found</div>
    @endif

</div>

<style>
/* Wrapper to position suggestion box relative to input */
.header-search {
    position: relative;
}

.suggestion-items1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.suggestion-items1 small {
    color: #000 !important;
    font-size: 14px;
}

/* Suggestion box styling */
#searchSuggestionBox {
    position: absolute;
    top: 100%;
    /* directly below input field */
    left: 0;
    right: 0;
    z-index: 1000;
    background: #fff;
    border: 1px solid #ccc;
    border-top: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    display: none;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px 0;
    font-size: 14px;
}

/* Individual suggestion item */
.suggestion-item {
    padding: 8px 15px;
    cursor: pointer;
    transition: background 0.2s;

    display: flex;
    align-items: center;
    padding: 8px 15px;
    gap: 10px;
}

.suggestion-item img {
    object-fit: cover;
    border-radius: 5px;
}

.suggestion-item:hover {
    background: #f3f3f3;
}

/* Optional: Group headers like "Posts", "Products" */
.suggestion-group {
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
    margin-bottom: 5px;
}

.suggestion-group strong {
    display: block;
    padding: 5px 15px;
    color: #333;
    font-weight: 600;
}

.suggestion-item a {
    color: #007bff;
    font-weight: 700;
    font-size: 16px !important;
    text-transform: capitalize;
}
</style>