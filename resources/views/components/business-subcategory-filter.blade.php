
<div class="product-widget ">
    <h6 class="product-widget-title">
        <a data-toggle="collapse" href="#filetrmain" role="button" aria-expanded="false" aria-controls="filetrmain">
           Filter by SubCategory
           <i class="fas fa-chevron-down"></i>
        </a>
    </h6>
    <div class="collapse" id="filetrmain">
        <form class="product-widget-form" method="GET" action="{{ $action }}">
            <ul class="product-widget-list product-widget-scroll">
                @foreach($subcategories as $subcategory)
                    <li>
                        <input type="checkbox" id="subcat{{ $subcategory->id }}" name="subcategories[]"
                            value="{{ $subcategory->slug }}"
                            {{ in_array($subcategory->slug, request()->query('subcategories', [])) ? 'checked' : '' }}>
                        <label for="subcat{{ $subcategory->id }}">
                            {{ $subcategory->name }} ({{ $subcategory->business_products_count }})
                        </label>
                    </li>
                @endforeach
            </ul>
            <div class="filter-button1">
                <a href="{{ $action }}" class="product-widget-btn">
                    <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                </a>
                <button type="submit" class="product-widget-btn"><i
                        class="fas fa-search"></i><span>Search</span></button>
            </div>
        </form>
    </div>
</div>