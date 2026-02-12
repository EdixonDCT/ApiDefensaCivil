<?php

namespace App\Http\Requests\RiskReductionAction;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateRiskReductionActionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'action'        => 'sometimes|string|max:255',
            'member_id'     => 'sometimes|exists:members,id',
            'risk_factor_id'=> 'sometimes|exists:risk_factors,id',
            'end_date'      => 'sometimes|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'action.string'            => 'La acción debe ser texto gei',
            'action.max'               => 'La acción es demasiado larga gei',
            'member_id.exists'         => 'El miembro seleccionado no existe gei',
            'risk_factor_id.exists'    => 'El factor de riesgo seleccionado no existe gei',
            'end_date.date'            => 'La fecha no es válida gei',
            'end_date.after_or_equal'  => 'La fecha debe ser hoy o posterior gei',
        ];
    }
}
