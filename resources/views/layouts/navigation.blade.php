<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('machines')" :active="request()->routeIs('machines.*')">
                        {{ __('Máquinas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('works')" :active="request()->routeIs('works.*')">
                        {{ __('Trabajos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('assignments')" :active="request()->routeIs('assignments.*')">
                        {{ __('Asignaciones') }}
                    </x-nav-link>
                    <x-nav-link :href="route('maintenances')" :active="request()->routeIs('maintenances.*')">
                        {{ __('Mantenimientos') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- INICIO DEL BLOQUE CORREGIDO: MENÚ DE USUARIO EN PANTALLAS GRANDES --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth {{-- Solo si hay un usuario autenticado --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Auth::user()->profile_photo_path) {{-- Check if user has a profile photo --}}
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Original Jetstream check for API features removed --}}
                            {{-- @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link :href="route('api-tokens')">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif --}}

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else {{-- Si no hay usuario autenticado, muestra opciones de login/registro --}}
                    <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Log In') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ms-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endauth
            </div>
            {{-- FIN DEL BLOQUE CORREGIDO --}}


            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('machines')" :active="request()->routeIs('machines.*')">
                {{ __('Máquinas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('works')" :active="request()->routeIs('works.*')">
                {{ __('Trabajos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('assignments')" :active="request()->routeIs('assignments.*')">
                {{ __('Asignaciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('maintenances')" :active="request()->routeIs('maintenances.*')">
                {{ __('Mantenimientos') }}
            </x-responsive-nav-link>
        </div>

        {{-- INICIO DEL BLOQUE CORREGIDO: MENÚ DE USUARIO EN PANTALLAS PEQUEÑAS --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth {{-- Solo si hay un usuario autenticado --}}
                <div class="flex items-center px-4">
                    @if (Auth::user()->profile_photo_path) {{-- Check if user has a profile photo --}}
                        <div class="shrink-0 me-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    {{-- Original Jetstream check for API features removed --}}
                    {{-- @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link :href="route('api-tokens')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif --}}

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                         @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else {{-- Si no hay usuario autenticado, muestra opciones de login/registro --}}
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>