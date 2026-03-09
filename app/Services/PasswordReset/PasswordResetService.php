<?php

namespace App\Services\PasswordReset;

use App\Models\User\User;
use App\Notifications\PasswordResetCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

/**
 * Servicio de restablecimiento de contraseña mediante código numérico.
 *
 * Flujo:
 * 1. sendCode()  → genera código, lo guarda hasheado y envía por email
 * 2. verify()    → valida que el código sea correcto y no haya expirado
 * 3. reset()     → verifica código nuevamente y actualiza la contraseña
 *
 * Seguridad:
 * - Código hasheado con bcrypt (nunca texto plano en BD)
 * - Expiración configurable (default: 60 minutos)
 * - hash_equals implícito via Hash::check (previene timing attacks)
 * - Respuestas genéricas en sendCode() para prevenir user enumeration
 * - Código eliminado tras uso exitoso (single-use)
 */
class PasswordResetService
{
    /** Minutos antes de que el código expire */
    public const EXPIRATION_MINUTES = 60;

    /**
     * Genera y envía un código de restablecimiento al email indicado.
     *
     * Siempre retorna el mismo mensaje genérico sin importar si el
     * usuario existe, para prevenir user enumeration.
     *
     * @param string $email
     * @return array
     */
    public function sendCode(string $email): array
    {
        $user = User::where('email', $email)->first();

        // Respuesta genérica: no revela si el email existe o no
        if (!$user) {
            return [
                'error'   => false,
                'code'    => 200,
                'message' => 'Si el correo existe, recibirás un código.',
            ];
        }

        try {
            $code = $this->generateCode();

            // Upsert: actualiza si ya existe un registro previo para este email
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'token'      => Hash::make($code), // nunca guardar en texto plano
                    'created_at' => now(),
                ]
            );

            $user->notify(new PasswordResetCode($code));

            return [
                'error'   => false,
                'code'    => 200,
                'message' => 'Si el correo existe, recibirás un código.',
            ];
        } catch (Throwable $e) {
            report($e);
            return [
                'error'   => true,
                'code'    => 503,
                'message' => 'No se pudo enviar el correo.',
            ];
        }
    }

    /**
     * Verifica que el código sea válido y no haya expirado.
     *
     * Útil para validar el código en un paso previo antes de
     * mostrar el formulario de nueva contraseña en el frontend.
     *
     * @param string $email
     * @param string $code
     * @return array
     */
    public function verifyCode(string $email, string $code): array
    {
        $result = $this->findValidRecord($email, $code);

        if ($result['error']) {
            return $result;
        }

        return [
            'error'   => false,
            'code'    => 200,
            'message' => 'Código válido.',
        ];
    }

    /**
     * Restablece la contraseña del usuario si el código es válido.
     *
     * Valida el código, actualiza la contraseña y elimina el token
     * para que sea de un solo uso.
     *
     * @param string $email
     * @param string $code
     * @param string $newPassword  Ya validada (min:8, confirmed) desde el Request
     * @return array
     */
    public function reset(string $email, string $code, string $newPassword): array
    {
        // Reutiliza la misma validación de código y expiración
        $result = $this->findValidRecord($email, $code);

        if ($result['error']) {
            return $result;
        }

        $user = User::where('email', $email)->first();

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // Elimina el token: código de un solo uso
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return [
            'error'   => false,
            'code'    => 200,
            'message' => 'Contraseña restablecida correctamente.',
        ];
    }

    // -------------------------------------------------------------------------
    // Métodos privados
    // -------------------------------------------------------------------------

    /**
     * Busca y valida el registro de reset: existencia, expiración y hash.
     *
     * Centraliza la lógica compartida entre verifyCode() y reset()
     * para no repetir las mismas validaciones en ambos métodos.
     *
     * @param string $email
     * @param string $code
     * @return array
     */
    private function findValidRecord(string $email, string $code): array
    {
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$record) {
            return ['error' => true, 'code' => 404, 'message' => 'Código inválido.'];
        }

        // Verifica expiración antes de comparar el hash (más eficiente)
        if (Carbon::parse($record->created_at)->addMinutes(self::EXPIRATION_MINUTES)->isPast()) {
            return ['error' => true, 'code' => 410, 'message' => 'El código ha expirado.'];
        }

        // Hash::check usa hash_equals internamente → previene timing attacks
        if (!Hash::check($code, $record->token)) {
            return ['error' => true, 'code' => 403, 'message' => 'Código inválido.'];
        }

        return ['error' => false, 'code' => 200, 'message' => 'OK'];
    }

    /**
     * Genera un código numérico aleatorio de 6 dígitos.
     *
     * random_int() usa CSPRNG (generador criptográficamente seguro),
     * a diferencia de rand() que es predecible.
     *
     * @return string  Se retorna como string para preservar ceros iniciales (ej: 045231)
     */
    private function generateCode(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
