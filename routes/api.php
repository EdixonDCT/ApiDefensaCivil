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
use App\Http\Controllers\API\Zone\ZoneController;
use App\Http\Controllers\API\HousingQuality\HousingQualityController;
use App\Http\Controllers\API\Sector\SectorController;
use App\Http\Controllers\API\StatusPlan\StatusPlanController;
use App\Http\Controllers\API\Apartment\ApartmentController;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\FamilyPlan\FamilyPlanController;

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

route::prefix('zones')->group(function () {
    route::get('/', [ZoneController::class, 'index']);
    
    route::get('/{zone_id}', [ZoneController::class, 'show']);
    
    route::post('/', [ZoneController::class, 'store']);

    route::put('/{zone_id}', [ZoneController::class, 'update']);

    route::delete('/{zone_id}', [ZoneController::class, 'destroy']);
});

route::prefix('housingQualities')->group(function () {
    route::get('/', [HousingQualityController::class, 'index']);
    
    route::get('/{housingQuality_id}', [HousingQualityController::class, 'show']);
    
    route::post('/', [HousingQualityController::class, 'store']);

    route::put('/{housingQuality_id}', [HousingQualityController::class, 'update']);

    route::delete('/{housingQuality_id}', [HousingQualityController::class, 'destroy']);
    
    route::patch('/{housingQuality_id}', [HousingQualityController::class, 'partialUpdate']);

    route::patch('/state/{housingQuality_id}', [HousingQualityController::class, 'changeState']);
});

route::prefix('sectors')->group(function () {
    route::get('/', [SectorController::class, 'index']);
    
    route::get('/{sector_id}', [SectorController::class, 'show']);
    
    route::post('/', [SectorController::class, 'store']);

    route::put('/{sector_id}', [SectorController::class, 'update']);

    route::delete('/{sector_id}', [SectorController::class, 'destroy']);
    
    route::patch('/{sector_id}', [SectorController::class, 'partialUpdate']);

    route::patch('/state/{sector_id}', [SectorController::class, 'changeState']);
});

route::prefix('statusPlans')->group(function () {
    route::get('/', [StatusPlanController::class, 'index']);
    
    route::get('/{statusPlan_id}', [StatusPlanController::class, 'show']);
    
    route::post('/', [StatusPlanController::class, 'store']);

    route::put('/{statusPlan_id}', [StatusPlanController::class, 'update']);

    route::delete('/{statusPlan_id}', [StatusPlanController::class, 'destroy']);
});

route::prefix('apartments')->group(function () {
    route::get('/', [ApartmentController::class, 'index']);
    
    route::get('/{apartment_id}', [ApartmentController::class, 'show']);
    
    route::post('/', [ApartmentController::class, 'store']);

    route::put('/{apartment_id}', [ApartmentController::class, 'update']);

    route::delete('/{apartment_id}', [ApartmentController::class, 'destroy']);
    
    route::patch('/{apartment_id}', [ApartmentController::class, 'partialUpdate']);

    route::patch('/state/{apartment_id}', [ApartmentController::class, 'changeState']);
});

route::prefix('cities')->group(function () {
    route::get('/', [CityController::class, 'index']);
        
    route::get('/{city_id}', [CityController::class, 'show']);
    
    route::get('/apartment/{city_id}', [CityController::class, 'getApartment']);

    route::post('/', [CityController::class, 'store']);

    route::put('/{city_id}', [CityController::class, 'update']);

    route::patch('/{city_id}', [CityController::class, 'partialUpdate']);

    route::patch('/state/{city_id}', [CityController::class, 'changeState']);

    route::delete('/{city_id}', [CityController::class, 'destroy']);
});

route::prefix('familyPlans')->group(function () {
    route::get('/', [FamilyPlanController::class, 'index']);
        
    route::get('/{familyPlan_id}', [FamilyPlanController::class, 'show']);

    route::post('/', [FamilyPlanController::class, 'store']);

    route::put('/{familyPlan_id}', [FamilyPlanController::class, 'update']);

    route::patch('/{familyPlan_id}', [FamilyPlanController::class, 'partialUpdate']);

    route::patch('/state/{familyPlan_id}', [FamilyPlanController::class, 'changeState']);

    route::patch('/geore/{familyPlan_id}', [FamilyPlanController::class, 'Georeferencing']);

    route::delete('/{familyPlan_id}', [FamilyPlanController::class, 'destroy']);
});