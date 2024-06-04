<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\API\EmployeesController;
use App\Http\Controllers\IncentiveController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\RaiseController;



Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);


// Clients routes
Route::middleware('auth:api')->group(function () {
    Route::resource('clients', ClientsController::class);
});

 // توجيهات الموظفين
Route::middleware('auth:api')->group(function () {
    Route::apiResource('employees', EmployeesController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::apiResource('Incentive', IncentiveController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::apiResource('Penalty', PenaltyController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::apiResource('Raise', RaiseController::class);
});
