<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStatusFamilyPlanRequest
 * * Valida el cambio de estado de un plan familiar.
 * Crucial para el flujo de trabajo (workflow) del sistema, conectando
 * el plan con los estados definidos en la tabla 'status_plans'.
 */
class ChangeStatusFamilyPlanRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para el cambio de estado.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * status_plan_id: Debe ser obligatorio y existir en la tabla maestra de estados.
             */
            'status_plan_id' => 'required|exists:status_plans,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y concordancia corregida.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'status_plan_id.required' => 'El :attribute es obligatorio',
            'status_plan_id.exists'   => 'El :attribute seleccionado no es válido'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'status_plan_id' => 'estado del plan'
        ];
    }
}