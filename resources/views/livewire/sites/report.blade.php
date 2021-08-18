<div>
  <x-jet-button type="button" wire:click="show()">
    Generate Report
  </x-jet-button>

  <x-form-modal wire:model="showModal" submit="generate" focusable>
    <x-slot name="title">Generate Report</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="launch_from" value="Date Launched From" />
          <x-date-picker id="launch_from" wire:model.defer="input.launch_from" />
          <x-jet-input-error for="launch_from" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="launch_to" value="Date Launched To" />
          <x-date-picker id="launch_to" wire:model.defer="input.launch_to" />
          <x-jet-input-error for="launch_to" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="update_from" value="Date Last Updated From" />
          <x-date-picker id="update_from" wire:model.defer="input.update_from" />
          <x-jet-input-error for="update_from" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="update_to" value="Date Last Updated To" />
          <x-date-picker id="update_to" wire:model.defer="input.update_to" />
          <x-jet-input-error for="update_to" class="mt-2" />
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
    <x-slot name="title">Software Report</x-slot>
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
