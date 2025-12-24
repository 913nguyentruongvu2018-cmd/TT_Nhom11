
@if ($paginator->hasPages())
    <div style="margin-top: 15px; text-align: center;">
        
        
        @if ($paginator->onFirstPage())
            <span style="color:#ccc; margin-right: 10px;">&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="margin-right: 10px; text-decoration: none; font-weight: bold;">&lt;</a>
        @endif

        
        @foreach ($elements as $element)
            
            @if (is_string($element))
                <span style="margin: 0 5px;">{{ $element }}</span>
            @endif

            
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        
                        <strong style="margin: 0 5px; color: red;">{{ $page }}</strong>
                    @else
                        
                        <a href="{{ $url }}" style="margin: 0 5px; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="margin-left: 10px; text-decoration: none; font-weight: bold;">&gt;</a>
        @else
            <span style="color:#ccc; margin-left: 10px;">&gt;</span>
        @endif
    </div>
@endif