<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedidos;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\Carpintero;
use App\Models\EstadoPedido;
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
            $ventasUltimos30Dias = Pedidos::where('fecha_pedido', '>=', Carbon::now()->subDays(30))
                ->selectRaw('DATE(fecha_pedido) as fecha, SUM(total) as total_ventas')
                ->groupBy('fecha')
                ->orderBy('fecha')
                ->get();

            // Preparar los datos para el gráfico
            $chartLabels = [];
            $chartData = [];
            $fechaInicio = Carbon::now()->subDays(29)->startOfDay();
            $fechaFin = Carbon::now()->endOfDay();

            while ($fechaInicio <= $fechaFin) {
                $fecha = $fechaInicio->format('Y-m-d');
                $venta = $ventasUltimos30Dias->firstWhere('fecha', $fecha);

                $chartLabels[] = $fechaInicio->format('d/m');
                $chartData[] = $venta ? $venta->total_ventas : 0;

                $fechaInicio->addDay();
            }

            // Obtener los 10 pedidos más recientes con eager loading
            $pedidosRecientes = Pedidos::with(['usuario', 'estado'])
                ->orderBy('fecha_pedido', 'desc')
                ->limit(10)
                ->get();

            // Obtener los 10 productos más vendidos
            $topProductos = DB::table('detalles_pedidos')
                ->join('productos', 'detalles_pedidos.producto_id', '=', 'productos.id')
                ->select('productos.nombre', DB::raw('SUM(detalles_pedidos.cantidad) as total_vendidos'))
                ->groupBy('productos.id', 'productos.nombre')
                ->orderByDesc('total_vendidos')
                ->limit(10)
                ->get();

            // Obtener los 10 productos menos vendidos
            $bottomProductos = DB::table('detalles_pedidos')
                ->rightJoin('productos', 'detalles_pedidos.producto_id', '=', 'productos.id')
                ->select('productos.nombre', DB::raw('COALESCE(SUM(detalles_pedidos.cantidad), 0) as total_vendidos'))
                ->groupBy('productos.id', 'productos.nombre')
                ->orderBy('total_vendidos', 'asc')
                ->limit(10)
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

            // Obtener todos los estados de pedido
            $estadosPedido = EstadoPedido::all();

            return view('dashboard', compact(
                'totalUsuarios',
                'totalPedidos',
                'totalProductos',
                'ingresosTotales',
                'chartLabels',
                'chartData',
                'pedidosRecientes',
                'topProductos',
                'bottomProductos',
                'proyectosActivos',
                'carpinterosDisponibles',
                'productosConBajoStock',
                'estadosPedido'
            ));

        } catch (\Exception $e) {
            return view('dashboard')->with('error', $e->getMessage());
        }
    }
}

