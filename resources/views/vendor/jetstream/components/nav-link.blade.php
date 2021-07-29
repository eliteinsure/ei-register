@props(['active'])

@php
$classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-lmara text-sm font-medium leading-5 text-lmara focus:outline-none focus:border-dsgreen transition' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-shark hover:border-gray-300 focus:outline-none focus:text-shark focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
