<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'is_active.required' => 'El estado activo de la organizacion es obligatorio.',
            'is_active.boolean' => 'El estado activo de la organizacion debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'El estado activo de la organizacion'
    ];
    }
}
