<div class="col-lg-4 col-xl-3">
    <div class="row"> 
        <div class="col-md-6 col-lg-12 filters-column-ads">
            <div class="product-widget desktop">
                    <div class="col-lg-12 text-center">
                        <a href="{{ route('ad-post.create') }}" class="btn btn-new-one">Add Your Product</a>
                    </div>
                <h6 class="product-widget-title">Filter by Price</h6>
                <form class="product-widget-form" action="{{ route('product.filter') }}" method="GET">
                    <div class="product-widget-group">
                        <input class="filters-input" type="text" placeholder="min - price" name="min_price"
                            value="{{ request()->get('min_price') }}">
                        <input class="filters-input" type="text" placeholder="max - price" name="max_price"
                            value="{{ request()->get('max_price') }}">
                    </div>
                    <div class="filter-button1">
                        <a href="{{route('product.filter') }}" class="product-widget-btn">
                            <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                        </a>
                        <button type="submit" class="product-widget-btn"><i
                                class="fas fa-search"></i><span>search</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="product-widget desktop">
                <h6 class="product-widget-title">Filter by Rating</h6>
                <form class="product-widget-form" action="{{ route('product.filter')}}" method="GET">

                    <x-ratings :selectedRatings="$selectedRatings" :ratingsCount="$ratingsCount" />

                    <div class="filter-button1 mt-5">
                        <a href="{{ route('product.filter')}}" class="product-widget-btn">
                            <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                        </a>
                        <button type="submit" class="product-widget-btn"><i
                                class="fas fa-search"></i><span>search</span></button>
                    </div>
                </form>
            </div>

            <div class="product-widget mobile">
                <div class="col-lg-12 text-center">
                           <a href="#" class="btn btn-new-one">Add Your Product</a>
                         </div>
                <h6 class="product-widget-title">
                    <a data-toggle="collapse" href="#filetrmain" role="button" aria-expanded="false"
                        aria-controls="filetrmain">
                      Main Filters
                      <i class="fas fa-chevron-down"></i>
                    </a>
                </h6>
                <div class="collapse" id="filetrmain">
                    <br>
                    <h6 class="product-widget-title">Filter by Price</h6>
                    <form class="product-widget-form" action="{{ route('product.filter') }}" method="GET">
                        <div class="product-widget-group">
                            <input class="filters-input" type="text" placeholder="min - price" name="min_price"
                                value="{{ request()->get('min_price') }}">
                            <input class="filters-input" type="text" placeholder="max - price" name="max_price"
                                value="{{ request()->get('max_price') }}">
                        </div>
                        <div class="filters-input filter-button1">
                            <a href="{{route('product.filter') }}" class="product-widget-btn">
                                <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                            </a>
                            <button type="submit" class="product-widget-btn"><i
                                    class="fas fa-search"></i><span>search</span>
                            </button>
                        </div>
                    </form>
                    <br>
                    <h6 class="product-widget-title">Filter by Rating</h6>
                    <form class="product-widget-form" action="{{ route('product.filter')}}" method="GET">

                        <x-ratings :selectedRatings="$selectedRatings" :ratingsCount="$ratingsCount" />

                        <div class="filter-button1 mt-5">
                            <a href="{{ route('product.filter')}}" class="product-widget-btn">
                                <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                            </a>
                            <button type="submit" class="product-widget-btn"><i
                                    class="fas fa-search"></i><span>search</span></button>
                        </div>
                    </form>
                </div>
            </div>


            <x-business-subcategory-filter :subcategories="$subcategories" action="{{ route('product.filter') }}" />


            <x-business-city-filter :topCities="$topCities" action="{{ route('product.filter') }}" />

            <x-business-state-city-filter :statesWithCities="$statesWithCities"
                action="{{ route('product.filter') }}" />
        </div>




    </div>
</div>

