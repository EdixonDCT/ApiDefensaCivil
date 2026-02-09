<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Model;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Species\Species;
use App\Models\AnimalGender\AnimalGender;
use App\Models\PetVaccine\PetVaccine;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

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
    public function petVaccine()
    {
        return $this->hasMany(PetVaccine::class, 'pet_id');
    }
}
