@if ($paginator->hasPages())
    <ul class="nav">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="nav-item"><span>&laquo;</span></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="nav-item" ><a class="nav-link active"  href="{{ $url }}"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="nav-item"><a class="nav-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="nav-item"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
