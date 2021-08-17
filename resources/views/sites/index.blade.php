<x-app-layout>
  @section('title', 'Softwares')

  <x-slot name="header">
    <x-page-header>
      Softwares
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('sites.index')
    @livewire('sites.form')
    @livewire('sites.manual')
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
