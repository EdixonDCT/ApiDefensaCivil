<?php


namespace App\Models\AccountVerificationToken;

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Modelo para tokens temporales de verificación de identidad.
 *
 * Se genera cuando el usuario confirma su contraseña antes de
 * realizar una operación sensible (cambio de correo, teléfono, etc.).
 *
 * Es de un solo uso: el middleware lo elimina al consumirlo.
 * Los tokens expirados se limpian automáticamente con model:prune.
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $token       Hash del token raw
 * @property string      $action      Acción que protege (ej: 'change_email')
 * @property Carbon      $expires_at
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class AccountVerificationToken extends Model
{
    use MassPrunable;


    /**
     * Campos asignables masivamente.
     *
     * 'token'      → se guarda ya hasheado desde el servicio
     * 'action'     → identifica qué acción sensible protege
     * 'expires_at' → TTL explícito definido al crear el token
     */
    protected $fillable = [
        'user_id',
        'token',
        'action',
        'expires_at',
    ];


    /**
     * Casteo de tipos automático.
     *
     * 'expires_at' se castea a Carbon para comparaciones de fecha
     * sin necesidad de parsear manualmente en el middleware.
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];


    // -------------------------------------------------------------------------
    // Relaciones
    // -------------------------------------------------------------------------


    /**
     * Usuario dueño del token.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // -------------------------------------------------------------------------
    // Prunable
    // -------------------------------------------------------------------------


    /**
     * Define qué registros se eliminan con: php artisan model:prune
     *
     * Limpia tokens cuyo TTL ya venció, evitando acumulación de basura
     * en la tabla sin necesidad de lógica manual de limpieza.
     */
    public function prunable()
    {
        return static::where('expires_at', '<', now());
    }
}
