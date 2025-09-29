    <div class="filter-action">
        <a href="{{ request()->fullUrlWithQuery(['view' => '3col']) }}" title="Three Column" class="{{ request('view', '3col') === '3col' ? 'active' : '' }}">
            <i class="fas fa-th"></i>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['view' => '1col']) }}" title="One Column" class="{{ request('view') === '1col' ? 'active' : '' }}">
            <i class="fas fa-th-list"></i>
        </a>
    </div> 