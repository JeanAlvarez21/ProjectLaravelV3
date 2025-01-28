<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detalles del Pedido - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
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
            bottom: 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            overflow-y: auto;
            transition: transform var(--transition-speed) ease;
        }

        .logo {
            margin-bottom: 2.5rem;
            padding: 0.5rem;
            text-align: center;
        }

        .logo img {
            height: auto;
            width: 80%;
            max-width: 200px;
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
            transition: margin-left var(--transition-speed) ease;
        }

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
                width: 80px;
            }

            .sidebar .nav-item span,
            .sidebar .btn-logout span {
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

        @media (max-width: 768px) {
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
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
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
                <a href="/pedidos" class="nav-item active">
                    <i class="bi bi-cart-fill"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/reportes" class="nav-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @else
                <a href="/productos" class="nav-item">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
                <a href="/categorias" class="nav-item">
                    <i class="bi bi-folder-fill"></i>
                    <span>Familias</span>
                </a>
                <a href="/pedidos" class="nav-item active">
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

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-4">Detalles del Pedido #{{ $pedido->id_pedido }}</h1>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Información del Cliente</h5>
                            <p><strong>Nombre:</strong> {{ $pedido->usuario->nombres }}
                                {{ $pedido->usuario->apellidos }}</p>
                            <p><strong>Email:</strong> {{ $pedido->usuario->email }}</p>
                            <p><strong>Dirección:</strong> {{ $pedido->direccion_pedido }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Pedido</h5>
                            <p><strong>Fecha:</strong>
                                @if($pedido->fecha_pedido instanceof \Carbon\Carbon)
                                    {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}
                                @else
                                    {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                @endif
                            </p>
                            <p><strong>Estado:</strong>
                                <span class="badge bg-{{ $pedido->estado == 'Completado' ? 'success' : 'warning' }}">
                                    {{ $pedido->estado ?? 'Pendiente' }}
                                </span>
                            </p>
                            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
                        </div>
                    </div>

                    <h5 class="mb-3">Productos del Pedido</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>${{ number_format($detalle->subtotal / $detalle->cantidad, 2) }}</td>
                                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($pedido->total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver a Pedidos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loadingIndicator = document.querySelector('.loading-indicator');

            // Ocultar el loader cuando la página ha cargado completamente
            window.addEventListener('load', function () {
                loadingIndicator.classList.add('d-none');
            });

            // Mostrar el loader cuando se hace clic en un enlace
            document.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    loadingIndicator.classList.remove('d-none');
                });
            });

            // Inicializar el toggle del sidebar
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });

                // Cerrar sidebar al hacer clic fuera
                document.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768 &&
                        !sidebar.contains(e.target) &&
                        !sidebarToggle.contains(e.target) &&
                        sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>

</html>