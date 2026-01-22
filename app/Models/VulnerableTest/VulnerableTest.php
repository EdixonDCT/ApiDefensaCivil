<?php

namespace App\Models\VulnerableTest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\VulnerableQuestion\VulnerableQuestion;
use App\Models\FamilyPlan\FamilyPlan;

class VulnerableTest extends Model
{
    protected $fillable = ['id','vulnerable_question_id','family_plan_id','answer'];

    public function vulnerableQuestion()
    {
        return $this->belongsTo(VulnerableQuestion::class);
    }
    public function FamilyPlan()
    {
        return $this->belongsTo(FamilyPlan::class);
    }
}
