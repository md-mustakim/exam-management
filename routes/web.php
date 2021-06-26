<?php

use App\Http\Controllers\TeacherController;
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

//Auth::routes();
Route::prefix('panel')->name('panel.')->group(function (){
    Route::get('auth/login', [TeacherController::class, 'showLoginForm'])->name('auth.login.show');
    Route::get('auth/register', [TeacherController::class, 'register'])->name('auth.create');

    Route::post('auth/login', [TeacherController::class, 'login'])->name('auth.login');
    Route::post('auth/register', [TeacherController::class, 'register'])->name('auth.register');

    Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::resource('/teacher', TeacherController::class);
});
