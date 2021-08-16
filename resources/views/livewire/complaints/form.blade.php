<div>
  <x-form-modal wire:model="showModal" submit="submit" max-width="5xl" focusable>
    <x-slot name="title">{{ isset($complaintId) ? 'Complaint Details' : 'Register a Complaint' }}</x-slot>
    <x-slot name="content">
      <div class="md:flex md:space-x-6">
        <div class="md:w-1/3">
          <div class="space-y-6">
            <div class="form-input">
              <p class="text-sm font-medium text-shark mb-2">&nbsp;</p>
              <x-jet-label for="complainant" value="Complainant Name" />
              <x-lookup.text id="complainant" wire:model.defer="input.complainant" />
              <x-jet-input-error for="complainant" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="label" value="Label" />
              <x-select id="label" class="block w-full mt-1" wire:model.defer="input.label"
                :options="$options['labels']" />
              <x-jet-input-error for="label" class="mt-2" />
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
        <div class="md:w-1/3">
          <div class="space-y-6">
            <div class="form-input">
              <p class="text-sm font-medium text-shark mt-6 md:mt-0 mb-2">TIER 1</p>
              <x-jet-label for="adviser" value="Adviser" />
              <x-lookup.select id="adviser" wire:model.defer="input.tier.1.adviser_id" />
              <x-jet-input-error for="tier.1.adviser_id" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier1_handed_over_at" value="Date Handed Over" />
              <x-date-picker id="tier1_handed_over_at" wire:model.defer="input.tier.1.handed_over_at" />
              <x-jet-input-error for="tier.1.handed_over_at" class="mt-2" />
            </div>
            <div class="form-input {{ $complaintId ? '' : 'hidden' }}">
              <x-jet-label for="tier1_status" value="Status" />
              <x-select id="tier1_status" class="block w-full mt-1" wire:model="input.tier.1.status"
                :options="$options['tier.1.status']" />
              <x-jet-input-error for="tier.1.status" class="mt-2" />
            </div>
            <div class="form-input {{ $complaintId ? '' : 'hidden' }}">
              <x-jet-label for="stated_at" value="Date Stated" />
              <x-date-picker id="stated_at" wire:model.defer="input.tier.1.stated_at" />
              <x-jet-input-error for="tier.1.stated_at" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier1_notes" value="Notes" />
              <x-textarea id="tier1_notes" class="block w-full mt-1 resize-y"
                wire:model.defer="input.tier.1.notes" />
              <x-jet-input-error for="tier.1.notes" class="mt-2" />
            </div>
          </div>
        </div>
        <div class="md:w-1/3">
          <div
            class="space-y-6 {{ ($input['tier'][1]['status'] ?? '') == 'Failed' ? 'block' : 'hidden' }}">
            <div class="form-input">
              <p class="text-sm font-medium text-shark mt-6 md:mt-0 mb-2">TIER 2</p>
              <x-jet-label for="staff_position" value="Staff" />
              <x-select id="staff_position" class="block w-full mt-1"
                wire:model.defer="input.tier.2.staff_position"
                :options="$options['tier.2.staffPositions']" />
              <x-jet-input-error for="tier.2.staff_position" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="staff" value="Staff Name" />
              <x-lookup.text id="staff" wire:model.defer="input.tier.2.staff_name" />
              <x-jet-input-error for="tier.2.staff_name" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier2_handed_over_at" value="Date Handed Over" />
              <x-date-picker id="tier2_handed_over_at" wire:model.defer="input.tier.2.handed_over_at" />
              <x-jet-input-error for="tier.2.handed_over_at" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier2_status" value="Status" />
              <x-select id="tier2_status" class="block w-full mt-1" wire:model.defer="input.tier.2.status"
                :options="$options['tier.2.status']" />
              <x-jet-input-error for="tier.2.status" class="mt-2" />
            </div>
            <div class="form-input">
              <x-jet-label for="tier2_notes" value="Notes" />
              <x-textarea id="tier2_notes" class="block w-full mt-1 resize-y"
                wire:model.defer="input.tier.2.notes" />
              <x-jet-input-error for="tier.2.notes" class="mt-2" />
            </div>
          </div>
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      @role('admin')
      <x-jet-button type="submit">{{ isset($complaintId) ? 'Update' : 'Register' }}</x-jet-button>
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
