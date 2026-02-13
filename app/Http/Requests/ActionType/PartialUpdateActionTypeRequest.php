<?php

namespace App\Http\Requests\ActionType;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateActionTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|unique:action_types,name,' . $this->route('id'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'name.unique' => 'Ya existe un tipo de acción con ese nombre.',
        ];
    }
}
