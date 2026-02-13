<?php

namespace App\Models\ActionPlan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActionType\ActionType;

class ActionPlan extends Model
{
    use HasFactory;

    protected $table = 'action_plans';

    protected $fillable = [
        'name',
        'description',
        'action_type_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function actionType()
    {
        return $this->belongsTo(ActionType::class, 'action_type_id');
    }
}
