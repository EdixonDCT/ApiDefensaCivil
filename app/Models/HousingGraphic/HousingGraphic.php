<?php

namespace App\Models\HousingGraphic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;

class HousingGraphic extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'path','description','family_plan_id',];

    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }
}