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
use App\Http\Controllers\NotificationCenterController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CarpinteroController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CorteController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Vistas
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
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Controllers
Route::post('/register', [RegisterController::class, 'register']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/logout', function () {
    Auth::logout(); // Cierra la sesión del usuario
    return redirect('/'); // Redirige a la página principal o de inicio de sesión
})->name('logout');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/address', [ProfileController::class, 'updateAddress'])->name('address.update');

// Inventario routes
Route::resource('inventario', InventarioController::class);

// Producto routes
Route::resource('productos', ProductoController::class);

// Ruta adicional para la búsqueda de productos
Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search');

// Categoria routes
Route::resource('categorias', CategoriaController::class);
Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index');


// Ruta de contacto (asumiendo que quieres mantenerla basada en tu inclusión del ContactController)
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// Rutas para Carpinteros
Route::get('/carpinteros', [CarpinteroController::class, 'index'])->name('carpinteros.index');
Route::get('/carpinteros/manage', [CarpinteroController::class, 'manage'])->name('carpinteros.manage');
Route::post('/carpinteros', [CarpinteroController::class, 'store'])->name('carpinteros.store');
Route::get('/carpinteros/{id}/edit', [CarpinteroController::class, 'edit'])->name('carpinteros.edit');
Route::put('/carpinteros/{id}', [CarpinteroController::class, 'update'])->name('carpinteros.update');
Route::delete('/carpinteros/{id}', [CarpinteroController::class, 'destroy'])->name('carpinteros.destroy');

//productos clientes
Route::get('/productos-clientes', [ProductoController::class, 'showForClients'])->name('productos.clientes');

// Ruta para agregar productos al carrito
Route::post('cart-add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart-update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('cart-remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');


// Rutas de proyectos
Route::resource('proyectos', ProyectoController::class);
Route::get('/proyectos/{proyecto}/cortes', [CorteController::class, 'create'])->name('proyectos.cortes.create');
Route::get('/cortes/create/{proyecto_id}', [CorteController::class, 'create'])->name('cortes.create');

// Rutas de cortes
Route::resource('cortes', CorteController::class);
Route::get('/cortes/create/{proyecto_id}', [CorteController::class, 'create'])->name('cortes.create');
Route::post('/cortes/store', [CorteController::class, 'store'])->name('cortes.store');


