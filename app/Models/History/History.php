<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para las relaciones de trazabilidad.
 */
use App\Models\User\User;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Action\Action;

/**
 * Clase History
 * * Este modelo actúa como la bitácora central del sistema (Log).
 * Registra cada interacción realizada por un usuario sobre un plan familiar,
 * permitiendo una auditoría completa de quién, qué y cuándo se hizo algo.
 */
class History extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     * * @var array
     */
    protected $fillable = [
        'id',
        'user_id',        // ID del usuario (funcionario) que ejecuta la acción
        'family_plan_id', // ID del plan familiar afectado
        'action_id',      // ID de la acción realizada (catálogo de acciones)
        'date',           // Fecha del registro
        'time'            // Hora del registro
    ];

    /**
     * El método "booted" automatiza el registro temporal.
     */
    protected static function booted()
    {
        /**
         * Evento "creating": Se dispara automáticamente antes de insertar en la BD.
         * * Lógica: Captura la fecha y hora actual del servidor en el momento exacto
         * de la creación, asegurando que el historial sea inalterable y preciso.
         */
        static::creating(function ($history) {
            $history->date = now()->toDateString(); // Formato YYYY-MM-DD
            $history->time = now()->toTimeString(); // Formato HH:MM:SS
        });
    }

    /**
     * --- RELACIONES BELONGS TO (Muchos a Uno) ---
     */

    /**
     * Relación con el Plan Familiar.
     * * Nota: Se corrigió 'Sectional::class' por 'FamilyPlan::class'.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }

    /**
     * Relación con el Usuario (Funcionario).
     * Identifica al responsable de la actividad registrada.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el tipo de Acción.
     * Describe la actividad ejecutada (ej: Visita, Llamada, etc).
     */
    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }
}