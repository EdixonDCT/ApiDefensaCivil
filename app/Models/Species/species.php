<?php

namespace App\Models\Species;

use Illuminate\Database\Eloquent\Model;

class species extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];
}
