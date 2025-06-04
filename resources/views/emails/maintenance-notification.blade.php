<x-mail::message>
# Mantenimiento Requerido

La máquina **{{ $machineName }} (ID: {{ $machineId }})** ha superado el umbral de kilómetros y requiere mantenimiento.

**Detalles:**
- Kilómetros recorridos en la última asignación (ID: {{ $assignmentId }}): {{ $kmTraveledAssignment }} km
- Kilómetros actuales de la máquina (después del reinicio): {{ $currentKm }} km
- Kilómetros totales acumulados (lifetime): {{ $kmAtLastMaintenance }} km

Se ha registrado un nuevo mantenimiento para esta máquina y su contador de kilómetros actual ha sido reiniciado.

Por favor, programa el mantenimiento necesario.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>