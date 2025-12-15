<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $gender = $this->route('gender_id');
        return [
            'name' => 'sometimes|alpha|string|max:50|unique:genders,name,'.$gender,
            'state' => 'sometimes|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del genero es obligatorio.',
            'name.alpha' => 'El nombre del genero debe tener solo letras.',
            'name.string' => 'El nombre del genero debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El nombre del genero ya existe.',
            'name.max' => 'El nombre del genero tiene maximo 50 caracteres.',
            'state.required' => 'El estado del genero es obligatorio.',
            'state.boolean' => 'El estado del genero debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del genero',
            'state' => 'estado del genero'
    ];
    }
}
