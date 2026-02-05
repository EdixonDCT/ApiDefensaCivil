<?php

namespace App\Models\PetVaccine;

use Illuminate\Database\Eloquent\Model;

class petvaccine extends Model
{
    protected $table = 'pet_vaccines';

    protected $fillable = [
        'name',
        'date',
        'pet_id'
    ];
    
}
