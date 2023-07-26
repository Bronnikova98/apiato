@if ($paginator->hasPages())
    <ul class="pager" style="display: flex;">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><=</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><=</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" style="margin-right: 2px; margin-left: 2px;"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active" style="margin-right: 2px; margin-left: 2px; font-weight: bold;"><span>{{ $page }}</span></li>
                    @else
                        <li style="margin-right: 2px; margin-left: 2px; color: #17a2b8;"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">=></a></li>
        @else
            <li class="disabled"><span>=></span></li>
        @endif
    </ul>
@endif
