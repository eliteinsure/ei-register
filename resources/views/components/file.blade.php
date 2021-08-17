@props(['id', 'model', 'accept' => '*'])

<label
  x-data="{ isUploading: false, progress: 0 }"
  x-on:livewire-upload-start="isUploading = true"
  x-on:livewire-upload-finish="isUploading = false"
  x-on:livewire-upload-error="isUploading = false"
  x-on:livewire-upload-progress="progress = $event.detail.progress"
  class="cursor-pointer overflow-hidden">

  <div {!! $attributes->merge(['class' => 'px-3 py-2 border border-gray-300 focus:border-dsgreen focus:ring focus:ring-lmara focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    <div x-show="!isUploading" class="whitespace-nowrap">
      {{ $this->$model ? Str::of($this->$model->getClientOriginalName())->limit(25) : 'Upload File...' }}
    </div>

    <div x-show="isUploading" class="-mx-3 -my-2">
      <div class="overflow-hidden flex rounded bg-white w-full">
        <div x-bind:style="{width: progress + '%'}"
          class="px-3 py-2 shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-lmara">
          &nbsp;
        </div>
      </div>
    </div>
  </div>

  <input type="file" id="{{ $id }}" wire:model.defer="{{ $model }}" class="sr-only"
    accept="{{ $accept }}">
</label>
