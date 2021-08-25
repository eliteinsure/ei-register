<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        @role('admin')
        <x-jet-button type="button" wire:click="$emitTo('sites.form', 'add')">
          Register a Software
        </x-jet-button>
        @endrole
      </div>
      <div>
        @livewire('sites.report')
      </div>
    </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 h-auto">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white divide-y divide-gray-200">
          @if ($sites->count())
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="relative px-4 py-3">
                    <span class="sr-only">Actions</span>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="name">
                      Name
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="url">
                      Link
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="launch_date">
                      Date Launched
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="update_date">
                      Date Last Updated
                    </x-column-sorter>
                  </th>
                  @if (auth()->user()->hasRole('admin'))
                    <th scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                      <span class="sr-only">Delete Action</span>
                    </th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($sites as $index => $site)
                  <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm">
                      <x-jet-dropdown align="bottom" content-classes="py-1 bg-white divide-y divide-gray-200">
                        <x-slot name="trigger">
                          <button type="button"
                            class="text-lmara hover:text-dsgreen" title="Actions">
                            <x-heroicon-o-dots-vertical class="h-6 w-6" />
                          </button>
                        </x-slot>
                        <x-slot name="content">
                          <x-jet-dropdown-link href="javascript:void(0)"
                            wire:click="$emitTo('sites.form', 'edit', {{ $site->id }})">
                            @if (auth()->user()->hasRole('admin'))
                              Update
                            @else
                              View Details
                            @endif
                          </x-jet-dropdown-link>
                          <x-jet-dropdown-link href="javascript:void(0)"
                            wire:click="$emitTo('sites.manual', 'show', {{ $site->id }})">
                            View Manuals
                          </x-jet-dropdown-link>
                        </x-slot>
                      </x-jet-dropdown>

                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      <a href="{{ $site->url }}" target="_blank"
                        class="font-medium text-lmara hover:text-shark">
                        {{ $site->url }}
                      </a>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->launch_date->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->update_date ? $site->update_date->format('d/m/Y') : '' }}
                    </td>
                    @if (auth()->user()->hasRole('admin'))
                      <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                        <button type="button" class="text-red-500 hover:text-red-700" title="Delete"
                          wire:click="confirmDelete({{ $site->id }})">
                          <x-heroicon-o-trash class="h-6 w-6" />
                        </button>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $sites->links() }}
          @else
            <p class="text-shark px-4 py-3">No available software.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <x-jet-confirmation-modal wire:model="showDelete">
    <x-slot name="title">Delete Software</x-slot>
    <x-slot name="content">Are you sure to delete this software?</x-slot>
    <x-slot name="footer">
      <x-jet-button type="button" wire:click="delete">Yes</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showDelete', false)">No
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-confirmation-modal>
</div>
