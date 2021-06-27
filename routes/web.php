<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanelController;
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

Route::get('/', [AdminController::class, 'dashboard']);

//Auth::routes();
Route::prefix('panel')->name('panel.')->group(function (){
    Route::get('auth/login', [TeacherController::class, 'showLoginForm'])->name('auth.login.show');
    Route::get('auth/register', [TeacherController::class, 'register'])->name('auth.create');

    Route::post('auth/login', [TeacherController::class, 'login'])->name('auth.login');
    Route::post('auth/register', [TeacherController::class, 'register'])->name('auth.register');

    Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::resource('/teacher', TeacherController::class);


});

Route::resource('panel', PanelController::class);

Route::prefix('admin')->group(function (){
    Route::get('login', [AdminController::class, 'showLogin'])->name('admin.login.show');
    Route::get('login', [AdminController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AdminController::class, 'loginAction'])->name('admin.login.action');

    Route::get('register', [AdminController::class, 'create'])->name('admin.register.show');
    Route::post('register', [AdminController::class, 'store'])->name('admin.register.action');

    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('teacher/create', [TeacherController::class, 'create'])->name('admin.teacher.create');
    Route::post('teacher/store', [TeacherController::class, 'store'])->name('admin.teacher.store');
    Route::get('teacher', [TeacherController::class, 'index'])->name('admin.teacher.index');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});
