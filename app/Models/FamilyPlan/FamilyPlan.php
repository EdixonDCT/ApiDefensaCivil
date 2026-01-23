<?php

namespace App\Models\FamilyPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Zone\Zone;
use App\Models\City\City;
use App\Models\HousingQuality\HousingQuality;
use App\Models\Sector\Sector;
use App\Models\StatusPlan\StatusPlan;
use App\Models\Sectional\Sectional;
use App\Models\VulnerableTest\VulnerableTest;
use App\Models\History\History;

class FamilyPlan extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','last_names','zone_id','address','landline_phone','georeference','city_id','housing_quality_id','sector_id','sector_name','status_plan_id','sectional_id','authorization'];

    protected $attributes = ['status_plan_id' => 4,];

    protected static function booted()
    {
        static::creating(function ($plan) {
            if (auth()->check() && isset(auth()->user()->profile->organization)) {
                $plan->sectional_id = auth()->user()->profile->organization->sectional_id;
            }
        });
    }
    
    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function housingQuality()
    {
        return $this->belongsTo(HousingQuality::class,'housing_quality_id');
    }
    public function Sector()
    {
        return $this->belongsTo(Sector::class,'sector_id');
    }
    public function StatusPlan()
    {
        return $this->belongsTo(StatusPlan::class,'status_plan_id');
    }
    public function Sectional()
    {
        return $this->belongsTo(Sectional::class,'sectional_id');
    }
    public function vulnerableTest()
    {
        return $this->hasMany(VulnerableTest::class, 'family_plan_id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'family_plan_id');
    }
}
