<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdatePermissionRequest
 * * Valida la actualización completa de un permiso existente.
 * A diferencia del Store, aquí la descripción es obligatoria y se ignora el ID actual 
 * en la validación de unicidad del nombre.
 */
class UpdatePermissionRequest extends FormRequest
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
     * Define las reglas de validación para la actualización de un permiso.
     * @return array
     */
    public function rules(): array
    {
        $permissionId = $this->route('permission_id');

        return [
            /**
             * El nombre debe ser único, ignorando el registro que se está editando.
             */
            'name'        => "required|string|min:5|max:50|unique:permissions,name,{$permissionId}",
            'descripcion' => 'required|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'El :attribute es obligatorio',
            'name.string'         => 'El :attribute debe ser una cadena de texto válida',
            'name.min'            => 'El :attribute debe tener al menos :min caracteres',
            'name.max'            => 'El :attribute no debe superar los :max caracteres',
            'name.unique'         => 'El :attribute ya se encuentra registrado',
            
            'descripcion.required' => 'La :attribute es obligatoria',
            'descripcion.string'   => 'La :attribute debe ser una cadena de texto',
            'descripcion.max'      => 'La :attribute no debe superar los :max caracteres'
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