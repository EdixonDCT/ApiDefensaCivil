<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'organization_id');
    }
}
