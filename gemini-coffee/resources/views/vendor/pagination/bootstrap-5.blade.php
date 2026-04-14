@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-5 pagination-shop" aria-label="Pagination">
        <ul class="pagination pagination-sm mb-0 gap-2">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link rounded-0 border" href="{{ $paginator->previousPageUrl() ?? '#' }}" tabindex="{{ $paginator->onFirstPage() ? '-1' : '0' }}">Previous</a>
            </li>
            @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                <li class="page-item text-center {{ $page === $paginator->currentPage() ? 'active' : '' }}" style="min-width: 2rem;">
                    <a class="page-link rounded-0 {{ $page === $paginator->currentPage() ? 'border-0' : 'border text-dark' }}" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endfor
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link rounded-0 border border-dark text-dark" href="{{ $paginator->nextPageUrl() ?? '#' }}">Next</a>
            </li>
        </ul>
    </nav>
@endif
