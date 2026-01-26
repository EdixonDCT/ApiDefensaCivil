<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateHousingQualityRequest
 * * Valida actualizaciones parciales (PATCH) para los indicadores de calidad de vivienda.
 * Permite modificar el nombre o el estado de forma independiente.
 */
class PartialUpdateHousingQualityRequest extends FormRequest
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
        $housingQualityId = $this->route('housingQuality_id');

        return [
            /**
             * 'sometimes' asegura que el campo solo se valide si está presente en la petición.
             */
            'name'      => "sometimes|alpha|string|max:50|unique:housing_qualities,name,{$housingQualityId}",
            'is_active' => 'sometimes|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.alpha'        => 'El :attribute debe contener solo letras',
            'name.string'       => 'El :attribute debe ser una cadena de texto',
            'name.unique'       => 'El :attribute ya se encuentra registrado',
            'name.max'          => 'El :attribute no puede superar los 50 caracteres',
            'is_active.boolean' => 'El :attribute debe ser activo o inactivo'
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