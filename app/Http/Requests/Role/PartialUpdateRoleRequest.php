<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateRoleRequest
 * * Valida la actualización parcial de roles de usuario.
 * Permite modificar el nombre del rol asegurando que no colisione con otros existentes,
 * excepto con el registro que se está editando actualmente.
 */
class PartialUpdateRoleRequest extends FormRequest
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
         * Capturamos el ID del rol desde la ruta para la excepción de unicidad.
         */
        $roleId = $this->route('role_id');

        return [
            /**
             * El nombre es opcional (sometimes), pero si se envía debe ser único.
             */
            'name' => "sometimes|string|min:3|max:50|unique:roles,name,{$roleId}",
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string' => 'El :attribute debe ser una cadena de texto válida',
            'name.min'    => 'El :attribute debe tener al menos :min caracteres',
            'name.max'    => 'El :attribute no debe superar los :max caracteres',
            'name.unique' => 'El :attribute ya se encuentra registrado'
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