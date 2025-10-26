<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Importa esta clase para la regla unique

class StoreMachineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'serial_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('machines')->where(fn ($query) => $query->whereRaw('LOWER(serial_number) = LOWER(?)', [$this->input('serial_number')])), 
            ],
            'type_id' => 'required|exists:machine_types,id', 
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'lifetime_km' => 'required|integer|min:0', 
            'current_km' => 'required|integer|min:0', 
            'status_id' => 'required|exists:statuses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'serial_number.unique' => 'El número de serie ya existe.',
            'type_id.exists' => 'El tipo de máquina seleccionado no es válido.',
            'status_id.exists' => 'El estado de máquina seleccionado no es válido.',
            'lifetime_km.min' => 'El kilometraje de vida no puede ser menor que 0.',
            'current_km.min' => 'El kilometraje actual no puede ser menor que 0.',
        ];
    }

    /**
     * Add "after" hooks to the validator.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function after(): array
    {
        return [
            function ($validator) {
                if ($this->input('current_km') > $this->input('lifetime_km')) {
                    $validator->errors()->add('current_km', 'El kilometraje actual no puede ser mayor que el kilometraje de vida.');
                    $validator->errors()->add('lifetime_km', 'El kilometraje de vida no puede ser menor que el kilometraje actual.');
                }
            }
        ];
    }
}