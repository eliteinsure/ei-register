@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation"
    class="flex items-center justify-between px-6 py-2">
    <div
      class="flex-1 lg:flex lg:flex-wrap lg:items-center lg:justify-between">
      <div class="flex">
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          <span>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
              <span aria-disabled="true"
                aria-label="{{ __('pagination.previous') }}">
                <span
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-shark bg-white border border-gray-300 cursor-not-allowed rounded-l-md leading-5"
                  aria-hidden="true">
                  <svg class="w-5 h-5" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
            @else
              <button wire:click="previousPage" dusk="previousPage.after"
                rel="prev"
                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-shark bg-white border border-gray-300 rounded-l-md leading-5 hover:text-lmara focus:text-lmara focus:z-10 focus:outline-none focus:border-lmara focus:ring-1 focus:ring-lmara focus:ring:opacity-50 active:text-lmara transition ease-in-out duration-150"
                aria-label="{{ __('pagination.previous') }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            @endif
          </span>

          {{-- Pagination Elements --}}
          <div class="flex items-center text-sm">
            <p
              class="flex items-center h-full px-2 border-t border-b border-gray-300">
              <span>Page</span>
            </p>

            <select
              wire:input="gotoPage($event.target.value)"
              class="h-full relative inline-flex items-center py-1 pl-2 pr-8 -ml-px text-sm font-medium text-shark bg-white border border-gray-300 leading-5 focus:z-10 focus:outline-none focus:border-lmara focus:ring-1 focus:ring-lmara focus:ring-opacity-50 transition ease-in-out duration-150">
              @foreach (range(1, $paginator->lastPage()) as $page)
                <option value="{{ $page }}"
                  {{ $page == $paginator->currentPage() ? 'selected' : '' }}>
                  {{ $page }}</option>
              @endforeach
            </select>

            <div
              class="flex items-center whitespace-nowrap h-full px-2 border-t border-b border-gray-300">
              <p>of <span
                  class="font-medium">{{ $paginator->lastPage() }}</span>
              </p>
            </div>
          </div>

          <span>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
              <button wire:click="nextPage" dusk="nextPage.after" rel="next"
                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-shark bg-white border border-gray-300 rounded-r-md leading-5 hover:text-lmara focus:z-10 focus:outline-none focus:border-lmara focus:ring-1 focus:ring-lmara focus:ring-opacity-50 active:text-lmara transition ease-in-out duration-150"
                aria-label="{{ __('pagination.next') }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            @else
              <span aria-disabled="true"
                aria-label="{{ __('pagination.next') }}">
                <span
                  class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-shark bg-white border border-gray-300 cursor-not-allowed rounded-r-md leading-5"
                  aria-hidden="true">
                  <svg class="w-5 h-5" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
            @endif
          </span>
        </span>
      </div>

      <div class="flex mt-4 lg:mt-0"> {{-- lg:order-first --}}
        <p class="text-sm text-shark leading-5">
          <span>{!! __('Showing') !!}</span>
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          <span>{!! __('to') !!}</span>
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
          <span>{!! __('of') !!}</span>
          <span class="font-medium">{{ $paginator->total() }}</span>
          <span>{!! __('results') !!}</span>
        </p>
      </div>
    </div>
  </nav>
@endif
