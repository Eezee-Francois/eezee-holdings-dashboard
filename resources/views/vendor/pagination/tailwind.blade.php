@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="float-right">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </span>
                @else
                    <button wire:click="previousPage" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</span>
                            @else
                                <span class="btn btn-icon btn-sm border-0  mr-2 my-1">{{ $page }}</span>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </button>
                @else
                    <span class="btn btn-icon btn-sm btn-light mr-2 my-1">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </span>
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>
    </nav>
@endif
