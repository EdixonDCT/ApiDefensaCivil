<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class StateUser extends Model
{
    use HasFactory;

    protected $fillable = ['state'];

    public function user()
    {
        return $this->hasMany(User::class, 'state_user_id');
    }
}