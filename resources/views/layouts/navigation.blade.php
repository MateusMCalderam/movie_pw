<nav x-data="{ open: false }" class="bg-black/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="flex items-center space-x-3">
                        <div class="text-3xl font-bold glow-text text-white">🎬 Infoflix</div>
                        <div class="film-strip w-20 hidden md:block"></div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->user()->isAdmin())
                        <!-- Links para Admin -->
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-300 hover:text-red-500 transition-colors">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.movies.index')" :active="request()->routeIs('admin.movies.*')" class="text-gray-300 hover:text-red-500 transition-colors">
                            Filmes
                        </x-nav-link>
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="text-gray-300 hover:text-red-500 transition-colors">
                            {{ __('Categoria') }}
                        </x-nav-link>
                    @else
                        <!-- Links para Usuários -->
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="text-gray-300 hover:text-red-500 transition-colors">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.movies')" :active="request()->routeIs('user.movies*')" class="text-gray-300 hover:text-red-500 transition-colors">
                            Filmes
                        </x-nav-link>
                        <x-nav-link :href="route('home')" class="text-gray-300 hover:text-red-500 transition-colors">
                            Início
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-700 text-sm leading-4 font-medium rounded-md text-gray-300 bg-black/50 hover:text-red-500 hover:bg-gray-800/50 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center space-x-2">
                                <span>{{ Auth::user()->name }}</span>
                                @if(auth()->user()->isAdmin())
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                        Admin
                                    </span>
                                @endif
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-red-500 hover:bg-gray-800 focus:outline-none focus:bg-gray-800 focus:text-red-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black/95 backdrop-blur-md border-t border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->isAdmin())
                <!-- Links responsivos para Admin -->
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.movies.index')" :active="request()->routeIs('admin.movies.*')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    Filmes
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    {{ __('Categoria') }}
                </x-responsive-nav-link>
            @else
                <!-- Links responsivos para Usuários -->
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.movies')" :active="request()->routeIs('user.movies*')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    Filmes
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    Início
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-300">
                    {{ Auth::user()->name }}
                    @if(auth()->user()->isAdmin())
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30 ml-2">
                            Admin
                        </span>
                    @endif
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-gray-300 hover:text-red-500 hover:bg-gray-800">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
