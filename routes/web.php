<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//Vistas
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/empleado/dashboard', [EmpleadoController::class, 'index'])->name('empleado.dashboard')->middleware('auth');
Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard')->middleware('auth');


//Controllers
Route::post('/register', [RegisterController::class, 'register']);


