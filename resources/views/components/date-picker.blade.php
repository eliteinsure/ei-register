@props([
    'options' => [
        'allowInput' => true,
        'altFormat' => 'd/m/Y',
        'altInput' => true,
    ],
])

<div wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    instance: undefined
  }"
  x-init="
    instance = flatpickr($refs.input, {{ json_encode($options) }});

    $watch('value', value => {
      instance.setDate(value, true);
    });
  ">
  <x-jet-input x-ref="input" x-bind:value="value"
    {{ $attributes->merge(['type' => 'text', 'class' => 'placeholder-gray-400 block w-full mt-1', 'placeholder' => 'DD/MM/YYYY']) }} />
</div>
