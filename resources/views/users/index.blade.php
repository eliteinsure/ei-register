<x-app-layout>
  @section('title', 'Users')

  <x-slot name="header">
    <x-page-header>
      Users
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('users.index')
    @livewire('users.form')
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
