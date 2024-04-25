<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AccommodationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('jobs.index');
});

Route::prefix('/jobs')->group(function () {

    Route::get('/', [JobController::class, 'index'])->name('jobs.index');

    Route::get('/add', [JobController::class, 'add'])->name('jobs.add');

    Route::post('get-states-by-country', [JobController::class, 'getState'])->name('jobs.getState');

    Route::post('get-cities-by-state', [JobController::class, 'getCity'])->name('jobs.getCity');

    Route::post('/store', [JobController::class, 'store'])->name('jobs.store'); // Zapisujemy pracę

    Route::match(['get', 'post'], '/search', [JobController::class, 'search'])->name('jobs.search'); // Wszukiwarka ?

    Route::get('/{job}', [JobController::class, 'show'])->name('jobs.show'); //Pokazywanie pojedyńczego pracy

    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit'); // Edytowanie konkretnej pracy.

    Route::put('/{job}', [JobController::class, 'update'])->name('jobs.update');

    Route::delete('/{job}', [JobController::class, 'delete'])->name('jobs.delete');
});


Route::prefix('/articles')->group(function () {

    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('/add', [ArticleController::class, 'add'])->name('articles.add');

    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update');

    Route::delete('/{article}', [ArticleController::class, 'delete'])->name('articles.delete');
});

Route::prefix('/accommodation')->group(function () {

    Route::get('/', [AccommodationController::class, 'index'])->name('accommodation.index');

    Route::get('/add', [AccommodationController::class, 'add'])->name('accommodation.add');

    Route::post('get-states-by-country', [AccommodationController::class, 'getState'])->name('accommodation.getState');

    Route::post('get-cities-by-state', [AccommodationController::class, 'getCity'])->name('accommodation.getCity');

    Route::post('/store', [AccommodationController::class, 'store'])->name('accommodation.store');

    Route::get('/{accommodation}', [AccommodationController::class, 'show'])->name('accommodation.show');

    Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('accommodation.edit');

    Route::put('/{accommodation}', [AccommodationController::class, 'update'])->name('accommodation.update');

    Route::delete('/{accommodation}', [AccommodationController::class, 'delete'])->name('accommodation.delete');
});
