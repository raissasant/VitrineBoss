@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginação" class="flex items-center justify-center gap-1 sm:gap-2 mt-8">

        {{-- Primeira --}}
        <a href="{{ $paginator->url(1) }}"
           class="px-2 py-1 rounded border text-sm sm:text-base {{ $paginator->onFirstPage() ? 'opacity-40 pointer-events-none' : 'hover:bg-gray-100' }}"
           aria-label="Primeira">
            «
            <span class="hidden sm:inline">Primeira</span>
        </a>

        {{-- Anterior --}}
        <a href="{{ $paginator->previousPageUrl() ?? '#' }}"
           class="px-2 py-1 rounded border text-sm sm:text-base {{ $paginator->onFirstPage() ? 'opacity-40 pointer-events-none' : 'hover:bg-gray-100' }}"
           aria-label="Anterior">
            ‹
            <span class="hidden sm:inline">Anterior</span>
        </a>

        {{-- Números de páginas --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded border bg-purple-600 text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 rounded border hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Próxima --}}
        <a href="{{ $paginator->nextPageUrl() ?? '#' }}"
           class="px-2 py-1 rounded border text-sm sm:text-base {{ $paginator->hasMorePages() ? 'hover:bg-gray-100' : 'opacity-40 pointer-events-none' }}"
           aria-label="Próxima">
            <span class="hidden sm:inline">Próxima</span>
            ›
        </a>

        {{-- Última --}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}"
           class="px-2 py-1 rounded border text-sm sm:text-base {{ $paginator->currentPage() == $paginator->lastPage() ? 'opacity-40 pointer-events-none' : 'hover:bg-gray-100' }}"
           aria-label="Última">
            <span class="hidden sm:inline">Última</span>
            »
        </a>
    </nav>
@endif
