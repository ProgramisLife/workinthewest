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

    Route::match(['get', 'post'], '/search', [JobController::class, 'search'])->name('jobs.search'); // Wszukiwarka ?
    
    Route::get('/', [JobController::class, 'index'])->name('jobs.index');

    Route::get('/add', [JobController::class, 'add'])->name('jobs.add');

    Route::post('get-states-by-country', [JobController::class, 'getState'])->name('jobs.getState');

    Route::post('get-cities-by-state', [JobController::class, 'getCity'])->name('jobs.getCity');

    Route::post('/store', [JobController::class, 'store'])->name('jobs.store'); // Zapisujemy pracę

    Route::get('/{job}', [JobController::class, 'show'])->name('jobs.show'); //Pokazywanie pojedyńczego pracy

    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit'); // Edytowanie konkretnej pracy.

    Route::put('/{job}', [JobController::class, 'update'])->name('jobs.update');

    Route::delete('/{job}', [JobController::class, 'delete'])->name('jobs.delete');
});


Route::prefix('/articles')->group(function () {

     Route::match(['get', 'post'], '/search', [ArticleController::class, 'search'])->name('articles.search');

    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('/add', [ArticleController::class, 'add'])->name('articles.add');

    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update');

    Route::delete('/{article}', [ArticleController::class, 'delete'])->name('articles.delete');
});

Route::prefix('/accommodations')->group(function () {

    Route::post('/search', [AccommodationController::class, 'search'])->name('accommodations.search');

    Route::get('/', [AccommodationController::class, 'index'])->name('accommodations.index');

    Route::get('/add', [AccommodationController::class, 'add'])->name('accommodations.add');

    Route::post('get-states-by-country', [AccommodationController::class, 'getState'])->name('accommodations.getState');

    Route::post('get-cities-by-state', [AccommodationController::class, 'getCity'])->name('accommodations.getCity');

    Route::post('/store', [AccommodationController::class, 'store'])->name('accommodations.store');

     Route::get('/{accommodation:slug}', [AccommodationController::class, 'show'])->name('accommodations.show');

    Route::get('/{accommodation:slug}/edit', [AccommodationController::class, 'edit'])->name('accommodations.edit');

    Route::put('/{accommodation}', [AccommodationController::class, 'update'])->name('accommodations.update');

    Route::delete('/{accommodation}', [AccommodationController::class, 'delete'])->name('accommodations.delete');
});
