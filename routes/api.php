<?php

use App\Http\Controllers\BatimentController;
use App\Http\Controllers\Calculo2Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\HabitationController;
use App\Http\Controllers\RenovationController;
use App\Http\Controllers\ArrondissementController;

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

Route::get('/renovation/calculDeperdition/{array}', [RenovationController::class,'calculDeperdition']);
Route::get('/bydistrict/{id}', [ArrondissementController::class,'getRenoByDistrict']);
Route::get('/bybuilding/{id}', [BatimentController::class,'getBuildingByDistrict']);

Route::apiResource('/calculo2', Calculo2Controller::class);
Route::apiResource('/renovation', RenovationController::class);
Route::apiResource('/habitation', HabitationController::class);
Route::apiResource('/arrondissement', ArrondissementController::class);
Route::apiResource('/commune', CommuneController::class);
Route::apiResource('/batiment', BatimentController::class);
//Route::apiResource('/deperdition',CalculDeperditionController::class);
