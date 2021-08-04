@props(['id' => null, 'maxWidth' => null, 'submit'])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
  <form wire:submit.prevent="{{ $submit }}">
    <div class="px-6 py-4">
      <div class="text-lg">
        {{ $title }}
      </div>
      <div class="mt-4">
        {{ $content }}
      </div>
    </div>
    <div class="px-6 py-4 bg-gray-100 text-right">
      {{ $footer }}
    </div>
  </form>
</x-jet-modal>
