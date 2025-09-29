   
    <div class="product-widget">
        <h6 class="product-widget-title">
            <a data-toggle="collapse" href="#filetrcity" role="button" aria-expanded="false" aria-controls="filetrcity">
               Filter by Cities
               <i class="fas fa-chevron-down"></i>
            </a>
        </h6>
        <div class="collapse" id="filetrcity">
            <form class="product-widget-form" action="{{ $action }}" method="GET">
                <div class="product-widget-search">
                    <input type="text" placeholder="Search">
                </div>
                <ul class="product-widget-list product-widget-scroll">
                    @foreach($topCities as $index => $city)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input type="checkbox" name="cities[]" id="city-{{ $index }}"
                                value="{{ $city->business_city }}"
                                {{ in_array($city->business_city, request()->input('cities', [])) ? 'checked' : '' }}>
                        </div>
                        <label class="product-widget-label" for="city-{{ $index }}">
                            <span class="product-widget-text">{{ $city->business_city }}</span>
                            <span class="product-widget-number">({{ $city->business_count }})</span>
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
<script>
$(document).ready(function(){function updateIcons(element,show){const icon=$(element).find('i');if(show){icon.removeClass('fa-chevron-down').addClass('fa-chevron-up')}else{icon.removeClass('fa-chevron-up').addClass('fa-chevron-down')}}
$('.collapse').on('show.bs.collapse',function(){updateIcons($(this).prev(),!0)}).on('hide.bs.collapse',function(){updateIcons($(this).prev(),!1)})})
</script>

<style>
.filter-button1{display:flex;column-gap:5px}.filters-column-ads{background:#fff;padding:0px}.filters-column-ads .product-widget{background:none;padding:5px;border:none;margin-bottom:10px}.filters-column-ads .product-widget .product-widget-title{font-size:15px}.filters-column-ads .product-widget .product-widget-title a{color:#000;display:flex;column-gap:15px}.filters-column-ads .product-widget.desktop{display:block}.filters-column-ads .product-widget.mobile{display:none}@media only screen and (max-width:737px){.product-title.mobile{display:block}.product-title.desktop{display:none}.filters-column-ads .product-widget.desktop{display:none}.filters-column-ads .product-widget.mobile{display:block}}

.filters-column-ads .product-widget {
        background: none;
    margin-bottom: 10px;
    padding: 7px 10px;
    margin-bottom: 0px;
    border: none;
    border-top: 1px solid #f3f3f3;
    border-bottom: 1px solid #f3f3f3
    }
    .product-widget .product-widget-search{display: none;}
.product-widget-checkbox input, .product-widget-dropitem input {
    width: 12px;
    height: 15px;
    cursor: pointer;
    margin-right: 5px;
}
.product-widget-item{margin: 0px;}

.product-widget-number, .product-widget-text {
    font-size: 12px;
    text-transform: capitalize;
}
.product-widget-dropitem {
    margin: 4px 0;
}
.product-widget-dropitem button{    display: flex
;
    justify-content: space-between;    width: 100%;
    font-size: 13px;}
    .product-widget-dropdown{margin: 0px;    padding: 10px 4px;}
    .product-widget-dropdown label{font-size: 12px;
        text-transform: capitalize;}
    .filters-column-ads .product-widget .product-widget-title {
        margin: 0;
        border: none;
        font-size: 13px;
        text-transform: capitalize;
        padding: 6px 0px;
    }

    .filters-column-ads .product-widget .product-widget-title a {
        color: #000;
        display: flex;justify-content: space-between;
        column-gap: 15px
    }
</style>