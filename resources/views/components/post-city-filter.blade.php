<div class="product-widget">
    <h6 class="product-widget-title">
        <a data-toggle="collapse" href="#filterCities" role="button" aria-expanded="false" aria-controls="filterCities">
             Filter by Cities
             <i class="fas fa-chevron-down"></i>
        </a>
    </h6> 
    <div class="collapse" id="filterCities">
        <form class="product-widget-form" action="{{ $action }}" method="GET">
            <div class="product-widget-search">
                <input type="text" placeholder="Search">
            </div>
            <!-- Example snippet for city checkboxes -->
            <ul class="product-widget-list">
                @foreach($topCities as $city)
                <li class="product-widget-item">
                    <div class="product-widget-checkbox">
                        <input type="checkbox" id="city_{{ $loop->index }}" name="cities[]" value="{{ $city->city }}"
                            {{ in_array($city->city, request('cities', [])) ? 'checked' : '' }}>
                    </div>
                    <label class="product-widget-label" for="city_{{ $loop->index }}">
                        <span class="product-widget-text">{{ $city->city }}</span>
                        <span class="product-widget-number">({{ $city->count }})</span>
                    </label>
                </li>
                @endforeach
            </ul>

            <div class="filter-button1 mt-5">
                <a href="{{ $action }}" class="product-widget-btn">
                    <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                </a>
                <button type="submit" class="product-widget-btn">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </button>
            </div>
        </form>
    </div>
</div>