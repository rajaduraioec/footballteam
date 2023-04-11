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

Route::get('team', [TeamController::class, 'index']);   
Route::post('team/players', [TeamController::class, 'players']);  
Route::post('player/info', [PlayerController::class, 'player']);   

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('team', [TeamController::class, 'store']);
    Route::get('team/{team}', [TeamController::class, 'show']);
    Route::put('team/{team}', [TeamController::class, 'update']);
    Route::delete('team/{team}', [TeamController::class, 'destroy']);
  
    Route::resource('player', PlayerController::class);     
});
