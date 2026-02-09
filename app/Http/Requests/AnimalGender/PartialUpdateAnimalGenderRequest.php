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
            'name'      => "sometimes|string|max:50|unique:animal_genders,name,{$id}",
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'      => 'El :attribute debe ser texto válido',
            'name.max'         => 'El :attribute no puede superar los 50 caracteres',
            'name.unique'      => 'Este :attribute ya existe',

            'is_active.boolean' => 'El :attribute debe ser verdadero o falso',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'      => 'nombre',
            'is_active' => 'estado genero del animal',
        ];
    }
}
