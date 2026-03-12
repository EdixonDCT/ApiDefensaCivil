<?php


namespace App\Http\Controllers\API\Account;


use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateEmailRequest;
use App\Services\Account\AccountEmailService;
use Illuminate\Http\JsonResponse;


/**
 * Controlador para la actualización de credenciales de acceso del usuario.
 *
 * Las rutas de este controlador requieren el middleware password.verify
 * con la acción correspondiente, garantizando que el usuario verificó
 * su identidad antes de realizar cambios.
 *
 * Endpoints:
 * - PATCH /account/email → updateEmail()
 *
 * Middlewares requeridos: auth:sanctum, acting.role, password.verify:{action}
 */
class AccountController extends Controller
{
    public function __construct(
        private readonly AccountEmailService $accountEmailService,
    ) {}


    /**
     * Actualiza el correo electrónico del usuario autenticado.
     *
     * PATCH /account/email
     * Middleware: password.verify:change_email
     *
     * Body:
     * {
     *   "email": "nuevo@correo.com",
     *   "email_confirmation": "nuevo@correo.com"
     * }
     *
     * Response 200:
     * {
     *   "message": "Correo actualizado correctamente."
     * }
     *
     * @param UpdateEmailRequest $request
     * @return JsonResponse
     */
    public function updateEmail(UpdateEmailRequest $request): JsonResponse
    {
        $response = $this->accountEmailService->updateEmail(
            user:  $request->user(),
            email: $request->input('email'),
        );

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code'],
                $response['errors'],
                $response['errorKey']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
        );
    }
}
