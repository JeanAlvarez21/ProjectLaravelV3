<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedidos;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\Carpintero;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Obtener el total de usuarios
            $totalUsuarios = User::count();

            // Obtener el total de pedidos
            $totalPedidos = Pedidos::count();

            // Obtener el total de productos en stock
            $totalProductos = Producto::sum('stock');

            // Obtener los ingresos totales
            $ingresosTotales = Pedidos::sum('total');

            // Obtener las ventas de los últimos 30 días
            $ventas = Pedidos::where('fecha_pedido', '>=', Carbon::now()->subDays(30))
                ->selectRaw('DATE(fecha_pedido) as date, SUM(total) as total')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Preparar los datos para el gráfico
            $chartLabels = $ventas->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d/m');
            });
            $chartData = $ventas->pluck('total');

            // Obtener los 5 pedidos más recientes con eager loading
            $pedidosRecientes = Pedidos::with('usuario')
                ->orderBy('fecha_pedido', 'desc')
                ->limit(5)
                ->get();

            // Obtener los 5 productos más vendidos
            $topProductos = DB::table('detalles_pedidos')
                ->join('productos', 'detalles_pedidos.producto_id', '=', 'productos.id')
                ->select('productos.nombre', DB::raw('SUM(detalles_pedidos.cantidad) as total_vendidos'))
                ->groupBy('productos.id', 'productos.nombre')
                ->orderByDesc('total_vendidos')
                ->limit(5)
                ->get();

            // Obtener los proyectos activos
            $proyectosActivos = Proyecto::whereIn('estado', ['Nuevo', 'En proceso'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Obtener los carpinteros disponibles
            $carpinterosDisponibles = Carpintero::where('disponibilidad', true)
                ->orderBy('nombre')
                ->limit(5)
                ->get();

            // Obtener productos con bajo stock
            $productosConBajoStock = Producto::whereRaw('stock <= min_stock')
                ->orderBy('stock')
                ->limit(5)
                ->get();

            // Obtener el contenido actual del carrito
            $cartItems = session()->get('cart', []);
            $cartItemCount = count($cartItems);

            return view('dashboard', compact(
                'totalUsuarios',
                'totalPedidos',
                'totalProductos',
                'ingresosTotales',
                'chartLabels',
                'chartData',
                'pedidosRecientes',
                'topProductos',
                'proyectosActivos',
                'carpinterosDisponibles',
                'productosConBajoStock',
                'cartItemCount'
            ));

        } catch (\Exception $e) {
            return view('dashboard')->with('error', $e->getMessage());
        }
    }
}