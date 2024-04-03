<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JobController;

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

    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store'); // Zapisujemy zadania

    Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update');

    Route::delete('/{article}', [ArticleController::class, 'delete'])->name('articles.delete');
});
