<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Asignación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __("Información de la Asignación") }}</h3>

                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                            
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Obra') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $assignment->work->name ?? 'N/A' }}
                                </dd>
                            </div>

                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Máquina') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $assignment->machine->brand ?? 'N/A' }} - {{ $assignment->machine->model ?? 'N/A' }} (SN: {{ $assignment->machine->serial_number ?? 'N/A' }})
                                </dd>
                            </div>

                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Fecha de Inicio') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $assignment->start_date ? \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') : 'N/A' }}
                                </dd>
                            </div>

                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Fecha de Fin Real') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $assignment->end_date ? \Carbon\Carbon::parse($assignment->end_date)->format('d/m/Y') : 'Pendiente' }}
                                </dd>
                            </div>

                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Estado') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $assignment->end_date == null ? __('En Progreso') : __('Finalizada') }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('assignment.edit', $assignment->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Editar Asignación') }}
                        </a>
                        <a href="{{ route('assignments') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Volver al Listado') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>