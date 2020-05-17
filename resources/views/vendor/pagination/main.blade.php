@if ($paginator->hasPages())
    <div class="flex justify-center mt-4 p-2 bg-gray-600">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="disabled p-2" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">Prev</span>
                </div>
            @else
                    <a class="bg-white p-2 rounded-lg" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>

            @endif
        <div class="p-2 font-bold">
            Page <span class="text-yellow-500">{{ $paginator->currentPage() }}</span>  of  {{ $paginator->lastPage() }}
        </div>



            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                    <a  class="bg-white p-2 rounded-lg" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
            @else
                <div class="disabled p-2" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">Next</span>
                </div>
            @endif
    </div>
@endif
