<?php

namespace App\Models\Sectional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Organization\Organization;

class Sectional extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active'];

    public function organization()
    {
        return $this->hasMany(Organization::class, 'sectional_id');
    }
}
