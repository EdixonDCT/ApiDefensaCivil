<?php

namespace App\Models\RiskFactor;

use App\Models\FamilyPlan\FamilyPlan;
use App\Models\ThreatType\ThreatType;
use App\Models\ActionPlan\ActionPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'threat_type_id',
        'description',
        'distance',
        'ubication',
        'family_plan_id'
    ];

    public function threatType()
    {
        return $this->belongsTo(ThreatType::class, 'threat_type_id');
    }

    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }

    public function actionPlan()
    {
        return $this->hasMany(ActionPlan::class, 'risk_factor_id');
    }
}
