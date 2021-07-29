@props(['active', 'icon'])

@php
$classes = 'group flex items-center px-2 py-2 text-sm font-medium rounded-md transition ' . ($active ?? false ? 'bg-lmara text-white' : 'text-tblue hover:bg-dsgreen hover:text-white');
$iconClasses = 'mr-3 flex-shrink-0 h-6 w-6 transition ' . ($active ?? false ? 'text-white' : 'text-tblue group-hover:text-white');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  <x-nav-icon name="{{ $icon }}" class="{{ $iconClasses }}" />
  {{ $slot }}
</a>
