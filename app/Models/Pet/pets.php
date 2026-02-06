<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Model;

class pets extends Model
{
    protected $fillable = [
        'name',
        'breed',
        'age',
        'animal_gender_id',
        'species_id',
        'family_plan_id',
    ];
}
