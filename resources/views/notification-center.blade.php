<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Notificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" width="40" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Carpinteros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}">
                        <img src="{{ asset('media/boton-usuario.png') }}" alt="Login/Register" width="30" height="30">
                    </a>
                    <span class="mx-3">|</span>
                    <a href="{{ route('notificaciones') }}">
                        <img src="{{ asset('media/boton-notificaciones.png') }}" alt="Notificaciones" width="30"
                            height="30">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido del Centro de Notificaciones -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Centro de Notificaciones</h1>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Proyecto "Proyecto Muebles sala"</h5>
                        <p class="card-text">El proyecto "Proyecto Muebles sala" se está empaquetando</p>
                        <a href="#" class="btn btn-success">Ver estado del envío</a>
                    </div>
                </div>
                <!-- Botón Volver -->
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>