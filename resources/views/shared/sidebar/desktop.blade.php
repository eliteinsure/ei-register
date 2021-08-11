<!-- Static sidebar for desktop -->
<div class="hidden md:flex md:flex-shrink-0">
  <div class="flex flex-col w-64">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex flex-col h-0 flex-1 border-r border-gray-200 bg-white">
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <x-jet-application-logo class="h-8 object-contain" />
        </div>

        <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
          <p class="text-center text-tblue text-lg font-semibold tracking-widest mb-5">REGISTERS</p>

          <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
            icon="heroicon-o-home">
            Dashboard
          </x-jet-nav-link>

          <x-jet-nav-link href="{{ route('complaints.index') }}"
            :active="request()->routeIs('complaints.index')"
            icon="heroicon-o-shield-exclamation">
            Complaints
          </x-jet-nav-link>

          <x-jet-nav-link href="{{ route('advisers.index') }}"
            :active="request()->routeIs('advisers.index')"
            icon="heroicon-o-user-circle">
            Advisers
          </x-jet-nav-link>

          @role('admin')
            <x-jet-nav-link href="{{ route('users.index') }}"
              :active="request()->routeIs('users.index')"
              icon="heroicon-o-users">
              Users
            </x-jet-nav-link>
          @endrole

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-nav-link href="{{ route('logout') }}" :active="false" icon="heroicon-o-logout"
              onclick="event.preventDefault(); this.closest('form').submit();">
              Log Out
            </x-jet-nav-link>
          </form>
        </nav>

      </div>
      <div class="flex-shrink-0 flex flex-col border-t border-gray-200">
        <a href="{{ route('profile.show') }}" class="flex-shrink-0 w-full group block p-4">
          <div class="flex items-center">
            <div>
              <img class="inline-block h-9 w-9 rounded-full"
                src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}">
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-dsgreen group-hover:text-lmara">
                {{ Auth::user()->name }}
              </p>
              <p class="text-xs font-medium text-shark group-hover:text-tblue">
                View profile
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
