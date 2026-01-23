<?php

namespace App\Models\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\History\History;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];

    public function history()
    {
        return $this->hasMany(History::class, 'action_id');
    }
}
