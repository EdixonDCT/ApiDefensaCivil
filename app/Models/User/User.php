<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Importación de modelos para relaciones y Traits de paquetes externos.
 */
use App\Models\StateUser\StateUser;
use App\Models\Profile\Profile;
use App\Models\History\History;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Clase User
 * * Esta es la clase auténtica para el manejo de sesiones y seguridad.
 * Hereda de Authenticatable para integrarse con el sistema de Guards de Laravel.
 */
class User extends Authenticatable
{
    /** * HasApiTokens: Permite emitir tokens para APIs (Sanctum).
     * HasRoles: Habilita el manejo de Roles y Permisos (Spatie).
     * Notifiable: Permite enviar correos o alertas al usuario.
     */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * Atributos asignables de forma masiva.
     * Mantenemos solo lo esencial para el acceso y el estado de la cuenta.
     */
    protected $fillable = [
        'id',
        'email',         // Correo electrónico (identificador de acceso)
        'password',      // Contraseña (siempre se almacena hasheada)
        'state_user_id'  // Referencia al estado de la cuenta (Activo/Inactivo)
    ];

    /**
     * Configuración de conversión de tipos (Casting).
     * Asegura que la contraseña siempre sea tratada como un hash seguro.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    
    /** --- RELACIONES --- **/

    /**
     * Relación con el Estado del Usuario (BelongsTo).
     * Determina si el usuario tiene permiso para entrar al sistema.
     */
    public function stateUser()
    {
        return $this->belongsTo(StateUser::class, 'state_user_id');
    }

    /**
     * Relación Uno a Uno (HasOne) con Perfil.
     * Conecta la cuenta de acceso con los datos personales del funcionario.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    /**
     * Relación de Uno a Muchos (HasMany) con Historial.
     * Permite auditar todas las acciones realizadas por este usuario en el sistema.
     */
    public function history()
    {
        return $this->hasMany(History::class, 'user_id');
    }
}