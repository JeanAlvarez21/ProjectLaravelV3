<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Ver Cortes - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #495E57;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: var(--text-color);
            padding-top: 76px;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .navbar-brand img {
            height: 50px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        .btn-custom,
        .btn-agregar,
        .btn-guardar {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover,
        .btn-agregar:hover,
        .btn-guardar:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 40px 0;
            margin-top: 3rem;
        }

        .footer h4 {
            color: var(--primary-color);
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .social-icons a {
            font-size: 1.5rem;
            margin-right: 10px;
            color: white;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        .table-warning {
            background-color: var(--primary-color);
        }

        .btn-auth {
            padding: 7px 15px;
            border: 0;
            border-radius: 100px;
            background-color: rgb(255, 255, 255);
            color: #333;
            font-weight: Bold;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        .btn-auth:hover {
            background-color: #FFFAEB;
            box-shadow: 0 0 20px #6fc5ff50;
            transform: scale(1.1);
        }

        .btn-auth:active {
            background-color: rgb(255, 255, 255);
            transition: all 0.25s;
            -webkit-transition: all 0.10s;
            box-shadow: none;
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.clientes') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proyectos.index') }}">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carpinteros.index') }}">Carpinteros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">Contacto</a>
                    </li>
                    @auth
                        @if(Auth::user()->rol == 1)
                            <li class="nav-item"><a href="/dashboard" class="nav-link">Admin</a></li>
                        @elseif(Auth::user()->rol == 2)
                            <li class="nav-item"><a href="/productos" class="nav-link">Empleado</a></li>
                        @endif
                    @endauth
                </ul>
                <div class="navbar-nav">
                    @auth
                        @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
                            <a href="{{ route('cart.view') }}" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge bg-primary">{{ count((array) session('cart')) }}</span>
                            </a>
                            <a href="{{ route('profile') }}" class="nav-link">
                                <i class="fas fa-user"></i>
                            </a>
                            <a href="{{ route('notificaciones') }}" class="nav-link">
                                <i class="fas fa-bell"></i>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">Cerrar Sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark">
                                Iniciar Sesión / Regístrate
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">
                            Iniciar Sesión / Regístrate
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Agregar / Ver Cortes del Proyecto: {{ $proyecto->nombre ?? $proyectoTemporal['nombre'] }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (isset($proyecto) && $proyecto->cortes->isNotEmpty())
            <div class="mt-5">
                <h2 class="mb-3">Cortes Existentes</h2>
                <table class="table table-bordered">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Cantidad</th>
                            <th>Medidas</th>
                            <th>Tipo de Borde</th>
                            <th>Color</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->cortes as $index => $corte)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $corte->cantidad }}</td>
                                <td>{{ $corte->medidas }}</td>
                                <td>{{ $corte->tipo_borde }}</td>
                                <td>{{ $corte->color_borde }}</td>
                                <td>${{ number_format($corte->precio_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (!isset($proyecto))
            <form action="{{ route('proyectos.guardarCorteTemporal') }}" method="POST">
                @csrf
                <input type="hidden" name="id_producto" value="{{ $proyectoTemporal['id_producto'] ?? '' }}">
                <input type="hidden" name="precio_total" value="0">

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" required>
                </div>

                <div class="mb-3">
                    <label for="medidas" class="form-label">Medidas</label>
                    <input type="text" name="medidas" id="medidas" class="form-control" placeholder="Ejemplo: 70x150 mm"
                        required>
                </div>

                <div class="mb-3">
                    <label for="tipo_borde" class="form-label">Tipo de Borde</label>
                    <input type="text" name="tipo_borde" id="tipo_borde" class="form-control" placeholder="Ejemplo: Recto"
                        required>
                </div>

                <div class="mb-3">
                    <label for="color_borde" class="form-label">Color de Borde</label>
                    <input type="text" name="color_borde" id="color_borde" class="form-control"
                        placeholder="Ejemplo: Blanco" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-agregar">Agregar Corte</button>
                </div>
            </form>
        @endif

        @if (session('cortes_temporales'))
            <div class="mt-5">
                <h2 class="mb-3">Cortes Agregados Temporalmente</h2>
                <table class="table table-bordered">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Cantidad</th>
                            <th>Medidas</th>
                            <th>Tipo de Borde</th>
                            <th>Color</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cortes_temporales') as $index => $corte)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $corte['cantidad'] }}</td>
                                <td>{{ $corte['medidas'] }}</td>
                                <td>{{ $corte['tipo_borde'] }}</td>
                                <td>{{ $corte['color_borde'] }}</td>
                                <td>${{ number_format($corte['precio_total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (!isset($proyecto))
            <div class="text-center mt-4">
                <form action="{{ route('proyectos.guardarProyecto') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-guardar">Guardar Proyecto</button>
                </form>
            </div>
        @endif
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4>Novocentro</h4>
                    <p>Transformando la industria de la madera con innovación y calidad desde 1995.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4>Enlaces Rápidos</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                        <li><a href="{{ route('productos.clientes') }}">Productos</a></li>
                        <li><a href="/proyectos">Proyectos</a></li>
                        <li><a href="/carpinteros">Carpinteros</a></li>
                        <li><a href="/contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Síguenos</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/novocentrodistablasa/?locale=es_LA" target="_blank"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://x.com/novocentrogarz1" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/novocentrodistablasa/?hl=es" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://ec.linkedin.com/company/distablasa-novopan" target="_blank"><i
                                class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2023 Novocentro. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>