<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $organization = $this->route('organization_id');
        return [
            'name' => 'required|string|max:50|unique:organizations,name,'.$organization,
            'sectional_id' => 'required|exists:sectionals,id',
            'is_active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la organizacion es obligatorio.',
            'name.string' => 'El nombre de la organizacion debe tener solo caracteres de tipo texto.',
            'name.max' => 'El nombre de la organizacion tiene maximo 50 caracteres.',
            'name.unique' => 'La organizacion ya existe.',
            'sectional_id.required' => 'ID de la seccional es obligatorio.',
            'sectional_id.exists' => 'ID de la seccional no existe.',
            'is_active.required' => 'El estado activo de la organizacion es obligatorio.',
            'is_active.boolean' => 'El estado activo de la organizacion debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la organizacion',
            'sectional_id' => 'ID de la seccional',
            'is_active' => 'El estado activo de la organizacion'
    ];
    }
}
