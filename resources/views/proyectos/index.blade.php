<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }

        h1 {
            color: #333;
        }

        .btn-ver {
            background-color: #17a2b8;
            color: white;
        }

        .btn-ver:hover {
            opacity: 0.8;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: white;
        }

        .btn-eliminar:hover {
            opacity: 0.8;
        }

        .btn-crear {
            background-color: #FF6347;
            color: white;
            border-radius: 50px;
        }

        .btn-crear:hover {
            background-color: #FF4500;
        }

        .badge {
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid" style="height: 6vh; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacto">Contacto</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <button style="font-size: 16px;"><a href="{{ route('logout') }}"
                            class="text-dark text-decoration-none">Cerrar Sesión</a></button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Listado de Proyectos</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Local</th>
                        <th>Producto Asociado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td>{{ $proyecto->nombre }}</td>
                            <td>{{ $proyecto->ciudad }}</td>
                            <td>{{ $proyecto->local }}</td>
                            <td>{{ $proyecto->producto->nombre ?? 'No asignado' }}</td>
                            <td>
                                <span class="badge bg-{{ $proyecto->estado == 'Nuevo' ? 'success' : ($proyecto->estado == 'En proceso' ? 'warning' : 'secondary') }}">
                                    {{ $proyecto->estado }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-ver btn-sm">Ver</a>
                                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-eliminar btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para crear un nuevo proyecto -->
        <div class="text-center mt-4">
            <a href="{{ route('proyectos.create') }}" class="btn btn-crear px-4 py-2">Crear Proyecto</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
