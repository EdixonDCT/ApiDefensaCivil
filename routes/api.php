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
    $usuario = User::all();
    return $usuario;
});

