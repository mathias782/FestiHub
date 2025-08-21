<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto text-gray-800" />
                    </a>
                </div>

                <!-- Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                        Events
                    </x-nav-link>
                    <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.*')">
                        FAQ
                    </x-nav-link>
                    <x-nav-link :href="route('contact.create')" :active="request()->routeIs('contact.*')">
                        Contact
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        Users
                    </x-nav-link>

                    @if(auth()->user()?->is_admin)
                        <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                            Admin: Events
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            Admin: Users
                        </x-nav-link>
                        <x-nav-link :href="route('admin.faq.index')" :active="request()->routeIs('admin.faq.*')">
                            Admin: FAQ
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition">
                                <div>{{ auth()->user()->username ?? auth()->user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path
                                            d="M5.516 7.548L10 12.032l4.484-4.484 1.032 1.032L10 14.096 4.484 8.58z"/></svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">
                                Dashboard
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900">Sign up</a>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                Events
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.*')">
                FAQ
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.create')" :active="request()->routeIs('contact.*')">
                Contact
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                Users
            </x-responsive-nav-link>

            @if(auth()->user()?->is_admin)
                <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                    Admin: Events
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    Admin: Users
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.faq.index')" :active="request()->routeIs('admin.faq.*')">
                    Admin: FAQ
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        {{ auth()->user()->username ?? auth()->user()->name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Sign up</x-responsive-nav-link>
                </div>
            </div>
        @endguest
    </div>
</nav>
