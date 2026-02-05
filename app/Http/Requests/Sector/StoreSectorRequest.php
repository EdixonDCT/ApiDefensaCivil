<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreSectorRequest
 * * Valida la creación de un nuevo sector.
 * Asegura que el nombre sea puramente alfabético y no se repita en la base de datos.
 */
class StoreSectorRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un sector.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio y debe ser único.
             * Nota: 'alpha' no permite espacios. Si necesitas sectores como "Sector A", 
             * considera usar 'alpha_spaces'.
             */
            'name' => 'required|alpha|string|max:50|unique:sectors,name',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
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
     * Define el nombre amigable del campo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del sector',
        ];
    }
}