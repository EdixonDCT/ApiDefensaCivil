<?php

namespace App\Models\VulnerableQuestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\vulnerableTest\vulnerableTest;

class VulnerableQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['id','description','question_caution','is_active'];

    public function vulnerableTest()
    {
        return $this->hasMany(vulnerableTest::class, 'vulnerable_question_id');
    }
}
