<?php

namespace App\Http\Requests\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreActionPlanRequest
 * 
 * Valida la creación de un nuevo plan de acción.
 * Asegura que el miembro y el factor de riesgo existan en el sistema.
 */
class StoreActionPlanRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'member_id'      => 'required|exists:members,id',
            'risk_factor_id' => 'required|exists:risk_factors,id',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'member_id.required'      => 'El :attribute es obligatorio',
            'member_id.exists'        => 'El :attribute seleccionado no es válido',

            'risk_factor_id.required' => 'El :attribute es obligatorio',
            'risk_factor_id.exists'   => 'El :attribute seleccionado no es válido',
        ];
    }

    /**
     * Nombres amigables.
     */
    public function attributes(): array
    {
        return [
            'member_id'      => 'miembro',
            'risk_factor_id' => 'factor de riesgo',
        ];
    }
}
