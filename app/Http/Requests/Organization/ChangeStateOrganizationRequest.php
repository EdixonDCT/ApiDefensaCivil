<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateOrganizationRequest
 * * Valida el cambio de estado (activo/inactivo) de una organización.
 * Útil para suspender organizaciones sin eliminar sus registros históricos 
 * o relaciones con otros modelos.
 */
class ChangeStateOrganizationRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para el cambio de estado.
     * @return array
     */
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'estado de la organización'
        ];
    }
}