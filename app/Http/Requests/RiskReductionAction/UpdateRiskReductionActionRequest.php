<?php

namespace App\Http\Requests\RiskReductionAction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiskReductionActionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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
        return (new StoreRiskReductionActionRequest())->messages();
    }
}
