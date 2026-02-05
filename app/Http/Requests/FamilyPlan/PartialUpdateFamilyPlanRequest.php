<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateFamilyPlanRequest
 * * Valida actualizaciones parciales (PATCH) de los datos del Plan Familiar.
 * El uso de 'sometimes' permite enviar solo los campos que necesitan cambio.
 */
class PartialUpdateFamilyPlanRequest extends FormRequest
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
     * Define las reglas de validación para la actualización parcial.
     * * @return array
     */
    public function rules(): array
    {
        return [
            'last_names'         => 'sometimes|alpha_spaces|string|max:255',
            'zone_id'            => 'sometimes|exists:zones,id',
            'city_id'            => 'sometimes|exists:cities,id',
            'sectionals_id'      => 'sometimes|exists:sectionals,id',
            'address'            => 'sometimes|string|max:255',
            'sector_id'          => 'sometimes|exists:sectors,id',
            'sector_name'        => 'sometimes|string|max:50',
            'landline_phone'     => 'sometimes|nullable|numeric|digits_between:7,10',
            'housing_quality_id' => 'sometimes|exists:housing_qualities,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'last_names.alpha_spaces' => 'Los :attribute solo pueden contener letras y espacios',
            'last_names.string'       => 'Los :attribute deben ser un texto válido',
            'last_names.max'          => 'Los :attribute no deben superar los :max caracteres',
            
            'zone_id.exists'          => 'La :attribute seleccionada no es válida',
            'city_id.exists'          => 'La :attribute seleccionada no es válida',
            'sectionals_id.exists'    => 'La :attribute seleccionada no es válida',
            
            'address.max'             => 'La :attribute no debe superar los :max caracteres',
            
            'sector_id.exists'        => 'El :attribute seleccionado no es válido',
            'sector_name.string'      => 'El :attribute debe ser un texto válido',
            'sector_name.max'         => 'El :attribute no debe superar los :max caracteres',
            
            'landline_phone.numeric'        => 'El :attribute solo debe contener números',
            'landline_phone.digits_between' => 'El :attribute debe tener entre :min y :max dígitos',
            
            'housing_quality_id.exists' => 'La :attribute seleccionada no es válida',
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
            'zone_id'            => 'zona',
            'city_id'            => 'ciudad',
            'sectionals_id'      => 'seccional',
            'address'            => 'dirección',
            'sector_id'          => 'sector',
            'sector_name'        => 'nombre del sector',
            'landline_phone'     => 'teléfono fijo',
            'housing_quality_id' => 'calidad de la vivienda',
        ];
    }
}