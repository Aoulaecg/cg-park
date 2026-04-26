@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" style="opacity:.4;cursor:default;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Page précédente">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="opacity:.4;cursor:default;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" style="background:var(--accent);color:#fff;min-width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;border-radius:7px;font-size:.8rem;font-weight:700;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="min-width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;border-radius:7px;font-size:.8rem;font-weight:600;color:#475569;text-decoration:none;transition:background .15s;" onmouseover="this.style.background='#f0f4f8'" onmouseout="this.style.background='transparent'">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Page suivante">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        @else
            <span aria-disabled="true" style="opacity:.4;cursor:default;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </span>
        @endif
    </nav>
@endif
