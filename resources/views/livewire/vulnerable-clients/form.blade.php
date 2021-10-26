<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="client" value="Name" />
          <x-jet-input type="text" id="client" class="block w-full mt-1" wire:model.defer="input.name" />
          <x-jet-input-error for="name" class="mt-2" />
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
          <x-jet-label for="issued_at" value="Date Issued" />
          <x-date-picker id="issued_at" wire:model.defer="input.issued_at" />
          <x-jet-input-error for="issued_at" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="nature" value="Nature" />
          <x-select type="text" id="nature" class="block w-full mt-1" wire:model.defer="input.nature"
            :options="$options['natures']" />
          <x-jet-input-error for="nature" class="mt-2" />
        </div>

        @if (auth()->user()->hasPermissionTo('vulnerable-client-notes'))
          <div class="form-input">
            @if (auth()->user()->hasPermissionTo('vulnerable-client-notes.create'))
              <x-jet-label for="client_notes" value="Notes" />
              <x-textarea id="client_notes" class="block w-full mt-1 resize-y" wire:model.defer="notesInput.notes" />
              <x-jet-input-error for="notes" class="mt-2" />
            @endif

            @if ($clientId)
              <div class="flex items-center justify-between mt-1">
                @if (auth()->user()->hasPermissionTo('vulnerable-client-notes.create'))
                  <x-jet-button type="button" wire:click="createVulnerableClientNote">Add</x-jet-button>
                  <x-jet-action-message on="vulnerableClientNotesCreated">Notes added.</x-jet-action-message>
                @endif

                <x-jet-button type="button" wire:click="$emitTo('vulnerable-clients.notes', 'show', {{ $clientId }})">View Notes</x-jet-button>
              </div>
            @endif
          </div>
        @endif
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->getPermissionNames()->intersect(['vulnerable-clients.creat', 'vulnerable-clients.update'])->count())
        <x-jet-button type="submit">{{ isset($clientId) ? 'Update' : 'Register' }}</x-jet-button>
      @endif
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        @if (auth()->user()->getPermissionNames()->intersect(['vulnerable-clients.creat', 'vulnerable-clients.update'])->count())
          Cancel
        @else
          Close
        @endif
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
