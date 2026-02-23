<?php

namespace App\Models\ThreatType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RiskFactor\RiskFactor;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

class ThreatType extends Model
{
    use HasFactory;

    protected $table = 'threat_types';

    protected $fillable = [
        'name',
        'is_active',
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Un tipo de amenaza puede tener múltiples factores de riesgo asociados.
     */
    public function riskFactors()
    {
        return $this->hasMany(RiskFactor::class, 'threat_type_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
