<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

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

Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'actors'], function () {
        // Routes included with prefix "actors"
        Route::get('/list', [ActorController::class, 'listActors'])->name('listActors');
        Route::get('/count', [ActorController::class, 'countActors'])->name('countActors');
        Route::get('decade', [ActorController::class, 'listActorsByDecade'])->name('listActorsByDecade');
    });
 
    Route::group(['prefix' => 'filmout'], function () {
        // Routes included with prefix "filmout"
     
        Route::get('oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films', [FilmController::class, "listFilms"])->name('listFilms');
        Route::get('films/year/{year}', [FilmController::class, "filmsByYear"])->name("filmsByYear");
        Route::get('films/genre/{genre}', [FilmController::class, "filmsByGenre"])->name('filmsByGenre');
        Route::get('films/count', [FilmController::class, "countFilms"])->name('countFilms');
        Route::middleware(['validate.url'])->group(function () {
            Route::post('/create-film', [FilmController::class, 'createFilm'])->name('createFilm');
        });
    });
});
