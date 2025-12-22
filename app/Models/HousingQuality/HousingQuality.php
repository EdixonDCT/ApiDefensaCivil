<?php

namespace App\Models\HousingQuality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;

class HousingQuality extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active'];
    
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'housing_quality_id');
    }
}
