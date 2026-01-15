<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_names' => 'required|alpha_spaces|string|max:255',
            'zone_id' => 'required|exists:zones,id',
            'city_id' => 'required|exists:cities,id',
            'sectionals_id' => 'required|exists:sectionals,id',
        ];
    }

    public function messages(): array
    {
        return [
            'last_names.required' => 'El campo :attribute es obligatorio.',
            'last_names.alpha_spaces' => 'El campo :attribute solo puede contener letras y espacios.',
            'last_names.string' => 'El campo :attribute debe ser un texto.',
            'last_names.max' => 'El campo :attribute no puede tener más de 255 caracteres.',
            'zone_id.required' => 'Debe seleccionar una :attribute.',
            'zone_id.exists' => 'La :attribute seleccionada no es válida.',
            'city_id.required' => 'Debe seleccionar una :attribute.',
            'city_id.exists' => 'La :attribute seleccionada no es válida.',
            'sectionals_id.required' => 'Debe seleccionar una :attribute.',
            'sectionals_id.exists' => 'La :attribute seleccionada no es válida.',
        ];
    }

    public function attributes(): array
    {
        return [
            'last_names' => 'apellidos',
            'zone_id' => 'zona',
            'city_id' => 'ciudad',
            'sectionals_id' => 'seccional',
        ];
    }
}
