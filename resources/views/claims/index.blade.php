<x-app-layout>
  @section('title', 'Claims')

  <x-slot name="header">
    <x-page-header>
      Claims
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('claims.index')
    @livewire('claims.form')
    @livewire('claims.notes')
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
