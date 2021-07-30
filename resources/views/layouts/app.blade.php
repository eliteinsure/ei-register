<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @livewireStyles

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
  <x-jet-banner />

  <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ open: false }">
    @include('shared.sidebar.mobile')
    @include('shared.sidebar.desktop')

    <div class="flex flex-col w-0 flex-1 overflow-hidden">
      <div
        class="md:hidden flex items-center justify-between px-1 pt-1 sm:px-3 sm:pt-3 border-b border-gray-200">
        <button
          class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-lmara hover:text-tblue focus:outline-none focus:ring-2 focus:ring-inset focus:ring-lmara"
          @click="open = true">
          <span class="sr-only">Open sidebar</span>
          <!-- Heroicon name: outline/menu -->
          <x-heroicon-o-menu class="h-6 w-6" />
        </button>
        <div class="flex items-center space-x-2">
          <x-jet-application-mark class="block h-6 w-auto object-contain" />
          <p class="text-center text-tblue text-lg font-semibold tracking-widest">REGISTERS</p>
        </div>
        <div class="-mr-0.5 -mt-0.5 h-12 w-12">&nbsp;</div>
      </div>
      <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
        <div class="py-6">
          @if (isset($header))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
              {{ $header }}
            </div>
          @endif
          {{ $slot }}
        </div>
      </main>
    </div>
  </div>

  @stack('modals')

  @livewireScripts

</body>

</html>
