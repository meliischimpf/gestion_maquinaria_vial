<nav x-data="{ open: false }" class="glass-nav border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo Section --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition duration-300">
                            <i class="fas fa-hard-hat text-white text-lg"></i>
                        </div>
                        <div class="hidden md:block">
                            <h1 class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                MaquinariaVial
                            </h1>
                            <p class="text-xs text-gray-600 dark:text-gray-400 -mt-1">Sistema de Gestión</p>
                        </div>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link-enhanced">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('machines')" :active="request()->routeIs('machines.*')" class="nav-link-enhanced">
                        <i class="fas fa-truck-moving mr-2"></i>
                        {{ __('Máquinas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('works')" :active="request()->routeIs('works.*')" class="nav-link-enhanced">
                        <i class="fas fa-building mr-2"></i>
                        {{ __('Obras') }}
                    </x-nav-link>
                    <x-nav-link :href="route('assignments')" :active="request()->routeIs('assignments.*')" class="nav-link-enhanced">
                        <i class="fas fa-tasks mr-2"></i>
                        {{ __('Asignaciones') }}
                    </x-nav-link>
                    <x-nav-link :href="route('maintenances')" :active="request()->routeIs('maintenances.*')" class="nav-link-enhanced">
                        <i class="fas fa-wrench mr-2"></i>
                        {{ __('Mantenimiento') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- User Menu Desktop --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- Notifications (placeholder) --}}
                    <div class="relative mr-4">
                        <button class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none focus:text-gray-500 dark:focus:text-gray-300 transition duration-150 ease-in-out">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full"></span>
                        </button>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Auth::user()->profile_photo_path)
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 group">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                        <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="text-left">
                                        <div class="font-semibold">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-400">Administrador</div>
                                    </div>
                                    <div class="ms-2">
                                        <svg class="fill-current h-4 w-4 transform group-hover:rotate-180 transition duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-1">
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                                    <i class="fas fa-user mr-3 text-gray-400"></i>
                                    {{ __('Mi Perfil') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('parameters')" class="flex items-center">
                                    <i class="fas fa-cogs mr-3 text-gray-400"></i>
                                    {{ __('Configuración') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                             @click.prevent="$root.submit();"
                                             class="flex items-center text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            {{ __('Iniciar Sesión') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-user-plus mr-2"></i>
                                {{ __('Registrarse') }}
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="mobile-nav-link">
                <i class="fas fa-home mr-3"></i>
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('machines')" :active="request()->routeIs('machines.*')" class="mobile-nav-link">
                <i class="fas fa-truck-moving mr-3"></i>
                {{ __('Máquinas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('works')" :active="request()->routeIs('works.*')" class="mobile-nav-link">
                <i class="fas fa-building mr-3"></i>
                {{ __('Obras') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('assignments')" :active="request()->routeIs('assignments.*')" class="mobile-nav-link">
                <i class="fas fa-tasks mr-3"></i>
                {{ __('Asignaciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('maintenances')" :active="request()->routeIs('maintenances.*')" class="mobile-nav-link">
                <i class="fas fa-wrench mr-3"></i>
                {{ __('Mantenimiento') }}
            </x-responsive-nav-link>
        </div>

        {{-- Mobile User Menu --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 px-4">
            @auth
                <div class="flex items-center px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg mb-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="mobile-nav-link">
                        <i class="fas fa-user mr-3"></i>
                        {{ __('Mi Perfil') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('parameters')" class="mobile-nav-link">
                        <i class="fas fa-cogs mr-3"></i>
                        {{ __('Configuración') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                         @click.prevent="$root.submit();"
                                         class="mobile-nav-link text-red-600 dark:text-red-400">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            {{ __('Cerrar Sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="space-y-2">
                    <x-responsive-nav-link :href="route('login')" class="mobile-nav-link">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        {{ __('Iniciar Sesión') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')" class="mobile-nav-link">
                            <i class="fas fa-user-plus mr-3"></i>
                            {{ __('Registrarse') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
.nav-link-enhanced {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.nav-link-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.5s;
}

.nav-link-enhanced:hover::before {
    left: 100%;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.mobile-nav-link:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
    transform: translateX(4px);
}
</style>
</nav>
