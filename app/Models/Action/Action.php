<?php

namespace App\Models\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\City\City;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

}
