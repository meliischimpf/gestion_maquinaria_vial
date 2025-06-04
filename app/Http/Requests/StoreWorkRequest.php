<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id', 
            'start_date' => 'required|date',
            'end_date_planned' => 'required|date|after_or_equal:start_date', 
            'description' => 'nullable|string|max:1000', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la obra es obligatorio.',
            'province_id.required' => 'La provincia es obligatoria.',
            'province_id.exists' => 'La provincia seleccionada no es válida.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date_planned.required' => 'La fecha de fin planificada es obligatoria.',
            'end_date_planned.date' => 'La fecha de fin planificada debe ser una fecha válida.',
            'end_date_planned.after_or_equal' => 'La fecha de fin planificada no puede ser anterior a la fecha de inicio.',
            'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
        ];
    }
}