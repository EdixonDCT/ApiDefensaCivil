<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $gender = $this->route('gender_id');
        return [
            'state' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'state.required' => 'El estado del genero es obligatorio.',
            'state.boolean' => 'El estado del genero debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'state' => 'estado del genero'
    ];
    }
}
