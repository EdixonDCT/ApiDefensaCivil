<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

class StoreVulnerableQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description'       => 'required|string|max:255',
            'question_caution'  => 'required|boolean',
            'is_active'         => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required'      => 'La descripción es obligatoria.',
            'description.string'        => 'La descripción debe ser un texto válido.',
            'description.max'           => 'La descripción no puede tener más de 255 caracteres.',

            'question_caution.required' => 'La pregunta de precaución es obligatoria.',
            'question_caution.boolean'  => 'La pregunta de precaución debe ser verdadero o falso.',

            'is_active.required'        => 'El estado activo es obligatorio.',
            'is_active.boolean'         => 'El estado activo debe ser verdadero o falso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'description'      => 'descripción',
            'question_caution' => 'pregunta de precaución',
            'is_active'        => 'estado activo',
        ];
    }
}
