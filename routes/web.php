<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationCenterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Vistas
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/empleado/dashboard', [EmpleadoController::class, 'index'])->name('empleado.dashboard')->middleware('auth');
Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard')->middleware('auth');
Route::get('/admin', function () {
    return view('roles.admin'); // Carga la vista
})->name('adminsito');
Route::get('/notificaciones', [NotificationCenterController::class, 'index'])->name('notificaciones');
Route::get('/dashboard', function () {
    return view('dashboard'); // Nombre del archivo en resources/views/dashboard.blade.php
})->name('dashboard');
Route::get('/notificaciones', [NotificationCenterController::class, 'index'])->name('notificaciones');

//Controllers
Route::post('/register', [RegisterController::class, 'register']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/logout', function () {
    Auth::logout(); // Cierra la sesión del usuario
    return redirect('/'); // Redirige a la página principal o de inicio de sesión
})->name('logout');

