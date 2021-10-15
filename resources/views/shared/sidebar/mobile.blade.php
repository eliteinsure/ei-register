<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true" x-show="open">
  <!--
  Off-canvas menu overlay, show/hide based on off-canvas menu state.

  Entering: "transition-opacity ease-linear duration-300"
  From: "opacity-0"
  To: "opacity-100"
  Leaving: "transition-opacity ease-linear duration-300"
  From: "opacity-100"
  To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true" x-show="open"
    x-transaction:enter="transition-opacity ease-linear duration-300"
    x-transaction:enter-start="opacity-0"
    x-transaction:enter-end="opacity-100"
    x-transaction:leave="transition-opacity ease-linear duration-300"
    x-transaction:leave-start="opacity-100"
    x-transaction:leave-end="opacity-0"></div>

  <!--
  Off-canvas menu, show/hide based on off-canvas menu state.

  Entering: "transition ease-in-out duration-300 transform"
    From: "-translate-x-full"
    To: "translate-x-0"
  Leaving: "transition ease-in-out duration-300 transform"
    From: "translate-x-0"
    To: "-translate-x-full"
  -->
  <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white" x-show="open"
    x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">
    <!--
    Close button, show/hide based on off-canvas menu state.

    Entering: "ease-in-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in-out duration-300"
      From: "opacity-100"
      To: "opacity-0"
    -->
    <div class="absolute top-0 right-0 -mr-12 pt-2" x-show="open"
      x-transition:enter="ease-in-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in-out duration-300"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0">
      <button
        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
        x-on:click="open = false">
        <span class="sr-only">Close sidebar</span>
        <!-- Heroicon name: outline/x -->
        <x-heroicon-o-x class="h-6 w-6 text-white" />
      </button>
    </div>

    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
      <div class="flex-shrink-0 flex items-center px-4">
        <x-jet-application-logo class="h-8 object-contain" />
      </div>
      <nav class="mt-5 px-2 space-y-1">
        <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
        <x-jet-responsive-nav-link href="{{ route('dashboard') }}"
          :active="request()->routeIs('dashboard')" icon="heroicon-o-home">
          Dashboard
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('complaints.index') }}"
          :active="request()->routeIs('complaints.index')" icon="heroicon-o-shield-exclamation">
          Complaints
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('claims.index') }}"
          :active="request()->routeIs('claims.index')" icon="heroicon-o-clipboard-list">
          Claims
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('cir.login') }}" icon="heroicon-o-document-report"
          :active="false" target="_blank">
          CIR
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('vulnerable-clients.index') }}" icon="heroicon-o-exclamation" :active="request()->routeis('vulnerable-clients.index')">
          Vulnerable Clients
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('sites.index') }}"
          :active="request()->routeIs('sites.index')" icon="heroicon-o-globe">
          Software
        </x-jet-responsive-nav-link>

        <x-jet-responsive-nav-link href="{{ route('advisers.index') }}"
          :active="request()->routeIs('advisers.index')" icon="heroicon-o-users">
          Advisers / Staffs
        </x-jet-responsive-nav-link>

        @role('admin')
          <x-jet-responsive-nav-link href="{{ route('users.index') }}"
            :active="request()->routeIs('users.index')" icon="heroicon-o-user-circle">
            Users
          </x-jet-responsive-nav-link>
        @endrole

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-jet-responsive-nav-link href="{{ route('logout') }}" :active="false" icon="heroicon-o-logout"
            onclick="event.preventDefault(); this.closest('form').submit();">
            Log Out
          </x-jet-responsive-nav-link>
        </form>
      </nav>
    </div>
    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
      <a href="{{ route('profile.show') }}" class="flex-shrink-0 group block">
        <div class="flex items-center">
          <div>
            <img class="inline-block h-10 w-10 rounded-full"
              src="{{ Auth::user()->profile_photo_url }}"
              alt="{{ Auth::user()->name }}">
          </div>
          <div class="ml-3">
            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
              {{ Auth::user()->name }}
            </p>
            <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">
              View profile
            </p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="flex-shrink-0 w-14">
    <!-- Force sidebar to shrink to fit close icon -->
  </div>
</div>
