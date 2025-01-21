<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }

        h1 {
            color: #333;
        }

        .btn-crear {
            background-color: #FF6347;
            color: white;
            border-radius: 50px;
        }

        .btn-crear:hover {
            background-color: #FF4500;
        }

        .form-label {
            font-weight: bold;
        }

        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid" style="height: 6vh; max-height: 100%; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="/productos">Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/proyectos">Proyectos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Proyecto</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear proyecto -->
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf

            <!-- Nombre del proyecto -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Proyecto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre del proyecto" required>
            </div>

            <!-- Ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Ingrese la ciudad" required>
            </div>

            <!-- Local -->
            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" name="local" id="local" class="form-control" placeholder="Ingrese el nombre del local" required>
            </div>

            <!-- Producto asociado -->
            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto Asociado</label>
                <select name="id_producto" id="id_producto" class="form-select" required>
                    <option value="" disabled selected>Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón para fijar medidas -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-crear px-4 py-2">Fijar Medidas</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
