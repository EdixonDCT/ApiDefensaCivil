<?php

namespace App\Models\Gender;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['id','state'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'gender_id');
    }
}
