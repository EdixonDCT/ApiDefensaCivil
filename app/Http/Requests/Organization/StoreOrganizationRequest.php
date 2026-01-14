<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:organizations,name',
            'sectional_id' => 'required|exists:sectionals,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la organizacion es obligatorio.',
            'name.string' => 'El nombre de la seccional debe tener solo caracteres de tipo texto.',
            'name.max' => 'El nombre de la seccional tiene maximo 50 caracteres.',
            'name.unique' => 'La seccional ya existe.',
            'sectional_id.required' => 'ID de la seleccional es obligatorio.',
            'sectional_id.exists' => 'ID de la seleccional no existe.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la organizacion',
            'sectional_id' => 'ID de la seleccional'
    ];
    }
}
