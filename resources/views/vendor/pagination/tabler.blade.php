@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center my-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="ti ti-chevron-left"></i> Prev
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" wire:click="setPage('{{ $paginator->currentPage() - 1 }}')" role="button">
                        <i class="ti ti-chevron-left"></i> Prev
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" wire:click="setPage('{{ $page }}')" role="button">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" wire:click="setPage('{{ $paginator->currentPage() + 1 }}')" role="button">
                        Next <i class="ti ti-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        Next <i class="ti ti-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
