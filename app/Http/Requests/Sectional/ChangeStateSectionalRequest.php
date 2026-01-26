<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateSectionalRequest
 * * Valida el cambio de estado de una seccional.
 * Permite deshabilitar sedes sin borrarlas físicamente, manteniendo la integridad
 * de los datos históricos vinculados.
 */
class ChangeStateSectionalRequest extends FormRequest
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
            /**
             * CORRECCIÓN: Se eliminó el pipe final '|' para evitar errores de validación.
             */
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
            'is_active' => 'estado de la seccional'
        ];
    }
}