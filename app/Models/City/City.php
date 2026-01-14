<?php

namespace App\Models\City;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Apartment\Apartment;
use App\Models\FamilyPlan\FamilyPlan;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','apartment_id'];

    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'city_id');
    }
    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    }
}
