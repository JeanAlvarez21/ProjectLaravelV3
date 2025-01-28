<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">


    <style>
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
        }

        .main-content .container-fluid {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
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

        /* Table Styles */
        .table {
            margin: 0;
        }

        .table th {
            font-weight: 600;
            color: #2c3e50;
            border-bottom-width: 2px;
        }

        .table td {
            vertical-align: middle;
            color: #4a5568;
        }

        /* Badge Styles */
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
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

        /* Chart Styles */
        .chart-container {
            background: #fff;
            padding: 1.5rem;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Chart wrapper styles */
        .chart-wrapper {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Loading Indicator -->
    <div class="loading-indicator">
        <div class="loading-spinner"></div>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-primary sidebar-toggle d-md-none" type="button" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid">
            </a>
        </div>

        <nav>
            @if(auth()->user()->rol == 1)
                <a href="/dashboard" class="nav-item active">
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
                <a href="/reportes" class="nav-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @else
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
            @endif

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </div>

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
                        <div class="d-flex gap-3">
                            <a href="{{ route('cart.view') }}"
                                class="btn btn-outline-primary d-flex align-items-center gap-2">
                                <i class="bi bi-cart"></i>
                                <span>Carrito ({{ $cartItemCount }})</span>
                            </a>
                        </div>
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
                            <h5 class="card-title mb-4">Ventas últimos 30 días</h5>
                            <div class="chart-wrapper">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders and Top Products -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="card-title mb-0">Pedidos Recientes</h5>
                                        <a href="{{ route('pedidos.index') }}" class="btn btn-primary btn-sm">
                                            Ver todos
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Usuario</th>
                                                    <th>Fecha</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pedidosRecientes as $pedido)
                                                    <tr>
                                                        <td>#{{ $pedido->id_pedido }}</td>
                                                        <td>{{ $pedido->usuario->nombres }}
                                                            {{ $pedido->usuario->apellidos }}
                                                        </td>
                                                        <td>
                                                            @if($pedido->fecha_pedido instanceof \Carbon\Carbon)
                                                                {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                                            @endif
                                                        </td>
                                                        <td>${{ number_format($pedido->total, 2) }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-{{ $pedido->estado == 'Completado' ? 'success' : 'warning' }}">
                                                                {{ $pedido->estado ?? 'Pendiente' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('pedidos.show', $pedido->id_pedido) }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Productos Más Vendidos</h5>
                                    <div class="list-group list-group-flush">
                                        @foreach($topProductos as $producto)
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span class="text-truncate">{{ $producto->nombre }}</span>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $producto->total_vendidos }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projects and Carpenters -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Proyectos Activos</h5>
                                    <div class="list-group list-group-flush">
                                        @foreach($proyectosActivos as $proyecto)
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span class="text-truncate">{{ $proyecto->nombre }}</span>
                                                <span
                                                    class="badge bg-{{ $proyecto->estado == 'En proceso' ? 'warning' : 'success' }} rounded-pill">
                                                    {{ $proyecto->estado }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Carpinteros Disponibles</h5>
                                    <div class="list-group list-group-flush">
                                        @foreach($carpinterosDisponibles as $carpintero)
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span class="text-truncate">{{ $carpintero->nombre }}</span>
                                                <span
                                                    class="badge bg-info rounded-pill">{{ $carpintero->especialidad }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Low Stock Products -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Productos con Bajo Stock</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Stock Actual</th>
                                            <th>Stock Mínimo</th>
                                            <th>Acciones</th>
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
                                                        <i class="bi bi-pencil"></i> Editar
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>

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
                    maintainAspectRatio: true,
                    aspectRatio: 2,
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
</body>

</html>