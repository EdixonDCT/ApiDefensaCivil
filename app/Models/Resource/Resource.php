<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

use App\Models\AvailableResource\AvailableResource;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

class Resource extends Model
{
    protected $fillable = [
        'name',
        'service',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Un recurso puede estar disponible en múltiples registros
     * dentro de available_resources.
     */
    public function availableResources()
    {
        return $this->hasMany(AvailableResource::class, 'resource_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
