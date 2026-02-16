<?php

namespace App\Models\ActionPlanAction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPlanAction extends Model
{
      use HasFactory;

    protected $table = 'action_plan_actions';

    protected $fillable = [
        'action_type_id',
        'description',
        'member_id',
        'action_plan_id',
    ];
}
