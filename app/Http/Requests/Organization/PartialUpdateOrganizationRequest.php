<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $organization = $this->route('organization_id');
        return [
            'name' => 'sometimes|string|max:50|unique:organizations,name,'.$organization,
            'sectional_id' => 'sometimes|exists:sectionals,id',
            'is_active' => 'sometimes|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'El nombre de la organizacion debe tener solo caracteres de tipo texto.',
            'name.max' => 'El nombre de la organizacion tiene maximo 50 caracteres.',
            'name.unique' => 'La organizacion ya existe.',
            'sectional_id.exists' => 'ID de la seccional no existe en la base de datos.',
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
