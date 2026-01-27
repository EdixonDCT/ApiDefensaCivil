<?php

namespace App\Http\Requests\Kinship;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreKinshipRequest
 * Se encarga de validar la creación de un nuevo registro de parentesco.
 * Asegura que el nombre sea válido y no se repita en el sistema.
 */
class StoreKinshipRequest extends FormRequest
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
     * Define las reglas de validación para el parentesco.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio, debe ser texto,
             * tener un tamaño razonable y ser único en la tabla kinships.
             */
            'name' => 'required|string|max:50|unique:kinships,name',
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.max'      => 'El :attribute no puede superar los 50 caracteres',
            'name.unique'   => 'El :attribute ya se encuentra registrado',
        ];
    }

    /**
     * Define el nombre amigable del atributo para los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'parentesco',
        ];
    }
}
