<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreHousingQualityRequest
 * * Valida el registro inicial de una nueva categoría de calidad de vivienda.
 * Asegura que no se dupliquen indicadores y que el formato sea puramente alfabético.
 */
class StoreHousingQualityRequest extends FormRequest
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
     * Define las reglas de validación para la creación de calidad de vivienda.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio, debe ser único y solo contener letras.
             */
            'name' => 'required|alpha|string|max:50|unique:housing_qualities,name',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'name.alpha'    => 'El :attribute debe contener solo letras',
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'   => 'El :attribute ya se encuentra registrado',
            'name.max'      => 'El :attribute no puede superar los 50 caracteres'
        ];
    }

    /**
     * Define el nombre amigable del campo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre de la calidad de vivienda',
        ];
    }
}