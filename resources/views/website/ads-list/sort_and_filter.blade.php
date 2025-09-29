
{{-- Sorting and Filtering Form --}}
<div class="header-filter">
    <form action="{{ route('adsList') }}" method="GET" class="d-flex">
        <div class="filter-show">
            <label class="filter-label">Show:</label>
            <select name="perPage" class="custom-select filter-select" onchange="this.form.submit()">
                <option value="12" {{ request('perPage') == '12' ? 'selected' : '' }}>12</option>
                <option value="24" {{ request('perPage') == '24' ? 'selected' : '' }}>24</option>
                <option value="36" {{ request('perPage') == '36' ? 'selected' : '' }}>36</option>
            </select>
        </div>
        <div class="filter-short ml-3">
            <label class="filter-label">Sort by:</label>
            <select name="sortBy" class="custom-select filter-select" onchange="this.form.submit()">
                <option value="default" {{ request('sortBy') == 'default' ? 'selected' : '' }}>Default</option>
                <option value="1" {{ request('sortBy') == '1' ? 'selected' : '' }}>Featured</option>
                <option value="2" {{ request('sortBy') == '2' ? 'selected' : '' }}>Recommend</option>
                <option value="3" {{ request('sortBy') == '3' ? 'selected' : '' }}>Trending</option>
            </select>
        </div>
    </form>
</div>
