<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Importa esta clase para la regla unique

class StoreAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambia esto si tienes lógica de autorización específica
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'machine_id' => [
                'required',
                'exists:machines,id',
                // Regla para evitar que una máquina ya asignada tenga otra asignación activa
                Rule::unique('assignments')->where(function ($query) {
                    return $query->where('machine_id', $this->machine_id)
                                 ->where(function ($q) {
                                     $q->whereNull('end_date')
                                       ->orWhere('end_date', '>', $this->start_date); 
                                 });
                })
            ],
            'work_id' => 'required|exists:works,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
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
        ];
    }
}