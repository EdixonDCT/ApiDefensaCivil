<?php

namespace App\Models\Species;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pet\Pet;

class Species extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_active'];

    public function pet()
    {
        return $this->hasMany(Pet::class, 'species_id');
    }
}
