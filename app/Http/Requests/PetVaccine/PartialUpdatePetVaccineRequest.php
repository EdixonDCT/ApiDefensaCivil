<?php

namespace App\Http\Requests\PetVaccine;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdatePetVaccineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => 'sometimes|string|max:255',
            'date'   => 'sometimes|date',
            'pet_id' => 'sometimes|exists:pets,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'     => 'El :attribute debe ser texto.',
            'name.max'        => 'El :attribute no puede superar los 255 caracteres.',

            'date.date'       => 'La :attribute no tiene un formato válido.',

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
