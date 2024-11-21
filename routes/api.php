<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIHandlerController;
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

Route::post('/login/submit', [APIHandlerController::class, 'login_submit']);


Route::post('/check/name', [ApiHandlerController::class, 'check_name_for_reset_password']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/validation', [APIHandlerController::class, 'checking_existing_room']);
});
