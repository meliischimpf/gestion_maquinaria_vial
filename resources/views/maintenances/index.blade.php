<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <i class="fas fa-wrench mr-3 text-yellow-500"></i>
                {{ __('Gestión de Mantenimientos') }}
            </h2>
            <div class="hidden md:flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <i class="fas fa-tools"></i>
                <span>{{ $maintenances->total() }} mantenimientos registrados</span>
            </div>
        </div>
    </x-slot>

    {{-- Hero Section for Maintenance --}}
    <div class="relative bg-gradient-to-r from-yellow-800 via-orange-900 to-red-900 min-h-64 flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('https://images.pexels.com/photos/33497140/pexels-photo-33497140.jpeg?auto=compress&cs=tinysrgb&w=1920');"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Centro de Mantenimiento
            </h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Mantén tu flota en condiciones óptimas con nuestro sistema de seguimiento
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('machine.create') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Programar Mantenimiento
                </a>
                <a href="{{ route('machines') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-truck-moving mr-2"></i>
                    Ver Máquinas
                </a>
            </div>
        </div>
    </div>

    <div class="py-12 machinery-pattern">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl professional-shadow sm:rounded-lg enhanced-table">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Enhanced Header --}}
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                                <i class="fas fa-clipboard-list mr-3 text-yellow-500"></i>
                                {{ __("Historial de Mantenimientos") }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Rastrea y supervisa todos los mantenimientos realizados
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('machine.create') }}" class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest shadow-lg transform hover:scale-105 transition duration-300">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Programar
                            </a>
                            <a href="{{ route('machines') }}" class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest shadow-lg transform hover:scale-105 transition duration-300">
                                <i class="fas fa-eye mr-2"></i>
                                Ver Máquinas
                            </a>
                        </div>
                    </div>

                    {{-- Enhanced Search and Filter Section --}}
                    <form method="GET" action="{{ route('maintenances') }}" class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-search mr-2"></i>Buscar Mantenimiento
                                </label>
                                <div class="flex">
                                    <input type="text"
                                           name="search"
                                           placeholder="Buscar por tipo o máquina..."
                                           value="{{ request('search') }}"
                                           class="block w-full rounded-l-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-400 focus:ring-yellow-500 dark:focus:ring-yellow-400 sm:text-sm shadow-sm"
                                    />
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-r-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-tools mr-2"></i>Tipo de Mantenimiento
                                </label>
                                <select name="maintenance_type_id"
                                        onchange="this.form.submit()"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-400 focus:ring-yellow-500 dark:focus:ring-yellow-400 sm:text-sm shadow-sm">
                                    <option value="all">Todos los Tipos</option>
                                    @foreach($maintenanceTypes as $type)
                                        <option value="{{ $type->id }}" {{ request('maintenance_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-truck-moving mr-2"></i>Máquina
                                </label>
                                <select name="machine_id"
                                        onchange="this.form.submit()"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-400 focus:ring-yellow-500 dark:focus:ring-yellow-400 sm:text-sm shadow-sm">
                                    <option value="all">Todas las Máquinas</option>
                                    @foreach($machines as $machine)
                                        <option value="{{ $machine->id }}" {{ request('machine_id') == $machine->id ? 'selected' : '' }}>
                                            {{ $machine->serial_number }} - {{ $machine->brand }} {{ $machine->model }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if(request('search') || request('maintenance_type_id') || request('machine_id'))
                                <div class="md:col-span-4 flex justify-center">
                                    <a href="{{ route('maintenances') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Limpiar Filtros') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>

                    {{-- Stats Summary --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="stat-card bg-gradient-to-br from-green-100 to-green-200 dark:from-green-800 dark:to-green-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-green-800 dark:text-green-200 text-sm">Completados</p>
                                    <p class="text-green-800 dark:text-green-200 text-xl font-bold">{{ $maintenances->total() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-yellow-100 to-yellow-200 dark:from-yellow-800 dark:to-yellow-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-yellow-800 dark:text-yellow-200 text-sm">Programados</p>
                                    <p class="text-yellow-800 dark:text-yellow-200 text-xl font-bold">3</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-800 dark:to-blue-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-blue-800 dark:text-blue-200 text-sm">Este Mes</p>
                                    <p class="text-blue-800 dark:text-blue-200 text-xl font-bold">{{ $maintenances->where('realization_date', '>=', now()->startOfMonth())->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-800 dark:to-purple-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-tools text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-purple-800 dark:text-purple-200 text-sm">Tipos Únicos</p>
                                    <p class="text-purple-800 dark:text-purple-200 text-xl font-bold">{{ $maintenanceTypes->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Results Summary --}}
                    <div class="mb-4 flex justify-between items-center bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Mostrando {{ $maintenances->firstItem() ?? 0 }} - {{ $maintenances->lastItem() ?? 0 }} de {{ $maintenances->total() }} mantenimientos
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Ordenados por fecha más reciente</span>
                        </div>
                    </div>

                    {{-- Enhanced Table --}}
                    <div class="overflow-x-auto rounded-lg shadow-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-hashtag mr-2"></i>ID
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-truck-moving mr-2"></i>Máquina
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-calendar-alt mr-2"></i>Fecha Realizada
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-tachometer-alt mr-2"></i>KM al Mantenimiento
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-tools mr-2"></i>Tipo de Mantenimiento
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($maintenances as $maintenance)
                                    <tr class="table-row hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                #{{ $maintenance->id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-truck-monster text-white"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $maintenance->machine->serial_number }}</div>
                                                    <div class="text-gray-500 dark:text-gray-400 text-xs">{{ $maintenance->machine->brand }} {{ $maintenance->machine->model }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                                <i class="fas fa-calendar text-blue-500 mr-2"></i>
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($maintenance->realization_date)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($maintenance->realization_date)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-tachometer-alt text-orange-500 mr-2"></i>
                                                <span class="font-mono text-gray-900 dark:text-gray-100">{{ number_format($maintenance->km_at_maintenance) }} km</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 status-badge">
                                                <i class="fas fa-wrench mr-1"></i>
                                                {{ $maintenance->type->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 status-badge">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Completado
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Enhanced Pagination --}}
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        {{ $maintenances->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
