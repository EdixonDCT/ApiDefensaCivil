<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase GeoreFamilyPlanRequest
 * * Valida la información de ubicación geográfica (coordenadas o dirección técnica)
 * de un plan familiar específico.
 */
class GeoreFamilyPlanRequest extends FormRequest
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
     * Define las reglas de validación para la georreferenciación.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * georeference: Obligatorio para poder ubicar el plan en el mapa.
             */
            'georeference' => 'required|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados con corrección de campos y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'georeference.required' => 'La :attribute es obligatoria',
            'georeference.string'   => 'La :attribute debe ser una cadena de texto válida',
            'georeference.max'      => 'La :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'georeference' => 'georreferenciación'
        ];
    }
}