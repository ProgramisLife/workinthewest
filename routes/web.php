<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Users\EditorController;
use App\Http\Controllers\Users\EmployeeController;
use App\Http\Controllers\Users\EmployerController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\RegistrationController;
use Illuminate\Support\Facades\Auth;

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
Auth::routes(['verify' => true]);

Route::get('/regulamin', function () {
    return view('auth.regulamin');
})->name('regulamin');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register/{type?}', [RegistrationController::class, 'create'])->name('register');


Route::get('/', function () {
    return redirect()->route('jobs.index');
});

Route::prefix('/jobs')->group(function () {

    Route::match(['get', 'post'], '/search', [JobController::class, 'search'])->name('jobs.search'); // Wszukiwarka ?
    
    Route::get('/', [JobController::class, 'index'])->name('jobs.index');

    Route::get('/add', [JobController::class, 'add'])->name('jobs.add')->middleware('auth.employer');

    Route::post('get-states-by-country', [JobController::class, 'getState'])->name('jobs.getState');

    Route::post('get-cities-by-state', [JobController::class, 'getCity'])->name('jobs.getCity');

    Route::post('/store', [JobController::class, 'store'])->name('jobs.store')->middleware('auth.employer'); // Zapisujemy pracę

    Route::get('/{job}', [JobController::class, 'show'])->name('jobs.show'); //Pokazywanie pojedyńczego pracy

    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit')->middleware('auth.employer'); // Edytowanie konkretnej pracy.

    Route::put('/{job}', [JobController::class, 'update'])->name('jobs.update')->middleware('auth.employer');

    Route::delete('/{job}', [JobController::class, 'delete'])->name('jobs.delete')->middleware('auth.employer');
});


Route::prefix('/articles')->group(function () {

     Route::match(['get', 'post'], '/search', [ArticleController::class, 'search'])->name('articles.search');

    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('/add', [ArticleController::class, 'add'])->name('articles.add')->middleware('auth.editor');

    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth.editor');

    Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); //Pokazywanie pojedyńczego zadania

    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth.editor');

    Route::put('/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth.editor');

    Route::delete('/{article}', [ArticleController::class, 'delete'])->name('articles.delete')->middleware('auth.editor');
});

Route::prefix('/accommodations')->group(function () {

    Route::post('/search', [AccommodationController::class, 'search'])->name('accommodations.search');

    Route::get('/', [AccommodationController::class, 'index'])->name('accommodations.index');

    Route::get('/add', [AccommodationController::class, 'add'])->name('accommodations.add')->middleware('auth.employer');

    Route::post('get-states-by-country', [AccommodationController::class, 'getState'])->name('accommodations.getState');

    Route::post('get-cities-by-state', [AccommodationController::class, 'getCity'])->name('accommodations.getCity');

    Route::post('/store', [AccommodationController::class, 'store'])->name('accommodations.store')->middleware('auth.employer');

    Route::get('/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');

    Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('accommodations.edit')->middleware('auth.employer');

    Route::put('/{accommodation}', [AccommodationController::class, 'update'])->name('accommodations.update')->middleware('auth.employer');

    Route::delete('/{accommodation}', [AccommodationController::class, 'delete'])->name('accommodations.delete')->middleware('auth.employer');
});

Route::prefix('/employers')->group(function () {
 
    Route::post('/store', [EmployerController::class, 'registerStore'])->name('employers.registerStore');

    Route::group(['middleware' => ['auth.employer']], function () {

        Route::get('/', [EmployerController::class, 'dashboard'])->name('employers.dashboard');

        Route::match(['get', 'post'], '/search', [EmployerController::class, 'search'])->name('employers.search');

        Route::get('/{employer}/edit', [EmployerController::class, 'edit'])->name('employers.edit');

        Route::put('/{employer}', [EmployerController::class, 'update'])->name('employers.update');

        Route::delete('/{employer}', [EmployerController::class, 'delete'])->name('employers.delete');
    });
});

Route::prefix('/employee')->group(function () {

    Route::post('/store', [EmployeeController::class, 'registerStore'])->name('employee.registerStore');
 
    Route::group(['middleware' => ['auth.employee']], function () {

        Route::get('/', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');

        Route::match(['get', 'post'], '/search', [EmployeeController::class, 'search'])->name('employee.search');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');

        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employee.update');

        Route::delete('/{employee}', [EmployeeController::class, 'delete'])->name('employee.delete');
    });
});

Route::prefix('/editor')->group(function () {
 
    Route::post('/store', [EditorController::class, 'registerStore'])->name('editor.registerStore');

    Route::group(['middleware' => ['auth.editor']], function () {

        Route::get('/', [EditorController::class, 'dashboard'])->name('editor.dashboard');

        Route::match(['get', 'post'], '/search', [EditorController::class, 'search'])->name('editor.search');

        Route::get('/{editor}/edit', [EditorController::class, 'edit'])->name('editor.edit');

        Route::put('/{editor}', [EditorController::class, 'update'])->name('editor.update');

        Route::delete('/{editor}', [EditorController::class, 'delete'])->name('editor.delete');
    });
});



