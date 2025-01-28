<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Período - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <style>
        .chart-container {
            width: 100%;
            height: 400px;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Loading Indicator -->
    <div class="loading-indicator d-none">
        <div class="loading-spinner"></div>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-primary sidebar-toggle" type="button" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid">
            </a>
        </div>

        <nav>
            @if(auth()->user()->rol == 1)
                <a href="/dashboard" class="nav-item">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/productos" class="nav-item">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
                <a href="/categorias" class="nav-item">
                    <i class="bi bi-folder-fill"></i>
                    <span>Familias</span>
                </a>
                <a href="/usuarios" class="nav-item">
                    <i class="bi bi-people-fill"></i>
                    <span>Usuarios</span>
                </a>
                <a href="/pedidos" class="nav-item">
                    <i class="bi bi-cart-fill"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/reportes" class="nav-item active">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @elseif(auth()->user()->rol == 2)
                <a href="/productos" class="nav-item">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
                <a href="/categorias" class="nav-item">
                    <i class="bi bi-folder-fill"></i>
                    <span>Familias</span>
                </a>
                <a href="/pedidos" class="nav-item">
                    <i class="bi bi-cart-fill"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/reportes" class="nav-item active">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Reporte de Ventas</h1>
                <div>
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
                        <i class="bi bi-file-pdf"></i> Exportar PDF
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Período: {{ $fechaInicio->format('d/m/Y') }} -
                        {{ $fechaFin->format('d/m/Y') }}
                    </h5>
                    <div class="chart-container">
                        <canvas id="ventasChart"></canvas>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Pedidos</th>
                                    <th>Total Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                                                                                                                                                                                                                                                                                                                                                        $totalVentas = 0;
                                    $totalPedidos = 0; 
                                @endphp
                                @foreach($ventas as $venta)
                                                                @php 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $totalVentas += $venta->total_ventas;
                                                                    $totalPedidos += $venta->total_pedidos;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                                                                    <td>{{ $venta->total_pedidos }}</td>
                                                                    <td>${{ number_format($venta->total_ventas, 2) }}</td>
                                                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ $totalPedidos }}</strong></td>
                                    <td><strong>${{ number_format($totalVentas, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card h-100 bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Ventas</h6>
                            <h3 class="card-title mb-0">${{ number_format($totalVentas, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100 bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Pedidos</h6>
                            <h3 class="card-title mb-0">{{ $totalPedidos }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100 bg-info text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Promedio por Pedido</h6>
                            <h3 class="card-title mb-0">
                                ${{ $totalPedidos > 0 ? number_format($totalVentas / $totalPedidos, 2) : '0.00' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
        // Include the same sidebar toggle script as in index.blade.php
        // ...

        const ctx = document.getElementById('ventasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($ventas->pluck('fecha')->map(function ($fecha) {
    return Carbon\Carbon::parse($fecha)->format('d/m');
})) !!},
                datasets: [{
                    label: 'Ventas Diarias',
                    data: {!! json_encode($ventas->pluck('total_ventas')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Ventas Diarias'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });

    </script>
</body>

</html>