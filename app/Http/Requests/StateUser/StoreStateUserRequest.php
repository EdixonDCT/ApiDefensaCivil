<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreStateUserRequest
 * * Valida la creación de un nuevo estado para los usuarios del sistema.
 * Asegura que el nombre sea único y cumpla con el formato alfabético.
 */
class StoreStateUserRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un estado de usuario.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|alpha|string|max:50|unique:state_users,name',
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
     * Define el nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del estado de usuario',
        ];
    }
}