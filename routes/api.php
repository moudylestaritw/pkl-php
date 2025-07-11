<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HourlyTargetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api"
| middleware group. Enjoy building your API!
|
*/

// Tes endpoint (opsional)
Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});

// Endpoint utama kamu
Route::post('/hourly-targets/set-default', [HourlyTargetController::class, 'setDefault']);
Route::post('/hourly-targets/update-actual', [HourlyTargetController::class, 'updateActual']);
Route::post('/hourly-targets/reset-actual', [HourlyTargetController::class, 'resetActualToDefault']);
