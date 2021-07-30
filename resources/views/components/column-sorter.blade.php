@props(['column'])

@php
$sortClasses = [
    '' => 'switch-horizontal',
    'asc' => 'sort-ascending',
    'desc' => 'sort-descending',
];
@endphp

<a wire:click.prevent="sortBy('{{ $column }}')" href="#"
  role="button" class="flex items-center hover:text-lmara">
  {{ $slot }}
  @svg('heroicon-o-' . ($this->sort['column'] == $column ? $sortClasses[$this->sort['direction']] :
  'switch-horizontal'), 'h-4 w-4 flex-shrink-0 ml-2')
</a>
