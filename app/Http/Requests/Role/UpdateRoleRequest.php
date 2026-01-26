<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateRoleRequest
 * * Valida la actualización completa de un rol.
 * Asegura que el nombre sea obligatorio y único, ignorando el registro actual
 * para permitir guardar cambios sin conflictos de duplicidad.
 */
class UpdateRoleRequest extends FormRequest
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
     * Define las reglas de validación para la actualización de un rol.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID del rol desde el parámetro de la ruta.
         */
        $roleId = $this->route('role_id');

        return [
            'name' => "required|string|min:3|max:50|unique:roles,name,{$roleId}",
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
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.min'      => 'El :attribute debe tener al menos :min caracteres',
            'name.max'      => 'El :attribute no debe superar los :max caracteres',
            'name.unique'   => 'El :attribute ya se encuentra registrado'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del rol',
        ];
    }
}