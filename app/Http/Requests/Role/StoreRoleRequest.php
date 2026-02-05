<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreRoleRequest
 * * Valida la creación de un nuevo rol en el sistema.
 * Asegura que el nombre sea obligatorio, único y que cumpla con los estándares de longitud.
 */
class StoreRoleRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un rol.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50|unique:roles,name',
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
            'name.unique'   => 'El :attribute ingresado ya existe',
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