<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase IdentifyFamilyPlanRequest
 * * Valida los datos de identificación y ubicación física del Plan Familiar.
 * Incluye validación de sectores, calidad de vivienda y contacto telefónico.
 */
class IdentifyFamilyPlanRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la identificación del plan.
     * * @return array
     */
    public function rules(): array
    {
        return [
            'last_names'         => 'required|alpha_spaces|string|max:255',
            'address'            => 'required|string|max:255',
            'sector_id'          => 'required|exists:sectors,id',
            'sector_name'        => 'required|alpha_spaces|max:50',
            'landline_phone'     => 'sometimes|nullable|numeric|digits_between:7,10',
            'housing_quality_id' => 'required|exists:housing_qualities,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'last_names.required'         => 'Los :attribute son obligatorios',
            'last_names.alpha_spaces'     => 'Los :attribute solo pueden contener letras y espacios',
            'last_names.string'           => 'Los :attribute deben ser un texto válido',
            'last_names.max'              => 'Los :attribute no pueden superar los :max caracteres',

            'address.required'            => 'La :attribute es obligatoria',
            'address.max'                 => 'La :attribute no debe superar los :max caracteres',

            'sector_id.required'          => 'Debe seleccionar un :attribute',
            'sector_id.exists'            => 'El :attribute seleccionado no es válido',

            'sector_name.required'        => 'El :attribute es obligatorio',
            'sector_name.alpha_spaces'    => 'El :attribute debe contener solo letras y espacios',
            'sector_name.max'             => 'El :attribute no puede superar los :max caracteres',

            'landline_phone.numeric'      => 'El :attribute solo debe contener números',
            'landline_phone.digits_between' => 'El :attribute debe tener entre :min y :max dígitos',

            'housing_quality_id.required' => 'Debe seleccionar la :attribute',
            'housing_quality_id.exists'   => 'La :attribute seleccionada no es válida',
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'last_names'         => 'apellidos de la familia',
            'address'            => 'dirección',
            'sector_id'          => 'sector',
            'sector_name'        => 'nombre del sector',
            'landline_phone'     => 'teléfono fijo',
            'housing_quality_id' => 'calidad de la vivienda',
        ];
    }
}