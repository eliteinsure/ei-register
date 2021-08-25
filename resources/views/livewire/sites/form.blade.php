<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="name" value="Name" />
          <x-jet-input type="text" id="name" class="block w-full mt-1" wire:model.defer="input.name" />
          <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="url" value="Link" />
          <x-jet-input type="text" id="url" class="block w-full mt-1" wire:model.defer="input.url" />
          <x-jet-input-error for="url" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="launch_date" value="Date Launched" />
          <x-date-picker id="launch_date" wire:model.defer="input.launch_date" />
          <x-jet-input-error for="launch_date" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="update_date" value="Date Last Updated" />
          <x-date-picker id="update_date" wire:model.defer="input.update_date" />
          <x-jet-input-error for="update_date" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="description" value="Description" />
          <x-textarea id="description" class="block w-full mt-1 resize-y"
            wire:model.defer="input.description" />
          <x-jet-input-error for="description" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">{{ isset($siteId) ? 'Update' : 'Register' }}</x-jet-button>
      @endif
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        @if (auth()->user()->hasRole('admin'))
          Cancel
        @else
          Close
        @endif
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
