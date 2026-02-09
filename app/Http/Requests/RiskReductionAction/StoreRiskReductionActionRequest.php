<?php

namespace App\Http\Requests\RiskReductionAction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRiskReductionActionRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Se puede agregar política si es necesario
    }

    public function rules()
    {
        return [
            'action'        => 'required|string|max:255',
            'member_id'     => 'required|exists:members,id',
            'risk_factor_id'=> 'required|exists:risk_factors,id',
            'end_date'      => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'action.required'          => 'La acción es gei, completa esto',
            'action.string'            => 'La acción debe ser texto gei',
            'action.max'               => 'La acción es demasiado larga gei',
            'member_id.required'       => 'Debes asignar un miembro gei',
            'member_id.exists'         => 'El miembro seleccionado no existe gei',
            'risk_factor_id.required'  => 'Debes asociar un factor de riesgo gei',
            'risk_factor_id.exists'    => 'El factor de riesgo seleccionado no existe gei',
            'end_date.required'        => 'Debes indicar la fecha gei',
            'end_date.date'            => 'La fecha no es válida gei',
            'end_date.after_or_equal'  => 'La fecha debe ser hoy o posterior gei',
        ];
    }
}
