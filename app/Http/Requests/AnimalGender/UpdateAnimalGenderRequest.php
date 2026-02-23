<?php

namespace App\Http\Requests\AnimalGender;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name'      => "required|string|max:50|unique:animal_genders,name,{$id}"
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'El :attribute es obligatorio',
            'name.string'      => 'El :attribute debe ser texto válido',
            'name.max'         => 'El :attribute no puede superar los 50 caracteres',
            'name.unique'      => 'Este :attribute ya existe'
        ];
    }

    public function attributes(): array
    {
        return [
            'name'      => 'nombre'
        ];
    }
}
