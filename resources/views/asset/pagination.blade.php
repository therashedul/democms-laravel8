{{-- <div class="custom-pagination">
    <a href="#" class="prev">Prevous</a>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#" class="next">Next</a>
</div> --}}


<div class="text-start py-4">
    @if ($paginator->hasPages())
        <div class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">Prevous</span>
                </a>
            @else
                <a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')">Prevous</a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a aria-disabled="true"><span>{{ $element }}</span></a>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active" aria-current="page"><span>{{ $page }}</span></a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="@lang('pagination.next')">Next</a>
            @else
                <a class="next" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">Next</span>
                </a>
            @endif
        </div>
    @endif
</div>
