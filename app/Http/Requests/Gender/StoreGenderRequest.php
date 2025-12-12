<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:genders,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del genero es obligatorio.',
            'name.string' => 'El nombre del genero debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El nombre del genero ya existe.',
            'name.max' => 'El nombre del genero tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del genero',
    ];
    }
}
