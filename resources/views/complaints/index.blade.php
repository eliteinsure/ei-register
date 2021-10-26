<x-app-layout>
  @section('title', 'Complaints')

  <x-slot name="header">
    <x-page-header>
      Complaints
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('complaints.index')
    @livewire('complaints.form')
    @livewire('complaints.notes')
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
