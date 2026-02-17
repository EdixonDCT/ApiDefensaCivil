<?php

namespace App\Models\ActionPlanAction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActionPlan\ActionPlan;
use App\Models\ActionType\ActionType;
use App\Models\Member\Member;

class ActionPlanAction extends Model
{
    use HasFactory;

    protected $fillable = ['action_type_id','description','member_id','action_plan_id',];

    public function actionPlan()
    {
        return $this->belongsTo(ActionPlan::class, 'action_plan_id');
    }
    public function actionType()
    {
        return $this->belongsTo(ActionType::class, 'action_type_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
