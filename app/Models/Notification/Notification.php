<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User\User;
use App\Models\History\History;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'history_id',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function history()
    {
        return $this->belongsTo(History::class, 'history_id');
    }
}
