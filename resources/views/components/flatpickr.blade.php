@props([
    'options' => [
        'allowInput' => true,
        'altFormat' => 'd/m/Y',
        'altInput' => true,
    ],
])

@php
$id = 'Flatpickr_' . $attributes->get('id', md5('flatpickr'));
@endphp

<div wire:ignore x-data="{{ $id }}">
  <x-jet-input
    {{ $attributes->merge(['type' => 'text', 'class' => 'block w-full mt-1', 'x-ref' => 'input']) }} />
</div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('alpine:init', () => {
      Alpine.data('{{ $id }}', () => ({
        init() {
          document.addEventListener('DOMContentLoaded', () => {
            flatpickr(this.$refs.input, @json($options));
          });
        }
      }));
    });
  </script>
@endpush
