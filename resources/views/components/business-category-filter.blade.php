


    <div class="product-widget ">
        <h6 class="product-widget-title">
            <a data-toggle="collapse" href="#filetrmain" role="button" aria-expanded="false" aria-controls="filetrmain">
               Filter by Category
               <i class="fas fa-chevron-down"></i>
            </a>
        </h6>
        <div class="collapse" id="filetrmain">
            <form class="product-widget-form" method="GET" action="{{ $action }}">
                <ul class="product-widget-list product-widget-scroll">
                    @foreach($categories as $category)
                    <li>
                        <input type="checkbox" id="cat{{ $category->id }}" name="categories[]"
                            value="{{ $category->slug }}"
                            {{ in_array($category->slug, request()->query('categories', [])) ? 'checked' : '' }}>
                        <label for="cat{{ $category->id }}">
                            {{ $category->name }} ({{ $category->user_business_infos_count }})
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