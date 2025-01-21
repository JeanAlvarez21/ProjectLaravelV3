<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #FFD700;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            min-height: 100vh;
            padding: 1rem;
            position: fixed;
        }

        .logo {
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
        }

        .logo img {
            height: 7vh;
            width: 70%;
        }

        .nav-item {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item.active {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .main-content {
            padding: 2rem;
            flex: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-bar {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            width: 300px;
        }

        .btn-logout {
            background-color: #FF6347;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            text-align: center;
            width: 100%;
            display: block;
            margin-top: auto;
        }

        .btn-logout:hover {
            background-color: #D44C3C;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo" style="text-align: center; margin-bottom: 2rem;">
            <a href="home">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid"
                    style="height: 7vh; max-height: auto; width: 70%;">
            </a>
        </div>

        <nav>
                @if(auth()->user()->rol == 1)
                    <!-- Menú completo para rol 3 -->
                    <a href="/dashboard" class="nav-item active">
                        <span>Dashboard</span>
                    </a>
                    <a href="/productos" class="nav-item">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/usuarios" class="nav-item">
                        <span>Usuarios</span>
                    </a>
                    <a href="/pedidos" class="nav-item">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <!-- Menú reducido para rol 2 -->
                    <a href="/productos" class="nav-item active">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/pedidos" class="nav-item">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @endif

                <!-- Botón de cerrar sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar sesión</button>
                </form>
            </nav>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @if(isset($error))
                        <div class="alert alert-danger" role="alert">
                            Error al cargar los datos: {{ $error }}
                        </div>
                    @endif

                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a href="{{ route('cart.view') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-cart"></i> Carrito ({{ $cartItemCount }})
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                                            <i class="bi bi-people fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Usuarios Totales</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalUsuarios }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded p-3 me-3">
                                            <i class="bi bi-cart-check fs-4 text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Pedidos Totales</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalPedidos }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 rounded p-3 me-3">
                                            <i class="bi bi-box-seam fs-4 text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Productos en Stock</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalProductos }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 rounded p-3 me-3">
                                            <i class="bi bi-currency-dollar fs-4 text-info"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title text-muted mb-0">Ingresos Totales</h6>
                                            <h2 class="mt-2 mb-0">${{ number_format($ingresosTotales, 2) }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Chart -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Ventas últimos 30 días</h5>
                            <canvas id="salesChart" height="100"></canvas>
                        </div>
                    </div>

                    <!-- Recent Orders and Top Products -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0">Pedidos Recientes</h5>
                                        <a href="{{ route('pedidos.index') }}" class="btn btn-primary btn-sm">Ver
                                            todos</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
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
                                                        <td>{{ $pedido->usuario->name }}</td>
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
                                                                class="btn btn-sm btn-outline-primary me-1">
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
                                    <h5 class="card-title">Productos Más Vendidos</h5>
                                    <ul class="list-group list-group-flush">
                                        @foreach($topProductos as $producto)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $producto->nombre }}
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $producto->total_vendidos }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projects and Carpenters -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Proyectos Activos</h5>
                                    <ul class="list-group list-group-flush">
                                        @foreach($proyectosActivos as $proyecto)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $proyecto->nombre }}
                                                <span
                                                    class="badge bg-{{ $proyecto->estado == 'En proceso' ? 'warning' : 'success' }} rounded-pill">
                                                    {{ $proyecto->estado }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Carpinteros Disponibles</h5>
                                    <ul class="list-group list-group-flush">
                                        @foreach($carpinterosDisponibles as $carpintero)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $carpintero->nombre }}
                                                <span
                                                    class="badge bg-info rounded-pill">{{ $carpintero->especialidad }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Low Stock Products -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Productos con Bajo Stock</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
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
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>