@extends('layouts.app')

@section('title', 'Dashboard - Novocentro')

@section('styles')
<style>
    .main-content {
        padding: 2rem;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        background: #fff;
        padding: 1.5rem;
    }

    .stats-card .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stats-card .stats-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0.5rem 0;
        color: #2c3e50;
    }

    .stats-card .stats-label {
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .chart-wrapper {
        position: relative;
        height: 400px;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <main class="col-12">
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Error al cargar los datos: {{ $error }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="stats-card card h-100">
                            <div class="icon-wrapper bg-primary bg-opacity-10">
                                <i class="bi bi-people-fill text-primary fs-4"></i>
                            </div>
                            <div class="stats-value">{{ $totalUsuarios }}</div>
                            <div class="stats-label">Usuarios Totales</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="stats-card card h-100">
                            <div class="icon-wrapper bg-success bg-opacity-10">
                                <i class="bi bi-cart-check-fill text-success fs-4"></i>
                            </div>
                            <div class="stats-value">{{ $totalPedidos }}</div>
                            <div class="stats-label">Pedidos Totales</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="stats-card card h-100">
                            <div class="icon-wrapper bg-warning bg-opacity-10">
                                <i class="bi bi-box-seam-fill text-warning fs-4"></i>
                            </div>
                            <div class="stats-value">{{ $totalProductos }}</div>
                            <div class="stats-label">Productos en Stock</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="stats-card card h-100">
                            <div class="icon-wrapper bg-info bg-opacity-10">
                                <i class="bi bi-currency-dollar text-info fs-4"></i>
                            </div>
                            <div class="stats-value">${{ number_format($ingresosTotales, 2) }}</div>
                            <div class="stats-label">Ingresos Totales</div>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-4">Ventas últimos 30 días</h2>
                        <div class="chart-wrapper">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top and Bottom Products -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title h5 mb-4">Top 10 Productos Más Vendidos</h2>
                                <ul class="list-group list-group-flush">
                                    @foreach($topProductos as $producto)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span class="text-truncate">{{ $producto->nombre }}</span>
                                            <span
                                                class="badge bg-primary rounded-pill">{{ $producto->total_vendidos }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title h5 mb-4">Top 10 Productos Menos Vendidos</h2>
                                <ul class="list-group list-group-flush">
                                    @foreach($bottomProductos as $producto)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span class="text-truncate">{{ $producto->nombre }}</span>
                                            <span
                                                class="badge bg-secondary rounded-pill">{{ $producto->total_vendidos }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title h5 mb-0">Últimos 10 Pedidos Recientes</h2>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-primary btn-sm">
                                Ver todos
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedidosRecientes as $pedido)
                                                                        <tr>
                                                                            <td>#{{ $pedido->id_pedido }}</td>
                                                                            <td>{{ $pedido->usuario->nombres }} {{ $pedido->usuario->apellidos }}</td>
                                                                            <td>
                                                                                @if($pedido->fecha_pedido instanceof \Carbon\Carbon)
                                                                                    {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}
                                                                                @else
                                                                                    {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                                                                @endif
                                                                            </td>
                                                                            <td>${{ number_format($pedido->total, 2) }}</td>
                                                                            <td>
                                                                                <span class="badge status-badge 
                                                                                    {{ $pedido->estado->nombre === 'Entregado' ? 'bg-success' :
                                                                                    ($pedido->estado->nombre === 'Cancelado' ? 'bg-danger' :
                                                                                    (in_array($pedido->estado->nombre, ['En proceso', 'En reparto']) ? 'bg-primary' : 'bg-warning')) }}">
                                                                                    {{ $pedido->estado->nombre ?? 'Pendiente' }}
                                                                                </span>

                                                                            </td>
                                                                            <td>
                                                                                <a href="{{ route('pedidos.show', $pedido->id_pedido) }}"
                                                                                    class="btn btn-sm btn-outline-primary">
                                                                                    <i class="bi bi-eye"></i>
                                                                                    <span class="visually-hidden">Ver detalles del pedido</span>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Carpenters -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title h5 mb-4">Carpinteros Disponibles</h2>
                                <ul class="list-group list-group-flush">
                                    @foreach($carpinterosDisponibles as $carpintero)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span class="text-truncate">{{ $carpintero->nombre }}</span>
                                            <span
                                                class="badge bg-success rounded-pill">{{ $carpintero->especialidad }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Products -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-4">Productos con Bajo Stock</h2>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Stock Actual</th>
                                        <th scope="col">Stock Mínimo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productosConBajoStock as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>{{ $producto->min_stock }}</td>
                                            <td>
                                                <a href="{{ route('productos.edit', $producto->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                    <span class="visually-hidden">Editar producto</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Ventas Diarias',
                    data: {!! json_encode($chartData) !!},
                    fill: true,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function (value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection