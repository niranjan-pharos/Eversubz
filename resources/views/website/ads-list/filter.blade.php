<div class="col-lg-4 col-xl-3">
    <div class="row">
        <div class="col-md-6 col-lg-12 filters-column-ads">
            <div class="product-widget desktop">
                 <div class="col-lg-12 text-center"> 
                    <a href="{{ route('ad-post.create') }}" class="btn btn-new-one">Add Your Post</a>
                         </div>
                <h6 class="product-widget-title">Filter by Price</h6>
                <form class="product-widget-form" action="{{ route('adsList') }}" method="GET">
                    <div class="product-widget-group">
                        <input class="filters-input" type="text" placeholder="min - price" name="search_min_price"
                            value="{{ request()->get('search_min_price') }}">
                        <input class="filters-input" type="text" placeholder="max - price" name="search_max_price"
                            value="{{ request()->get('search_max_price') }}">
                    </div>
                    <h6 class="product-widget-title mt-5">Filter by Type</h6>
                    <ul class="product-widget-list">
                        @foreach($ad_categories as $category)
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="check_{{ $loop->index }}" name="ad_category[]"
                                    value="{{ $category->ad_category }}" {{ is_array($adCategory) &&
                                    in_array($category->ad_category, $adCategory) ? 'checked' : '' }}>

                            </div>
                            <label class="product-widget-label" for="check_{{ $loop->index }}">
                                <span class="product-widget-type {{ strtolower($category->ad_category) }}">{{
                                    $category->ad_category }}</span>
                                <span class="product-widget-number">({{ $category->total }})</span>
                            </label>
                        </li>
                        @endforeach

                    </ul>


                    <div class="filter-button1 mt-5">
                        <a href="{{ route('adsList') }}" class="product-widget-btn">
                            <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                        </a>
                        <button type="submit" class="product-widget-btn"><i
                                class="fas fa-search"></i><span>search</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="product-widget mobile">
                 <div class="col-lg-12 text-center">
                           <a href="#" class="btn btn-new-one">Add Post</a>
                         </div>
                <h6 class="product-widget-title">
                    <a data-toggle="collapse" href="#filetrmain" role="button" aria-expanded="false"
                        aria-controls="filetrmain">
                       PRICE & TYPE FILTERS
                       <i class="fas fa-chevron-down"></i>
                    </a>
                </h6>
                <div class="collapse" id="filetrmain">
                    <h6 class="product-widget-title mt-3">Filter by Price</h6>
                    <form class="product-widget-form" action="{{ route('adsList') }}" method="GET">
                        <div class="product-widget-group">
                            <input class="filters-input" type="text" placeholder="min - price" name="search_min_price"
                                value="{{ request()->get('search_min_price') }}">
                            <input class="filters-input" type="text" placeholder="max - price" name="search_max_price"
                                value="{{ request()->get('search_max_price') }}">
                        </div>
                        <h6 class="product-widget-title mt-5">Filter by Type</h6>
                        <ul class="product-widget-list">
                            @foreach($ad_categories as $category)
                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" id="check_{{ $loop->index }}" name="ad_category[]"
                                        value="{{ $category->ad_category }}" {{ is_array($adCategory) &&
                                        in_array($category->ad_category, $adCategory) ? 'checked' : '' }}>
                                </div>
                                <label class="product-widget-label" for="check_{{ $loop->index }}">
                                    <span class="product-widget-type {{ strtolower($category->ad_category) }}">{{
                                        $category->ad_category }}</span>
                                    <span class="product-widget-number">({{ $category->total }})</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>

                        <div class="filter-button1 mt-5">
                            <a href="{{ route('adsList') }}" class="product-widget-btn">
                                <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                            </a>
                            <button type="submit" class="product-widget-btn"><i
                                    class="fas fa-search"></i><span>search</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>


            <x-post-city-filter :topCities="$topCities" action="{{ route('adsList') }}" />
            <x-post-state-city-filter :statesWithCities="$statesWithCities" action="{{ route('adsList') }}" />

            <div class="product-widget">
                <h6 class="product-widget-title">
                    <a data-toggle="collapse" href="#filterPopularity" role="button" aria-expanded="false"
                        aria-controls="filterPopularity">
                        Filter by popularity
                        <i class="fas fa-chevron-down"></i> 
                    </a>
                </h6>
                <div class="collapse" id="filterPopularity">
                    <form class="product-widget-form" method="GET" action="{{ route('adsList') }}">
                        <ul class="product-widget-list product-widget-scroll">
                            @if(!empty($topSubcategories))
                            @foreach ($topSubcategories as $subcategory)

                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" id="check{{ $subcategory->name }}" name="popularity[]"
                                        value="{{ $subcategory->slug }}" {{
                                        in_array($subcategory->slug, request('popularity', [])) ? 'checked' : '' }}>
                                </div>
                                <label class="product-widget-label" for="check{{ $subcategory->name }}">
                                    <span class="product-widget-text">{{ $subcategory->name }}</span>
                                    <span class="product-widget-number">({{ $subcategory->ad_posts_count }})</span>
                                </label>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <div class="filter-button1">
                            <a href="{{ route('adsList') }}" class="product-widget-btn">
                                <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                            </a>
                            <button type="submit" class="product-widget-btn">
                                <i class="fas fa-search"></i><span>search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>




            <div class="product-widget">
                <h6 class="product-widget-title">
                    <a data-toggle="collapse" href="#filterCategory" role="button" aria-expanded="false"
                        aria-controls="filterCategory">
                      Filter by category
                      <i class="fas fa-chevron-down"></i> 
                    </a>
                </h6>
                <div class="collapse" id="filterCategory">
                    <form class="product-widget-form" method="GET" action="{{ route('adsList') }}">
                        <div class="product-widget-search">
                            <input type="text" name="search_category" placeholder="Search"
                                value="{{ request('search_category') }}">
                        </div>
                        <ul class="product-widget-list product-widget-scroll">
                            @if(!empty($categories))
                            @foreach ($categories as $category)
                            <li class="product-widget-dropitem">
                                <button type="button" class="accordion-toggle-category" aria-expanded="false"
                                    aria-controls="category-{{ $category->id }}">
                                    {{ $category->name }} ({{
                                            $category->subcategories->pluck('adPosts')->flatten()->count() }})
                                    <i class="fas fa-chevron-down toggle-icon-category"></i>
                                </button>
                                <ul class="accordion-content-category product-widget-dropdown"
                                    id="category-{{ $category->id }}" style="display: none;">
                                    @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <input type="checkbox" id="subcat{{ $subcategory->id }}" name="subcategories[]"
                                            value="{{ $subcategory->slug }}"
                                            {{ in_array($subcategory->slug, request('subcategories', [])) ? 'checked' : '' }}>
                                        <label for="subcat{{ $subcategory->id }}">{{ $subcategory->name }} ({{
                                               $subcategory->adPosts->count() }})</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <div class="filter-button1">
                            <a href="{{ route('adsList') }}" class="product-widget-btn">
                                <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                            </a>
                            <button type="submit" class="product-widget-btn"><i
                                    class="fas fa-search"></i><span>Search</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>