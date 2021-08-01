<div>
  <div class="flex flex-col">
    <div class="mb-4 flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
      <div>
        <x-jet-input type="text" placeholder="Search..." wire:model.debounce="search" />
      </div>
      <div>
        <x-jet-button type="button" wire:click="$emitTo('complaints.form', 'add')">
          Create a New Complaint
        </x-jet-button>
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
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="id">
                      Complaint Number
                    </x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="complainant">Complainant</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="label">Label</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="policy_number">Policy Number</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="insurer">Insurer</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="received_at">Date Received</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="registered_at">Date Registered</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="acknowledged_at">Date Acknowledged</x-column-sorter>
                  </th>
                  <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    <x-column-sorter column="nature">Nature</x-column-sorter>
                  </th>
                  {{-- <th scope="col"
                    class="px-4 py-3 text-left text-xs font-medium text-shark uppercase tracking-wider">
                    Tier Result
                  </th> --}}
                  <th scope="col" class="relative px-4 py-3">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($complaints as $index => $complaint)
                  <!-- Odd row -->
                  <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->number }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->complainant }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->label }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->policy_number }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->insurer }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->received_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->registered_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->acknowledged_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->nature }}
                    </td>
                    {{-- <td class="px-4 py-2 whitespace-nowrap text-sm text-shark text-opacity-75">
                      {{ $complaint->tier_result }}
                    </td> --}}
                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
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
</div>
