<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\City\City;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function city()
    {
        return $this->hasMany(City::class, 'apartment_id');
    }
}
