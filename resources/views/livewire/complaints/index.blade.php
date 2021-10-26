<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        @if (auth()->user()->hasPermissionTo('complaints.create'))
          <x-jet-button type="button" wire:click="$emitTo('complaints.form', 'add')">
            Register a Complaint
          </x-jet-button>
        @endif
      </div>
      <div>
        @if (auth()->user()->hasPermissionTo('complaints.generate-report'))
          @livewire('complaints.report')
        @endif
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
                    <x-column-sorter column="complainee">Complainee Name</x-column-sorter>
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
                  {{-- <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="acknowledged_at">Days Counter</x-column-sorter>
                  </th> --}}
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="nature">Nature of Complaint</x-column-sorter>
                  </th>
                  @if (auth()->user()->hasPermissionTo('complaints.delete'))
                    <th scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                      <span class="sr-only">Delete Action</span>
                    </th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($complaints as $index => $complaint)
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
                            wire:click="$emitTo('complaints.form', 'edit', {{ $complaint->id }})">
                            @if (auth()->user()->hasPermissionTo('complaints.update'))
                              Update
                            @else
                              View Details
                            @endif
                          </x-jet-dropdown-link>

                          @if (auth()->user()->hasPermissionTo('complaints.view-pdf'))
                            <x-jet-dropdown-link href="javascript:void(0)"
                              wire:click="showPdf({{ $complaint->id }})">
                              View PDF
                            </x-jet-dropdown-link>
                          @endif
                        </x-slot>
                      </x-jet-dropdown>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->number }}
                    </td>
                    <td class="px-4 py-2 text-sm text-shark text-opacity-75">
                      {{ $complaint->complainant }}
                    </td>
                    <td class="px-4 py-2 text-sm text-shark text-opacity-75">
                      {{ $complaint->complainee }}
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
                    {{-- <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ number_format($complaint->day_counter) }}
                    </td> --}}
                    <td class="px-4 py-2 text-sm text-shark text-opacity-75">
                      {{ $complaint->nature }}
                    </td>
                    @if (auth()->user()->hasPermissionTo('complaints.delete'))
                      <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                        <button type="button" class="text-red-500 hover:text-red-700" title="Delete"
                          wire:click="confirmDelete({{ $complaint->id }})">
                          <x-heroicon-o-trash class="h-6 w-6" />
                        </button>
                      </td>
                    @endif
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

  <x-jet-dialog-modal wire:model="showPdf" max-width="5xl" focusable>
    <x-slot name="title">Complaint PDF</x-slot>
    <x-slot name="content">
      <iframe src="{{ $this->PdfUrl }}" class="w-full" style="height: 600px;"></iframe>
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button type="button" wire:click="$set('showPdf', false)">Close</x-jet-secondary-button>
    </x-slot>
  </x-jet-dialog-modal>

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
