<?php

namespace App\Http\Requests\History;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'family_plan_id' => 'sometimes|exists:sectionals,id',
            'action_id' => 'sometimes|exists:actions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'El usuario no existe.',
            'family_plan_id.exists' => 'El plan familiar no existe.',
            'action_id.exists' => 'La acción no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'usuario',
            'family_plan_id' => 'plan familiar',
            'action_id' => 'acción',
        ];
    }
}
