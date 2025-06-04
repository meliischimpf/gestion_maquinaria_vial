<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'serial_number' => strtoupper($this->input('serial_number')),
        ]);
    }

    public function rules(): array
    {
        $machineId = $this->route('id'); 

        return [
            'serial_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('machines')->ignore($machineId)
                   
            ],
            'type_id' => 'required|exists:machine_types,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'lifetime_km' => 'required|integer|min:0',
            'current_km' => 'required|integer|min:0',
            'status_id' => 'required|exists:statuses,id', 
        ];
    }

    public function messages(): array
    {
        return [
            'serial_number.required' => 'El número de serie es obligatorio.',
            'serial_number.unique' => 'El número de serie ya existe.',
            'type_id.required' => 'El tipo de máquina es obligatorio.',
            'type_id.exists' => 'El tipo de máquina seleccionado no es válido.',
            'brand.required' => 'La marca es obligatoria.',
            'model.required' => 'El modelo es obligatorio.',
            'lifetime_km.required' => 'El kilometraje de vida es obligatorio.',
            'lifetime_km.integer' => 'El kilometraje de vida debe ser un número entero.',
            'lifetime_km.min' => 'El kilometraje de vida no puede ser menor que 0.',
            'current_km.required' => 'El kilometraje actual es obligatorio.',
            'current_km.integer' => 'El kilometraje actual debe ser un número entero.',
            'current_km.min' => 'El kilometraje actual no puede ser menor que 0.',
            'status_id.required' => 'El estado es obligatorio.',
            'status_id.exists' => 'El estado seleccionado no es válido.',
        ];
    }


    public function after(): array
    {
        return [
            function ($validator) {
                if ($this->input('current_km') !== null && $this->input('lifetime_km') !== null &&
                    $this->input('current_km') > $this->input('lifetime_km')) {
                    $validator->errors()->add('current_km', 'El kilometraje actual no puede ser mayor que el kilometraje de vida.');
                    $validator->errors()->add('lifetime_km', 'El kilometraje de vida no puede ser menor que el kilometraje actual.');
                }
            }
        ];
    }
}