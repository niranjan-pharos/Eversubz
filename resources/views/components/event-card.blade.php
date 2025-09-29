    <div class="product-card">
        <div class="product-media">
            <div class="product-img recommend-product-img">
                <img src="{{ asset('storage/' . $event->main_image) }}" class="img-fluid" alt="Main Image">
            </div>
        </div>
        <div class="product-content">
            <ol class="breadcrumb product-category">
             
                @if ($event->from_date_time)
                <li class="breadcrumb-item">
                    @if (\Carbon\Carbon::parse($event->from_date_time)->format('Y-m-d') ==
                    \Carbon\Carbon::parse($event->to_date_time)->format('Y-m-d'))
                    {{ \Carbon\Carbon::parse($event->from_date_time)->format('D jS M, h:i a') }}
                    - {{ \Carbon\Carbon::parse($event->to_date_time)->format('h:i a') }}

                    @else
                    {{ \Carbon\Carbon::parse($event->from_date_time)->format('D jS M, h:i a') }}
                    - {{ \Carbon\Carbon::parse($event->to_date_time)->format('D jS M, h:i a') }}
                    @endif

                </li>
                @else
                N/A
                @endif
                <li class="breadcrumb-item product-price">
                @if(empty($event->price) || $event->price == 0 || $event->price == '0.00')
                Free
                @else
                ${{ $event->price }}
                @endif
                </li>

            </ol>
            <h5 class="product-title"><a href="{{ route('event.show', [$event->slug]) }}">
                    {{ strlen($event->title) > 30 ? substr($event->title, 0, 30) . '...' : $event->title }}
                </a></h5>
        

            <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>{{ $event->city." ," }}
                    {{ $event->state }}</span>
            </div>
         
        </div>
    </div>