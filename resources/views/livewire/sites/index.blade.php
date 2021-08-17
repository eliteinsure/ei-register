<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        @role('admin')
        <x-jet-button type="button" wire:click="$emitTo('sites.form', 'add')">
          Create a New Software
        </x-jet-button>
        @endrole
      </div>
    </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
                      Date Updated
                    </x-column-sorter>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sites as $index => $site)
                  <!-- Odd row -->
                  <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm font-medium">
                      <div class="flex items-center space-x-2">
                        <button type="button" class="text-lmara hover:text-dsgreen" title="View Details"
                          wire:click="$emitTo('sites.form', 'edit', {{ $site->id }})">
                          <x-heroicon-o-eye class="h-6 w-6" />
                        </button>
                        @role('admin')
                        <button type="button" class="text-red-500 hover:text-red-700" title="Delete"
                          wire:click="confirmDelete({{ $site->id }})">
                          <x-heroicon-o-trash class="h-6 w-6" />
                        </button>
                        @endrole
                      </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      <a href="{{ $site->url }}" target="_blank" class="font-medium text-lmara hover:text-shark">
                        {{ $site->url }}
                      </a>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->launch_date->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $site->update_date ? $site->update_date->format('d/m/Y') : '' }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $sites->links() }}
          @else
            <p class="text-shark px-4 py-3">No available softwares.</p>
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
