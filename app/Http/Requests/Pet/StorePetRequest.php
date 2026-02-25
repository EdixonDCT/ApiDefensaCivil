<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiado a true para permitir la validación
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'breed' => 'required|string|max:50',
            'age' => 'required|integer|min:0|max:50',
            'animal_gender_id' => 'required|exists:animal_genders,id',
            'species_id' => 'required|exists:species,id',
            'family_plan_id' => 'required|exists:family_plans,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la mascota es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 50 caracteres.',

            'breed.required' => 'La raza es obligatoria.',
            'breed.string' => 'La raza debe ser un texto válido.',
            'breed.max' => 'La raza no puede superar los 50 caracteres.',

            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser menor a 0.',
            'age.max' => 'La edad no puede ser mayor de 50.',

            'animal_gender_id.required' => 'El género del animal es obligatorio.',
            'animal_gender_id.exists' => 'El género seleccionado no existe.',

            'species_id.required' => 'La especie es obligatoria.',
            'species_id.exists' => 'La especie seleccionada no existe.',

            'family_plan_id.required' => 'El plan familiar es obligatorio.',
            'family_plan_id.exists' => 'El plan familiar seleccionado no existe.',
        ];
    }
}
