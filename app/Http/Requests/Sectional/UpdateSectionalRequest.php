<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $sectional = $this->route('sectional_id');
        return [
            'name' => 'required|alpha_spaces|string|max:50|unique:sectionals,name,'.$sectional,
            'is_active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la seccional es obligatorio.',
            'name.alpha_spaces' => 'El nombre de la seccional debe tener solo letras y espacios.',
            'name.string' => 'El nombre de la seccional debe tener solo caracteres de tipo texto.',
            'name.unique' => 'La seccional ya existe.',
            'name.max' => 'El nombre de la seccional tiene maximo 50 caracteres.',
            'is_active.required' => 'El estado activo de la seccional es obligatorio.',
            'is_active.boolean' => 'El estado activo de la seccional debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la seccional',
            'is_active' => 'El estado activo de la seccional'
            ];
    }
}
