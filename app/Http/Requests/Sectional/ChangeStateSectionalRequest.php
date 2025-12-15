<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateSectionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'is_active.required' => 'El estado activo de la seccional es obligatorio.',
            'is_active.boolean' => 'El estado activo de la seccional debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'estado activo de la seccional'
    ];
    }
}
