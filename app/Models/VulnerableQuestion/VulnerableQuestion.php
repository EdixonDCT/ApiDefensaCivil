<?php

namespace App\Models\VulnerableQuestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VulnerableQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['id','description','question_caution','is_active'];
}
