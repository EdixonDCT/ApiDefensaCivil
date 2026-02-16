<?php

namespace App\Http\Requests\RiskReductionAction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateRiskReductionActionRequest
 *
 * Valida la actualización parcial (PATCH) de una acción
 * de reducción de riesgo existente.
 * Solo se validan los campos enviados en la solicitud.
 */
class PartialUpdateRiskReductionActionRequest extends FormRequest
{
    /**
     * Autoriza la ejecución de la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualización parcial.
     * Se usa "sometimes|required" para validar únicamente
     * los campos presentes en la petición.
     */
    public function rules(): array
    {
        return [
            // Descripción de la acción
            'action' => 'sometimes|required|string|max:255',

            // Miembro responsable
            'member_id' => 'sometimes|required|exists:members,id',

            // Factor de riesgo asociado
            'risk_factor_id' => 'sometimes|required|exists:risk_factors,id',

            // Fecha límite de ejecución
            'end_date' => 'sometimes|required|date|after_or_equal:today',
        ];
    }

    /**
     * Mensajes de error reutilizables.
     */
    public function messages(): array
    {
        return [
            'required' => 'El :attribute es obligatorio',
            'string' => 'El :attribute debe ser una cadena de texto válida',
            'exists' => 'El :attribute seleccionado no existe en el sistema',
            'max' => 'El :attribute no puede superar los :max caracteres',
            'date' => 'El :attribute debe tener un formato de fecha válido',
            'after_or_equal' => 'La :attribute debe ser igual o posterior a la fecha actual',
        ];
    }

    /**
     * Nombres amigables para los atributos.
     */
    public function attributes(): array
    {
        return [
            'action' => 'acción de reducción',
            'member_id' => 'miembro responsable',
            'risk_factor_id' => 'factor de riesgo',
            'end_date' => 'fecha límite',
        ];
    }
}
