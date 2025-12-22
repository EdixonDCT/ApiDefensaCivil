<?php

namespace App\Models\Sector;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active'];
    
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'sector_id');
    }
}
