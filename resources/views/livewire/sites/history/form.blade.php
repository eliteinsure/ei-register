<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="updates" value="Updates" />
          <x-textarea id="updates" class="block w-full mt-1 resize-y" wire:model.defer="input.updates" />
          <x-jet-input-error for="updates" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="update_date" value="Date Updated" />
          <x-date-picker id="update_date" wire:model.defer="input.update_date" />
          <x-jet-input-error for="update_date" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="developer" value="Developer" />
          <x-lookup.text id="developer" wire:model.defer="input.developer" />
          <x-jet-input-error for="developer" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="version" value="Version" />
          <x-jet-input type="text" id="version" class="block w-full mt-1" wire:model.defer="input.version" />
          <x-jet-input-error for="version" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">{{ isset($historyId) ? 'Update' : 'Register' }}</x-jet-button>
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
