<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">Update Notes</x-slot>
    <x-slot name="content">
      <div class="space-y-6">
        <div class="form-input">
          <x-jet-label for="created_at" value="Date Added" />
          <x-jet-input type="text" value="{{ $input['created_at'] ? \Illuminate\Support\Carbon::parse($input['created_at'])->format('d/m/Y') : '' }}" :disabled="true" class="block w-full mt-1 bg-gray-100" />
        </div>
        <div class="form-input">
          <x-jet-label for="notes" value="Notes" />
          <x-textarea id="notes" class="block w-full mt-1 resize-y" wire:model.defer="input.notes" />
          <x-jet-input-error for="notes" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      <x-jet-button type="submit">Update</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">
        Cancel
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
