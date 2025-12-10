<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'gender_id');
    }
}
