<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
    Route::post('/create', [AdminController::class, 'submit_new_user'])->name('submit_new_user');
    Route::post('/submit', [AdminController::class, 'submit_user'])->name('submit_user');
});

Route::group(['prefix' => '/quizzes', 'as' => 'quizzes.'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/edit/{quiz}', [AdminController::class, 'edit_user'])->name('edit');
    Route::get('/delete/{quiz}', [AdminController::class, 'delete_user'])->name('delete');
    Route::get('/create', [AdminController::class, 'create_user'])->name('create');
    Route::post('/create', [AdminController::class, 'submit_new_user'])->name('submit_new_user');
    Route::post('/submit', [AdminController::class, 'submit_user'])->name('submit_user');
});
