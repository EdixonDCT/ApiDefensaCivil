<?php

namespace App\Http\Requests\Kinship;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateKinshipRequest
 * Se encarga de validar la actualización de un parentesco.
 * Permite mantener el mismo nombre sin romper la regla unique.
 */
class UpdateKinshipRequest extends FormRequest
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
     * Define las reglas de validación para actualizar el parentesco.
     * @return array
     */
    public function rules(): array
    {
        $kinshipId = $this->route('kinship_id');

        return [
            /**
             * El nombre es obligatorio, debe ser texto,
             * tener un tamaño razonable y ser único,
             * ignorando el registro actual.
             */
            'name' => "required|string|max:50|unique:kinships,name,{$kinshipId}" 
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
     * Nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'parentesco',
        ];
    }
}
