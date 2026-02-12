<?php

namespace App\Models\ThreatType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreatType extends Model
{
    
    use HasFactory;

    protected $table = 'threat_types';

    protected $fillable = [
        'name',
        'is_active',
    ];
}
