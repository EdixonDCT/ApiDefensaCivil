<?php

namespace App\Models\ActionType;

use App\Models\ActionPlanAction\ActionPlanAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    use HasFactory;

    protected $fillable = ['name',];

    public function actionPlanAction()
    {
        return $this->hasMany(ActionPlanAction::class, 'action_type_id');
    }
}
