<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Model;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Species\Species;
use App\Models\AnimalGender\AnimalGender;
class Pet extends Model
{
    protected $fillable = ['name','breed','age','animal_gender_id','species_id','family_plan_id',];

    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }
    public function species()
    {
        return $this->belongsTo(Species::class, 'species_id');
    }
    public function animalGender()
    {
        return $this->belongsTo(AnimalGender::class, 'animal_gender_id');
    }
}
