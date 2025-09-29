
    <div class="product-card">
        <div class="product-media">
            <a href="{{ route('business.show', ['slug'=>$post->slug]) }}">
            <div class="product-img">
                    <img  loading="eager"  
                    src="{{ $post->logo_path ? asset('storage/' . $post->logo_path) : asset('storage/no-image.png') }}"
                    alt="{{ $post->business_name }}">
                </div>
            </a>
        </div>
        <div class="product-content">
            <ol class="breadcrumb product-category">
                <li class="breadcrumb-item">{{ $post->businessCategory->name ?? 'Uncategorized' }}</li>
            </ol>
            <h5 class="product-title"><a href="{{ route('business.show', $post->slug) }}">{{ $post->business_name }}</a></h5>
            
            <div class="product-meta"><span> {{ $post->business_city." ," }} {{ $post->business_state }}</span></div>
        </div>
    </div>
