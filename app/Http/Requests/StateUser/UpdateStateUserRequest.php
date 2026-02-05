<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateStateUserRequest
 * * Valida la edición de un estado de usuario existente.
 * Permite cambiar el nombre del estado asegurando que no se duplique,
 * pero ignorando el registro actual para evitar errores de validación falsos.
 */
class UpdateStateUserRequest extends FormRequest
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
         * Obtenemos el ID desde el parámetro de la ruta.
         */
        $stateUserId = $this->route('state_user_id');

        return [
            'name' => "required|alpha|string|max:50|unique:state_users,name,{$stateUserId}",
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
            'name.unique'   => 'El :attribute ingresado ya se encuentra registrado',
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