<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Novocentro</title>
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
                <a href="/dashboard" class="nav-item ">
                    <span>Dashboard</span>
                </a>
                <a href="/productos" class="nav-item">
                    <span>Productos</span>
                </a>
                <a href="/inventario" class="nav-item active">
                    <span>Inventario</span>
                </a>
                <a href="/usuarios" class="nav-item">
                    <span>Usuarios</span>
                </a>
                <a href="/facturacion" class="nav-item">
                    <span>Facturación</span>
                </a>
                <a href="/reportes" class="nav-item">
                    <span>Reportes</span>
                </a>
                <!-- Botón de cerrar sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar sesión</button>
                </form>
            </nav>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-4">Inventario</h1>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex">
                                <form method="GET" action="{{ route('inventario.index') }}" class="d-flex">
                                    <input type="text" name="search" class="form-control me-2"
                                        placeholder="Buscar producto" value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                                </form>
                            </div>

                            <a href="{{ route('inventario.create') }}" class="btn btn-primary">Añadir nuevo item</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Sucursal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inventarioItems as $item)
                                        <tr>
                                            <td>{{ $item->id_inventario }}</td>
                                            <td>{{ $item->producto->nombre_producto }}</td>
                                            <td>{{ $item->cantidad_disponible }}</td>
                                            <td>{{ $item->precio_unitario }}</td>
                                            <td>{{ $item->nombre_sucursal }}</td>
                                            <td>
                                                <a href="{{ route('inventario.edit', $item->id_inventario) }}"
                                                    class="btn btn-sm btn-warning">Editar</a>

                                                <form action="{{ route('inventario.destroy', $item->id_inventario) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este item de inventario?')">Eliminar</button>
                                                </form>


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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>