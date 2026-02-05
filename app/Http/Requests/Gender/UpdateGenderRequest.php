<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateGenderRequest
 * * Valida la actualización de un género existente.
 * Incluye la lógica de ignorar el ID actual para permitir guardar cambios
 * sin que el nombre genere un conflicto de duplicidad.
 */
class UpdateGenderRequest extends FormRequest
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
     * Define las reglas de validación para la actualización del género.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID del género desde los parámetros de la ruta.
         */
        $genderId = $this->route('gender_id');

        return [
            /**
             * El nombre es obligatorio y debe ser único, ignorando el registro actual.
             */
            'name'      => "required|alpha|string|max:50|unique:genders,name,{$genderId}",
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'El :attribute es obligatorio',
            'name.alpha'         => 'El :attribute debe contener solo letras',
            'name.string'        => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'        => 'El :attribute ya se encuentra registrado',
            'name.max'           => 'El :attribute no puede superar los 50 caracteres',
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los campos para los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre del género',
            'is_active' => 'estado del género'
        ];
    }
}