<div>
  <x-form-modal wire:model="showModal" submit="submit" max-width="3xl" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
    <x-slot name="content">
      <div class="md:flex md:space-x-6">
        <div class="md:w-1/2">
          <div class="space-y-6">
            <div class="form-input">
              <x-jet-label for="complainant" value="Complainant Name" />
              <x-lookup.text id="complainant" wire:model.defer="input.complainant" />
              <x-jet-input-error for="complainant" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="label" value="Label" />
              <x-select id="label" class="block w-full mt-1" wire:model.lazy="input.label"
                :options="$options['labels']" />
              <x-jet-input-error for="label" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="complainee" value="Complainee Name" />
              <x-lookup.text id="complainee" wire:model.defer="input.complainee" />
              <x-jet-input-error for="complainee" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="complainee_label" value="Label" />
              <x-select id="complainee_label" class="block w-full mt-1" wire:model.lazy="input.complainee_label"
                :options="$options['labels']" />
              <x-jet-input-error for="complainee_label" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="policy_number" value="Policy Number" />
              <x-jet-input type="text" id="policy_number" class="block w-full mt-1"
                wire:model.defer="input.policy_number" />
              <x-jet-input-error for="policy_number" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="insurer" value="Insurer" />
              <x-select id="insurer" class="block w-full mt-1" wire:model.defer="input.insurer"
                :options="$options['insurers']" />
              <x-jet-input-error for="insurer" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="received_at" value="Date Received" />
              <x-date-picker id="received_at" wire:model.defer="input.received_at" />
              <x-jet-input-error for="received_at" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="acknowledged_at" value="Date Acknowledged" />
              <x-date-picker id="acknowledged_at" wire:model.defer="input.acknowledged_at" />
              <x-jet-input-error for="acknowledged_at" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="nature" value="Nature of Complaint" />
              <x-select id="nature" class="block w-full mt-1" wire:model.defer="input.nature"
                :options="$options['natures']" />
              <x-jet-input-error for="nature" class="mt-2" />
            </div>
          </div>
        </div>
        <div class="md:w-1/2">
          <div class="space-y-6">
            <div class="form-input">
              <x-jet-label for="tier" value="Tier" />
              <x-select id="tier" class="block w-full mt-1" wire:model.defer="input.tier.tier" :options="$options['tier.tier']" />
              <x-jet-input-error for="tier.tier" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="handler" value="Handled By" />
              <x-select id="handler" class="block w-full mt-1" wire:model.lazy="input.tier.handler" :options="$options['tier.handlers']" />
              <x-jet-input-error for="tier.handler" class="mt-2" />
            </div>
            <div class="form-input {{ $input['tier']['handler'] ? null : 'hidden' }}">
              <x-jet-label for="adviser" value="{{ $input['tier']['handler'] }}" />
              <x-lookup.select id="adviser" wire:model.defer="input.tier.adviser_id" />
              <x-jet-input-error for="tier.adviser_id" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier_status" value="Status" />
              <x-select id="tier_status" class="block w-full mt-1" wire:model="input.tier.status"
                :options="$options['tier.status']" />
              <x-jet-input-error for="tier.status" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="completed_at" value="Date Completed" />
              <x-date-picker id="completed_at" wire:model.defer="input.tier.completed_at" />
              <x-jet-input-error for="tier.completed_at" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier_notes" value="Notes" />
              <x-textarea id="tier_notes" class="block w-full mt-1 resize-y" wire:model.defer="tierNotesInput.notes" />
              <x-jet-input-error for="notes" class="mt-2" />

              @if ($complaintId)
                <div class="flex items-center justify-between mt-1">
                  @if (auth()->user()->hasRole('admin'))
                    <x-jet-button type="button" wire:click="createTierNote">Add</x-jet-button>
                    <x-jet-action-message on="tierNotesCreated">Notes added.</x-jet-action-message>
                  @endif
                  <x-jet-button type="button" wire:click="$emitTo('complaints.notes', 'show', {{ $complaintId }})">View Notes</x-jet-button>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">{{ isset($complaintId) ? 'Update' : 'Register' }}</x-jet-button>
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
