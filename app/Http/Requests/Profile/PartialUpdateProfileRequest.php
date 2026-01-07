<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateProfileRequest extends FormRequest
{
public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'names' => 'sometimes|alpha_spaces|string|max:50',
            'last_names' => 'sometimes|alpha_spaces|string|max:50',
            'birth_date' => 'sometimes|date_format:Y-m-d|before:18 years ago',
            'document_type_id' => 'sometimes|exists:document_types,id',
            'document_number' => 'required|numeric|max_digits:20|unique_document_by_type',
            'phone' => 'sometimes|numeric|max_digits:15|unique:profiles,phone',
            'gender_id' => 'sometimes|exists:genders,id',
            'organization_id' => 'sometimes|exists:organizations,id' 
        ];
    }

    public function messages()
    {
        return [
            'names.alpha_spaces' => 'Los nombres deben tener solo letras y espacios',
            'names.string' => 'Los nombres solo puede tener caracteres de tipo texto.',
            'names.max' => 'Los nombres tiene un maximo de 50 caracteres.',
            'last_names.alpha_spaces' => 'Los apellidos deben tener solo letras y espacios',
            'last_names.string' => 'Los apellidos solo puede tener caracteres de tipo texto.',
            'last_names.max' => 'Los apellidos tiene un maximo de 50 caracteres.',
            'birth_date.date_format' => 'La fecha de nacimiento debe tener el formato AAAA-MM-DD.',
            'birth_date.before' => 'La fecha de nacimiento obligatoriamente debe tener 18 años o mas.',
            'document_type.exists' => 'El tipo de documento debe existir.',
            'document_number.numeric' => 'El numero del documento debe tener caracteres numericos.',
            'document_number.max_digits ' => 'El numero de documento tiene un maximo de 20 caracteres.',
            'document_number.unique_document_by_type' => 'Este número de documento ya existe para ese tipo de documento.',
            'phone.numeric'    => 'El número de teléfono solo debe contener números.',
            'phone.max_digits' => 'El número de teléfono tiene un máximo de 15 dígitos.',
            'phone.unique'     => 'Este número de teléfono ya está registrado.',
            'gender_id.exists' => 'El genero debe existir.',
            'organization_id.exists' => 'La organizacion debe existir.'
        ];
    }
    public function attributes()
    {
        return [
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
