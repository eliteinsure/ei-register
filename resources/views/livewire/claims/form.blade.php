<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="client" value="Client Name" />
          <x-jet-input type="text" id="client" class="block w-full mt-1" wire:model.defer="input.client_name" />
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
          <x-jet-label for="adviser" value="Adviser" />
          <x-lookup.select id="adviser" wire:model.defer="input.adviser_id" />
          <x-jet-input-error for="adviser_id" class="mt-2" />
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

        @if (auth()->user()->hasPermissionTo('claim-notes'))
          <div class="form-input">
            @if (auth()->user()->hasPermissionTo('claim-notes.create'))
              <x-jet-label for="claim_notes" value="Notes" />
              <x-textarea id="claim_notes" class="block w-full mt-1 resize-y" wire:model.defer="notesInput.notes" />
              <x-jet-input-error for="notes" class="mt-2" />
            @endif

            @if ($claimId)
              <div class="flex items-center justify-between mt-1">
                @if (auth()->user()->hasPermissionTo('claim-notes.create'))
                  <x-jet-button type="button" wire:click="createClaimNote">Add</x-jet-button>
                  <x-jet-action-message on="claimNotesCreated">Notes added.</x-jet-action-message>
                @endif
                <x-jet-button type="button" wire:click="$emitTo('claims.notes', 'show', {{ $claimId }})">View Notes</x-jet-button>
              </div>
            @endif
          </div>
        @endif
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->getPermissionNames()->intersect(['claims.create', 'claims.update'])->count())
        <x-jet-button type="submit">{{ isset($claimId) ? 'Update' : 'Register' }}</x-jet-button>
      @endif
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        @if (auth()->user()->getPermissionNames()->intersect(['claims.create', 'claims.update'])->count())
          Cancel
        @else
          Close
        @endif
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
