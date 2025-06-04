<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Obra') }} {{-- Cambiado de 'Máquinas' a 'Detalles de la Obra' --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __("Información de la Obra") }}</h3>

                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Nombre --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Nombre') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ $work->name }}</dd>
                            </div>

                            {{-- Descripción --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Descripción') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ $work->description }}</dd>
                            </div>

                            {{-- Provincia --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Provincia') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $work->province->name ?? 'N/A' }} {{-- Usar ?? 'N/A' por si la relación no existe --}}
                                </dd>
                            </div>

                            {{-- Fecha de Inicio --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Fecha de Inicio') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $work->start_date ? \Carbon\Carbon::parse($work->start_date)->format('d/m/Y') : 'N/A' }}
                                </dd>
                            </div>

                            {{-- Fecha de Fin Estimada --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Fecha de Fin Estimada') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $work->end_date_planned ? \Carbon\Carbon::parse($work->end_date_planned)->format('d/m/Y') : 'N/A' }}
                                </dd>
                            </div>

                            {{-- Fecha de Fin Real (Añadido, ya que es común para obras) --}}
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ __('Fecha de Fin Real') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                    {{ $work->end_date_real ? \Carbon\Carbon::parse($work->end_date_real)->format('d/m/Y') : 'Pendiente' }}
                                </dd>
                            </div>

                            
                        </dl>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('work.edit', $work->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Editar Obra') }}
                        </a>
                        <a href="{{ route('works') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Volver al Listado') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>