<?php

use App\Enums\TokenAbility;
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
use App\Http\Controllers\API\HousingInfo\HousingInfoController;
use App\Http\Controllers\API\VulnerableQuestion\VulnerableQuestionController;
use App\Http\Middleware\DecodeBearerToken;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/documentTypesPublic', [DocumentTypeController::class, 'index']);
Route::get('/gendersPublic', [GenderController::class, 'index']);
Route::get('/sectionalsPublic', [SectionalController::class, 'index']);
Route::get('/organizationsPublic/{sectional_id}', [OrganizationController::class, 'getSectional']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/refresh-token', [AuthenticationController::class, 'refreshToken'])
        ->middleware('ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value);
    
    Route::post('/logout', [AuthenticationController::class, 'logOut']);

    Route::prefix('statusPlans')->group(function () {
    Route::get('/', [StatusPlanController::class, 'index']);
    
    Route::get('/{statusPlan_id}', [StatusPlanController::class, 'show']);
    
    Route::post('/', [StatusPlanController::class, 'store']);

    Route::put('/{statusPlan_id}', [StatusPlanController::class, 'update']);

    Route::delete('/{statusPlan_id}', [StatusPlanController::class, 'destroy']);}); 
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
    route::get('/', [ZoneController::class, 'index'])->middleware('permission:zones.index');
    
    route::get('/{zone_id}', [ZoneController::class, 'show']);
    
    route::post('/', [ZoneController::class, 'store']);

    route::put('/{zone_id}', [ZoneController::class, 'update']);

    route::delete('/{zone_id}', [ZoneController::class, 'destroy']);
});

route::prefix('housingQualities')->group(function () {
    route::get('/', [HousingQualityController::class, 'index'])->middleware('permission:housing-qualities.index');
    
    route::get('/{housingQuality_id}', [HousingQualityController::class, 'show']);
    
    route::post('/', [HousingQualityController::class, 'store']);

    route::put('/{housingQuality_id}', [HousingQualityController::class, 'update']);

    route::delete('/{housingQuality_id}', [HousingQualityController::class, 'destroy']);
    
    route::patch('/{housingQuality_id}', [HousingQualityController::class, 'partialUpdate']);

    route::patch('/state/{housingQuality_id}', [HousingQualityController::class, 'changeState']);
});

route::prefix('sectors')->group(function () {
    route::get('/', [SectorController::class, 'index'])->middleware('permission:sectors.index');
    
    route::get('/{sector_id}', [SectorController::class, 'show']);
    
    route::post('/', [SectorController::class, 'store']);

    route::put('/{sector_id}', [SectorController::class, 'update']);

    route::delete('/{sector_id}', [SectorController::class, 'destroy']);
    
    route::patch('/{sector_id}', [SectorController::class, 'partialUpdate']);

    route::patch('/state/{sector_id}', [SectorController::class, 'changeState']);
});



route::prefix('apartments')->group(function () {
    route::get('/', [ApartmentController::class, 'index'])->middleware('permission:apartments.index');
    
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
    
    route::get('/apartment/{city_id}', [CityController::class, 'getApartment'])->middleware('permission:cities.apartments');

    route::post('/', [CityController::class, 'store']);

    route::put('/{city_id}', [CityController::class, 'update']);

    route::patch('/{city_id}', [CityController::class, 'partialUpdate']);

    route::patch('/state/{city_id}', [CityController::class, 'changeState']);

    route::delete('/{city_id}', [CityController::class, 'destroy']);
});

route::prefix('familyPlans')->group(function () {
    route::get('/', [FamilyPlanController::class, 'index']);
        
    route::get('/{familyPlan_id}', [FamilyPlanController::class, 'show'])->middleware('permission:family-plans.show');

    route::post('/', [FamilyPlanController::class, 'store'])->middleware('permission:family-plans.store');

    route::put('/{familyPlan_id}', [FamilyPlanController::class, 'update']);

    route::patch('/{familyPlan_id}', [FamilyPlanController::class, 'partialUpdate']);

    route::patch('/identify/{familyPlan_id}', [FamilyPlanController::class, 'identify'])->middleware('permission:family-plans.identify');

    route::patch('/state/{familyPlan_id}', [FamilyPlanController::class, 'changeState']);

    route::patch('/geore/{familyPlan_id}', [FamilyPlanController::class, 'georeferencing']);

    route::delete('/{familyPlan_id}', [FamilyPlanController::class, 'destroy']);
});

route::prefix('housingInfo')->group(function () {
    route::get('/', [HousingInfoController::class, 'index']);
        
    route::get('/{housingInfo_id}', [HousingInfoController::class, 'show'])->middleware('permission:housing-info.show');

    route::post('/', [HousingInfoController::class, 'store'])->middleware('permission:housing-info.store');

    route::delete('/{housingInfo_id}', [HousingInfoController::class, 'destroy'])->middleware('permission:housing-info.destroy');
});

    route::prefix('documentTypes')->group(function ()
{
    route::get('/', [DocumentTypeController::class, 'index']);
    route::get('/{documentType_id}', [DocumentTypeController::class, 'show']);
    route::post('/', [DocumentTypeController::class, 'store']);
    route::put('/{documentType_id}', [DocumentTypeController::class, 'update']);
    route::patch('/{documentType_id}', [DocumentTypeController::class, 'partialUpdate']);
    route::patch('/state/{documentType_id}', [DocumentTypeController::class, 'changeState']);
    route::delete('/{documentType_id}', [DocumentTypeController::class, 'destroy']);
});

route::prefix('vulnerableQuestions')->group(function () {
    route::get('/', [VulnerableQuestionController::class, 'index']);
    
    route::get('/{vulnerableQuestion_id}', [VulnerableQuestionController::class, 'show']);
    
    route::post('/', [VulnerableQuestionController::class, 'store']);

    route::put('/{vulnerableQuestion_id}', [VulnerableQuestionController::class, 'update']);

    route::patch('/{vulnerableQuestion_id}', [VulnerableQuestionController::class, 'partialUpdate']);

    route::patch('/state/{vulnerableQuestion_id}', [VulnerableQuestionController::class, 'changeState']);

    route::delete('/{vulnerableQuestion_id}', [VulnerableQuestionController::class, 'destroy']);
});
});