<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PermissionController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicalInstitutionController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\TopographyController;
use App\Http\Controllers\Api\TumorLineageController;
use App\Http\Controllers\Api\TypeSampleController;
use App\Http\Controllers\Api\TypeSurgeryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('signup', [AuthController::class, 'signup']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::apiResources([
        'roles'=> RoleController::class,
        'permissions'=> PermissionController::class
    ]);
    Route::post('assign_permission_to_role/{role_id}', [RoleController::class, 'assign_permission']);

});

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
]);

Route::get('check_patient_exist', [PatientController::class, 'check_patient_exist']);
