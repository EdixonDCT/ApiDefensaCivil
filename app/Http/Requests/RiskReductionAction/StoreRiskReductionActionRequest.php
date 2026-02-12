<?php

namespace App\Http\Requests\RiskReductionAction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreRiskReductionActionRequest
 *
 * Centraliza la validación necesaria para registrar
 * una acción de reducción de riesgo.
 */
class StoreRiskReductionActionRequest extends FormRequest
{
    /**
     * Define si el usuario puede ejecutar esta acción.
     * Actualmente no se restringe por permisos.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas técnicas de validación.
     * Cada campo representa la información básica y relacional
     * de la acción de mitigación.
     */
    public function rules(): array
    {
        return [
            // Descripción de la acción
            'action' => 'required|string|max:255',

            // Miembro responsable de la acción
            'member_id' => 'required|exists:members,id',

            // Factor de riesgo asociado
            'risk_factor_id' => 'required|exists:risk_factors,id',

            // Fecha límite para ejecutar la acción
            'end_date' => 'required|date|after_or_equal:today',
        ];
    }

    /**
     * Mensajes de error reutilizables.
     * Se usan reglas globales para mantener consistencia.
     */
    public function messages(): array
    {
        return [
            'required' => 'El :attribute es obligatorio',

            'string' => 'El :attribute debe ser una cadena de texto válida',

            'max' => 'El :attribute no puede superar los :max caracteres',

            'exists' => 'El :attribute seleccionado no existe en el sistema',

            'date' => 'El :attribute debe tener un formato de fecha válido',

            'after_or_equal' => 'La :attribute debe ser igual o posterior a la fecha actual',
        ];
    }

    /**
     * Traducción de nombres técnicos a nombres entendibles.
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
