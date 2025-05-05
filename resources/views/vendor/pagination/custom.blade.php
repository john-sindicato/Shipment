@php
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
@endphp

@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&#10094;  </span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&#10094;     </a></li>
        @endif

        {{-- Page Numbers --}}
        @for ($page = 1; $page <= $lastPage; $page++)
            @if (
                $page == 1 || 
                $page == $lastPage || 
                ($page >= $currentPage - 2 && $page <= $currentPage + 2)
            )
                @if ($page == $currentPage)
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @elseif (
                $page == 2 && $currentPage > 4 || 
                $page == $lastPage - 1 && $currentPage < $lastPage - 3
            )
                <li class="dots"><span>...</span></li>
            @endif
        @endfor

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&#10095;</a></li>
        @else
            <li class="disabled"><span>  &#10095;</span></li>
        @endif
    </ul>
@endif
