<?php

namespace App\Models\Zone;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'status_plan_id');
    }
}
