<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedidos; // Asegúrate de importar el modelo Pedidos
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el total de usuarios
        $totalUsuarios = User::count();

        // Obtener las ventas de los últimos 30 días
        $ventas = Pedidos::where('fecha_pedido', '>=', Carbon::now()->subDays(30))
            ->selectRaw('DATE(fecha_pedido) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Preparar los datos para el gráfico
        $chartLabels = $ventas->pluck('date'); // Extraer las fechas
        $chartData = $ventas->pluck('total');  // Extraer los totales de ventas

        // Obtener los 5 pedidos más recientes
        $pedidosRecientes = Pedidos::orderBy('fecha_pedido', 'desc')
            ->limit(5)
            ->get();

        // Pasar las variables a la vista
        return view('dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'pedidosRecientes' => $pedidosRecientes, // Pasar los pedidos recientes
        ]);
    }
}
