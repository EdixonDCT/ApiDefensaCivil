<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateGenderRequest
 * * Permite la actualización parcial de los registros de género.
 * La regla 'sometimes' es ideal para métodos PATCH, validando solo los campos presentes.
 */
class PartialUpdateGenderRequest extends FormRequest
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
     * Define las reglas de validación para la actualización parcial.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID del género desde la ruta para la excepción de unicidad.
         */
        $genderId = $this->route('gender_id');

        return [
            /**
             * El nombre es opcional, pero si se envía debe ser único (ignorando el actual) 
             * y contener solo letras.
             */
            'name'      => "sometimes|alpha|string|max:50|unique:genders,name,{$genderId}",
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
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'El :attribute ya se encuentra registrado',
            'name.max'          => 'El :attribute no puede superar los 50 caracteres',
            'is_active.boolean' => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
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