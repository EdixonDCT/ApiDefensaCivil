<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\StateUser;
use App\Models\User;

// Route::post('/prueba', function (Request $request) {
//     return StateUser::create($request->all());
// });

Route::post('/prueba', function (Request $request) {
    return User::create($request->all());
});

Route::get('/wasa', function (Request $request) {
    $usuario = StateUser::find(1);
    return $usuario->user;
});

Route::get('/estado', function (Request $request) {
    $usuario = StateUser::all();
    return $usuario;
});

Route::post('/estado', function (Request $request) {
    return StateUser::create($request->all());
});

