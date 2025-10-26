<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <i class="fas fa-truck-moving mr-3 text-orange-500"></i>
                {{ __('Gestión de Máquinas') }}
            </h2>
            <div class="hidden md:flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <i class="fas fa-chart-bar"></i>
                <span>{{ $machines->total() }} máquinas registradas</span>
            </div>
        </div>
    </x-slot>

    {{-- Hero Section for Machines --}}
    <div class="relative bg-gradient-to-r from-gray-800 via-gray-900 to-black min-h-64 flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://images.pexels.com/photos/33484880/pexels-photo-33484880.jpeg?auto=compress&cs=tinysrgb&w=1920');"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Flota de Maquinaria
            </h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Control total de tu equipo de construcción y maquinaria vial
            </p>
            <a href="{{ route('machine.create') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <i class="fas fa-plus mr-2"></i>
                {{ __('Nueva Máquina') }}
            </a>
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
                                <i class="fas fa-list-alt mr-3 text-blue-500"></i>
                                {{ __("Inventario de Máquinas") }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Administra y supervisa toda tu maquinaria
                            </p>
                        </div>
                        <a href="{{ route('machine.create') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest shadow-lg transform hover:scale-105 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Agregar Máquina') }}
                        </a>
                    </div>

                    {{-- Enhanced Search and Filter Section --}}
                    <form method="GET" action="{{ route('machines') }}" class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-search mr-2"></i>Buscar Máquina
                                </label>
                                <div class="flex">
                                    <input type="text"
                                           name="search"
                                           placeholder="Buscar por serie, marca o modelo..."
                                           value="{{ request('search') }}"
                                           class="block w-full rounded-l-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 sm:text-sm shadow-sm"
                                    />
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-r-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-filter mr-2"></i>Filtrar por Estado
                                </label>
                                <select name="status_id"
                                        onchange="this.form.submit()"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 sm:text-sm shadow-sm">
                                    <option value="all">Todos los estados</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->situation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if(request('search') || request('status_id'))
                                <div class="md:col-span-3 flex justify-center">
                                    <a href="{{ route('machines') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Limpiar Filtros') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>

                    {{-- Enhanced Machines Grid/Table View --}}
                    <div class="mb-4 flex justify-between items-center">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Mostrando {{ $machines->firstItem() ?? 0 }} - {{ $machines->lastItem() ?? 0 }} de {{ $machines->total() }} resultados
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="toggleView('grid')" id="grid-btn" class="p-2 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button onclick="toggleView('table')" id="table-btn" class="p-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Grid View --}}
                    <div id="grid-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        @foreach ($machines as $machine)
                            <div class="machine-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                                {{-- Machine Image --}}
                                <div class="h-48 bg-gray-200 flex items-center justify-center relative overflow-hidden">
                                    @if($machine->image)
                                        <img src="{{ $machine->image }}" 
                                             alt="{{ $machine->brand }} {{ $machine->model }}" 
                                             class="w-full h-full object-cover"
                                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605000797499-95a51c5269ae?w=800&auto=format&fit=crop&q=80';">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center">
                                            <i class="fas fa-truck-monster text-6xl text-white opacity-50"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        @php
                                            $statusClass = '';
                                            $statusIcon = '';
                                            switch ($machine->status->situation) {
                                                case 'Operativa':
                                                    $statusClass = 'bg-green-500';
                                                    $statusIcon = 'fa-check-circle';
                                                    break;
                                                case 'En Mantenimiento':
                                                    $statusClass = 'bg-yellow-500';
                                                    $statusIcon = 'fa-wrench';
                                                    break;
                                                case 'Fuera de Servicio':
                                                    $statusClass = 'bg-red-500';
                                                    $statusIcon = 'fa-exclamation-circle';
                                                    break;
                                                default:
                                                    $statusClass = 'bg-gray-500';
                                                    $statusIcon = 'fa-question-circle';
                                                    break;
                                            }
                                        @endphp
                                        <span class="{{ $statusClass }} text-white p-2 rounded-full">
                                            <i class="fas {{ $statusIcon }}"></i>
                                        </span>
                                    </div>
                                </div>

                                {{-- Machine Details --}}
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                                                {{ $machine->brand }} {{ $machine->model }}
                                            </h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Serie: {{ $machine->serial_number }}
                                            </p>
                                        </div>
                                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            ID: {{ $machine->id }}
                                        </span>
                                    </div>

                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                                <i class="fas fa-cog mr-2"></i>
                                                Tipo:
                                            </span>
                                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $machine->type->name }}</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                                <i class="fas fa-tachometer-alt mr-2"></i>
                                                KM Actual:
                                            </span>
                                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ number_format($machine->current_km) }}</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                                <i class="fas fa-clock mr-2"></i>
                                                KM de Vida:
                                            </span>
                                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ number_format($machine->lifetime_km) }}</span>
                                        </div>
                                    </div>

                                    {{-- Status Badge --}}
                                    <div class="mb-4">
                                        @php
                                            $statusClass = '';
                                            switch ($machine->status->situation) {
                                                case 'Operativa':
                                                    $statusClass = 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100';
                                                    break;
                                                case 'En Mantenimiento':
                                                    $statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100';
                                                    break;
                                                case 'Fuera de Servicio':
                                                    $statusClass = 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100';
                                                    break;
                                                default:
                                                    $statusClass = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100';
                                                    break;
                                            }
                                        @endphp
                                        <span class="status-badge inline-flex items-center px-3 py-1 text-xs leading-4 font-semibold rounded-full {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }} mr-1"></i>
                                            {{ $machine->status->situation }}
                                        </span>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="flex space-x-2">
                                        <a href="{{ route('machine.show', $machine->id) }}" class="action-btn flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150" title="Ver Detalles">
                                            <i class="fas fa-eye mr-1"></i>
                                            Ver
                                        </a>
                                        <a href="{{ route('machine.edit', $machine->id) }}" class="action-btn flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent rounded-lg text-sm font-semibold text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-150" title="Editar">
                                            <i class="fas fa-edit mr-1"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('machine.destroy', $machine->id) }}" class="action-btn inline-flex items-center justify-center px-3 py-2 border border-transparent rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta máquina?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Enhanced Table View --}}
                    <div id="table-view" class="hidden overflow-x-auto rounded-lg shadow-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-hashtag mr-2"></i>ID
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-barcode mr-2"></i>Serie
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2"></i>Tipo
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-industry mr-2"></i>Marca
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-2"></i>Modelo
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-tachometer-alt mr-2"></i>KM Actual
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>KM de Vida
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Estado
                                    </th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($machines as $machine)
                                    <tr class="table-row hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                            {{ $machine->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300 font-mono">
                                            {{ $machine->serial_number }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                {{ $machine->type->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $machine->brand }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                            {{ $machine->model }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300 font-mono">
                                            {{ number_format($machine->current_km) }} km
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300 font-mono">
                                            {{ number_format($machine->lifetime_km) }} km
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $statusClass = '';
                                                $statusIcon = '';
                                                switch ($machine->status->situation) {
                                                    case 'Operativa':
                                                        $statusClass = 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100';
                                                        $statusIcon = 'fa-check-circle';
                                                        break;
                                                    case 'En Mantenimiento':
                                                        $statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100';
                                                        $statusIcon = 'fa-wrench';
                                                        break;
                                                    case 'Fuera de Servicio':
                                                        $statusClass = 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100';
                                                        $statusIcon = 'fa-exclamation-circle';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100';
                                                        $statusIcon = 'fa-question-circle';
                                                        break;
                                                }
                                            @endphp
                                            <span class="status-badge inline-flex items-center px-3 py-1 text-xs leading-4 font-semibold rounded-full {{ $statusClass }}">
                                                <i class="fas {{ $statusIcon }} mr-1"></i>
                                                {{ $machine->status->situation }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('machine.show', $machine->id) }}" class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Ver Detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('machine.edit', $machine->id) }}" class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('machine.destroy', $machine->id) }}" class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta máquina?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Enhanced Pagination --}}
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        {{ $machines->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for View Toggle --}}
    <script>
        function toggleView(view) {
            const gridView = document.getElementById('grid-view');
            const tableView = document.getElementById('table-view');
            const gridBtn = document.getElementById('grid-btn');
            const tableBtn = document.getElementById('table-btn');

            if (view === 'grid') {
                gridView.classList.remove('hidden');
                tableView.classList.add('hidden');
                gridBtn.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
                gridBtn.classList.add('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                tableBtn.classList.remove('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                tableBtn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
            } else {
                gridView.classList.add('hidden');
                tableView.classList.remove('hidden');
                tableBtn.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
                tableBtn.classList.add('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                gridBtn.classList.remove('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                gridBtn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
            }
        }
    </script>
</x-app-layout>
