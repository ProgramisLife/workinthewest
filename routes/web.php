<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Users\EmployerController;

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

    Route::get('/add', [JobController::class, 'add'])->name('jobs.add')->middleware('auth');

    Route::post('get-states-by-country', [JobController::class, 'getState'])->name('jobs.getState');

    Route::post('get-cities-by-state', [JobController::class, 'getCity'])->name('jobs.getCity');

    Route::post('/store', [JobController::class, 'store'])->name('jobs.store')->middleware('auth'); // Zapisujemy pracę

    Route::get('/{job}', [JobController::class, 'show'])->name('jobs.show'); //Pokazywanie pojedyńczego pracy

    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit')->middleware('auth'); // Edytowanie konkretnej pracy.

    Route::put('/{job}', [JobController::class, 'update'])->name('jobs.update')->middleware('auth');

    Route::delete('/{job}', [JobController::class, 'delete'])->name('jobs.delete')->middleware('auth');
});


Route::prefix('/articles')->group(function () {

     Route::match(['get', 'post'], '/search', [ArticleController::class, 'search'])->name('articles.search');

    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('/add', [ArticleController::class, 'add'])->name('articles.add')->middleware('auth');

    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');

    Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');

    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');

    Route::delete('/{article}', [ArticleController::class, 'delete'])->name('articles.delete')->middleware('auth');
});

Route::prefix('/accommodations')->group(function () {

    Route::post('/search', [AccommodationController::class, 'search'])->name('accommodations.search');

    Route::get('/', [AccommodationController::class, 'index'])->name('accommodations.index');

    Route::get('/add', [AccommodationController::class, 'add'])->name('accommodations.add')->middleware('auth');

    Route::post('get-states-by-country', [AccommodationController::class, 'getState'])->name('accommodations.getState');

    Route::post('get-cities-by-state', [AccommodationController::class, 'getCity'])->name('accommodations.getCity');

    Route::post('/store', [AccommodationController::class, 'store'])->name('accommodations.store')->middleware('auth');

    Route::get('/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');

    Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('accommodations.edit')->middleware('auth');

    Route::put('/{accommodation}', [AccommodationController::class, 'update'])->name('accommodations.update')->middleware('auth');

    Route::delete('/{accommodation}', [AccommodationController::class, 'delete'])->name('accommodations.delete')->middleware('auth');
});

Route::prefix('/employers')->group(function () {

     Route::match(['get', 'post'], '/search', [EmployerController::class, 'search'])->name('employers.search');

    Route::get('/', [EmployerController::class, 'index'])->name('employers.index');

    Route::get('/register', [EmployerController::class, 'register'])->name('employers.register');

    Route::post('/store', [EmployerController::class, 'store'])->name('employers.store');

    Route::get('/{employer}', [EmployerController::class, 'show'])->name('employers.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{employer}/edit', [EmployerController::class, 'edit'])->name('employers.edit');

    Route::put('/{employer}', [EmployerController::class, 'update'])->name('employers.update');

    Route::delete('/{employer}', [EmployerController::class, 'delete'])->name('employers.delete');
});
