<x-app-layout>
  @section('title', 'Test Upload')

  <x-slot name="header">
    <x-page-header>
      Test Upload
    </x-page-header>
  </x-slot>

  <x-page-wrap>
    <form method="post" enctype="multipart/form-data" action="{{ route('test-upload.store') }}">
      @csrf
      <input type="file" name="file" />

      <x-jet-button type="submit">Submit</x-jet-button>
    </form>
  </x-page-wrap>
</x-app-layout>
