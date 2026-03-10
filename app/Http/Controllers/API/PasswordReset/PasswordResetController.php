<?php

namespace App\Http\Controllers\API\PasswordReset;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\ForgotPasswordRequest;
use App\Http\Requests\PasswordReset\ResetPasswordRequest;
use App\Http\Requests\PasswordReset\VerifyCodeRequest;
use App\Services\PasswordReset\PasswordResetService;

class PasswordResetController extends Controller
{
    public function __construct(protected PasswordResetService $service) {}

    /**
     * POST /api/password/forgot
     * Envía el código al correo indicado.
     */
    public function forgot(ForgotPasswordRequest $request)
    {
        $response = $this->service->sendCode($request->validated('email'));

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code']);
    }

    /**
     * POST /api/password/verify
     * Valida que el código sea correcto y no haya expirado.
     */
    public function verify(VerifyCodeRequest $request)
    {
        $response = $this->service->verifyCode(
            $request->validated('email'),
            $request->validated('code'),
        );

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code']);
    }

    /**
     * POST /api/password/reset
     * Restablece la contraseña si el código es válido.
     */
    public function reset(ResetPasswordRequest $request)
    {
        $response = $this->service->reset(
            $request->validated('email'),
            $request->validated('code'),
            $request->validated('password'),
        );

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code']);
    }
}
