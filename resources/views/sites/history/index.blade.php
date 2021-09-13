<x-app-layout>
  @section('title', 'Software History')

  <x-slot name="header">
    <x-page-header>
      <a href="{{ route('sites.index') }}" class="underline hover:text-gray-900">Softwares</a> / {{ $site->name  }} - Software History
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    @livewire('sites.history.index', ['siteId' => $site->id])
    @livewire('sites.history.form', ['siteId' => $site->id])
    <x-focus-error />
  </x-page-wrap>
</x-app-layout>
