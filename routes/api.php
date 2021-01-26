<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PermissionController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\TypeSampleController;

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
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class );
    Route::post('assign_permission_to_role/{role_id}', [RoleController::class, 'assign_permission']);

});

Route::apiResources([
    'type_samples' => TypeSampleController::class,
]);