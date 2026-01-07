<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StateUser\StateUserController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\DocumentType\DocumentTypeController;
use App\Http\Controllers\API\Sectional\SectionalController;
use App\Http\Controllers\API\Organization\OrganizationController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\Auth\AuthenticationController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

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

route::prefix('genders')->group(function () {
    route::get('/', [GenderController::class, 'index']);
    
    route::get('/{gender_id}', [GenderController::class, 'show']);
    
    route::post('/', [GenderController::class, 'store']);

    route::put('/{gender_id}', [GenderController::class, 'update']);

    route::patch('/{gender_id}', [GenderController::class, 'partialUpdate']);

    route::patch('/state/{gender_id}', [GenderController::class, 'changeState']);

    route::delete('/{gender_id}', [GenderController::class, 'destroy']);
});

route::prefix('documentTypes')->group(function () {
    route::get('/', [DocumentTypeController::class, 'index']);
    
    route::get('/{documentType_id}', [DocumentTypeController::class, 'show']);
    
    route::post('/', [DocumentTypeController::class, 'store']);

    route::put('/{documentType_id}', [DocumentTypeController::class, 'update']);

    route::patch('/{documentType_id}', [DocumentTypeController::class, 'partialUpdate']);

    route::patch('/state/{documentType_id}', [DocumentTypeController::class, 'changeState']);

    route::delete('/{documentType_id}', [DocumentTypeController::class, 'destroy']);
});

route::prefix('sectionals')->group(function () {
    route::get('/', [SectionalController::class, 'index']);
    
    route::get('/{sectional_id}', [SectionalController::class, 'show']);
    
    route::post('/', [SectionalController::class, 'store']);

    route::put('/{sectional_id}', [SectionalController::class, 'update']);

    route::patch('/{sectional_id}', [SectionalController::class, 'partialUpdate']);

    route::patch('/state/{sectional_id}', [SectionalController::class, 'changeState']);

    route::delete('/{sectional_id}', [SectionalController::class, 'destroy']);
});

route::prefix('organizations')->group(function () {
    route::get('/', [OrganizationController::class, 'index']);
        
    route::get('/{organization_id}', [OrganizationController::class, 'show']);
    
    route::get('/sectional/{sectional_id}', [OrganizationController::class, 'getSectional']);

    route::post('/', [OrganizationController::class, 'store']);

    route::put('/{organization_id}', [OrganizationController::class, 'update']);

    route::patch('/{organization_id}', [OrganizationController::class, 'partialUpdate']);

    route::patch('/state/{organization_id}', [OrganizationController::class, 'changeState']);

    route::delete('/{organization_id}', [OrganizationController::class, 'destroy']);
});

route::prefix('profiles')->group(function () {
    route::get('/', [ProfileController::class, 'index']);
    
    route::get('/{profile_id}', [ProfileController::class, 'show']);
    
    route::post('/', [ProfileController::class, 'store']);

    route::put('/{profile_id}', [ProfileController::class, 'update']);

    route::patch('/{profile_id}', [ProfileController::class, 'partialUpdate']);

    route::delete('/{profile_id}', [ProfileController::class, 'destroy']);
});