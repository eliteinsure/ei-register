<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="type" value="Type" />
          <x-select id="type" class="block w-full mt-1" :options="$types" wire:model.lazy="input.type" />
          <x-jet-input-error for="type" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="name" value="Name" />
          <x-jet-input type="text" id="name" class="block w-full mt-1" wire:model.defer="input.name" />
          <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="email" value="Email" />
          <x-jet-input type="email" id="email" class="block w-full mt-1" wire:model.defer="input.email" />
          <x-jet-input-error for="email" class="mt-2" />
        </div>
        <div class="form-input {{ ($input['type'] ?? '') == 'Adviser' ? 'block' : 'hidden' }}">
          <x-jet-label for="fsp_no" value="FSP Number" />
          <x-jet-input type="text" id="fsp_no" class="block w-full mt-1" wire:model.defer="input.fsp_no" />
          <x-jet-input-error for="fsp_no" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="contact_number" value="Contact Number" />
          <x-jet-input type="text" id="contact_number" class="block w-full mt-1"
            wire:model.defer="input.contact_number" />
          <x-jet-input-error for="contact_number" class="mt-2" />
        </div>
        @if ($adviserId)
          <div class="form-input">
            <x-jet-label for="status" value="Status" />
            <x-select id="status" class="block w-full mt-1" :options="$status"
              wire:model.defer="input.status" />
            <x-jet-input-error for="status" class="mt-2" />
          </div>
        @endif
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">{{ isset($adviserId) ? 'Update' : 'Register' }}</x-jet-button>
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
