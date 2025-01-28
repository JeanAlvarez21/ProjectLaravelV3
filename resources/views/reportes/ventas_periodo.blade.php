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
        /* Include the same styles as in index.blade.php */
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
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const loadingIndicator = document.querySelector('.loading-indicator');

            // Sidebar toggle functionality
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 992 &&
                    !sidebar.contains(e.target) &&
                    !sidebarToggle.contains(e.target) &&
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });

            // Collapse sidebar on larger screens
            const collapseSidebar = () => {
                if (window.innerWidth > 992) {
                    sidebar.classList.toggle('sidebar-collapsed');
                    content.classList.toggle('content-expanded');
                }
            };

            // Double-click on sidebar to collapse
            sidebar.addEventListener('dblclick', collapseSidebar);

            // Loading indicator functionality
            const showLoader = () => loadingIndicator.classList.remove('d-none');
            const hideLoader = () => loadingIndicator.classList.add('d-none');

            // Show loader when navigating
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', showLoader);
            });

            // Hide loader when page is fully loaded
            window.addEventListener('load', hideLoader);

            // Adjust layout for smaller screens
            const adjustLayout = () => {
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('show');
                    content.style.marginLeft = '0';
                } else {
                    sidebar.classList.remove('sidebar-collapsed');
                    content.classList.remove('content-expanded');
                    content.style.marginLeft = `${sidebar.offsetWidth}px`;
                }
            };

            window.addEventListener('resize', adjustLayout);
            adjustLayout(); // Initial call
        });
    </script>
</body>

</html>