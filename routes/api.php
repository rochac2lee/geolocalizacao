<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/forecast/me/', [GeoController::class, 'showForecastTemp']); // Mostra a minha previsão do tempo
Route::get('/forecast/list/{ip}/{limit}', [GeoController::class, 'list']); // Mostra a lista de previsões recentes