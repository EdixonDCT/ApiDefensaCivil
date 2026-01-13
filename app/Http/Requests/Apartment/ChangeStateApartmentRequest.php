<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateApartmentRequest extends FormRequest
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
            'is_active.required' => 'El estado activo del apartamento es obligatorio.',
            'is_active.boolean' => 'El estado activo del apartamento debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'estado activo del apartamento'
    ];
    }
}
