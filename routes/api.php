<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleStatusController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('view_trips', [UserController::class, 'getTrips']);
Route::post('trip', [TripController::class, 'create']);
Route::put('trip', [TripController::class, 'update']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users',UserController::class);
Route::resource('departments',DepartmentController::class);
Route::resource('trips',TripController::class);
Route::resource('vehicles',VehicleController::class);
Route::resource('vehicle_statuses',VehicleStatusController::class);
