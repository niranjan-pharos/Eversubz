            
    <ul class="product-widget-list">
        @foreach([5, 4, 3, 2, 1] as $rating)
            <li class="product-widget-item">
                <div class="product-widget-checkbox">
                    <input type="checkbox" id="rating{{ $rating }}" name="ratings[]" value="{{ $rating }}"
                        {{ in_array($rating, $selectedRatings) ? 'checked' : '' }}>
                </div>
                <label class="product-widget-label" for="rating{{ $rating }}">
                    <span class="product-widget-star">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= $rating ? 's' : 'r' }} fa-star"></i>
                        @endfor
                    </span>
                    <span class="product-widget-number">({{ $ratingsCount[$rating] ?? 0 }})</span>
                </label>
            </li>
        @endforeach
    </ul>