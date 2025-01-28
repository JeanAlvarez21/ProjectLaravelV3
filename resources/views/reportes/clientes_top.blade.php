<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Top - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FFD700;
            --primary-dark: #E6C200;
            --sidebar-width: 280px;
            --sidebar-width-collapsed: 80px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            padding: 1.5rem;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .logo {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .logo img {
            max-width: 80%;
            height: auto;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-collapsed .logo img {
            max-width: 40px;
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

        .nav-item:hover,
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #000;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-item i {
            font-size: 1.25rem;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-collapsed .nav-item span {
            display: none;
        }

        .sidebar-collapsed .nav-item {
            justify-content: center;
            padding: 0.875rem;
        }

        .sidebar-collapsed .nav-item i {
            font-size: 1.5rem;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            transition: all var(--transition-speed) ease;
        }

        .content-expanded {
            margin-left: var(--sidebar-width-collapsed);
            width: calc(100% - var(--sidebar-width-collapsed));
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

        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            display: none;
        }

        .loading-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-indicator.d-none {
            display: none;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
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
                <a href="/reportes" class="nav-item">
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
                <a href="/reportes" class="nav-item">
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
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Clientes Top</h1>
                <div>
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
                        <i class="bi bi-file-pdf"></i> Exportar PDF
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Período: {{ $fechaInicio->format('d/m/Y') }} -
                        {{ $fechaFin->format('d/m/Y') }}
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Cédula</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Total Pedidos</th>
                                    <th>Total Gastado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->name }}</td>
                                        <td>{{ $cliente->cedula }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->total_pedidos }}</td>
                                        <td>${{ number_format($cliente->total_gastado, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
    <!-- Loading Indicator -->
    <div class="loading-indicator d-none">
        <div class="loading-spinner"></div>
    </div>

    <!--Sidebar Toggle Button-- >
    <button class="btn btn-primary sidebar-toggle" type="button" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!--Sidebar -->
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
                        <a href="/reportes" class="nav-item">
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
                        <a href="/reportes" class="nav-item">
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
    </script>
</body>

</html>