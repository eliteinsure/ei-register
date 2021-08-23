<div>
  <x-jet-button type="button" wire:click="show()">
    Generate Report
  </x-jet-button>

  <x-form-modal wire:model="showModal" submit="generate" focusable>
    <x-slot name="title">Generate Report</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="created_from" value="Date created From" />
          <x-date-picker id="created_from" wire:model.defer="input.created_from" />
          <x-jet-input-error for="created_from" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="created_to" value="Date created To" />
          <x-date-picker id="created_to" wire:model.defer="input.created_to" />
          <x-jet-input-error for="created_to" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      <x-jet-button type="submit">Generate</x-jet-button>
      <x-jet-secondary-button type="button" wire:click="$set('showModal', false)">Cancel
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>

  <x-focus-error />

  <x-jet-dialog-modal wire:model="showPdf" max-width="5xl" focusable>
    <x-slot name="title">Claim Report</x-slot>
    <x-slot name="content">
      <iframe src="{{ $pdfUrl }}" class="w-full" style="height: 600px;"></iframe>
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button type="button" wire:click="$set('showPdf', false)">
        Close
      </x-jet-secondary-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>
