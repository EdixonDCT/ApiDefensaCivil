<?php

namespace App\Models\AnimalGender;

use Illuminate\Database\Eloquent\Model;

class AnimalGender extends Model
{
    protected $table = 'animal_genders';

    protected $fillable = [
        'name'
    ];
}
