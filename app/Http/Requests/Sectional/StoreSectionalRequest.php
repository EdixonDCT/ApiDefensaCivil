<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|alpha_spaces|string|max:50|unique:sectionals,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la seccional es obligatorio.',
            'name.alpha_spaces' => 'El nombre de la seccional debe tener solo letras y espacios.',
            'name.string' => 'El nombre de la seccional debe tener solo caracteres de tipo texto.',
            'name.unique' => 'La seccional ya existe.',
            'name.max' => 'El nombre de la seccional tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la seccional',
    ];
    }
}
