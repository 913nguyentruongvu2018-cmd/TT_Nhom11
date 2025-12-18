{{-- File: resources/views/phantrang.blade.php --}}
@if ($paginator->hasPages())
    <div style="margin-top: 15px; text-align: center;">
        
        {{-- Nút Quay lại (<) --}}
        @if ($paginator->onFirstPage())
            <span style="color:#ccc; margin-right: 10px;">&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="margin-right: 10px; text-decoration: none; font-weight: bold;">&lt;</a>
        @endif

        {{-- Danh sách số trang (1 2 3...) --}}
        @foreach ($elements as $element)
            {{-- Dấu ba chấm "..." --}}
            @if (is_string($element))
                <span style="margin: 0 5px;">{{ $element }}</span>
            @endif

            {{-- Các số trang --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- Trang hiện tại (In đậm, màu đỏ hoặc đen tùy bạn) --}}
                        <strong style="margin: 0 5px; color: red;">{{ $page }}</strong>
                    @else
                        {{-- Các trang khác --}}
                        <a href="{{ $url }}" style="margin: 0 5px; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút Tiếp theo (>) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="margin-left: 10px; text-decoration: none; font-weight: bold;">&gt;</a>
        @else
            <span style="color:#ccc; margin-left: 10px;">&gt;</span>
        @endif
    </div>
@endif