<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdf5e6;
        }

        .navbar {
            background-color: #FFD700;
        }

        h1 {
            color: #333;
        }

        .form-label {
            color: #555;
        }

        .form-control {
            border-color: #FFD700;
        }

        .btn-primary {
            background-color: #FF6347;
            border-color: #FF6347;
        }

        .btn-primary:hover {
            background-color: #FF4500;
            border-color: #FF4500;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" style="height: 50px;">
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
                        <a class="nav-link active" href="/proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/productos">Productos</a>
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
        <h1>Crear Nuevo Proyecto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Proyecto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del proyecto" required>
            </div>

            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Ciudad" required>
            </div>

            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" name="local" id="local" class="form-control" placeholder="Local" required>
            </div>

            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto Asociado</label>
                <select name="producto_id" id="producto_id" class="form-control" required>
                    <option value="" selected disabled>Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar Proyecto y proceder con los cortes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
