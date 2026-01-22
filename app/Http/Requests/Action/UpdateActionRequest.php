<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'alpha_spaces',
                'string',
                'max:50',
                Rule::unique('actions', 'name')->ignore($this->route('action')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la acción es obligatorio.',
            'name.alpha_spaces' => 'El nombre de la acción debe tener solo letras y espacios.',
            'name.string' => 'El nombre de la acción debe ser texto.',
            'name.unique' => 'La acción ya existe.',
            'name.max' => 'El nombre de la acción tiene un máximo de 50 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre de la acción',
        ];
    }
}
