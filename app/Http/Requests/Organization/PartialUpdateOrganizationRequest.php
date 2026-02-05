<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateOrganizationRequest
 * * Valida actualizaciones parciales (PATCH) para las organizaciones.
 * Permite actualizar el nombre, la seccional vinculada o el estado de forma independiente.
 */
class PartialUpdateOrganizationRequest extends FormRequest
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
     * Define las reglas de validación.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Capturamos el ID de la organización desde la ruta para la excepción de unicidad.
         */
        $organizationId = $this->route('organization_id');

        return [
            /**
             * 'sometimes' permite que los campos no sean obligatorios en la petición.
             */
            'name'         => "sometimes|string|max:50|unique:organizations,name,{$organizationId}",
            'sectional_id' => 'sometimes|exists:sectionals,id',
            'is_active'    => 'sometimes|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string'         => 'El :attribute debe ser una cadena de texto válida',
            'name.max'            => 'El :attribute no debe superar los 50 caracteres',
            'name.unique'         => 'El :attribute ya se encuentra registrado',
            'sectional_id.exists' => 'La :attribute seleccionada no existe',
            'is_active.boolean'   => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'         => 'nombre de la organización',
            'sectional_id' => 'seccional vinculada',
            'is_active'    => 'estado de la organización'
        ];
    }
}