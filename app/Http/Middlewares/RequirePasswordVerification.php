<?php


namespace App\Http\Middlewares;


use App\Helpers\ResponseFormatter;
use App\Models\AccountVerificationToken\AccountVerificationToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


/**
 * Middleware que verifica el token de confirmación de contraseña
 * antes de permitir operaciones sobre datos sensibles del usuario.
 *
 * El usuario debe solicitar primero un token mediante la validación
 * de su contraseña actual. Este token tiene un TTL corto (10 minutos)
 * y es de un solo uso: se elimina al consumirse.
 *
 * Flujo:
 * 1. POST /account/verify-password → valida contraseña → retorna token
 * 2. PATCH /account/email          → requiere header X-Password-Verification-Token
 *
 * Datos inyectados en el request:
 * - password_verification_token: Instancia del token consumido
 *
 * Validaciones:
 * 1. Header X-Password-Verification-Token debe estar presente
 * 2. Debe existir un token válido y no expirado para el usuario y acción
 * 3. El token debe coincidir con el hash almacenado
 *
 * Registro como 'password.verify' en bootstrap/app.php:
 * $middleware->alias(['password.verify' => RequirePasswordVerification::class])
 *
 * Uso en frontend:
 * headers['X-Password-Verification-Token'] = getPasswordVerificationToken();
 */
class RequirePasswordVerification
{
    /**
     * Procesa la petición y verifica el token de confirmación de contraseña.
     *
     * @param Request $request Petición HTTP entrante
     * @param Closure $next    Siguiente middleware en la cadena
     * @param string  $action  Acción sensible requerida (ej: 'change_email')
     * @return Response Respuesta (error o continúa)
     */
    public function handle(Request $request, Closure $next, string $action): Response
    {
        $user  = $request->user();
        $token = $request->header('X-Password-Verification-Token');


        /**
         * VALIDACIÓN 1: Header requerido.
         *
         * El frontend siempre debe enviar X-Password-Verification-Token
         * tras haber validado la contraseña del usuario.
         */
        if (!$token) {
            return ResponseFormatter::error(
                'Debes verificar tu contraseña para continuar.',
                422,
                [],
                'password_verification_token_required'
            );
        }


        /**
         * VALIDACIÓN 2: Busca un token válido y no expirado.
         *
         * Filtra por usuario, acción y expiración antes de traer
         * el registro para evitar consultas innecesarias.
         */
        $record = AccountVerificationToken::query()
            ->where('user_id', $user->id)
            ->where('action', $action)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$record) {
            return ResponseFormatter::error(
                'Token de verificación inválido o expirado.',
                401,
                [],
                'password_verification_token_invalid'
            );
        }


        /**
         * VALIDACIÓN 3: Verifica que el token coincida con el hash.
         *
         * Hash::check previene ataques de timing y comparación directa.
         */
        if (!Hash::check($token, $record->token)) {
            return ResponseFormatter::error(
                'Token de verificación incorrecto.',
                401,
                [],
                'password_verification_token_mismatch'
            );
        }


        /**
         * Consume el token eliminándolo de la BD.
         *
         * Es de un solo uso: una vez utilizado no puede reutilizarse,
         * evitando que un token interceptado se use múltiples veces.
         */
        $record->delete();

        return $next($request);
    }
}
