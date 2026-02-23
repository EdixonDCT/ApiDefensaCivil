<?php

namespace App\Http\Requests\ThreatType;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreatTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:threat_types,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de amenaza es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'name.unique' => 'El nombre del tipo de amenaza ya existe.',
        ];
    }
}
