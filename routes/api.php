<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PlayerController;
use App\Http\Controllers\API\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', LoginController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('team', TeamController::class);    
    Route::resource('player', PlayerController::class);    
});
