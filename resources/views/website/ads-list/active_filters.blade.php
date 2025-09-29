
{{-- Active Filters Display --}}
@if(!empty($activeFilters))
    @foreach($activeFilters as $filter => $value)
        <div class="alert alert-warning alert-dismissible fade show filter_alert" role="alert" style="width:auto">
            {{ ucfirst($filter) }}: {{ $value }}
            <a href="{{ route('adsList', array_merge(request()->query(), [$filter => null])) }}" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
    @endforeach
@endif
