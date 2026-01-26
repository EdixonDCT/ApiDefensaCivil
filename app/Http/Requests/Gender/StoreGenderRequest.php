<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreGenderRequest
 * * Se encarga de validar la creación de un nuevo registro de género.
 * Asegura que el nombre sea único y contenga únicamente caracteres alfabéticos.
 */
class StoreGenderRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un género.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio, debe ser alfabético, texto, 
             * máximo 50 caracteres y único en la tabla 'genders'.
             */
            'name' => 'required|alpha|string|max:50|unique:genders,name',
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
            'name.alpha'    => 'El :attribute debe contener solo letras',
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'   => 'El :attribute ya se encuentra registrado',
            'name.max'      => 'El :attribute no puede superar los 50 caracteres'
        ];
    }

    /**
     * Define el nombre amigable del atributo para los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del género',
        ];
    }
}