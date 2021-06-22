<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PermissionController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EstadioController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\MedicalInstitutionController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\StageController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\TnmController;
use App\Http\Controllers\Api\TopographyController;
use App\Http\Controllers\Api\TubeController;
use App\Http\Controllers\Api\TumorLineageController;
use App\Http\Controllers\Api\TypeSampleController;
use App\Http\Controllers\Api\TypeSurgeryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TraceabilityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//PROTECTED ROUTES
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResources([
        'type_samples' => TypeSampleController::class,
        'topographies' => TopographyController::class,
        'tumor_lineages' => TumorLineageController::class,
        'countries' => CountryController::class,
        'states' => StateController::class,
        'cities' => CityController::class,
        'patients' => PatientController::class,
        'medical-institutions' => MedicalInstitutionController::class,
        'doctors' => DoctorController::class,
        'surgeries' => TypeSurgeryController::class,
        'samples' => SampleController::class,
        'types_samples' => TypeSampleController::class,
        'tumor_lineages' => TumorLineageController::class,
        'tnms' => TnmController::class,
        'tubes' => TubeController::class,
        'families' => FamilyController::class,
        'estadios' => EstadioController::class,
        'users' => UserController::class,
        'stages' => StageController::class,
        'traceabilities' => TraceabilityController::class,
        'documents' => DocumentController::class,
    ]);
    
    //Check exist
    Route::get('check_patient_exist', [PatientController::class, 'check_patient_exist']);
    Route::get('last_id', [PatientController::class, 'last_id']);
    Route::get('last_id_sample', [SampleController::class, 'last_id_sample']);
    Route::get('check_sample_exist', [SampleController::class, 'check_sample_exist']);
    Route::get('last_id_tube', [TubeController::class, 'last_id_tube']);
    Route::get('check_tube_exist', [TubeController::class, 'check_tube_exist']);
    Route::get('check_email_exist', [UserController::class, 'check_email_exist']);
    Route::get('check_role_exist', [RoleController::class, 'check_role_exist']);
    Route::get('last_status_sample', [TraceabilityController::class, 'last_status_sample']);

    //Roles y permisos
    Route::group(['prefix' => 'admin'], function () {
        Route::apiResources([
            'roles'=> RoleController::class,
            'permissions'=> PermissionController::class
        ]);
        Route::post('assign_permission_to_role/{role_id}', [RoleController::class, 'assign_permission']);
    
    });



    //auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('user', [AuthController::class, 'currentUser']);
        Route::get('logout', [AuthController::class, 'logout']);

    });
});


//PUBLIC ROUTES
Route::group(['prefix' => 'auth'], function () {
    Route::post('signup', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});