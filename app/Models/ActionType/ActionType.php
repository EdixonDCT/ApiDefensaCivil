<?php

namespace App\Models\ActionType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    use HasFactory;

    protected $table = 'action_types';

    protected $fillable = [
        'name',
    ];
}
