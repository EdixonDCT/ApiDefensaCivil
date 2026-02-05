<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreOrganizationRequest
 * * Valida la creación de una nueva organización.
 * Asegura que el nombre sea único y que la seccional vinculada exista en el sistema.
 */
class StoreOrganizationRequest extends FormRequest
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
     * Define las reglas de validación para el registro de una organización.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:50|unique:organizations,name',
            'sectional_id' => 'required|exists:sectionals,id',
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
            'sectional_id.exists'   => 'La :attribute seleccionada no existe'
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
            'sectional_id' => 'seccional vinculada'
        ];
    }
}