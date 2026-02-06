<?php

namespace App\Models\Species;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class species extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_active'];
}
