<?php

namespace App\Http\Requests\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateActionPlanRequest
 * 
 * Valida la actualización completa de un plan de acción.
 */
class UpdateActionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id'      => 'required|exists:members,id',
            'risk_factor_id' => 'required|exists:risk_factors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'member_id.required'      => 'El :attribute es obligatorio',
            'member_id.exists'        => 'El :attribute seleccionado no es válido',

            'risk_factor_id.required' => 'El :attribute es obligatorio',
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
