<nav
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="{ 'shadow-lg bg-gradient-to-r from-blue-100 via-white to-blue-100': scrolled }"
    class="bg-white border-b border-gray-100 fixed top-0 inset-x-0 z-50 transition-all duration-500"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center animate-fade-in">
            <!-- Logo + Navigation Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo hkbp.png') }}" alt="Logo HKBP"
                             class="h-14 w-auto object-contain mr-8 drop-shadow-md hover:scale-105 transition-transform duration-300" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-10 items-center ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profilegereja')" :active="request()->routeIs('profilegereja')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Profil Gereja') }}
                    </x-nav-link>
                    <x-nav-link :href="route('jadwal')" :active="request()->routeIs('jadwal')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Jadwal') }}
                    </x-nav-link>
                    <x-nav-link :href="route('warta')" :active="request()->routeIs('warta')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Warta') }}
                    </x-nav-link>
                    <x-nav-link :href="route('layanan')" :active="request()->routeIs('layanan')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Layanan Gereja') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pemberitahuan')" :active="request()->routeIs('pemberitahuan')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Pemberitahuan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('datajemaat')" :active="request()->routeIs('datajemaat')" class="hover:text-blue-700 transition duration-300 hover:scale-105">
                        {{ __('Data Jemaat') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if(auth()->check())
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-300">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-300">
                                Login
                            </a>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-gray-400 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden transition-all duration-300 bg-white">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profilegereja')" :active="request()->routeIs('profilegereja')">
                {{ __('Profil Gereja') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jadwal')" :active="request()->routeIs('jadwal')">
                {{ __('Jadwal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('warta')" :active="request()->routeIs('warta')">
                {{ __('Warta') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('layanan')" :active="request()->routeIs('layanan')">
                {{ __('Layanan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pemberitahuan')" :active="request()->routeIs('pemberitahuan')">
                {{ __('Pemberitahuan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('datajemaat')" :active="request()->routeIs('datajemaat')">
                {{ __('Data Jemaat') }}
            </x-responsive-nav-link>
        

            @auth
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endauth
        </div>
    </div>
</nav>

<style>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fade-in 0.6s ease-out both;
}
</style>