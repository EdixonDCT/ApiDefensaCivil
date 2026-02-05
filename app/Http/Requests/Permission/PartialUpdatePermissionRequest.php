<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdatePermissionRequest
 * * Controla la actualización parcial de los permisos del sistema.
 * Valida que el nombre no se duplique y que la descripción cumpla con los límites de longitud.
 */
class PartialUpdatePermissionRequest extends FormRequest
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
         * Obtenemos el ID del permiso desde la ruta.
         */
        $permissionId = $this->route('permission_id');

        return [
            /**
             * 'sometimes' permite omitir campos. El nombre debe ser único (ignorando el actual)
             * y tener una longitud razonable para slugs o nombres internos.
             */
            'name'        => "sometimes|string|min:5|max:50|unique:permissions,name,{$permissionId}",
            'descripcion' => 'sometimes|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute, placeholders dinámicos y sin puntos.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string'        => 'El :attribute debe ser un texto válido',
            'name.min'           => 'El :attribute debe tener al menos :min caracteres',
            'name.max'           => 'El :attribute no debe superar los :max caracteres',
            'name.unique'        => 'El :attribute ingresado ya se encuentra registrado',
            'descripcion.string' => 'La :attribute debe ser una cadena de texto',
            'descripcion.max'    => 'La :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'        => 'nombre del permiso',
            'descripcion' => 'descripción del permiso',
        ];
    }
}