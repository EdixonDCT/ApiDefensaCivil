<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'names' => 'required|alpha_spaces|min:3|max:50',
            'last_names' => 'required|alpha_spaces|min:3|max:50',
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'required|numeric|min_digits:3|max_digits:20',
            'birth_date' => 'required|date_format:Y-m-d|before:18 years ago',
            'gender_id' => 'required|exists:genders,id',
            'organization_id' => 'required|exists:organizations,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20|password_security'
        ];
    }

    public function messages(): array
    {
        return [
            'names.required' => 'El campo :attribute es obligatorio.',
            'names.alpha_spaces' => 'Los :attribute solo pueden contener letras y espacios.',
            'names.min' => 'Los :attribute deben tener al menos 3 caracteres.',
            'names.max' => 'Los :attribute no pueden tener más de 50 caracteres.',
            'last_names.required' => 'El campo :attribute es obligatorio.',
            'last_names.alpha_spaces' => 'Los :attribute solo pueden contener letras y espacios.',
            'last_names.min' => 'Los :attribute deben tener al menos 3 caracteres.',
            'last_names.max' => 'Los :attribute no pueden tener más de 50 caracteres.',
            'document_type_id.required' => 'El campo :attribute es obligatorio.',
            'document_type_id.exists' => 'El :attribute seleccionado no es valido.',
            'document_number.required' => 'El :attribute es obligatorio.',
            'document_number.numeric' => 'El :attribute debe ser un valor numérico.',
            'document_number.min_digits' => 'El :attribute debe tener al menos 3 caracteres.',
            'document_number.max_digits' => 'El :attribute no puede superar los 20 caracteres.',
            'birth_date.required' => 'La :attribute es obligatoria.',
            'birth_date.date_format' => 'La :attribute debe seguir el formato AAAA-MM-DD.',
            'birth_date.before' => 'Debes ser mayor de edad para registrarte.',
            'gender_id.required' => 'El campo :attribute es obligatorio',
            'gender_id.exists' => 'El :attribute seleccionado no es valido.',
            'organization_id.required' => 'La :attribute es obligatoria.',
            'organization_id.exists' => 'La :attribute seleccionada no es válida.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute debe ser una dirección válida.',
            'email.unique' => 'Este :attribute ya está siendo utilizado por otro usuario.',
            'password.required' => 'La :attribute es obligatoria.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password.max' => 'La :attribute no puede tener más de :max caracteres.',
            'password.password_security' => 'La :attribute debe incluir mayúsculas, minúsculas, números y símbolos.',
        ];
    }

    public function attributes(): array
    {
        return [
            'names' => 'nombres',
            'last_names' => 'apellidos',
            'document_type_id' => 'tipo de documento',
            'document_number' => 'numero de documento',
            'birth_date' => 'fecha de nacimiento',
            'gender_id' => 'genero',
            'organization_id' => 'organizacion',
            'email' => 'correo electronico',
            'password' => 'contraseña'
        ];
    }
}