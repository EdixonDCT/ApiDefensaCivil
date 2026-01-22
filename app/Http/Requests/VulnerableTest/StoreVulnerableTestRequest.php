<?php

namespace App\Http\Requests\VulnerableTest;

use Illuminate\Foundation\Http\FormRequest;

class StoreVulnerableTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vulnerable_question_id' => 'required|exists:vulnerable_questions,id',
            'family_plan_id'         => 'required|exists:family_plans,id',
            'answer'                 => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'vulnerable_question_id.required' => 'La pregunta vulnerable es obligatoria.',
            'vulnerable_question_id.exists'   => 'La pregunta vulnerable seleccionada no es válida.',

            'family_plan_id.required' => 'El plan familiar es obligatorio.',
            'family_plan_id.exists'   => 'El plan familiar seleccionado no es válido.',

            'answer.required' => 'La respuesta es obligatoria.',
            'answer.boolean'  => 'La respuesta debe ser verdadero o falso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'vulnerable_question_id' => 'pregunta vulnerable',
            'family_plan_id'         => 'plan familiar',
            'answer'                 => 'respuesta',
        ];
    }
}
