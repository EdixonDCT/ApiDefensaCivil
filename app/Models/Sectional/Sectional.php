<?php

namespace App\Models\Sectional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Organization\Organization;
use App\Models\FamilyPlan\FamilyPlan;

class Sectional extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active'];

    public function organization()
    {
        return $this->hasMany(Organization::class, 'sectional_id');
    }
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'sectional_id');
    }
}
