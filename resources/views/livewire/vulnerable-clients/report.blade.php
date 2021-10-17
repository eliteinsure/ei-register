<div>
  <x-jet-button type="button" wire:click="show()">
    Generate Report
  </x-jet-button>

  <x-form-modal wire:model="showModal" submit="generate" focusable>
    <x-slot name="title">Generate Report</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="issued_from" value="Date Issued From" />
          <x-date-picker id="issued_from" wire:model.defer="input.issued_from" />
          <x-jet-input-error for="issued_from" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="issued_to" value="Date Issued To" />
          <x-date-picker id="issued_to" wire:model.defer="input.issued_to" />
          <x-jet-input-error for="issued_to" class="mt-2" />
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
    <x-slot name="title">Vulnerable Client Report</x-slot>
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
