<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Importa Rule para la validación de unicidad

class UpdateParameterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Define aquí la lógica de autorización. Por ahora, asumimos true.
        // En una aplicación real, aquí verificarías si el usuario tiene permiso para editar parámetros.
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $parameterId = $this->route('id'); 

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('parameters')->ignore($parameterId),
            ],
            'value' => 'required|string|max:255', 
            'description' => 'nullable|string', 
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del parámetro es obligatorio.',
            'name.unique' => 'Ya existe un parámetro con este nombre. Por favor, elige otro.',
            'name.string' => 'El nombre del parámetro debe ser texto.',
            'name.max' => 'El nombre del parámetro no puede exceder los :max caracteres.',
            
            'value.required' => 'El valor del parámetro es obligatorio.',
            'value.string' => 'El valor del parámetro debe ser texto.',
            'value.max' => 'El valor del parámetro no puede exceder los :max caracteres.',
            
            'description.string' => 'La descripción debe ser texto.',
        ];
    }
}