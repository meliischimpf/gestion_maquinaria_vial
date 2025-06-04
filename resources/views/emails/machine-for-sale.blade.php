<x-mail::message>
# ¡Máquina Lista para Venta!

La máquina **{{ $machineName }} (ID: {{ $machineId }})** ha alcanzado un kilometraje total acumulado de {{ $lifetimeKm }} km.

Este valor supera el umbral de vida útil estipulado para la consideración de venta de la máquina.

**Detalles de la Máquina:**
- Nombre: {{ $machineName }}
- ID Interno: {{ $machineId }}
- Kilometraje de Vida Útil Acumulado: {{ $lifetimeKm }} km

Se recomienda evaluar la posibilidad de su venta o desincorporación.

<x-mail::button :url="route('machine.show', $machineId)"> 
Ver Detalles de la Máquina
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>