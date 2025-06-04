<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __("Gestión de Asignaciones") }}</h3>
                        <div class="flex space-x-3">
                            <a href="{{ route('assignment.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-800 transition ease-in-out duration-150">
                                {{ __('Crear Asignación') }}
                            </a>
                            <button type="button" onclick="openPdfFilterModal()" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Exportar PDF') }}
                            </button>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ __("Asignaciones Activas") }}</h4>
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Máquina</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Obra</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de Inicio</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de Fin</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Razón de Fin</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Km Recorridos</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($activeAssignments as $assignment)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $assignment->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->machine->brand ?? 'N/A' }} {{ $assignment->machine->model ?? 'N/A' }}
                                                (SN: {{ $assignment->machine->serial_number ?? 'N/A' }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->work->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->start_date ? \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->end_date ? \Carbon\Carbon::parse($assignment->end_date)->format('d/m/Y') : ''}} 
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->assignmentend->name ?? '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->km_traveled ?? '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('assignment.show', $assignment->id) }}"
                                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-800"
                                                   title="Ver Detalles">
                                                    Ver
                                                </a>

                                                <a href="{{ route('assignment.edit', $assignment->id) }}"
                                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-offset-gray-800"
                                                   title="Editar Asignación">
                                                    Editar
                                                </a>

                                                @if (is_null($assignment->end_date))
                                                    <button type="button"
                                                            onclick="openCompleteModal({{ $assignment->id }})"
                                                            class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-offset-gray-800"
                                                            title="Finalizar Asignación">
                                                        Finalizar
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 text-center">
                                                No se encontraron asignaciones activas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $activeAssignments->links('pagination::tailwind') }}
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ __("Asignaciones Finalizadas") }}</h4>
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Máquina</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Obra</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de Inicio</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de Fin</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Razón de Fin</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Km Recorridos</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($finishedAssignments as $assignment)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $assignment->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->machine->brand ?? '' }} {{ $assignment->machine->model ?? '' }}
                                                (SN: {{ $assignment->machine->serial_number ?? '' }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->work->name ?? '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->start_date ? \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') : '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->end_date ? \Carbon\Carbon::parse($assignment->end_date)->format('d/m/Y') : ''}} 
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->assignmentend->name ?? '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $assignment->km_traveled ?? '' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('assignment.show', $assignment->id) }}"
                                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-800"
                                                   title="Ver Detalles">
                                                    Ver
                                                </a>

                                                <a href="{{ route('assignment.edit', $assignment->id) }}"
                                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-offset-gray-800"
                                                   title="Editar Asignación">
                                                    Editar
                                                </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 text-center">
                                                No se encontraron asignaciones finalizadas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $finishedAssignments->links('pagination::tailwind') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Finalizar Asignación</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        Por favor, ingrese los detalles para finalizar la asignación.
                    </p>
                    <form id="completeForm" method="POST" action="">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="assignment_id" id="modalAssignmentId">

                        <div class="mt-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Fecha de Fin:</label>
                            <input type="date" name="end_date" id="end_date" required
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300">
                        </div>

                        <div class="mt-4">
                            <label for="assignment_end_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Razón de Fin:</label>
                            <select name="assignment_end_id" id="assignment_end_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300">
                                <option value="">Selecciona una razón</option>
                                @foreach ($assignment_ends as $endReason)
                                    <option value="{{ $endReason->id }}">{{ $endReason->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="km_traveled" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Km Recorridos (opcional):</label>
                            <input type="number" name="km_traveled" id="km_traveled"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300">
                        </div>
                    </form>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirmCompleteBtn" class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                        Confirmar
                    </button>
                    <button type="button" onclick="closeCompleteModal()" class="mt-3 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="pdfFilterModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Opciones de Exportación PDF</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-300 mb-4">
                        Seleccione el mes y el año para filtrar el reporte PDF.
                    </p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="pdf_filter_month" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Mes:</label>
                            <select id="pdf_filter_month" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
                                <option value="">Todos los Meses</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ (\Carbon\Carbon::now()->month == $m) ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="pdf_filter_year" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-left">Año:</label>
                            <select id="pdf_filter_year" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
                                <option value="">Todos los Años</option>
                                @foreach(range(\Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year - 5) as $y)
                                    <option value="{{ $y }}" {{ (\Carbon\Carbon::now()->year == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="generatePdfBtn" class="px-4 py-2 bg-purple-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-75">
                        Generar PDF
                    </button>
                    <button type="button" onclick="closePdfFilterModal()" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const completeModal = document.getElementById('completeModal');
        const modalAssignmentId = document.getElementById('modalAssignmentId');
        const completeForm = document.getElementById('completeForm');
        const confirmCompleteBtn = document.getElementById('confirmCompleteBtn');
        const endDateInput = document.getElementById('end_date');
        const kmTraveledInput = document.getElementById('km_traveled');
        const assignmentEndSelect = document.getElementById('assignment_end_id');

        function openCompleteModal(assignmentId) {
            modalAssignmentId.value = assignmentId;
            completeForm.action = `/assignments/destroy/${assignmentId}`;
            completeModal.classList.remove('hidden');
            endDateInput.valueAsDate = new Date();
            kmTraveledInput.value = ''; 
            assignmentEndSelect.value = ''; 
        }

        function closeCompleteModal() {
            completeModal.classList.add('hidden');
            endDateInput.value = '';
            kmTraveledInput.value = '';
            assignmentEndSelect.value = '';
        }

        confirmCompleteBtn.addEventListener('click', function() {
            completeForm.submit();
        });

        const pdfFilterModal = document.getElementById('pdfFilterModal');
        const pdfFilterMonthSelect = document.getElementById('pdf_filter_month');
        const pdfFilterYearSelect = document.getElementById('pdf_filter_year');
        const generatePdfBtn = document.getElementById('generatePdfBtn');

        function openPdfFilterModal() {
            pdfFilterModal.classList.remove('hidden');

            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear();
            pdfFilterMonthSelect.value = currentMonth.toString();
            pdfFilterYearSelect.value = currentYear.toString();
        }

        function closePdfFilterModal() {
            pdfFilterModal.classList.add('hidden');
        }

        generatePdfBtn.addEventListener('click', function() {
            const selectedMonth = pdfFilterMonthSelect.value;
            const selectedYear = pdfFilterYearSelect.value;

            let pdfUrl = "{{ route('reports.export_assigned_machines_pdf') }}";
            const params = new URLSearchParams();

            if (selectedMonth) {
                params.append('month', selectedMonth);
            }
            if (selectedYear) {
                params.append('year', selectedYear);
            }

            if (params.toString()) {
                pdfUrl += '?' + params.toString();
            }

            window.open(pdfUrl, '_blank');
        });

        window.addEventListener('click', function(event) {
            if (event.target === completeModal) {
                closeCompleteModal();
            }
            if (event.target === pdfFilterModal) {
                closePdfFilterModal();
            }
        });
    </script>
    @endpush
</x-app-layout>