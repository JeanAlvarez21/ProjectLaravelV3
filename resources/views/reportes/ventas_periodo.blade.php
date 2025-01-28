<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Período - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #FFD700;
            --primary-dark: #E6C200;
            --sidebar-width: 280px;
            --header-height: 70px;
            --card-border-radius: 12px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
            margin: 0;
            width: 100%;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            padding: 1.5rem;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .logo {
            margin-bottom: 2.5rem;
            padding: 0.5rem;
            text-align: center;
        }

        .logo img {
            height: auto;
            width: 80%;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .nav-item {
            padding: 0.875rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 10px;
            color: rgba(0, 0, 0, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
        }

        .nav-item i {
            font-size: 1.25rem;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #000;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: #fff;
            color: #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            max-width: 1200px;
            flex: 1;
            /* Added flex: 1; for full width */
        }

        .container {
            max-width: 100%;
            width: 100%;
            /* Added for full width container */
        }

        .btn-logout {
            background-color: #fff;
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            margin-top: 2rem;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-logout:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .card {
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            background: #fff;
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #000;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #000;
        }

        .chart-container {
            width: 100%;
            height: 400px;
            margin-bottom: 2rem;
        }

        .row {
            margin: 0;
            width: 100%;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-item span {
                display: none;
            }

            .content {
                margin-left: 80px;
                width: calc(100% - 80px);
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .logo img {
                width: 40px;
            }

            .chart-container {
                height: 300px;

            }
        }

        @media (max-width: 768px) {
            .row>[class*='col-'] {
                padding: 0.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
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
                    <a href="/productos" class="nav-item ">
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
                    <a href="/productos" class="nav-item ">
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


        <!-- Main content -->
        <div class="content">
            <div class="container">
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
    </div>

    <script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>