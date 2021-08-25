<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        <x-jet-button type="button" wire:click="$emitTo('advisers.form', 'add')">
          Register an Adviser / Staff
        </x-jet-button>
      </div>
    </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white divide-y divide-gray-200">
          @if ($advisers->count())
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="relative px-4 py-3">
                    <span class="sr-only">Actions</span>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="type">
                      Type
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="name">
                      Name
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="email">
                      Email
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="fsp_no">
                      FSP Number
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="contact_number">
                      Contact Number
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="status">
                      Status
                    </x-column-sorter>
                  </th>
                  @if (auth()->user()->hasRole('admin'))
                    <th scope="col" class="relative px-4 py-3">
                      <span class="sr-only">Delete Action</span>
                    </th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($advisers as $index => $adviser)
                  <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm font-medium">
                      <x-jet-dropdown align="bottom" content-classes="py-1 bg-white divide-y divide-gray-200">
                        <x-slot name="trigger">
                          <button type="button"
                            class="text-lmara hover:text-dsgreen" title="Actions">
                            <x-heroicon-o-dots-vertical class="h-6 w-6" />
                          </button>
                        </x-slot>
                        <x-slot name="content">
                          <x-jet-dropdown-link href="javascript:void(0)"
                            wire:click="$emitTo('advisers.form', 'edit', {{ $adviser->id }})">
                            @if (auth()->user()->hasRole('admin'))
                              Update
                            @else
                              View Details
                            @endif
                          </x-jet-dropdown-link>
                        </x-slot>
                      </x-jet-dropdown>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->type }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->email }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->fsp_no ?? 'N/A' }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->contact_number }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $adviser->status }}
                    </td>
                    @if (auth()->user()->hasRole('admin'))
                      <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                        <button type="button" class="text-red-500 hover:text-red-700" title="Delete"
                          wire:click="confirmDelete({{ $adviser->id }})">
                          <x-heroicon-o-trash class="h-6 w-6" />
                        </button>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $advisers->links() }}
          @else
            <p class="text-shark px-4 py-3">No available advisers.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <x-jet-confirmation-modal wire:model="showDelete">
    <x-slot name="title">Delete Adviser</x-slot>
    <x-slot name="content">Are you sure to delete this adviser?</x-slot>
    <x-slot name="footer">
      <x-jet-button type="button" wire:click="delete">Yes</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showDelete', false)">No
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-confirmation-modal>
</div>
