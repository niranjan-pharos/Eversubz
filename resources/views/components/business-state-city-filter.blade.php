   

    <div class="product-widget ">
        <h6 class="product-widget-title">
            <a class="accordion-toggle-mobile" data-toggle="collapse" href="#filterStateCityMobile" role="button"
                aria-expanded="false" aria-controls="filterStateCityMobile">
               Filter by State and City
               <i class="fas fa-chevron-down toggle-icon-mobile"></i>
            </a>
        </h6>
        <div class="collapse" id="filterStateCityMobile">
            <form class="product-widget-form" method="GET" action="{{ $action }}">
                <ul class="product-widget-list product-widget-scroll">
                    @foreach ($statesWithCities as $state => $cities)
                    <li class="product-widget-dropitem">
                        <button type="button" class="accordion-toggle-state-mobile" aria-expanded="false"
                            aria-controls="state-mobile-{{ Str::slug($state) }}" onclick="toggleAccordionMobile(this)">
                            {{ $state }} <i class="fas fa-chevron-down toggle-icon-mobile"></i>
                        </button>
                        <ul class="accordion-content-state-mobile product-widget-dropdown"
                            id="state-mobile-{{ Str::slug($state) }}" style="display: none;">
                            @foreach ($cities as $city)
                            <li>
                                <input type="checkbox" id="city{{ $city->business_city }}" name="cities[]"
                                    value="{{ $city->business_city }}"
                                    {{ in_array($city->business_city, request('cities', [])) ? 'checked' : '' }}>
                                <label for="city{{ $city->business_city }}">
                                    {{ $city->business_city }} ({{ $city->business_count }})
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
                    <button type="submit" class="product-widget-btn"><i
                            class="fas fa-search"></i><span>Search</span></button>
                </div>
            </form>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded',function(){function toggleAccordionState(element){const content=document.getElementById(element.getAttribute('aria-controls'));const isExpanded=element.getAttribute('aria-expanded')==='true';const icon=element.querySelector('.toggle-icon-state');if(!isExpanded){document.querySelectorAll('.accordion-content-state').forEach(content=>{if(content.style.display==='block'){content.style.display='none';const toggle=document.querySelector(`[aria-controls="${content.id}"]`);toggle.setAttribute('aria-expanded','false');toggle.querySelector('.toggle-icon-state').classList.replace('fa-chevron-up','fa-chevron-down')}});element.setAttribute('aria-expanded','true');content.style.display='block';icon.classList.replace('fa-chevron-down','fa-chevron-up')}else{element.setAttribute('aria-expanded','false');content.style.display='none';icon.classList.replace('fa-chevron-up','fa-chevron-down')}}
function toggleAccordionMobile(element){const content=document.getElementById(element.getAttribute('aria-controls'));const isExpanded=element.getAttribute('aria-expanded')==='true';const icon=element.querySelector('.toggle-icon-mobile');if(!isExpanded){document.querySelectorAll('.accordion-content-state-mobile').forEach(content=>{if(content.style.display==='block'){content.style.display='none';const toggle=document.querySelector(`[aria-controls="${content.id}"]`);toggle.setAttribute('aria-expanded','false');toggle.querySelector('.toggle-icon-mobile').classList.replace('fa-chevron-up','fa-chevron-down')}});element.setAttribute('aria-expanded','true');content.style.display='block';icon.classList.replace('fa-chevron-down','fa-chevron-up')}else{element.setAttribute('aria-expanded','false');content.style.display='none';icon.classList.replace('fa-chevron-up','fa-chevron-down')}}
document.querySelectorAll('.accordion-toggle-state').forEach(toggle=>{toggle.addEventListener('click',function(){toggleAccordionState(this)})});document.querySelectorAll('.accordion-toggle-state-mobile').forEach(toggle=>{toggle.addEventListener('click',function(){toggleAccordionMobile(this)})})})
    </script>