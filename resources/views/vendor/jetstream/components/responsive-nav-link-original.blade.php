@props(['active'])

@php
$classes = $active ?? false ? 'block pl-3 pr-4 py-2 border-l-4 border-dsgreen text-base font-medium text-white bg-lmara focus:outline-none focus:bg-tblue focus:border-shark transition' : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-shark hover:bg-gray-50 hover:border-shark focus:outline-none focus:bg-gray-50 focus:border-shark transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
