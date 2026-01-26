<?php

namespace App\Models\StateUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo User para establecer la relación de integridad de cuenta.
 */
use App\Models\User\User;

/**
 * Clase StateUser
 * * Este modelo gestiona los estados posibles de las cuentas de usuario en el sistema.
 * Es fundamental para la seguridad y el control de acceso, permitiendo habilitar 
 * o restringir el inicio de sesión de forma global.
 */
class StateUser extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name' // Nombre del estado (ej: 'Activo', 'Bloqueado', 'Pendiente de Verificación')
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Un estado (ej: 'Activo') puede estar asignado a múltiples usuarios.
     * Esta relación permite realizar auditorías rápidas sobre el estado de la comunidad.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        /**
         * Retorna la colección de usuarios que comparten este estado específico.
         */
        return $this->hasMany(User::class, 'state_user_id');
    }
}