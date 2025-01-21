<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Excel;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function ventasPorPeriodo(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now();

        $ventas = Pedidos::whereBetween('fecha_pedido', [$fechaInicio, $fechaFin])
            ->select(
                DB::raw('DATE(fecha_pedido) as fecha'),
                DB::raw('COUNT(*) as total_pedidos'),
                DB::raw('SUM(total) as total_ventas')
            )
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        if ($request->input('export') === 'pdf') {
            $pdf = PDF::loadView('reportes.pdf.ventas_periodo', compact('ventas', 'fechaInicio', 'fechaFin'));
            return $pdf->download('reporte_ventas.pdf');
        }

        return view('reportes.ventas_periodo', compact('ventas', 'fechaInicio', 'fechaFin'));
    }

    public function productosPopulares(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now();

        $productos = DB::table('detalles_pedidos')
            ->join('productos', 'detalles_pedidos.producto_id', '=', 'productos.id')
            ->join('pedidos', 'detalles_pedidos.pedido_id', '=', 'pedidos.id_pedido')
            ->whereBetween('pedidos.fecha_pedido', [$fechaInicio, $fechaFin])
            ->select(
                'productos.nombre',
                DB::raw('SUM(detalles_pedidos.cantidad) as total_vendido'),
                DB::raw('SUM(detalles_pedidos.subtotal) as total_ingresos')
            )
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->get();

        if ($request->input('export') === 'pdf') {
            $pdf = PDF::loadView('reportes.pdf.productos_populares', compact('productos', 'fechaInicio', 'fechaFin'));
            return $pdf->download('productos_populares.pdf');
        }

        return view('reportes.productos_populares', compact('productos', 'fechaInicio', 'fechaFin'));
    }

    public function inventarioBajo()
    {
        $productos = Producto::whereRaw('stock <= min_stock')
            ->orderBy('stock')
            ->get();

        if (request()->input('export') === 'pdf') {
            $pdf = PDF::loadView('reportes.pdf.inventario_bajo', compact('productos'));
            return $pdf->download('inventario_bajo.pdf');
        }

        return view('reportes.inventario_bajo', compact('productos'));
    }

    public function clientesTop(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now();

        $clientes = DB::table('users')
            ->join('pedidos', 'users.id', '=', 'pedidos.id_usuario')
            ->whereBetween('pedidos.fecha_pedido', [$fechaInicio, $fechaFin])
            ->select(
                DB::raw("CONCAT(users.nombres, ' ', users.apellidos) as name"), // Concatenamos nombres y apellidos
                'users.email',
                'users.cedula',
                'users.telefono',
                DB::raw('COUNT(pedidos.id_pedido) as total_pedidos'),
                DB::raw('SUM(pedidos.total) as total_gastado')
            )
            ->groupBy('users.id', 'users.nombres', 'users.apellidos', 'users.email', 'users.cedula', 'users.telefono')
            ->orderByDesc('total_gastado')
            ->get();

        if ($request->input('export') === 'pdf') {
            $pdf = PDF::loadView('reportes.pdf.clientes_top', compact('clientes', 'fechaInicio', 'fechaFin'));
            return $pdf->download('clientes_top.pdf');
        }

        return view('reportes.clientes_top', compact('clientes', 'fechaInicio', 'fechaFin'));
    }
}