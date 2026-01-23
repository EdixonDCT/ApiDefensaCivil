<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User\User;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Action\Action;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','family_plan_id','action_id','date','time'];

    protected static function booted()
    {
        static::creating(function ($history) {
            $history->date = now()->toDateString();
            $history->time = now()->toTimeString();
        });
    }

    public function familyPlan()
    {
        return $this->belongsTo(Sectional::class,'family_plan_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }
}
