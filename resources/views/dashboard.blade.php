<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg mb-6">{{ __("¡Has iniciado sesión!") }}</p>

                    {{-- Sección de Bienvenida/Resumen --}}
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Bienvenido, {{ Auth::user()->name }}</h3>
                        <p class="text-gray-700 dark:text-gray-300">Aquí podrás acceder a las principales funciones de gestión de maquinaria vial.</p>
                    </div>

                    {{-- Sección de Estadísticas Rápidas --}}
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Estadísticas Rápidas</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {{-- Tarjeta: Total Máquinas --}}
                            <div class="p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-truck-moving text-blue-600 dark:text-blue-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Máquinas Totales</p>
                                    <p class="font-bold text-blue-800 dark:text-blue-200 text-xl">{{ $totalMachines }}</p>
                                </div>
                            </div>
                            
                            {{-- Tarjeta: Máquinas en Uso --}}
                            <div class="p-4 bg-orange-100 dark:bg-orange-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-hard-hat text-orange-600 dark:text-orange-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Máquinas en Uso</p>
                                    <p class="font-bold text-orange-800 dark:text-orange-200 text-xl">{{ $machinesInUse }}</p>
                                </div>
                            </div>

                            {{-- Tarjeta: Total Obras --}}
                            <div class="p-4 bg-green-100 dark:bg-green-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-building text-green-600 dark:text-green-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Obras Totales</p>
                                    <p class="font-bold text-green-800 dark:text-green-200 text-xl">{{ $totalWorks }}</p>
                                </div>
                            </div>

                            {{-- Tarjeta: Obras Activas --}}
                            <div class="p-4 bg-teal-100 dark:bg-teal-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-wrench text-teal-600 dark:text-teal-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Obras Activas</p>
                                    <p class="font-bold text-teal-800 dark:text-teal-200 text-xl">{{ $activeWorks }}</p>
                                </div>
                            </div>

                            {{-- Tarjeta: Total Asignaciones --}}
                            <div class="p-4 bg-purple-100 dark:bg-purple-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-tasks text-purple-600 dark:text-purple-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Asignaciones Totales</p>
                                    <p class="font-bold text-purple-800 dark:text-purple-200 text-xl">{{ $totalAssignments }}</p>
                                </div>
                            </div>

                            {{-- Tarjeta: Asignaciones Pendientes --}}
                            <div class="p-4 bg-red-100 dark:bg-red-900/50 rounded-lg shadow-sm flex items-center justify-between">
                                <i class="fas fa-clock text-red-600 dark:text-red-400 text-2xl mr-3"></i>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">Asignaciones Pendientes</p>
                                    <p class="font-bold text-red-800 dark:text-red-200 text-xl">{{ $pendingAssignments }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Accesos Rápidos</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            
                            <a href="{{ route('parameters') }}" class="block p-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center transition duration-150 ease-in-out">
                                <i class="fas fa-cogs mr-2"></i> {{ __('Administrar Parámetros') }}
                            </a>

                            <a href="{{ route('machines') }}" class="block p-4 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center transition duration-150 ease-in-out">
                                <i class="fas fa-truck-moving mr-2"></i> {{ __('Ver Máquinas') }}
                            </a>
                            <a href="{{ route('works') }}" class="block p-4 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center transition duration-150 ease-in-out">
                                <i class="fas fa-building mr-2"></i> {{ __('Ver Obras') }}
                            </a>
                            <a href="{{ route('assignments') }}" class="block p-4 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center transition duration-150 ease-in-out">
                                <i class="fas fa-tasks mr-2"></i> {{ __('Ver Asignaciones') }}
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>