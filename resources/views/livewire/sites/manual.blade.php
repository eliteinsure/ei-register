<div>
  <x-jet-dialog-modal wire:model="showModal" focusable>
    <x-slot name="title">Software Manuals</x-slot>
    <x-slot name="content">
      @if (auth()->user()->hasRole('admin'))
        <form wire:submit.prevent="submit">
          <div class="md:flex md:items-start md:-mx-3 space-y-6 md:space-y-0">
            <div class="form-input md:flex-1 md:px-3">
              <x-jet-input type="text" id="file_namename" class="block w-full" placeholder="Manual Name"
                wire:model.defer="input.name" />
              <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="form-input md:flex-1 md:px-3">
              <x-file id="file" model="file" class="block w-full"
                accept="{{ implode(',', config('services.site.manual.mimetypes')) }}" />
              <x-jet-input-error for="file" class="mt-2" />
            </div>
            <div class="md:flex-shrink-0 md:px-3">
              <x-jet-button type="submit">Add Manual</x-jet-button>
            </div>
          </div>
        </form>
      @endif

      <ul class="bg-white shadow overflow-hidden sm:rounded-md mt-6 divide-y divide-gray-200">
        @forelse ($manuals as $manual)
          <li class="flex items-center hover:bg-gray-50 px-4 py-2">
            <a href="{{ route('sites.manuals.show', ['site' => $siteId, 'manual' => $manual->id]) }}"
              class="flex-1 text-sm font-medium text-tblue flex items-center" target="_blank">
              @svg($manual->file_icon, 'flex-shrink-0 h-6 w-6 text-tblue')
              <span class="ml-4 flex-1">{{ $manual->name }}</span>
            </a>
            @if (auth()->user()->hasRole('admin'))
              <div class="ml-4 flex-shrink-0">
                <button type="button" class="text-red-600 hover:text-red-700" title="Delete"
                  wire:click="confirmDelete({{ $manual->id }})">
                  <x-heroicon-o-trash class="h-6 w-6" />
                </button>
              </div>
            @endif
          </li>
        @empty
          <li class="px-4 py-4 sm:px-6">No available software manuals.</li>
        @endforelse
      </ul>
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        Close
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-dialog-modal>

  <x-jet-confirmation-modal wire:model="showDelete">
    <x-slot name="title">Delete Software Manual</x-slot>
    <x-slot name="content">Are you sure to delete this software manual?</x-slot>
    <x-slot name="footer">
      <x-jet-button type="button" wire:click="delete">Yes</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showDelete', false)">No
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-confirmation-modal>
</div>
