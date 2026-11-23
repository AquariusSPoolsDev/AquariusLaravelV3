@if ($paginator->hasPages())
    <nav aria-label="{{ __('strings.pagination_label') }}" class="flex items-center flex-col lg:flex-row lg:justify-between w-full">

        <div>
            <p class="text-base text-neutral-700 leading-normal mb-2 lg:mb-0 text-center">
                {!! __('strings.pagination_showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-bold">{{ $paginator->firstItem() }}</span>
                    {!! __('strings.pagination_to') !!}
                    <span class="font-bold">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('strings.pagination_of') !!}
                <span class="font-bold">{{ $paginator->total() }}</span>
                {!! __('strings.pagination_results') !!}
            </p>
        </div>

        <div class="flex flex-wrap justify-between gap-2 w-full lg:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-base font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default leading-5 rounded-xl">
                    {!! __('strings.pagination_previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-base font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 rounded-xl hover:text-neutral-500 active:bg-neutral-100 active:text-primary-700 transition ease-in-out duration-150">
                    {!! __('strings.pagination_previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-base font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 rounded-xl hover:text-neutral-500 active:bg-neutral-100 active:text-primary-700 transition ease-in-out duration-150">
                    {!! __('strings.pagination_next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 text-base font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default leading-5 rounded-xl">
                    {!! __('strings.pagination_next') !!}
                </span>
            @endif
        </div>

        <div class="hidden lg:flex">
            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-xl">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span>
                            <span class="relative inline-flex items-center px-2 py-2 text-base font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default rounded-l-xl leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-base font-medium text-neutral-500 bg-white border border-neutral-300 rounded-l-xl leading-5 hover:text-neutral-400 focus:z-10 active:bg-neutral-100 active:text-primary-500 transition ease-in-out duration-150" aria-label="{{ __('strings.pagination_prev_label') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-medium text-neutral-700 bg-white border border-neutral-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 hover:text-neutral-500 focus:z-10 active:bg-neutral-100 active:text-primary-700 transition ease-in-out duration-150" aria-label="{{ __('strings.pagination_go_to', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-base font-medium text-neutral-500 bg-white border border-neutral-300 rounded-r-xl leading-5 hover:text-neutral-400 focus:z-10 active:bg-neutral-100 active:text-primary-500 transition ease-in-out duration-150" aria-label="{{ __('strings.pagination_next_label') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span>
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-base font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default rounded-r-xl leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
