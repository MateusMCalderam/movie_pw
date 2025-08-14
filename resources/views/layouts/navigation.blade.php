<nav x-data="{ open: false }" class="bg-black/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo + Título -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <div class="text-3xl font-bold glow-text">🎬 Infoflix</div>
            </a>
            <div class="film-strip w-20 hidden md:block"></div>
        </div>

        <!-- Links Desktop -->
        <div class="hidden md:flex space-x-6 text-gray-300">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-red-500 transition-colors">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')" class="hover:text-red-500 transition-colors">
                Filmes
            </x-nav-link>
        </div>

        <div class="hidden md:flex items-center space-x-4">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-gray-300 hover:text-red-500 transition-colors">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 011.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}">
                    <button class="bg-gradient-to-r from-red-700 to-red-500 px-4 py-2 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                        Login
                    </button>
                </a>
            @endauth
        </div>

        <!-- Hamburger -->
        <div class="md:hidden">
            <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-red-500 hover:bg-gray-900 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor">
                    <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-black border-t border-gray-800">
        <div class="px-4 py-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                Filmes
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="px-4 py-3 border-t border-gray-800 text-gray-300">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="px-4 py-3 border-t border-gray-800">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div class="px-4 py-3 border-t border-gray-800">
                <a href="{{ route('login') }}">
                    <button class="bg-gradient-to-r from-red-700 to-red-500 px-4 py-2 rounded-full font-semibold w-full hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-red-500/25">
                        Login
                    </button>
                </a>
            </div>
        @endauth
    </div>
</nav>

<style>
    .film-strip {
        background: repeating-linear-gradient(90deg, #2d2d2d 0px, #2d2d2d 20px, #1a1a1a 20px, #1a1a1a 40px);
        height: 8px;
    }
    .glow-text {
        text-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
    }
</style>
