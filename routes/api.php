<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StateUser\StateUserController;
use App\Http\Controllers\API\User\UserController;

// Route::post('/prueba', function (Request $request) {
//     return StateUser::create($request->all());
// });

// Route::post('/prueba', function (Request $request) {
//     $stateUser = ["state" => "pruebo"];
//     return StateUser::create($stateUser);
// });

// Route::get('/wasa', function (Request $request) {
//     $usuario = StateUser::find(1);
//     return $usuario->user;
// });

// Route::get('/estado', function (Request $request) {
//     $usuario = StateUser::all();
//     return $usuario;
// });

// Route::post('/estado', function (Request $request) {
//     return StateUser::create($request->all());
// });

route::prefix('stateUsers')->group(function () {
    route::get('/', [StateUserController::class, 'index']);
    
    route::get('/{state_user_id}', [StateUserController::class, 'show']);
    
    route::post('/', [StateUserController::class, 'store']);

    route::put('/{state_user_id}', [StateUserController::class, 'update']);

    route::patch('/{state_user_id}', [StateUserController::class, 'partialUpdate']);

    route::delete('/{state_user_id}', [StateUserController::class, 'destroy']);
});

route::prefix('users')->group(function () {
    route::get('/', [UserController::class, 'index']);
    
    route::get('/{user_id}', [UserController::class, 'show']);
    
    route::post('/', [UserController::class, 'store']);

    route::put('/{user_id}', [UserController::class, 'update']);

    route::patch('/{user_id}', [UserController::class, 'partialUpdate']);

    route::delete('/{user_id}', [UserController::class, 'destroy']);
});

