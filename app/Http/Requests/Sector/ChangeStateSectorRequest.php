<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateSectorRequest extends FormRequest
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
            'is_active.required' => 'El estado activo del sector es obligatorio.',
            'is_active.boolean' => 'El estado activo del sector debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'estado activo del sector'
    ];
    }
}
