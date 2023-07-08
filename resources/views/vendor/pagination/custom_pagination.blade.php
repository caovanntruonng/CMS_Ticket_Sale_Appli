<div class="custom-pagination">
    <ul class="pagination">
        {{-- Hiển thị nút "Previous" --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><i class="fa-solid fa-caret-left"></i></span></li>
        @else
            <li class="page-item pre"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fa-solid fa-caret-left"></i></a></li>
        @endif

        {{-- Hiển thị các trang --}}
        @foreach ($elements as $element)
            {{-- Hiển thị nút "..." --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Hiển thị các trang --}}
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

        {{-- Hiển thị nút "Next" --}}
        @if ($paginator->hasMorePages())
            <li class="page-item next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-caret-right"></i></a></li>
        @else
            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><i class="fa-solid fa-caret-right"></i></span></li>
        @endif
    </ul>
</div>
