<?php


namespace App\Services\Account;


use App\Models\User\User;
use Illuminate\Support\Facades\Hash;


/**
 * Servicio para verificar la contraseña actual del usuario.
 *
 * Responsabilidad única: validar que la contraseña enviada
 * coincida con la almacenada en BD.
 */
class PasswordVerificationService
{
    /**
     * Verifica que la contraseña actual del usuario sea correcta.
     *
     * @param User   $user     Usuario autenticado
     * @param string $password Contraseña en texto plano
     * @return array{error: bool, code: int, message: string, errorKey?: string}
     */
    public function verify(User $user, string $password): array
    {
        if (!Hash::check($password, $user->password)) {
            return [
                'error'    => true,
                'code'     => 401,
                'message'  => 'Contraseña incorrecta.',
                'errors'   => [],
                'errorKey' => 'password_incorrect',
            ];
        }

        return [
            'error'   => false,
            'code'    => 200,
            'message' => 'Contraseña verificada.',
        ];
    }
}
