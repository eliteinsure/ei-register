<x-app-layout>
  @section('title', 'Advisers / Staffs')

  <x-slot name="header">
    <x-page-header>
      Advisers / Staffs
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('advisers.index')
    @livewire('advisers.form')
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
