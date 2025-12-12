<?php

namespace App\Models\Sectional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

class Sectional extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'sectional_id');
    }
}
