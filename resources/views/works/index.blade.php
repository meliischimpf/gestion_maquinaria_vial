<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <i class="fas fa-building mr-3 text-green-500"></i>
                {{ __('Gestión de Obras') }}
            </h2>
            <div class="hidden md:flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <i class="fas fa-chart-pie"></i>
                <span>{{ $works->total() }} proyectos en gestión</span>
            </div>
        </div>
    </x-slot>

    {{-- Hero Section for Works --}}
    <div class="relative bg-gradient-to-r from-green-800 via-teal-900 to-blue-900 min-h-64 flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://images.pexels.com/photos/534220/pexels-photo-534220.jpeg?auto=compress&cs=tinysrgb&w=1920');"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Centro de Proyectos
            </h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Administra todos tus proyectos de construcción e infraestructura vial
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('work.create') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Nueva Obra
                </a>
                <a href="{{ route('assignments') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <i class="fas fa-tasks mr-2"></i>
                    Ver Asignaciones
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
                                <i class="fas fa-clipboard-list mr-3 text-green-500"></i>
                                {{ __("Portfolio de Obras") }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Supervisa el progreso y estado de todos tus proyectos
                            </p>
                        </div>
                        <a href="{{ route('work.create') }}" class="action-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest shadow-lg transform hover:scale-105 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Nueva Obra') }}
                        </a>
                    </div>

                    {{-- Enhanced Search and Filter Section --}}
                    <form method="GET" action="{{ route('works') }}" class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-search mr-2"></i>Buscar Obra
                                </label>
                                <div class="flex">
                                    <input type="text"
                                           name="search"
                                           placeholder="Buscar por nombre o descripción..."
                                           value="{{ request('search') }}"
                                           class="block w-full rounded-l-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400 sm:text-sm shadow-sm"
                                    />
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-r-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Filtrar por Provincia
                                </label>
                                <select name="province_id"
                                        onchange="this.form.submit()"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400 sm:text-sm shadow-sm">
                                    <option value="all">Todas las Provincias</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if(request('search') || request('province_id'))
                                <div class="md:col-span-3 flex justify-center">
                                    <a href="{{ route('works') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Limpiar Filtros') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>

                    {{-- Project Stats Summary --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="stat-card bg-gradient-to-br from-green-100 to-green-200 dark:from-green-800 dark:to-green-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-building text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-green-800 dark:text-green-200 text-sm">Total Obras</p>
                                    <p class="text-green-800 dark:text-green-200 text-xl font-bold">{{ $works->total() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-800 dark:to-blue-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-play text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-blue-800 dark:text-blue-200 text-sm">En Progreso</p>
                                    <p class="text-blue-800 dark:text-blue-200 text-xl font-bold">{{ $works->where('end_date_real', null)->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-yellow-100 to-yellow-200 dark:from-yellow-800 dark:to-yellow-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-yellow-800 dark:text-yellow-200 text-sm">Completadas</p>
                                    <p class="text-yellow-800 dark:text-yellow-200 text-xl font-bold">{{ $works->where('end_date_real', '!=', null)->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-800 dark:to-purple-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-purple-800 dark:text-purple-200 text-sm">Provincias</p>
                                    <p class="text-purple-800 dark:text-purple-200 text-xl font-bold">{{ $provinces->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Results Summary --}}
                    <div class="mb-4 flex justify-between items-center bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Mostrando {{ $works->firstItem() ?? 0 }} - {{ $works->lastItem() ?? 0 }} de {{ $works->total() }} obras
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-green-500"></i>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Ordenadas por fecha de inicio</span>
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
                                        <i class="fas fa-building mr-2"></i>Obra
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Provincia
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-calendar-alt mr-2"></i>Fecha Inicio
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-calendar-check mr-2"></i>Fin Estimado
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        <i class="fas fa-flag-checkered mr-2"></i>Estado
                                    </th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($works as $work)
                                    <tr class="table-row hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                #{{ $work->id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-teal-500 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-hard-hat text-white"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $work->name }}</div>
                                                    <div class="text-gray-500 dark:text-gray-400 text-xs max-w-xs truncate">{{ $work->description }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                                                <span class="text-gray-600 dark:text-gray-300">{{ $work->province->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                                <i class="fas fa-calendar text-green-500 mr-2"></i>
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($work->start_date)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($work->start_date)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($work->end_date_planned)
                                                <div class="flex items-center text-gray-600 dark:text-gray-300">
                                                    <i class="fas fa-clock text-yellow-500 mr-2"></i>
                                                    <span>{{ \Carbon\Carbon::parse($work->end_date_planned)->format('d/m/Y') }}</span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">No definido</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($work->end_date_real)
                                                <span class="inline-flex items-center px-3 py-1 text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100 status-badge">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Completada ({{ \Carbon\Carbon::parse($work->end_date_real)->format('d/m/Y') }})
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100 status-badge">
                                                    <i class="fas fa-play mr-1"></i>
                                                    En Progreso
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('work.show', $work->id) }}" class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Ver Detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('work.edit', $work->id) }}" class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if (is_null($work->end_date_real))
                                                <button type="button"
                                                        onclick="openFinalizeModal({{ $work->id }})"
                                                        class="action-btn inline-flex items-center px-3 py-1 border border-transparent rounded-lg text-xs font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                        title="Finalizar Obra">
                                                    <i class="fas fa-flag-checkered mr-1"></i>
                                                    Finalizar
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Enhanced Pagination --}}
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        {{ $works->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Enhanced Modal --}}
    <div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-lg bg-white dark:bg-gray-800 enhanced-table">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 mb-4">
                    <i class="fas fa-flag-checkered text-green-600 dark:text-green-300 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-gray-100">Finalizar Obra</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        Ingrese la fecha de finalización real para completar esta obra.
                    </p>
                    <form id="completeForm" method="POST" action="">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="work_id" id="modalWorkId">
                        <div class="mt-4">
                            <label for="end_date_real" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Fecha de Finalización:</label>
                            <input type="date" name="end_date_real" id="end_date_real" required
                                   value="{{ date('Y-m-d') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        </div>
                    </form>
                </div>
                <div class="items-center px-4 py-3 space-y-2">
                    <button id="confirmCompleteBtn" class="action-btn px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white text-base font-medium rounded-lg w-full shadow-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75 transition duration-300">
                        <i class="fas fa-check mr-2"></i>
                        Confirmar Finalización
                    </button>
                    <button onclick="closeCompleteModal()" class="px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-base font-medium rounded-lg w-full shadow-sm hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75 transition duration-300">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const completeModal = document.getElementById('completeModal');
        const modalWorkId = document.getElementById('modalWorkId');
        const completeForm = document.getElementById('completeForm');
        const confirmCompleteBtn = document.getElementById('confirmCompleteBtn');

        function openFinalizeModal(workId) {
            modalWorkId.value = workId;
            completeForm.action = `/works/destroy/${workId}`;
            completeModal.classList.remove('hidden');
        }

        function closeCompleteModal() {
            completeModal.classList.add('hidden');
            document.getElementById('end_date_real').value = '{{ date('Y-m-d') }}';
        }

        confirmCompleteBtn.addEventListener('click', function() {
            completeForm.submit();
        });

        window.addEventListener('click', function(event) {
            if (event.target === completeModal) {
                closeCompleteModal();
            }
        });

        // Close modal on Escape key
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCompleteModal();
            }
        });
    </script>
</x-app-layout>
