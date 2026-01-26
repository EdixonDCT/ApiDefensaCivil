<?php

namespace App\Models\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\History\History;

/**
 * Modelo Action
 * Representa los tipos de actividades o intervenciones que se pueden registrar.
 */
class Action extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id',   // ID de la acción (útil si se manejan IDs específicos)
        'name'  // Nombre descriptivo de la acción (ej. Visita, Entrega, etc.)
    ];

    /**
     * Relación de Uno a Muchos (One-to-Many).
     * Una Acción puede estar presente en muchos registros del historial.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        // Retorna todos los registros de la tabla 'histories' vinculados a esta acción
        return $this->hasMany(History::class, 'action_id');
    }
}