<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdatePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:50',
            'breed' => 'sometimes|string|max:50',
            'age' => 'sometimes|integer|min:0',
            'animal_gender_id' => 'sometimes|exists:animal_genders,id',
            'species_id' => 'sometimes|exists:species,id',
            'family_plan_id' => 'sometimes|exists:family_plans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 50 caracteres.',

            'breed.string' => 'La raza debe ser un texto válido.',
            'breed.max' => 'La raza no puede superar los 50 caracteres.',

            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser menor a 0.',

            'animal_gender_id.exists' => 'El género seleccionado no existe.',
            'species_id.exists' => 'La especie seleccionada no existe.',
            'family_plan_id.exists' => 'El plan familiar seleccionado no existe.',
        ];
    }
}
