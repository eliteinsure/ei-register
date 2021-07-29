@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-shark']) }}>
  {{ $value ?? $slot }}
</label>
