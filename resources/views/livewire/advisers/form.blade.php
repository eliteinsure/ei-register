<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ isset($adviserId) ? 'Adviser Details' : 'Create a New Adviser' }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
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
        <div class="form-input">
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
        <div class="form-input">
          <x-jet-label for="address" value="Address" />
          <x-jet-input type="text" id="address" class="block w-full mt-1" wire:model.defer="input.address" />
          <x-jet-input-error for="address" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="fap_name" value="FAP Name" />
          <x-jet-input type="text" id="fap_name" class="block w-full mt-1"
            wire:model.defer="input.fap_name" />
          <x-jet-input-error for="fap_name" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="fap_email" value="FAP Email" />
          <x-jet-input type="email" id="fap_email" class="block w-full mt-1"
            wire:model.defer="input.fap_email" />
          <x-jet-input-error for="fap_email" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="fap_fsp_no" value="FAP FSP Number" />
          <x-jet-input type="text" id="fap_fsp_no" class="block w-full mt-1"
            wire:model.defer="input.fap_fsp_no" />
          <x-jet-input-error for="fap_fsp_no" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="fap_contact_number" value="FAP Contact Number" />
          <x-jet-input type="text" id="fap_contact_number" class="block w-full mt-1"
            wire:model.defer="input.fap_contact_number" />
          <x-jet-input-error for="fap_contact_number" class="mt-2" />
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
      @role('admin')
      <x-jet-button type="submit">{{ isset($adviserId) ? 'Update' : 'create' }}</x-jet-button>
      @endrole
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        @role('admin')
          Cancel
        @else
          Close
        @endrole
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
