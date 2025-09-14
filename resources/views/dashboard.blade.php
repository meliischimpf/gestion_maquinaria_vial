<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Hero Section --}}
    <div class="hero-construction min-h-96 flex items-center justify-center relative">
        <div class="hero-overlay absolute inset-0"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-red-500 to-pink-500 aniamate-gradient">
                Sistema de Gestión
            </h1>
            <h2 class="text-3xl md:text-4xl font-semibold mb-6">
                Maquinaria Vial
            </h2>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Controla y optimiza tu flota de maquinaria con tecnología avanzada
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('machines') }}" class="action-btn px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-truck-moving mr-2"></i>
                    Ver Máquinas
                </a>
                <a href="{{ route('assignments') }}" class="action-btn px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-tasks mr-2"></i>
                    Gestionar Asignaciones
                </a>
            </div>
        </div>
    </div>

    <div class="py-12 machinery-pattern min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Section --}}
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl professional-shadow sm:rounded-lg enhanced-table">
                    <div class="p-8 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    ¡Bienvenido, {{ Auth::user()->name }}!
                                </h3>
                                <p class="text-lg text-gray-600 dark:text-gray-400">
                                    Gestiona tu flota de maquinaria vial de manera eficiente
                                </p>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-24 h-24 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-hard-hat text-3xl text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enhanced Statistics Section --}}
            <div class="mb-8">
                <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">
                    Panel de Control en Tiempo Real
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Total Machines Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-truck-moving text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Máquinas Totales</p>
                                    <p class="font-bold text-blue-800 dark:text-blue-200 text-3xl">{{ $totalMachines }}</p>
                                </div>
                            </div>
                            <div class="text-blue-500">
                                <i class="fas fa-chart-line text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-blue-100 dark:bg-blue-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Machines in Use Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-cogs text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Máquinas en Uso</p>
                                    <p class="font-bold text-orange-800 dark:text-orange-200 text-3xl">{{ $machinesInUse }}</p>
                                </div>
                            </div>
                            <div class="text-orange-500">
                                <i class="fas fa-sync-alt text-2xl animate-spin"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-orange-100 dark:bg-orange-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Total Works Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-building text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Obras Totales</p>
                                    <p class="font-bold text-green-800 dark:text-green-200 text-3xl">{{ $totalWorks }}</p>
                                </div>
                            </div>
                            <div class="text-green-500">
                                <i class="fas fa-arrow-up text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-green-100 dark:bg-green-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Active Works Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-wrench text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Obras Activas</p>
                                    <p class="font-bold text-teal-800 dark:text-teal-200 text-3xl">{{ $activeWorks }}</p>
                                </div>
                            </div>
                            <div class="text-teal-500">
                                <i class="fas fa-play text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-teal-100 dark:bg-teal-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-teal-500 to-teal-600 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Total Assignments Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-tasks text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Asignaciones Totales</p>
                                    <p class="font-bold text-purple-800 dark:text-purple-200 text-3xl">{{ $totalAssignments }}</p>
                                </div>
                            </div>
                            <div class="text-purple-500">
                                <i class="fas fa-clipboard-list text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-purple-100 dark:bg-purple-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Pending Assignments Card --}}
                    <div class="stat-card machine-card p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-clock text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm font-medium">Asignaciones Pendientes</p>
                                    <p class="font-bold text-red-800 dark:text-red-200 text-3xl">{{ $pendingAssignments }}</p>
                                </div>
                            </div>
                            <div class="text-red-500">
                                <i class="fas fa-exclamation-triangle text-2xl loading-pulse"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-red-100 dark:bg-red-900 rounded-full h-2">
                                <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enhanced Quick Actions Section --}}
            <div class="mb-8">
                <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">
                    Accesos Rápidos
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <a href="{{ route('parameters') }}" class="action-btn group block p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition duration-300 professional-shadow">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-opacity-30 transition duration-300">
                                <i class="fas fa-cogs text-2xl"></i>
                            </div>
                            <h5 class="text-lg font-semibold mb-2">Parámetros</h5>
                            <p class="text-sm opacity-90">Configurar sistema</p>
                        </div>
                    </a>

                    <a href="{{ route('machines') }}" class="action-btn group block p-6 bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition duration-300 professional-shadow">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-opacity-30 transition duration-300">
                                <i class="fas fa-truck-moving text-2xl"></i>
                            </div>
                            <h5 class="text-lg font-semibold mb-2">Máquinas</h5>
                            <p class="text-sm opacity-90">Gestionar flota</p>
                        </div>
                    </a>

                    <a href="{{ route('works') }}" class="action-btn group block p-6 bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition duration-300 professional-shadow">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-opacity-30 transition duration-300">
                                <i class="fas fa-building text-2xl"></i>
                            </div>
                            <h5 class="text-lg font-semibold mb-2">Obras</h5>
                            <p class="text-sm opacity-90">Proyectos activos</p>
                        </div>
                    </a>

                    <a href="{{ route('assignments') }}" class="action-btn group block p-6 bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition duration-300 professional-shadow">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-opacity-30 transition duration-300">
                                <i class="fas fa-tasks text-2xl"></i>
                            </div>
                            <h5 class="text-lg font-semibold mb-2">Asignaciones</h5>
                            <p class="text-sm opacity-90">Distribuir recursos</p>
                        </div>
                    </a>

                </div>
            </div>

            {{-- Additional Information Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Recent Activity --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl professional-shadow sm:rounded-lg enhanced-table">
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <i class="fas fa-history mr-3 text-blue-500"></i>
                            Actividad Reciente
                        </h5>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Nueva máquina agregada al sistema</p>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Asignación completada exitosamente</p>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Mantenimiento programado</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- System Status --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl professional-shadow sm:rounded-lg enhanced-table">
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <i class="fas fa-server mr-3 text-green-500"></i>
                            Estado del Sistema
                        </h5>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Base de Datos</span>
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>Operativa
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Servicios API</span>
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>Activos
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Backup</span>
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                    <i class="fas fa-sync-alt mr-1"></i>Sincronizado
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
