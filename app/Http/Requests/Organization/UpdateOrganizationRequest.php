<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateOrganizationRequest
 * * Valida la actualización completa de una organización existente.
 * Mantiene la integridad referencial con las seccionales y permite 
 * conservar el nombre original mediante la excepción de ID.
 */
class UpdateOrganizationRequest extends FormRequest
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
     * Define las reglas de validación para la actualización.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID de la organización desde la ruta.
         */
        $organizationId = $this->route('organization_id');

        return [
            'name'         => "required|string|max:50|unique:organizations,name,{$organizationId}",
            'sectional_id' => 'required|exists:sectionals,id',
            'is_active'    => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'El :attribute es obligatorio',
            'name.string'           => 'El :attribute debe ser una cadena de texto válida',
            'name.max'              => 'El :attribute no debe superar los 50 caracteres',
            'name.unique'           => 'La :attribute ya se encuentra registrada',
            'sectional_id.required' => 'La :attribute es obligatoria',
            'sectional_id.exists'   => 'La :attribute seleccionada no existe',
            'is_active.required'    => 'El :attribute es obligatorio',
            'is_active.boolean'     => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
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