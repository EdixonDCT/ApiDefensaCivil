<?php

namespace App\Models\AvailableResource;

use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Resource\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableResource extends Model
{
    use HasFactory;

    protected $table = 'available_resources';

    protected $fillable = [
        'resource_id',
        'location',
        'distance',
        'phone',
        'description',
        'family_plan_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }
}
