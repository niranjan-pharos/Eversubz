@if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator)
    @if ($paginator->hasPages()) 
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-pagection">
                    <p class="page-info">
                        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
                    </p>

                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><i class="fas fa-long-arrow-alt-left"></i></span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-long-arrow-alt-left"></i></a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($paginator->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-long-arrow-alt-right"></i></a></li>
                        @else
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><i class="fas fa-long-arrow-alt-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endif
