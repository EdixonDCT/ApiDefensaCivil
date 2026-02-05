<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreProfileRequest
 * * Valida la creación inicial del perfil de un usuario.
 * Garantiza la integridad de la relación 1:1 con la tabla users y
 * valida campos críticos como el documento de identidad y la mayoría de edad.
 */
class StoreProfileRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para el registro del perfil.
     * * @return array
     */
    public function rules(): array
    {
        return [
            'user_id'          => 'required|exists:users,id|unique:profiles,user_id',
            'names'            => 'required|alpha_spaces|string|max:50',
            'last_names'       => 'required|alpha_spaces|string|max:50',
            'birth_date'       => 'required|date_format:Y-m-d|before:18 years ago',
            'document_type_id' => 'required|exists:document_types,id',
            'document_number'  => 'required|numeric|max_digits:20|unique_document_by_type',
            'phone'            => 'required|numeric|max_digits:15|unique:profiles,phone',
            'gender_id'        => 'required|exists:genders,id',
            'organization_id'  => 'required|exists:organizations,id'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'user_id.required'         => 'El :attribute es obligatorio',
            'user_id.exists'           => 'El :attribute seleccionado no es válido',
            'user_id.unique'           => 'El :attribute ya está relacionado a otro perfil',

            'names.required'           => 'Los :attribute son obligatorios',
            'names.alpha_spaces'       => 'Los :attribute deben contener solo letras y espacios',
            'names.string'             => 'Los :attribute deben ser una cadena de texto válida',
            'names.max'                => 'Los :attribute no deben superar los :max caracteres',

            'last_names.required'      => 'Los :attribute son obligatorios',
            'last_names.alpha_spaces'  => 'Los :attribute deben contener solo letras y espacios',
            'last_names.string'        => 'Los :attribute deben ser una cadena de texto válida',
            'last_names.max'           => 'Los :attribute no deben superar los :max caracteres',

            'birth_date.required'      => 'La :attribute es obligatoria',
            'birth_date.date_format'   => 'La :attribute debe tener el formato AAAA-MM-DD',
            'birth_date.before'        => 'La :attribute indica que debe ser mayor de 18 años',

            'document_type_id.required' => 'El :attribute es obligatorio',
            'document_type_id.exists'   => 'El :attribute seleccionado no es válido',

            'document_number.required'               => 'El :attribute es obligatorio',
            'document_number.numeric'                => 'El :attribute debe contener solo números',
            'document_number.max_digits'             => 'El :attribute no debe superar los :max dígitos',
            'document_number.unique_document_by_type' => 'Este :attribute ya existe para el tipo de documento seleccionado',

            'phone.required'   => 'El :attribute es obligatorio',
            'phone.numeric'    => 'El :attribute solo debe contener números',
            'phone.max_digits' => 'El :attribute no debe superar los :max dígitos',
            'phone.unique'     => 'Este :attribute ya está registrado',

            'gender_id.required' => 'El :attribute es obligatorio',
            'gender_id.exists'   => 'El :attribute seleccionado no es válido',

            'organization_id.required' => 'La :attribute es obligatoria',
            'organization_id.exists'   => 'La :attribute seleccionada no es válida',
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'user_id'          => 'ID de usuario',
            'names'            => 'nombres',
            'last_names'       => 'apellidos',
            'birth_date'       => 'fecha de nacimiento',
            'document_type_id' => 'tipo de documento',
            'document_number'  => 'número de documento',
            'phone'            => 'número de teléfono',
            'gender_id'        => 'género',
            'organization_id'  => 'organización',
        ];
    }
}