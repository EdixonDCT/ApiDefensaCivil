<?php

namespace App\Http\Requests\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateActionPlanRequest
 * 
 * Valida la actualización parcial (PATCH) de un plan de acción.
 */
class PartialUpdateActionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id'      => 'sometimes|exists:members,id',
            'risk_factor_id' => 'sometimes|exists:risk_factors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'member_id.exists'        => 'El :attribute seleccionado no es válido',
            'risk_factor_id.exists'   => 'El :attribute seleccionado no es válido',
        ];
    }

    public function attributes(): array
    {
        return [
            'member_id'      => 'miembro',
            'risk_factor_id' => 'factor de riesgo',
        ];
    }
}
