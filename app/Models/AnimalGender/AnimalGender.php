<?php

namespace App\Models\AnimalGender;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pet\Pet;

class AnimalGender extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pet()
    {
        return $this->hasMany(Pet::class, 'animal_gender_id');
    }
}