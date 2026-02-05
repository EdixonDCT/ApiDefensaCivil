<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateSectorRequest
 * * Valida el cambio de estado (activo/inactivo) de un sector.
 * Permite deshabilitar sectores geográficos o económicos sin eliminar la data histórica.
 */
class ChangeStateSectorRequest extends FormRequest
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
             * Eliminado el pipe final '|' para evitar errores de ejecución.
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
            'is_active' => 'estado del sector'
        ];
    }
}