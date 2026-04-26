@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span style="opacity:.4;cursor:default;">← Précédent</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Précédent</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant →</a>
        @else
            <span style="opacity:.4;cursor:default;">Suivant →</span>
        @endif
    </nav>
@endif
