<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            min-height: 100vh;
            padding: 1rem;
        }

        .logo {
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 1.2rem;
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

        /* Estilo para el botón de cerrar sesión */
        .btn-logout {
            background-color: #FF6347;
            /* Un color rojo para el botón */
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
                    <a href="/dashboard" class="nav-item">
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
                    <a href="/reportes" class="nav-item active">
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <!-- Menú reducido para rol 2 -->
                    <a href="/productos" class="nav-item">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/pedidos" class="nav-item">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item active">
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
    <div class="container mt-5">
        <h1 class="mb-4">Reportes y Consultas</h1>

        <div class="row g-4">
            <!-- Reporte de Ventas por Período -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Ventas por Período</h5>
                        <p class="card-text">Analiza las ventas realizadas en un período específico.</p>
                        <form action="{{ route('reportes.ventas-periodo') }}" method="GET" class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Ver</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('reportes.ventas-periodo', ['export' => 'pdf']) }}" class="btn btn-secondary">
                            <i class="bi bi-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Productos más Populares -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Productos más Populares</h5>
                        <p class="card-text">Visualiza los productos más vendidos y sus estadísticas.</p>
                        <form action="{{ route('reportes.productos-populares') }}" method="GET" class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Ver</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('reportes.productos-populares', ['export' => 'pdf']) }}"
                            class="btn btn-secondary">
                            <i class="bi bi-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Inventario Bajo -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Inventario Bajo</h5>
                        <p class="card-text">Revisa los productos con stock bajo que necesitan reposición.</p>
                        <a href="{{ route('reportes.inventario-bajo') }}" class="btn btn-primary mb-2">Ver Reporte</a>
                        <a href="{{ route('reportes.inventario-bajo', ['export' => 'pdf']) }}"
                            class="btn btn-secondary">
                            <i class="bi bi-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Clientes Top -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Clientes Top</h5>
                        <p class="card-text">Identifica a tus mejores clientes por volumen de compras.</p>
                        <form action="{{ route('reportes.clientes-top') }}" method="GET" class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Ver</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('reportes.clientes-top', ['export' => 'pdf']) }}" class="btn btn-secondary">
                            <i class="bi bi-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>