<?php

namespace App\Models\StateUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User\User;

class StateUser extends Model
{
    use HasFactory;

    protected $fillable = ['id','state'];

    public function user()
    {
        return $this->hasMany(User::class, 'state_user_id');
    }
}