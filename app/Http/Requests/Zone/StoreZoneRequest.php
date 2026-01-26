<?php

namespace App\Http\Requests\Zone;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreZoneRequest
 * * Valida la creación de un nuevo tipo de zona geográfica.
 * Asegura que el nombre sea único y cumpla con el formato alfabético.
 */
class StoreZoneRequest extends FormRequest
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
     * Define las reglas de validación para el registro de una zona.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * name: Requerido, único en la tabla 'zones'.
             * Nota: 'alpha' no permite espacios ni números.
             */
            'name' => 'required|alpha|string|max:50|unique:zones,name',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'name.alpha'    => 'El :attribute debe contener solo letras',
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'   => 'El :attribute ingresado ya existe',
            'name.max'      => 'El :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'tipo de zona',
        ];
    }
}