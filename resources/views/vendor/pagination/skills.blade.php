@if ($paginator->hasPages())
    <nav>
        <ul class="pagination uk-pagination uk-flex-center mt-5">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a onclick="event.preventDefault();"><span uk-pagination-previous></span></a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span uk-pagination-previous></span></a>
                </li>
            @endif
<!-- 
    
    <li><a href="#">1</a></li>
    <li class="uk-disabled"><span>...</span></li>
    <li><a href="#">5</a></li>
    <li><a href="#">6</a></li>
    <li class="uk-active"><span>7</span></li>
    <li><a href="#">8</a></li>
    <li><a href="#"><span uk-pagination-next></span></a></li> 
-->
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="uk-active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"><span uk-pagination-next></span></a>
                </li>
            @else
                <li class="disabled"><a onclick="event.preventDefault();"><span uk-pagination-next></span></a></li>
            @endif
        </ul>
    </nav>
@endif
