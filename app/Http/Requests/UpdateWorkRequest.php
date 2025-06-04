<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkRequest extends FormRequest
{
    public function authorize(): bool
    {
        
        return true; 
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strtoupper($this->input('name')),
        ]);
    }

    public function rules(): array
    {
        $workId = $this->route('id'); 

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('works')->ignore($workId),
            ],
            'province_id' => 'required|exists:provinces,id',
            'start_date' => 'required|date',
            'end_date_planned' => 'required|date|after_or_equal:start_date',
            'end_date_real' => 'nullable|date|after_or_equal:start_date|after_or_equal:end_date_planned',
            'description' => 'nullable|string',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la obra es obligatorio.',
            'name.unique' => 'Ya existe una obra con este nombre.',
            'province_id.required' => 'La provincia es obligatoria.',
            'province_id.exists' => 'La provincia seleccionada no es válida.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date_planned.required' => 'La fecha de fin planificada es obligatoria.',
            'end_date_planned.date' => 'La fecha de fin planificada debe ser una fecha válida.',
            'end_date_planned.after_or_equal' => 'La fecha de fin planificada no puede ser anterior a la fecha de inicio.',
            'end_date_real.date' => 'La fecha de fin real debe ser una fecha válida.',
            'end_date_real.after_or_equal' => 'La fecha de fin real no puede ser anterior a la fecha de inicio ni a la fecha de fin planificada.',
            'description.string' => 'La descripción debe ser texto.',
        ];
    }
}