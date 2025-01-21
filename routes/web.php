<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ReporteController;


// Welcome page
Route::get('/', function () {
    return view('home');
});

// Authentication routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authentication views
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/empleado/dashboard', [EmpleadoController::class, 'index'])->name('empleado.dashboard');
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
    Route::get('/admin', function () {
        return view('roles.admin');
    })->name('adminsito');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Added route within authenticated middleware group
    Route::get('/pedidos/{pedido}/detalles', [PedidoController::class, 'detalles'])->name('pedidos.detalles');
});

// Notification routes
Route::get('/notificaciones', [NotificationCenterController::class, 'index'])->name('notificaciones');

// User management routes
Route::prefix('usuarios')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/crear', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/{user}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/address', [ProfileController::class, 'updateAddress'])->name('address.update');
Route::get('/user/orders', [ProfileController::class, 'getUserOrders'])->name('user.orders');
Route::get('/user/orders', [ProfileController::class, 'getUserOrders'])->name('user.orders')->middleware('auth');
// Authentication actions
Route::post('/register', [RegisterController::class, 'register']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Inventory routes
Route::resource('inventario', InventarioController::class);

// Product routes
Route::resource('productos', ProductoController::class);
Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search');
Route::get('/productos-clientes', [ProductoController::class, 'showForClients'])->name('productos.clientes');

// Category routes
Route::resource('categorias', CategoriaController::class);

// Contact routes
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// Carpenter routes
Route::prefix('carpinteros')->group(function () {
    Route::get('/', [CarpinteroController::class, 'index'])->name('carpinteros.index');
    Route::get('/manage', [CarpinteroController::class, 'manage'])->name('carpinteros.manage');
    Route::post('/', [CarpinteroController::class, 'store'])->name('carpinteros.store');
    Route::get('/{id}/edit', [CarpinteroController::class, 'edit'])->name('carpinteros.edit');
    Route::put('/{id}', [CarpinteroController::class, 'update'])->name('carpinteros.update');
    Route::delete('/{id}', [CarpinteroController::class, 'destroy'])->name('carpinteros.destroy');
});

// Cart routes
Route::prefix('cart')->group(function () {
    Route::post('add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/', [CartController::class, 'viewCart'])->name('cart.view');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Project routes
Route::resource('proyectos', ProyectoController::class)->except(['show']);
Route::get('proyectos/{proyecto}/crear-cortes', [ProyectoController::class, 'crearCortes'])->name('proyectos.crearCortes');
Route::post('proyectos/{proyecto}/guardar-cortes', [CorteController::class, 'store'])->name('cortes.store');
Route::post('proyectos/guardar-proyecto', [ProyectoController::class, 'guardarProyecto'])->name('proyectos.guardarProyecto');
// Cut routes
Route::get('proyectos/{proyecto}/crear-cortes', [ProyectoController::class, 'verCrearCortes'])->name('proyectos.verCrearCortes');
Route::resource('cortes', CorteController::class);
Route::get('proyectos/crear-cortes', [ProyectoController::class, 'crearCortes'])->name('proyectos.crearCortes');
Route::post('proyectos/guardar-corte', [ProyectoController::class, 'guardarCorte'])->name('proyectos.guardarCorte');
Route::post('proyectos/guardar-corte-temporal', [ProyectoController::class, 'guardarCorteTemporal'])->name('proyectos.guardarCorteTemporal');
Route::get('proyectos/{proyecto}/ver-cortes', [ProyectoController::class, 'verCortes'])->name('proyectos.verCortes');

// Order routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos/{pedido}/editar', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');
    Route::delete('/pedidos/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
});

//Rutas reportes
// Rutas para reportes
Route::prefix('reportes')->middleware(['auth'])->group(function () {
    Route::get('/', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/ventas-periodo', [ReporteController::class, 'ventasPorPeriodo'])->name('reportes.ventas-periodo');
    Route::get('/productos-populares', [ReporteController::class, 'productosPopulares'])->name('reportes.productos-populares');
    Route::get('/inventario-bajo', [ReporteController::class, 'inventarioBajo'])->name('reportes.inventario-bajo');
    Route::get('/clientes-top', [ReporteController::class, 'clientesTop'])->name('reportes.clientes-top');
});
Route::get('/pedidos/{id}', [PedidoController::class, 'show2'])->name('pedidos.show2')->middleware('auth');
Route::get('/pedidos/{id}/detalles', [PedidoController::class, 'detalles'])->name('pedidos.detalles')->middleware('auth');
