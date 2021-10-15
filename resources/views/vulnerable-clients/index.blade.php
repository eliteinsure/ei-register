<x-app-layout>
  @section('title', 'Vulnerable Clients')

  <x-slot name="header">
    <x-page-header>
      Vulnerable Clients
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('vulnerable-clients.index')
    @livewire('vulnerable-clients.form')
    @livewire('vulnerable-clients.notes')
  </x-page-wrap>
</x-app-layout>
