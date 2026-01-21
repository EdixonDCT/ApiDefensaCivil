<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateVulnerableQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description'       => 'sometimes|string|max:255',
            'question_caution'  => 'sometimes|boolean',
            'is_active'         => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'description.string'       => 'La descripción debe ser un texto válido.',
            'description.max'          => 'La descripción no puede tener más de 255 caracteres.',

            'question_caution.boolean' => 'La pregunta de precaución debe ser verdadero o falso.',

            'is_active.boolean'        => 'El estado activo debe ser verdadero o falso.',
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
