<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

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
                            <a href="{{ route('reportes.ventas-periodo', ['export' => 'pdf']) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-file-pdf"></i> Exportar PDF
                            </a>
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
                            <a href="{{ route('reportes.productos-populares', ['export' => 'pdf']) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-file-pdf"></i> Exportar PDF
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Inventario Bajo</h5>
                            <p class="card-text">Revisa los productos con stock bajo que necesitan reposición.</p>
                            <a href="{{ route('reportes.inventario-bajo') }}" class="btn btn-primary mb-2">Ver</a>
                            <a href="{{ route('reportes.inventario-bajo', ['export' => 'pdf']) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-file-pdf"></i> Exportar PDF
                            </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/sidebar.js') }}"></script>

</body>

</html>