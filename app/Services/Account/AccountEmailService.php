<?php


namespace App\Services\Account;


use App\Models\User\User;


/**
 * Servicio para la actualización del correo electrónico del usuario.
 *
 * Responsabilidad única: actualizar el email del usuario en BD.
 *
 * El token de verificación ya fue validado y consumido por el middleware
 * RequirePasswordVerification antes de llegar a este servicio.
 */
class AccountEmailService
{
    /**
     * Actualiza el correo electrónico del usuario autenticado.
     *
     * @param User   $user  Usuario autenticado
     * @param string $email Nuevo correo electrónico validado
     * @return array{error: bool, code: int, message: string}
     */
    public function updateEmail(User $user, string $email): array
    {
        $user->update(['email' => $email]);

        return [
            'error'   => false,
            'code'    => 200,
            'message' => 'Correo electrónico actualizado correctamente.',
        ];
    }
}
