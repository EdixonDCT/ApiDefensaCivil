<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateHousingQualityRequest
 * * Valida la actualización completa de un indicador de calidad de vivienda.
 * Permite mantener el nombre original del registro sin disparar errores de unicidad
 * gracias a la excepción por ID.
 */
class UpdateHousingQualityRequest extends FormRequest
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
         * Obtenemos el ID desde la ruta para que Laravel lo ignore en la validación unique.
         */
        $housingQualityId = $this->route('housingQuality_id');

        return [
            'name'      => "required|alpha|string|max:50|unique:housing_qualities,name,{$housingQualityId}",
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Validaciones para el Nombre
            'name.required'      => 'El :attribute es obligatorio',
            'name.alpha'         => 'El :attribute debe contener solo letras',
            'name.string'        => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'        => 'El :attribute ya se encuentra registrado',
            'name.max'           => 'El :attribute no puede superar los 50 caracteres',

            // Validaciones para el Estado
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre de la calidad de vivienda',
            'is_active' => 'estado de la calidad de vivienda'
        ];
    }
}