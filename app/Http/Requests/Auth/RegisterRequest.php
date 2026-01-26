<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase RegisterRequest
 * * Gestiona la validación masiva para el registro de nuevos usuarios.
 * Combina reglas de integridad de cuenta (email/password) con datos 
 * demográficos y validaciones de negocio (mayoría de edad, unicidad de documento).
 */
class RegisterRequest extends FormRequest
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
     * Define las reglas de validación para el registro completo.
     * @return array
     */
    public function rules(): array
    {
        return [
            // Datos personales
            'names'            => 'required|alpha_spaces|min:3|max:50',
            'last_names'       => 'required|alpha_spaces|min:3|max:50',
            
            // Identificación y contacto
            'document_type_id' => 'required|exists:document_types,id',
            'document_number'  => 'required|numeric|max_digits:20|unique_document_by_type',
            'phone'            => 'required|numeric|max_digits:15|unique:profiles,phone',
            
            // Lógica de negocio: Mayoría de edad (18 años)
            'birth_date'       => 'required|date_format:Y-m-d|before:18 years ago',
            
            // Relaciones estructurales
            'gender_id'        => 'required|exists:genders,id',
            'organization_id'  => 'required|exists:organizations,id',
            
            // Credenciales de acceso
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:8|max:20|password_security'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Nombres y Apellidos
            'names.required'      => 'El campo :attribute es obligatorio',
            'names.alpha_spaces'  => 'Los :attribute solo pueden contener letras y espacios',
            'names.min'           => 'Los :attribute deben tener al menos 3 caracteres',
            'names.max'           => 'Los :attribute no pueden tener más de 50 caracteres',
            'last_names.required' => 'El campo :attribute es obligatorio',
            'last_names.alpha_spaces' => 'Los :attribute solo pueden contener letras y espacios',
            'last_names.min'      => 'Los :attribute deben tener al menos 3 caracteres',
            'last_names.max'      => 'Los :attribute no pueden tener más de 50 caracteres',

            // Documento y Teléfono
            'document_type_id.required' => 'El campo :attribute es obligatorio',
            'document_type_id.exists'   => 'El :attribute seleccionado no es válido',
            'document_number.required'   => 'El :attribute es obligatorio',
            'document_number.numeric'    => 'El :attribute debe ser un valor numérico',
            'document_number.max_digits' => 'El :attribute no puede superar los 20 caracteres',
            'document_number.unique_document_by_type' => 'Este :attribute ya existe para ese tipo de documento',
            'phone.required'   => 'El :attribute es obligatorio',
            'phone.numeric'    => 'El :attribute solo debe contener números',
            'phone.max_digits' => 'El :attribute tiene un máximo de 15 dígitos',
            'phone.unique'     => 'Este :attribute ya está registrado',

            // Fecha y Otros
            'birth_date.required'    => 'La :attribute es obligatoria',
            'birth_date.date_format' => 'La :attribute debe seguir el formato AAAA-MM-DD',
            'birth_date.before'      => 'La :attribute indica que debes ser mayor de edad para registrarte',
            'gender_id.required'     => 'El campo :attribute es obligatorio',
            'gender_id.exists'       => 'El :attribute seleccionado no es válido',
            'organization_id.required' => 'La :attribute es obligatoria',
            'organization_id.exists'   => 'La :attribute seleccionada no es válida',

            // Cuenta
            'email.required' => 'El :attribute es obligatorio',
            'email.email'    => 'El :attribute debe ser una dirección válida',
            'email.unique'   => 'Este :attribute ya está siendo utilizado por otro usuario',
            'password.required' => 'La :attribute es obligatoria',
            'password.min'      => 'La :attribute debe tener al menos :min caracteres',
            'password.max'      => 'La :attribute no puede tener más de :max caracteres',
            'password.password_security' => 'La :attribute debe incluir mayúsculas, minúsculas, números y símbolos'
        ];
    }

    /**
     * Nombres amigables para los atributos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'names'            => 'nombres',
            'last_names'       => 'apellidos',
            'document_type_id' => 'tipo de documento',
            'document_number'  => 'número de documento',
            'phone'            => 'número de teléfono',
            'birth_date'       => 'fecha de nacimiento',
            'gender_id'        => 'género',
            'organization_id'  => 'organización',
            'email'            => 'correo electrónico',
            'password'         => 'contraseña'
        ];
    }
}