<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
/*
|--------------------------------------------------------------------------
| API Routess
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

Route::get('destroy/{id}', [ActorController::class, "destroy"])->name('destroy');
Route::get('showfilms/{id}', [ActorController::class, "showFilms"])->name('showFilms');

Route::get('/films', [FilmController::class, 'apiListFilms']);
Route::get('/actors', [ActorController::class, 'apiListActors']);
