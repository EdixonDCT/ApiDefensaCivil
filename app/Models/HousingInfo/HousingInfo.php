<?php

namespace App\Models\HousingInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;

class HousingInfo extends Model
{
    use HasFactory;

    protected $fillable = ['id','family_plan_id','path'];
    
    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }
}
