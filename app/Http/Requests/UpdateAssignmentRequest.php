<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        $assignmentId = $this->route('id') ?? $this->assignment->id; 

        return [
            'start_date' => 'required|date',
            'machine_id' => [
                'required',
                'exists:machines,id',
                Rule::unique('assignments')->ignore($assignmentId)
                    ->where(function ($query) {
                        return $query->where('machine_id', $this->machine_id)
                                     ->where(function ($q) {
                                         $q->whereNull('end_date')
                                           ->orWhere('end_date', '>', $this->start_date);
                                     });
                    }),
            ],
            'work_id' => 'required|exists:works,id',
            ];
    }

    public function messages(): array
    {
        return [
            'start_date.required' => 'La fecha de inicio de la asignación es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'machine_id.required' => 'Debes seleccionar una máquina.',
            'machine_id.exists' => 'La máquina seleccionada no es válida.',
            'machine_id.unique' => 'Esta máquina ya está asignada y su asignación actual no ha finalizado para la fecha de inicio seleccionada.',
            'work_id.required' => 'Debes seleccionar una obra.',
            'work_id.exists' => 'La obra seleccionada no es válida.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after_or_equal' => 'La fecha de fin no puede ser anterior a la fecha de inicio.',
            'km_traveled.numeric' => 'Los kilómetros recorridos deben ser un número.',
            'km_traveled.min' => 'Los kilómetros recorridos no pueden ser negativos.',
        ];
    }
}