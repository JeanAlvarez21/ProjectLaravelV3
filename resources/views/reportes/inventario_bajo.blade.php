<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Bajo - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            position: fixed;
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

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
        }

        .warning {
            color: #dc3545;
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
            <a href="/facturacion" class="nav-item">
                <span>Facturación</span>
            </a>
            <a href="/reportes" class="nav-item active">
                <span>Reportes</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Inventario Bajo</h1>
                <div>
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">Volver</a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
                        Exportar PDF
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Stock Actual</th>
                                    <th>Stock Mínimo</th>
                                    <th>Diferencia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>{{ $producto->min_stock }}</td>
                                        <td class="warning">{{ $producto->stock - $producto->min_stock }}</td>
                                        <td>
                                            <a href="{{ route('productos.edit', $producto->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Editar Stock
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
</body>

</html>