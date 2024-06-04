<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\API\EmployeesController; // استيراد المراقب

// Define your API routes here

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


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