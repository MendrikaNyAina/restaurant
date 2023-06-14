<style>
    .mypagination {
      display: inline-block;
    }

    .mypagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
    }

    .mypagination a.active {
      background-color: #4CAF50;
      color: white;
    }

    .mypagination a:hover:not(.active) {background-color: #ddd;}
    </style>
@if ($paginator->hasPages())
<div class="mypagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a class="disabled" ><span>&laquo;</span></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="disabled"><span>{{ $element }}</span></a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active" ><span>{{ $page }}</span></a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
    @else
        <a class="disabled" ><span>&raquo;</span></a>
    @endif
</div>
@endif


