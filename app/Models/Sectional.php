<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile;

class Sectional extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'sectional_id');
    }
}
