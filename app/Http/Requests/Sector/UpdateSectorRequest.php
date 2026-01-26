<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateSectorRequest
 * * Valida la actualización completa de un sector existente.
 * Permite modificar el nombre y el estado, asegurando la integridad de los datos
 * y permitiendo mantener el nombre actual sin errores de duplicidad.
 */
class UpdateSectorRequest extends FormRequest
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
     * Define las reglas de validación para la actualización.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID del sector desde la ruta para la excepción de unicidad.
         */
        $sectorId = $this->route('sector_id');

        return [
            'name'      => "required|alpha|string|max:50|unique:sectors,name,{$sectorId}",
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'El :attribute es obligatorio',
            'name.alpha'         => 'El :attribute debe contener solo letras',
            'name.string'        => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'        => 'El :attribute ya se encuentra registrado',
            'name.max'           => 'El :attribute no debe superar los :max caracteres',
            
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre del sector',
            'is_active' => 'estado del sector'
        ];
    }
}