<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
            }

            .logo img {
                width: 40px;
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
                <h1 class="mb-4">Reportes y Consultas</h1>
                <div class="row g-4">
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
                                <div class="d-flex justify-content-start gap-2">
                                    <a href="{{ route('reportes.ventas-periodo', ['export' => 'pdf']) }}"
                                        class="btn btn-secondary">
                                        <i class="bi bi-file-pdf"></i> Exportar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <div class="d-flex justify-content-start gap-2">
                                    <a href="{{ route('reportes.productos-populares', ['export' => 'pdf']) }}"
                                        class="btn btn-secondary">
                                        <i class="bi bi-file-pdf"></i> Exportar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Inventario Bajo</h5>
                                <p class="card-text">Revisa los productos con stock bajo que necesitan reposición.</p>
                                <div class="d-flex justify-content-start gap-2">
                                    <a href="{{ route('reportes.inventario-bajo') }}"
                                        class="btn btn-primary mb-2">Ver</a>
                                    <a href="{{ route('reportes.inventario-bajo', ['export' => 'pdf']) }}"
                                        class="btn btn-secondary">
                                        <i class="bi bi-file-pdf"></i> Exportar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <div class="d-flex justify-content-start gap-2">
                                    <a href="{{ route('reportes.clientes-top', ['export' => 'pdf']) }}"
                                        class="btn btn-secondary">
                                        <i class="bi bi-file-pdf"></i> Exportar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>