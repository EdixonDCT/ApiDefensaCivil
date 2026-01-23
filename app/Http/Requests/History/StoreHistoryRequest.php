<?php

namespace App\Http\Requests\History;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'family_plan_id' => 'required|exists:sectionals,id',
            'action_id' => 'required|exists:actions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario no existe.',
            'family_plan_id.required' => 'El plan familiar es obligatorio.',
            'family_plan_id.exists' => 'El plan familiar no existe.',
            'action_id.required' => 'La acción es obligatoria.',
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
