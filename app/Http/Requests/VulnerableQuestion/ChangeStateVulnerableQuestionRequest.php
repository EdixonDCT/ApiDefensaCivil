<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateVulnerableQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active'         => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'is_active.required'        => 'El estado activo es obligatorio.',
            'is_active.boolean'         => 'El estado activo debe ser verdadero o falso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'is_active'        => 'estado activo',
        ];
    }
}
