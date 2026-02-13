<?php

namespace App\Http\Requests\RiskFactor;

use Illuminate\Foundation\Http\FormRequest;
use RuntimeException;

class PartialUpdateRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'threat_type_id' => 'sometimes|exists:threat_types,id',
            'description' => 'sometimes|string|max:255',
            'ubication' => 'sometimes|string|max:255',
            'family_plan_id' => 'sometimes|exists:family_plans,id',
            'distance' => 'sometimes|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'threat_type_id.exists' => 'El tipo de amenaza seleccionado no existe.',

            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',

            'ubication.string' => 'La ubicación debe ser un texto válido.',
            'ubication.max' => 'La ubicación no puede superar los 255 caracteres.',

            'family_plan_id.exists' => 'El plan familiar seleccionado no existe.',

            'distance.integer' => 'La distancia debe ser un número entero.',
            'distance.min' => 'La distancia debe ser mayor o igual a 1 metro.',
        ];
    }
}
