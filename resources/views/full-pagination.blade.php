@if ($paginator->hasPages())
    <div class="flex items-center justify-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 no-underline bg-white border border-gray-200 rounded-sm rounded-l cursor-not-allowed dark:border-gray-800 border-brand-light dark:bg-gray-700 dark:text-gray-200">&laquo;</span>
        @else
            <a
                class="px-3 py-2 no-underline bg-white border-t border-b border-l border-gray-200 rounded-sm rounded-l dark:border-gray-800 border-brand-light text-brand-dark hover:bg-brand-light dark:bg-gray-700 dark:text-gray-200"
                href="{{ $paginator->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 no-underline bg-white border-t border-b border-l border-gray-200 cursor-not-allowed dark:border-gray-800 border-brand-light dark:bg-gray-700 dark:text-gray-200">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 text-white no-underline bg-white bg-blue-600 border-t border-b border-l border-blue-600 dark:bg-blue-500 bordrder border-brand-light bg-brand-light dark:bg-gray-700 dark:text-gray-200">{{ $page }}</span>
                    @else
                        <a class="px-3 py-2 no-underline bg-white border-t border-b border-l border-gray-200 dark:border-gray-800 border-brand-light hover:bg-brand-light text-brand-dark dark:bg-gray-700 dark:text-gray-200" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="px-3 py-2 no-underline bg-white border border-gray-200 rounded-sm rounded-r dark:border-gray-800 border-brand-light hover:bg-brand-light text-brand-dark dark:bg-gray-700 dark:text-gray-200" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span class="px-3 py-2 no-underline bg-white border border-gray-200 rounded-sm rounded-r cursor-not-allowed dark:border-gray-800 border-brand-light hover:bg-brand-light text-brand-dark dark:bg-gray-700 dark:text-gray-200">&raquo;</span>
        @endif
    </div>
@endif