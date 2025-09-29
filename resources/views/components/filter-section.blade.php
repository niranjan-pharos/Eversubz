<div class="product-widget">
    <h6 class="product-widget-title">
        <a href="#{{ Str::slug($title) }}" data-toggle="collapse" role="button" aria-expanded="false" class="collapsed toggle-icon" style="display: flex; justify-content: space-between; color: #000;">
            <span>{{ $title }}</span>
            <i class="fas fa-chevron-down"></i>
        </a>
    </h6>
    <div class="collapse" id="{{ Str::slug($title) }}">
        <div class="side-list no-border">
            <div class="single_filter_card">
                <ul class="no-ul-list filter-list">
                    @foreach ($items as $item)
                        @php
                            $itemName = is_object($item) ? $item->{$keyName} : (is_array($item) ? $item[$keyName] : null);
                            $itemSlug = is_object($item) && isset($item->slug) ? $item->slug : (is_array($item) && isset($item['slug']) ? $item['slug'] : null);
                            $isChecked = in_array($itemSlug, request($inputName, [])); // Check if the slug is selected
                        @endphp
                        @if ($itemName)
                            <li>
                                <input 
                                    id="{{ Str::slug($itemName) }}" 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="{{ $inputName }}[]"  <!-- Ensure the name is an array for multiple selections -->
                                    value="{{ $itemSlug }}"  <!-- Use slug here instead of itemId -->
                                    {{ $isChecked ? 'checked' : '' }}>
                                <label for="{{ Str::slug($itemName) }}" class="form-check-label">
                                    {{ $itemName }}
                                </label>
                            </li>
                        @endif
                    @endforeach
                </ul>            
                               
            </div>
        </div>
    </div>
</div>
