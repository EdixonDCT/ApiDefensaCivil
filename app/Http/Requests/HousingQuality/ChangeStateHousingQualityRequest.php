<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateHousingQualityRequest
 * * Permite activar o desactivar las categorías de calidad de vivienda.
 * Útil para gestionar catálogos de indicadores de vivienda sin eliminar registros históricos.
 */
class ChangeStateHousingQualityRequest extends FormRequest
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
             * Se eliminó el pipe final para evitar errores de sintaxis en el validador.
             */
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados.
     * * Corregido: Se cambió "genero" por :attribute para ser dinámico.
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
            'is_active' => 'estado de la calidad de vivienda'
        ];
    }
}