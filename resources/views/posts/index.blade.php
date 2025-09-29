@extends('frontend.template.master')
@php
use Illuminate\Support\Facades\Crypt;
@endphp

@section('content') 
    <section class="inner-section ad-list-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-lg-4 col-xl-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Price</h6>
                                <form class="product-widget-form" action="{{ route('products.index', ['category' => $category, 'subcategory' => $subcategory]) }}" method="GET">
                                    <div class="product-widget-group">
                                        <input type="text" name="min_price" placeholder="min - 00">
                                        <input type="text" name="max_price" placeholder="max - 1B">
                                    </div>
                                    <button type="submit" class="product-widget-btn"><i class="fas fa-search"></i><span>search</span></button>
                                    <button type="button" class="product-widget-btn reset-btn"><i class="fas fa-times"></i><span>reset</span></button>
                                </form>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by type</h6>
                                <form class="product-widget-form" action="{{ route('products.index', ['category' => $category, 'subcategory' => $subcategory]) }}" id="filterForm" method="GET">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="saleCheckbox" name="ad_category[]" value="Sale">
                                            </div>
                                            <label class="product-widget-label" for="saleCheckbox">
                                                <span class="product-widget-type sale">Sales</span>
                                                <span class="product-widget-number sale-count">({{ $productCountsArray['Sale'] ?? 0 }})</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="rentCheckbox" name="ad_category[]" value="Rent">
                                            </div>
                                            <label class="product-widget-label" for="rentCheckbox">
                                                <span class="product-widget-type rent">Rental</span>
                                                <span class="product-widget-number rent-count">({{ $productCountsArray['Rent'] ?? 0 }})</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="bookingCheckbox" name="ad_category[]" value="Booking">
                                            </div>
                                            <label class="product-widget-label" for="bookingCheckbox">
                                                <span class="product-widget-type booking">Booking</span>
                                                <span class="product-widget-number booking-count">({{ $productCountsArray['Booking'] ?? 0 }})</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn"><i class="fas fa-search"></i><span>Search</span></button>
                                    <button type="reset" class="product-widget-btn reset-filter-btn"><i class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by rating</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek4">
                                            </div><label class="product-widget-label" for="chcek4"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i></span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek5">
                                            </div><label class="product-widget-label" for="chcek5"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(55)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek6">
                                            </div><label class="product-widget-label" for="chcek6"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(65)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek7">
                                            </div><label class="product-widget-label" for="chcek7"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="far fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(75)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek8">
                                            </div><label class="product-widget-label" for="chcek8"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(85)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by cities</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="Search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek9">
                                            </div><label class="product-widget-label" for="chcek9"><span
                                                    class="product-widget-text">Los Angeles</span><span
                                                    class="product-widget-number">(95)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek10">
                                            </div><label class="product-widget-label" for="chcek10"><span
                                                    class="product-widget-text">San Francisco</span><span
                                                    class="product-widget-number">(82)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek11">
                                            </div><label class="product-widget-label" for="chcek11"><span
                                                    class="product-widget-text">California</span><span
                                                    class="product-widget-number">(1t)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek12">
                                            </div><label class="product-widget-label" for="chcek12"><span
                                                    class="product-widget-text">Manhattan</span><span
                                                    class="product-widget-number">(46)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek13">
                                            </div><label class="product-widget-label" for="chcek13"><span
                                                    class="product-widget-text">Baltimore</span><span
                                                    class="product-widget-number">(24)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek14">
                                            </div><label class="product-widget-label" for="chcek14"><span
                                                    class="product-widget-text">Avocados</span><span
                                                    class="product-widget-number">(34)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek15">
                                            </div><label class="product-widget-label" for="chcek15"><span
                                                    class="product-widget-text">new york</span><span
                                                    class="product-widget-number">(82)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek16">
                                            </div><label class="product-widget-label" for="chcek16"><span
                                                    class="product-widget-text">Houston</span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek17">
                                            </div><label class="product-widget-label" for="chcek17"><span
                                                    class="product-widget-text">Chicago</span><span
                                                    class="product-widget-number">(19)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by popularity</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="Search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek9">
                                            </div><label class="product-widget-label" for="chcek9"><span
                                                    class="product-widget-text">laptop</span><span
                                                    class="product-widget-number">(68)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek10">
                                            </div><label class="product-widget-label" for="chcek10"><span
                                                    class="product-widget-text">camera</span><span
                                                    class="product-widget-number">(78)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek11">
                                            </div><label class="product-widget-label" for="chcek11"><span
                                                    class="product-widget-text">television</span><span
                                                    class="product-widget-number">(34)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek12">
                                            </div><label class="product-widget-label" for="chcek12"><span
                                                    class="product-widget-text">by cycle</span><span
                                                    class="product-widget-number">(43)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek13">
                                            </div><label class="product-widget-label" for="chcek13"><span
                                                    class="product-widget-text">bike</span><span
                                                    class="product-widget-number">(57)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek14">
                                            </div><label class="product-widget-label" for="chcek14"><span
                                                    class="product-widget-text">private car</span><span
                                                    class="product-widget-number">(67)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek15">
                                            </div><label class="product-widget-label" for="chcek15"><span
                                                    class="product-widget-text">air condition</span><span
                                                    class="product-widget-number">(98)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek16">
                                            </div><label class="product-widget-label" for="chcek16"><span
                                                    class="product-widget-text">apartment</span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek17">
                                            </div><label class="product-widget-label" for="chcek17"><span
                                                    class="product-widget-text">watch</span><span
                                                    class="product-widget-number">(76)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">filter by category</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>electronics (234)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">mixer (56)</a></li>
                                                <li><a href="#">freez (78)</a></li>
                                                <li><a href="#">LED tv (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>automobiles (767)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">private car (56)</a></li>
                                                <li><a href="#">motorbike (78)</a></li>
                                                <li><a href="#">truck (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>properties (456)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">free land (56)</a></li>
                                                <li><a href="#">apartment (78)</a></li>
                                                <li><a href="#">shop (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>fashion (356)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>gadgets (768)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">computer (56)</a></li>
                                                <li><a href="#">mobile (78)</a></li>
                                                <li><a href="#">drone (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>furnitures (977)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">chair (56)</a></li>
                                                <li><a href="#">sofa (78)</a></li>
                                                <li><a href="#">table (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>hospitality (124)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>agriculture (565)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select class="custom-select filter-select" id="resultsPerPage">
                                        <option value="10" {{ config('constants.DEFAULT_PAGINATION') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ config('constants.DEFAULT_PAGINATION') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="30" {{ config('constants.DEFAULT_PAGINATION') == 30 ? 'selected' : '' }}>30</option>
                                        <option value="40" {{ config('constants.DEFAULT_PAGINATION') == 40 ? 'selected' : '' }}>40</option>
                                        <option value="50" {{ config('constants.DEFAULT_PAGINATION') == 50 ? 'selected' : '' }}>50</option>
                                    </select>
                                </div> 
                                    <div class="filter-short">
                                        <label class="filter-label">Short by :</label>
                                        <select class="custom-select filter-select" id="filterSelect" name="filter">
                                            <option value="default" {{ $filter == 'default' ? 'selected' : '' }}>Default</option>
                                            <option value="Trending" {{ $filter == 'Trending' ? 'selected' : '' }}>Trending</option>
                                            <option value="Featured" {{ $filter == 'Featured' ? 'selected' : '' }}>Featured</option>
                                            <option value="Recommended" {{ $filter == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                                        </select> 
                                    </div>  

                                <div class="filter-action"><a href="ad-list-column3.html" title="Three Column"><i
                                            class="fas fa-th"></i></a><a href="ad-list-column2.html"
                                        title="Two Column"><i class="fas fa-th-large"></i></a><a
                                        href="ad-list-column1.html" title="One Column"><i class="fas fa-th-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        @if (!empty($products)) 
                            @foreach ($products as $product) 
                             
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                    <div class="product-card">
                                        <div class="product-media">
                                            <div class="product-img recommend-product-img">
                                                @if($product->primaryImage)
                                                    <img loading="eager"  src="{{ asset('storage/'.$product->primaryImage->url) }}" alt="{{ $product->title }}">
                                                @else
                                                    <img loading="eager"  src="{{ asset('storage/no-image.jpg') }}" alt="{{ $product->title }}">
                                                @endif
                                            </div>
                                            <div class="product-type"><span class="flat-badge booking">{{ $product->ad_category }}</span></div>
                                            <ul class="product-action">
                                                <li class="view"><i class="fas fa-eye"></i><span>{{ $product->prview_count }}</span></li>
                                                <li class="click">{{ $product->clicks_count }}</li>
                                                <li class="rating"><i class="fas fa-star"></i><span>{{ $product->reviewCountForPost != null ? $product->reviewCountForPost : 'No reviews' }}</span></li>
                                            </ul>
                                        </div> 
                                        @php  
                                            $categoryData = json_decode($product->category);
                                            $subcategoryData = json_decode($product->subcategory);
                                        @endphp
                                        <div class="product-content">
                                            <ol class="breadcrumb product-category">
                                                <li><i class="fas fa-tags"></i></li>
                                                <li class="breadcrumb-item"><a href="{{ route('products.by_category',[$categoryData->slug])}}">{{ $categoryData->name }}</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    <a href="{{ route('products.index', [$categoryData->slug, $subcategoryData->slug]) }}">
                                                        {{ $subcategoryData->name }}
                                                    </a>
                                                </li>
                                                
                                            </ol>
                                            <h5 class="product-title"><a href="{{ route('product.show',[$product->item_url])}}">{{ strlen($post->title) > 80 ? substr($post->title, 0, 80) . '...' : $post->title }}
                                            </a></h5>
                                            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>{{ $product->location }}</span></div>
                                            <div class="product-info">
                                                <h5 class="product-price">{{ config('constants.CURRENCY_SYMBOL') }}{{ $product->price }}<span>/{{ $product->price_condition}}</span></h5>
                                                <div class="product-btn">
                                                    <button type="button" title="Wishlist" aria-label="{{ $product->isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}" class="fa-heart wishlistButton {{ $product->isInWishlist ? 'fas' : 'far' }}" data-ad-id="{{ Crypt::encryptString($product->id) }}">
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-pagection">
                                <p class="page-info">Showing {{ ($products->currentPage() - 1) * $products->perPage() + 1 }} to 
                                    {{ $products->currentPage() * $products->perPage() }} of  
                                    {{ $products->total() }} Results</p>
                                
                                <ul class="pagination">
                                    @if($products->currentPage() > 1)
                                        <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left"></i></a></li>
                                    @endif
                                    
                                    @for($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="page-item {{ ($products->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    
                                    @if($products->currentPage() < $products->lastPage()) 
                                        <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fas fa-long-arrow-alt-right"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <style>
        .recommend-product-img {height:200px;}
    .recommend-product-img img{height: 100% !important;
    object-fit: contain;}
</style>
<script>
   document.getElementById('filterSelect').addEventListener('change', function () { var selectedFilter = this.value; var url = '{{ route("products.index", ["category" => $category, "subcategory" => $subcategory]) }}'; if (selectedFilter !== 'default') { url += '?filter=' + selectedFilter; } window.location.href = url; }); $(document).ready(function () { $('#resultsPerPage').on('change', function () { var resultsPerPage = $(this).val(); var currentUrl = window.location.href; var updatedUrl = updateQueryStringParameter(currentUrl, 'per_page', resultsPerPage); window.location.href = updatedUrl; }); $('#postFilter').on('change', function () { var filterValue = $(this).find(':selected').data('filter'); var currentUrl = window.location.href; var updatedUrl = updateQueryStringParameter(currentUrl, 'filter', filterValue); window.location.href = updatedUrl; }); function updateQueryStringParameter(url, key, value) { var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i"); var separator = url.indexOf('?') !== -1 ? "&" : "?"; if (url.match(re)) { return url.replace(re, '$1' + key + "=" + value + '$2'); } else { return url + separator + key + "=" + value; } } $('.reset-btn').click(function () { $('input[name="min_price"]').val(''); $('input[name="max_price"]').val(''); window.location.href = "{{ route('products.index', ['category' => $category, 'subcategory' => $subcategory]) }}"; }); var urlSearchParams = new URLSearchParams(window.location.search); var perPageParam = urlSearchParams.get('per_page'); if (perPageParam) { $('#resultsPerPage').val(perPageParam); } var urlParams = new URLSearchParams(window.location.search); var filterValues = urlParams.getAll('ad_category[]'); filterValues.forEach(function (value) { $('#check-' + value).prop('checked', true); }); $('.reset-filter-btn').on('click', function () { $('#filterForm')[0].reset(); var currentUrl = window.location.href; var updatedUrl = removeUrlParameter(currentUrl, 'ad_category'); window.location.href = updatedUrl; }); function removeUrlParameter(url, parameter) { var urlParts = url.split('?'); if (urlParts.length >= 2) { var prefix = encodeURIComponent(parameter) + '='; var queryParams = urlParts[1].split(/[&;]/g); for (var i = queryParams.length - 1; i >= 0; i--) { if (queryParams[i].lastIndexOf(prefix, 0) !== -1) { queryParams.splice(i, 1); } } return urlParts[0] + (queryParams.length > 0 ? '?' + queryParams.join('&') : ''); } return url; } $('.wishlistButton').click(function () { const adId = $(this).data('ad-id'); let isInWishlist = $(this).hasClass('fas'); const actionUrl = isInWishlist ? '/wishlist/add' : '/wishlist/remove'; const ajaxMethod = isInWishlist ? 'POST' : 'DELETE'; $.ajax({ url: actionUrl, type: ajaxMethod, data: { _token: $('meta[name="csrf-token"]').attr('content'), ad_id: adId, }, success: function (response) { if (isInWishlist) { $(this).removeClass('far').addClass('fas'); } else { $(this).removeClass('fas').addClass('far'); } isInWishlist = !isInWishlist; displayToastr(response.message, 'success'); }.bind(this), error: function (xhr) { if (xhr.status === 401) { localStorage.setItem('wishlistProductId', adId); window.location.href = `/login?redirect=${encodeURIComponent(window.location.href)}`; } else { let errorMsg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "An error occurred"; displayToastr(errorMsg, 'error'); } } }); }); function displayToastr(message, type = 'success') { toastr[type](message); } });


</script>
@endsection
