<?php

namespace App\Http\Requests\AnimalGender;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:animal_genders,name'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string'   => 'El nombre debe ser texto válido',
            'name.max'      => 'El nombre no puede superar los 50 caracteres',
            'name.unique'   => 'Este género de animal ya existe'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre'
        ];
    }
}
