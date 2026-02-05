<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreSectionalRequest
 * * Valida la creación de una nueva seccional en el sistema.
 * Garantiza que el nombre sea único, obligatorio y que cumpla con el formato permitido.
 */
class StoreSectionalRequest extends FormRequest
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
     * Define las reglas de validación para el registro de una seccional.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * 'alpha_spaces' permite nombres compuestos (ej: "Sede Centro").
             */
            'name' => 'required|alpha_spaces|string|max:50|unique:sectionals,name',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe contener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'La :attribute ya se encuentra registrada',
            'name.max'          => 'El :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define el nombre amigable del campo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre de la seccional',
        ];
    }
}