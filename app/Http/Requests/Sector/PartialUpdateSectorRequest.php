<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateSectorRequest
 * * Valida actualizaciones parciales (PATCH) para los sectores.
 * Permite modificar el nombre o el estado de forma independiente,
 * ignorando el registro actual en la validación de unicidad.
 */
class PartialUpdateSectorRequest extends FormRequest
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
         * Capturamos el ID del sector desde la ruta.
         */
        $sectorId = $this->route('sector_id');

        return [
            /**
             * 'sometimes' permite que los campos sean opcionales en el body.
             * Se mantiene 'alpha' si el nombre del sector no debe llevar espacios ni números.
             */
            'name'      => "sometimes|alpha|string|max:50|unique:sectors,name,{$sectorId}",
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
            'name.max'          => 'El :attribute no debe superar los :max caracteres',
            'is_active.boolean' => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
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