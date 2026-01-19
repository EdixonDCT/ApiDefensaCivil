<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;

class AuthenticationController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $response = $this->authService->register($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials);

        if ($result['error'])
        
        return ResponseFormatter::error($result['message'], $result['code']);

        $cookieToken = $result['data']['cookieToken'];
        $cookieRefresh = $result['data']['cookieRefreshToken'];

        return ResponseFormatter::success(
        $result['message'], 
        $result['code'],
        array_diff_key($result['data'], array_flip(['cookieToken', 'cookieRefreshToken',]))
        )->cookie($cookieToken)
        ->cookie($cookieRefresh);
    }

    public function refreshToken (Request $request) 
    {
        $user = Auth::user();

        $currentRefreshToken = $request->bearerToken();

        $result = $this->authService->refreshToken($currentRefreshToken, $user);

        return response()->json([
            'success' => true,
            'message' => 'Token refrescado exitosamente',
            'data' => []
        ])->withCookie($result['cookieToken'])
    ->withCookie($result['cookieRefreshToken']);
    }

    public function logOut(Request $request)
    {
        $user = Auth::user();
        
        $this->authService->logOut($user);
        
        $expiredCookies = $this->authService->createExpiredCookies();
        
        return response()->json(['success' => true, 'message' => 'Sesión cerrada con éxito'])
            ->cookie($expiredCookies['expiredAccessToken'])
            ->cookie($expiredCookies['expiredRefreshToken']);
    }
}