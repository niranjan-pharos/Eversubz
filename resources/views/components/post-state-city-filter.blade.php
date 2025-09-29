<div class="product-widget">
<h6 class="product-widget-title">
            <a data-toggle="collapse" href="#filterStateCity" role="button" aria-expanded="false"
                aria-controls="filterStateCity">
                Filter by State and City
                <i class="fas fa-chevron-down"></i> 
            </a>
        </h6>
        <div class="collapse" id="filterStateCity">
        <form class="product-widget-form" method="GET" action="{{ $action }}">
            <ul class="product-widget-list product-widget-scroll">
                @foreach ($statesWithCities as $state => $cities)
                <li class="product-widget-dropitem">
                    <button type="button" class="accordion-toggle" aria-expanded="false"
                        aria-controls="state-{{ Str::slug($state) }}">
                       <span>  {{ $state }}</span> <i class="fas fa-chevron-down toggle-icon"></i>
                    </button>
                    <ul class="accordion-content product-widget-dropdown" id="state-{{ Str::slug($state) }}">
                        @foreach ($cities as $city)
                        <li>
                            <input type="checkbox" id="city{{ $city->city }}" name="cities[]"
                                value="{{ $city->city }}"
                                {{ in_array($city->city, request('cities', [])) ? 'checked' : '' }}>
                            <label for="city{{ $city->city }}">
                                {{ $city->city }} ({{ $city->count }})
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            <div class="filter-button1">
                <a href="{{ $action }}" class="product-widget-btn">
                    <i class="fa fa-scissors" aria-hidden="true"></i><span>Reset</span>
                </a>
                <button type="submit" class="product-widget-btn"><i class="fas fa-search"></i><span>Search</span></button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){function toggleAccordion(element){const content=element.nextElementSibling;const isExpanded=element.getAttribute('aria-expanded')==='true';const icon=element.querySelector('.toggle-icon');document.querySelectorAll('.accordion-toggle').forEach(toggle=>{toggle.setAttribute('aria-expanded','false');toggle.nextElementSibling.style.display='none';toggle.querySelector('.toggle-icon').classList.replace('fa-chevron-up','fa-chevron-down')});if(!isExpanded){element.setAttribute('aria-expanded','true');content.style.display='block';icon.classList.replace('fa-chevron-down','fa-chevron-up')}else{element.setAttribute('aria-expanded','false');content.style.display='none';icon.classList.replace('fa-chevron-up','fa-chevron-down')}}
document.querySelectorAll('.accordion-toggle').forEach(toggle=>{toggle.addEventListener('click',function(){toggleAccordion(this)})});document.querySelectorAll('.accordion-content').forEach(content=>{content.style.display='none'})})
</script>
