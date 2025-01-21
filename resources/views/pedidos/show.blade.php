<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #FFD700;
            min-height: 100vh;
            padding: 1rem;
        }

        .sidebar .logo {
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .sidebar .nav-item {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar .nav-item.active {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar .btn-logout {
            background-color: #FF6347;
            /* Rojo */
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

        .sidebar .btn-logout:hover {
            background-color: #D44C3C;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
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
                    <a href="/pedidos" class="nav-item  active">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item">
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
                    <a href="/pedidos" class="nav-item  active">
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

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h2>Pedido #{{ $pedido->id_pedido }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3">Cliente:</h6>
                                    <div>
                                        <strong>{{ $pedido->usuario->nombres }}
                                            {{ $pedido->usuario->apellidos }}
                                        </strong>
                                    </div>
                                    <div>{{ $pedido->usuario->email }}</div>
                                    <div>{{ $pedido->direccion_pedido }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="mb-3">Detalles del Pedido:</h6>
                                    <div>
                                        Fecha:
                                        @if($pedido->fecha_pedido instanceof \Carbon\Carbon)
                                            {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                        @endif
                                    </div>
                                    <div>Estado: <span
                                            class="badge bg-primary">{{ $pedido->estado ?? 'Pendiente' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
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

                            <div class="text-center mt-4">
                                <a href="{{ route('pedidos.index') }}" class="btn btn-primary">Volver a Pedidos</a>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Ir al Inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>