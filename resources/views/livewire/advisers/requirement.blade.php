<div>
  <x-form-modal wire:model="showModal" submit="submit" focusable>
    <x-slot name="title">Adviser Requirements - {{ $adviserId ? $this->adviser->name : null }}</x-slot>
    <x-slot name="content">
      <div class="mb-4">
        <div class="sm:hidden">
          <label for="tabs" class="sr-only">Select a tab</label>
          <select id="tabs" name="tabs"
            class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
            wire:change="$set('currentTab', $event.target.value)">
            @foreach ($tabs as $tabName => $tabLabel)
              <option {{ $tabName == $currentTab ? 'selected' : null }} value="{{ $tabName }}">
                {{ $tabLabel }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="hidden sm:inline-block">
          <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
            @foreach ($tabs as $tabName => $tabLabel)
              <a href="javascript:void(0);"
                class="{{ $tabName == $currentTab ? 'text-tblue' : 'text-shark hover:text-dsgreen' }} {{ $tabName == $firstTab ? 'rounded-l-lg' : null }} {{ $tabName == $lastTab ? 'rounded-r-lg' : null }} group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 flex items-center"
                aria-current="page"
                wire:click="$set('currentTab', '{{ $tabName }}')">
                <span class="w-full">{{ $tabLabel }}</span>
                <span aria-hidden="true"
                  class="{{ $tabName == $currentTab ? 'bg-lmara' : 'bg-transparent' }} absolute inset-x-0 bottom-0 h-0.5"></span>
              </a>
            @endforeach
          </nav>
        </div>
      </div>
      @foreach (config('services.adviser.requirements') as $requirementKey => $requirement)
        <div class="space-y-6 {{ $requirementKey == $currentTab ? 'block' : 'hidden' }}">
          @foreach ($requirement as $subRequirementKey => $subRequirement)
            <div class="form-input">
              <x-jet-label for="{{ $requirementKey . '_' . $subRequirementKey }}"
                value="{{ $subRequirement['label'] }}" />
              @if (is_array($subRequirement['options']))
                <x-select id="{{ $requirementKey . '_' . $subRequirementKey }}" class="block w-full mt-1"
                  :options="$this->getRequirementOptions($requirementKey, $subRequirementKey)"
                  wire:model.defer="input.{{ $requirementKey . '.' . $subRequirementKey }}" />
              @elseif($subRequirement['options'] == 'expiring-date')
                <x-date-picker id="{{ $requirementKey . '_' . $subRequirementKey }}"
                  wire:model.defer="input.{{ $requirementKey . '.' . $subRequirementKey }}" />
              @else
                <x-jet-input type="text" id="{{ $requirementKey . '_' . $subRequirementKey }}"
                  class="block w-full mt-1"
                  wire:model.defer="input.{{ $requirementKey . '.' . $subRequirementKey }}" />
              @endif
              <x-jet-input-error for="{{ $requirementKey . '.' . $subRequirementKey }}"
                class="mt-2" />
            </div>
          @endforeach
        </div>
      @endforeach
    </x-slot>
    <x-slot name="footer">
      @if (auth()->user()->hasRole('admin'))
        <x-jet-button type="submit">Update</x-jet-button>
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
