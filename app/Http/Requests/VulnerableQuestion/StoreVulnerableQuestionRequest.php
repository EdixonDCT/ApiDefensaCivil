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
            'description' => 'required|string|max:255|unique:vulnerable_questions,description',
            'question_caution' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required'      => 'La descripción es obligatoria.',
            'description.string'        => 'La descripción debe ser un texto válido.',
            'description.max'           => 'La descripción no puede tener más de 255 caracteres.',
            'description.unique' => 'La descripcion no se debe repetir.',
            'question_caution.required' => 'La pregunta de precaución es obligatoria.',
            'question_caution.boolean'  => 'La pregunta de precaución debe ser verdadero o falso.'
        ];
    }

    public function attributes(): array
    {
        return [
            'description'      => 'descripción',
            'question_caution' => 'pregunta de precaución'
        ];
    }
}
