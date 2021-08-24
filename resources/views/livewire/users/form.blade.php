<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">{{ $this->title }}</x-slot>
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
          <x-jet-label for="password" value="Password" />
          <x-jet-input type="password" id="password" class="block w-full mt-1"
            wire:model.defer="input.password" />
          <x-jet-input-error for="password" class="mt-2" />
        </div>
        <div class="form-input">
          <x-jet-label for="password_confirmation" value="Confirm Password" />
          <x-jet-input type="password" id="password_confirmation" class="block w-full mt-1"
            wire:model.defer="input.password_confirmation" />
        </div>
        <div class="form-input">
          <x-jet-label for="role" value="Role" />
          <x-select id="role" class="block w-full mt-1" wire:model.defer="input.role"
            :options="$roles" />
          <x-jet-input-error for="role" class="mt-2" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      <x-jet-button type="submit">{{ isset($userId) ? 'Update' : 'Register' }}</x-jet-button>
      <x-jet-secondary-button type="button" class="ml-2" wire:click="$set('showModal', false)">Cancel
      </x-jet-secondary-button>
    </x-slot>
  </x-form-modal>
</div>
