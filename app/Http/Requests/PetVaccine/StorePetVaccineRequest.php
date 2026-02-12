<?php

namespace App\Http\Requests\PetVaccine;

use Illuminate\Foundation\Http\FormRequest;

class StorePetVaccineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'date'   => 'required|date',
            'pet_id' => 'required|exists:pets,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'El :attribute es obligatorio.',
            'name.string'     => 'El :attribute debe ser texto.',
            'name.max'        => 'El :attribute no puede superar los 255 caracteres.',

            'date.required'   => 'La :attribute es obligatoria.',
            'date.date'       => 'La :attribute no tiene un formato válido.',

            'pet_id.required' => 'La mascota es obligatoria.',
            'pet_id.exists'   => 'La mascota seleccionada no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'   => 'nombre de la vacuna',
            'date'   => 'fecha de aplicación',
            'pet_id' => 'mascota',
        ];
    }
}
