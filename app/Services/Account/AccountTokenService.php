<?php


namespace App\Services\Account;


use App\Models\AccountVerificationToken\AccountVerificationToken;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * Servicio para la gestión de tokens temporales de verificación.
 *
 * Responsabilidad única: generar, almacenar y revocar tokens
 * de acceso para acciones sensibles del usuario.
 */
class AccountTokenService
{
    /**
     * TTL del token en minutos.
     */
    private const TOKEN_TTL_MINUTES = 10;


    /**
     * Genera un token temporal para una acción sensible.
     *
     * Revoca tokens previos de la misma acción antes de crear uno nuevo.
     *
     * @param User   $user   Usuario autenticado
     * @param string $action Acción sensible (ej: 'change_email')
     * @return array{error: bool, code: int, message: string, data: array}
     */
    public function generate(User $user, string $action): array
    {
        // Revoca tokens previos de la misma acción
        $this->revoke($user, $action);

        $rawToken = Str::random(64);

        AccountVerificationToken::create([
            'user_id'    => $user->id,
            'token'      => Hash::make($rawToken),
            'action'     => $action,
            'expires_at' => now()->addMinutes(self::TOKEN_TTL_MINUTES),
        ]);

        return [
            'error'   => false,
            'code'    => 200,
            'message' => 'Token generado correctamente.',
            'data'    => [
                'token'      => $rawToken,
                'expires_in' => self::TOKEN_TTL_MINUTES . ' minutos',
                'action'     => $action,
            ],
        ];
    }


    /**
     * Revoca todos los tokens activos de una acción para el usuario.
     *
     * @param User   $user
     * @param string $action
     * @return void
     */
    public function revoke(User $user, string $action): void
    {
        AccountVerificationToken::query()
            ->where('user_id', $user->id)
            ->where('action', $action)
            ->delete();
    }
}
