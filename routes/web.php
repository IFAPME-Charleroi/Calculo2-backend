<?php

use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\RenovationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetchdata', [RenovationController::class, 'fetchdata']);
Route::get('/arrondissements/fetchdata', [ArrondissementController::class, 'fetchdata']);

//Route::get('/home', [RenovationController::class, 'create'])->name('home');
