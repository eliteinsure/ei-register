<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        @role('admin')
        <x-jet-button type="button" wire:click="$emitTo('complaints.form', 'add')">
          Register a Complaint
        </x-jet-button>
        @endrole
      </div>
    </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white divide-y divide-gray-200">
          @if ($complaints->count())
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="relative px-4 py-3">
                    <span class="sr-only">Actions</span>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="id">
                      Complaint Number
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="complainant">Complainant Name</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="received_at">Date Received</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="created_at">Date Registered</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="acknowledged_at">Date Acknowledged</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="acknowledged_at">Days Counter</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="nature">Nature of Complaint</x-column-sorter>
                  </th>
                  {{-- <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    Tier Result
                  </th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($complaints as $index => $complaint)
                  <!-- Odd row -->
                  <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm font-medium">
                      <div class="flex items-center space-x-2">
                        <button type="button" class="text-lmara hover:text-dsgreen" title="View Details"
                          wire:click="$emitTo('complaints.form', 'edit', {{ $complaint->id }})">
                          <x-heroicon-o-eye class="h-6 w-6" />
                        </button>
                        @role('admin')
                        <button type="button" class="text-red-500 hover:text-red-700" title="Delete"
                          wire:click="confirmDelete({{ $complaint->id }})">
                          <x-heroicon-o-trash class="h-6 w-6" />
                        </button>
                        @endrole
                      </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->number }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->complainant }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->received_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->acknowledged_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->status }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ number_format($complaint->day_counter) }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->nature }}
                    </td>
                    {{-- <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->tier_result }}
                    </td> --}}
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $complaints->links() }}
          @else
            <p class="text-shark px-4 py-3">No available complaints.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <x-jet-confirmation-modal wire:model="showDelete">
    <x-slot name="title">Delete Complaint</x-slot>
    <x-slot name="content">Are you sure to delete this complaint?</x-slot>
    <x-slot name="footer">
      <x-jet-button type="button" wire:click="delete">Yes</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showDelete', false)">No
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-confirmation-modal>
</div>
