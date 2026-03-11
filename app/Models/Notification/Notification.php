<?php

namespace App\Models\Notification;

use App\Models\Audit\Audit;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'audit_id',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }
}
