<x-app-layout>
  @section('title', 'Dashboard')

    <x-slot name="header">
      <x-page-header>
        Dashboard
      </x-page-header>
    </x-slot>

    <x-page-wrap>
      {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <x-jet-welcome />
      </div> --}}

      {{-- <div class="space-y-6">
        <label class="flex items-center">
          <x-jet-checkbox />
          <span class="ml-2">Checkbox</span>
        </label>
        <div class="flex items-center space-x-4">
          <x-jet-secondary-button>
            Secondary Button
          </x-jet-secondary-button>
          <x-jet-button>
            Primary Button
          </x-jet-button>
        </div>
        <div>
          @svg('heroicon-o-home', 'h-4 w-4')
        </div>
      </div> --}}

      Welcome {{ auth()->user()->name }}
    </x-page-wrap>
  </x-app-layout>
