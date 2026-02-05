<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StorePermissionRequest
 * * Valida la creación de nuevos permisos en el sistema.
 * Asegura que el nombre sea único y que la descripción sea opcional pero válida.
 */
class StorePermissionRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un permiso.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio y único. Se sugiere un formato como 'modulo.accion'.
             */
            'name'        => 'required|string|min:5|max:50|unique:permissions,name',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y placeholders dinámicos.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'El :attribute es obligatorio',
            'name.string'        => 'El :attribute debe ser una cadena de texto',
            'name.min'           => 'El :attribute debe tener al menos :min caracteres',
            'name.max'           => 'El :attribute no debe superar los :max caracteres',
            'name.unique'        => 'El :attribute ingresado ya existe',
            'descripcion.string' => 'La :attribute debe ser una cadena de texto',
            'descripcion.max'    => 'La :attribute no debe superar los :max caracteres',
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