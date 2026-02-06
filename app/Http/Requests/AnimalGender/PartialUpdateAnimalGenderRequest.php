<?php

namespace App\Http\Requests\AnimalGender;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateAnimalGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => "sometimes|string|max:50|unique:animal_genders,name,{$id}"
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser texto válido',
            'name.max'    => 'El nombre no puede superar los 50 caracteres',
            'name.unique' => 'Este género de animal ya existe'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre'
        ];
    }
}
