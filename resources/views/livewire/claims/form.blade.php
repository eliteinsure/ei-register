<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="client" value="Client Name" />
          <x-lookup.text id="client" wire:model.defer="input.client_name" />
          <x-jet-input-error for="client_name" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="insurer" value="Insurer" />
          <x-select type="text" id="insurer" class="block w-full mt-1" wire:model.defer="input.insurer"
            :options="$options['insurers']" />
          <x-jet-input-error for="insurer" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="policy_number" value="Policy Number" />
          <x-jet-input type="text" id="policy_number" class="block w-full mt-1"
            wire:model.defer="input.policy_number" />
          <x-jet-input-error for="policy_number" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="nature" value="Nature" />
          <x-select type="text" id="nature" class="block w-full mt-1" wire:model.defer="input.nature"
            :options="$options['natures']" />
          <x-jet-input-error for="nature" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="type" value="Type" />
          <x-lookup.multi id="type" wire:model.defer="input.type" :options="$options['types']" />
          <x-jet-input-error for="type" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="status" value="Status" />
          <x-select type="text" id="status" class="block w-full mt-1" wire:model.defer="input.status"
            :options="$options['status']" />
          <x-jet-input-error for="status" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">{{ isset($claimId) ? 'Update' : 'Register' }}</x-jet-button>
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
