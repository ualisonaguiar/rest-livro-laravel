<div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <p class="text-sm text-gray-700">
            <span class="font-medium">{{ $registers->resource->currentPage() }}</span>
            de
            <span class="font-medium">{{ $registers->resource->perPage() }}</span>
            de
            <span class="font-medium">{{ $registers->resource->total() }}</span>
            resultado
        </p>
    </div>

    <div class="flex justify-center mt-6">
        <nav aria-label="Pagination" class="isolate inline-flex -space-x-px rounded-md shadow-xs">
            {{-- Botão Anterior --}}

            @if ($registers->resource->onFirstPage())
            <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-300 bg-gray-100 cursor-not-allowed">
                <span class="sr-only">Anterior</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" />
                </svg>
            </span>
            @else
            <a href="{{ $registers->resource->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 hover:bg-gray-50">
                <span class="sr-only">Anterior</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" />
                </svg>
            </a>
            @endif

            {{-- Links de páginas --}}
            @php
            $current = $registers->resource->currentPage();
            $last = $registers->resource->lastPage();
            $range = 3; // quantidade de páginas nas pontas
            @endphp

            {{-- Primeiras páginas --}}
            @foreach ($registers->resource->getUrlRange(1, min($range, $last)) as $page => $url)
            @if ($page == $current)
            <a href="{{ $url }}" aria-current="page"
                class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">
                {{ $page }}
            </a>
            @else
            <a href="{{ $url }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                {{ $page }}
            </a>
            @endif
            @endforeach

            {{-- Reticências depois das primeiras páginas --}}
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500">...</span>

            {{-- Últimas páginas --}}
            @foreach ($registers->resource->getUrlRange(max($last - $range + 1, $range + 1), $last) as $page => $url)
            @if ($page == $current)
            <a href="{{ $url }}" aria-current="page"
                class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">
                {{ $page }}
            </a>
            @else
            <a href="{{ $url }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50">
                {{ $page }}
            </a>
            @endif
            @endforeach


            {{-- Botão Próximo --}}
            @if ($registers->resource->hasMorePages())
            <a href="{{ $registers->resource->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 hover:bg-gray-50">
                <span class="sr-only">Próxima</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" />
                </svg>
            </a>
            @else
            <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-300 bg-gray-100 cursor-not-allowed">
                <span class="sr-only">Próxima</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" />
                </svg>
            </span>
            @endif
        </nav>
    </div>
</div>
