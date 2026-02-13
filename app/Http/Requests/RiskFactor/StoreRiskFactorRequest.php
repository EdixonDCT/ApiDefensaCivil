<?php

namespace App\Http\Requests\RiskFactor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'threat_type_id' => 'required|exists:threat_types,id',
            'description' => 'required|string|max:255',
            'ubication' => 'required|string|max:255',
            'family_plan_id' => 'required|exists:family_plans,id',
            'distance' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'threat_type_id.required' => 'El tipo de amenaza es obligatorio.',
            'threat_type_id.exists' => 'El tipo de amenaza seleccionado no existe.',

            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',

            'ubication.required' => 'La ubicación es obligatoria.',
            'ubication.string' => 'La ubicación debe ser un texto válido.',
            'ubication.max' => 'La ubicación no puede superar los 255 caracteres.',

            'family_plan_id.required' => 'El plan familiar es obligatorio.',
            'family_plan_id.exists' => 'El plan familiar seleccionado no existe.',

            'distance.required' => 'La distancia es obligatoria.',
            'distance.integer' => 'La distancia debe ser un número entero.',
            'distance.min' => 'La distancia debe ser mayor o igual a 1 metros.',
        ];
    }
}
