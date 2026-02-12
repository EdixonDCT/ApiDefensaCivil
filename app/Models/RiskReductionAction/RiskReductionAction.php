<?php

namespace App\Models\RiskReductionAction;

use App\Models\Member\Member;
use App\Models\RiskFactor\RiskFactor;
use Illuminate\Database\Eloquent\Model;

class RiskReductionAction extends Model
{
    protected $fillable = [
        'action',
        'member_id',
        'risk_factor_id',
        'end_date'
    ];

    // Relaciones
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function riskFactor()
    {
        return $this->belongsTo(RiskFactor::class, 'risk_factor_id');
    }
}
