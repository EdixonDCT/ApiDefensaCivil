<?php

namespace App\Http\Requests\StatusPlan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $statusPlan = $this->route('status_plan_id');
        return [
            'name' => 'required|alpha_spaces|string|max:50|unique:status_plans,name,'.$statusPlan,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del estado de plan es obligatorio.',
            'name.alpha_spaces' => 'El nombre del estado de plan debe tener solo letras y espacios.',
            'name.string' => 'El nombre del estado de plan debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El nombre del estado de plan ya existe.',
            'name.max' => 'El nombre del estado de plan tiene maximo 50 caracteres.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del estado de plan',
    ];
    }
}
