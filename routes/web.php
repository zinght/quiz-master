<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;

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

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => '/users', 'as' => 'users.'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/edit/{user}', [AdminController::class, 'edit_user'])->name('edit');
    Route::get('/delete/{user}', [AdminController::class, 'delete_user'])->name('delete');
    Route::get('/create', [AdminController::class, 'create_user'])->name('create');
    Route::post('/submit', [AdminController::class, 'submit_user'])->name('submit_user');
    Route::post('/create', [AdminController::class, 'submit_new_user'])->name('submit_new_user');
});

Route::group(['prefix' => '/quizzes', 'as' => 'quizzes.'], function(){
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('/edit/{quiz}', [QuizController::class, 'edit'])->name('edit');
    Route::get('/delete/{quiz}', [QuizController::class, 'delete'])->name('delete');
    Route::get('/create', [QuizController::class, 'create'])->name('create')->middleware(['middleware' => 'permission:create quizzes']);
    Route::post('/submit', [QuizController::class, 'submit'])->name('submit')->middleware(['middleware' => 'permission:edit quizzes']);
    Route::post('/create', [QuizController::class, 'submit_new_quiz'])->name('submit_new_quiz')->middleware(['middleware' => 'permission:create quizzes']);;
});
