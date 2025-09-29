@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center">
        <ul class="pagination flex items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled px-3 py-2 mx-1 text-gray-500 bg-white border rounded-md cursor-not-allowed" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    &laquo;
                </li> 
            @else
                <li class="px-3 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled px-3 py-2 mx-1 text-gray-700 bg-white border">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 mx-1 text-white bg-blue-500 border rounded-md">{{ $page }}</li>
                        @else
                            <li class="px-3 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="px-3 py-2 mx-1 text-gray-700 bg-white border rounded-md hover:bg-gray-100">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">&raquo;</a>
                </li>
            @else
                <li class="disabled px-3 py-2 mx-1 text-gray-500 bg-white border rounded-md cursor-not-allowed" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    &raquo;
                </li>
            @endif
        </ul>
    </nav>
@endif
