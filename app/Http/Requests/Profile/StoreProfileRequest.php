<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|unique:profiles,user_id',
            'names' => 'required|alpha_spaces|string|max:50',
            'last_names' => 'required|alpha_spaces|string|max:50',
            'birth_date' => 'required|date_format:Y-m-d|before:18 years ago',
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'required|numeric|max_digits:20|unique_document_by_type',
            'phone' => 'required|numeric|max_digits:15|unique:profiles,phone',
            'gender_id' => 'required|exists:genders,id',
            'organization_id' => 'required|exists:organizations,id'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El ID de usuario es obligatorio',
            'user_id.exists' => 'El ID de usuario debe existir.',
            'user_id.unique' => 'El ID de usuario ya esta relacionado a otro perfil.',
            'names.required' => 'Los nombres son obligatorios.',
            'names.alpha_spaces' => 'Los nombres deben tener solo letras y espacios',
            'names.string' => 'Los nombres solo puede tener caracteres de tipo texto.',
            'names.max' => 'Los nombres tiene un maximo de 50 caracteres.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'last_names.alpha_spaces' => 'Los apellidos deben tener solo letras y espacios',
            'last_names.string' => 'Los apellidos solo puede tener caracteres de tipo texto.',
            'last_names.max' => 'Los apellidos tiene un maximo de 50 caracteres.',
            'birth_date.required' => 'La fecha de nacimiento es requerida.',
            'birth_date.date_format' => 'La fecha de nacimiento debe tener el formato AAAA-MM-DD.',
            'birth_date.before' => 'La fecha de nacimiento obligatoriamente debe tener 18 años o mas.',
            'document_type_id.required' => 'El tipo de documento es obligatorio.',
            'document_type.exists' => 'El tipo de documento debe existir.',
            'document_number.required' => 'El numero del documento es obligatorio.',
            'document_number.numeric' => 'El numero del documento debe tener caracteres numericos.',
            'document_number.max_digits ' => 'El numero de documento tiene un maximo de 20 caracteres.',
            'document_number.unique_document_by_type' => 'Este número de documento ya existe para ese tipo de documento.',
            'phone.required'   => 'El número de teléfono es obligatorio.',
            'phone.numeric'    => 'El número de teléfono solo debe contener números.',
            'phone.max_digits' => 'El número de teléfono tiene un máximo de 15 dígitos.',
            'phone.unique'     => 'Este número de teléfono ya está registrado.',
            'gender_id.required' => 'El genero es obligatorio.',
            'gender_id.exists' => 'El genero debe existir.',
            'organization_id.required' => 'La organizacion es obligatorio.',
            'organization_id.exists' => 'La organizacion debe existir.'
        ];
    }
    public function attributes()
    {
        return [
            'user_id' => 'ID del usuario',
            'names' => 'nombres',
            'last_names' => 'apellidos',
            'birth_date' => 'fecha de nacimiento',
            'document_type_id' => 'tipo de documento',
            'document_number' => 'número de documento',
            'phone' => 'número de telefono',
            'gender_id' => 'género',
            'organization_id' => 'organización',
    ];
    }
}
