<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active','sectional_id'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'organization_id');
    }
    public function sectional()
    {
        return $this->belongsTo(Sectional::class, 'sectional_id');
    }
}
