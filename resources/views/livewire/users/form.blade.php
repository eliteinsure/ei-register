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
        <div class="form-input space-y-1">
          <div class="flex items-center justify-between">
            <x-jet-label value="Permissions" />
            <label class="flex items-center">
              <x-jet-checkbox wire:model.lazy="permissionToggle" />
              <span class="ml-2 text-sm text-shark">Toggle All</span>
            </label>
          </div>
          <div class="h-40 max-h-40 overflow-y-scroll p-2 border rounded">
            @foreach (config('services.permissions') as $parentPermissionName => $parentPermission)
              <label class="inline-flex items-center" wire:key={{ $loop->index }}>
                <x-jet-checkbox value="{{ $parentPermissionName }}" wire:model.lazy="input.permissions" wire:change="updatePermissions($event.target.value)" />
                <span class="ml-2 text-sm text-shark">{{ Str::title(Str::replace('-', ' ', $parentPermissionName)) }}</span>
              </label>
              <br>
              @foreach ($parentPermission as $childPermissionName => $childPermission)
                @if (in_array($parentPermissionName, $input['permissions']))
                  <label class="ml-6 inline-flex items-center" wire:key="{{ $loop->parent->index . '.' . $loop->index }}">
                    <x-jet-checkbox value="{{ $parentPermissionName . '.' . $childPermissionName }}" wire:model.defer="input.permissions" />
                    <span class="ml-2 text-sm text-shark">{{ $childPermission }}</span>
                  </label>
                  @if ($loop->last)
                    <br>
                  @endif
                @endif
              @endforeach
            @endforeach
          </div>
          <x-jet-input-error for="permissions" class="mt-2" />
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
