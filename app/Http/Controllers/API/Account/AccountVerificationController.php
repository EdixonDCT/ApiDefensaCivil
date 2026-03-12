<?php


namespace App\Http\Controllers\API\Account;


use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\VerifyPasswordRequest;
use App\Services\Account\AccountTokenService;
use App\Services\Account\PasswordVerificationService;
use Illuminate\Http\JsonResponse;


/**
 * Controlador para la verificación de identidad antes de operaciones sensibles.
 *
 * Verifica la contraseña actual del usuario y genera un token temporal
 * que autoriza a realizar una acción sensible sobre la cuenta.
 *
 * Endpoints:
 * - POST /account/verify-password → verify()
 *
 * Middlewares requeridos: auth:sanctum, acting.role
 */
class AccountVerificationController extends Controller
{
    public function __construct(
        private PasswordVerificationService $passwordVerificationService,
        private AccountTokenService         $accountTokenService,
    ) {}


    /**
     * Verifica la contraseña actual y genera un token de acceso temporal.
     *
     * POST /account/verify-password
     *
     * Body:
     * {
     *   "password": "contraseña_actual",
     *   "action": "change_email"
     * }
     *
     * Response 200:
     * {
     *   "token": "abc123...",
     *   "expires_in": "10 minutos",
     *   "action": "change_email"
     * }
     *
     * @param VerifyPasswordRequest $request
     * @return JsonResponse
     */
    public function verify(VerifyPasswordRequest $request): JsonResponse
    {
        $verification = $this->passwordVerificationService->verify(
            user:     $request->user(),
            password: $request->input('password'),
        );

        if ($verification['error']) {
            return ResponseFormatter::error(
                $verification['message'],
                $verification['code'],
                $verification['errors'],
                $verification['errorKey']
            );
        }

        $response = $this->accountTokenService->generate(
            user:   $request->user(),
            action: $request->input('action'),
        );

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data']
        );
    }
}
