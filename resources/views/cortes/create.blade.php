<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Corte</title>
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
                        <a class="nav-link" href="/proyectos">Proyectos</a>
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
        <h1>Agregar Corte al Proyecto: {{ $proyecto->nombre }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cortes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
            <input type="hidden" name="producto_id" value="{{ $proyecto->producto->id_producto }}">

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad de cortes" required>
            </div>

            <div class="mb-3">
                <label for="medidas" class="form-label">Medidas</label>
                <input type="text" name="medidas" id="medidas" class="form-control" placeholder="Ejemplo: 70x150 mm" required>
            </div>

            <div class="mb-3">
                <label for="tipo_borde" class="form-label">Tipo de Borde</label>
                <input type="text" name="tipo_borde" id="tipo_borde" class="form-control" placeholder="Ejemplo: Recto" required>
            </div>

            <div class="mb-3">
                <label for="color_borde" class="form-label">Color de Borde</label>
                <input type="text" name="color_borde" id="color_borde" class="form-control" placeholder="Ejemplo: Blanco" required>
            </div>

            <div class="mb-3">
                <label for="descripcion_corte" class="form-label">Descripción</label>
                <textarea name="descripcion_corte" id="descripcion_corte" class="form-control" rows="3" placeholder="Descripción adicional del corte"></textarea>
            </div>

            <div class="mb-3">
                <label for="precio_total" class="form-label">Precio Total</label>
                <input type="number" step="0.01" name="precio_total" id="precio_total" class="form-control" placeholder="Precio total del corte" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar Corte</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
