<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }

        h1, h2 {
            color: #333;
        }

        .card-header {
            background-color: #FFFAEB;
            font-weight: bold;
        }

        .badge {
            font-size: 0.9em;
        }

        .btn-regresar {
            background-color: #FF6347;
            color: white;
            border-radius: 50px;
        }

        .btn-regresar:hover {
            background-color: #FF4500;
        }

        .table th, .table td {
            vertical-align: middle;
        }
        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 70px; /* Added padding to prevent content from being hidden behind the fixed navbar */
        }

        .navbar {
            background-color: #FFD700;
        }

        .no-link {
            text-decoration: none;
            color: inherit;
        }

        .carousel-item img {
            max-height: 200px;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto;
        }

        .logo-responsive {
            max-width: 150px;
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .logo-responsive {
                max-width: 100px;
            }

            .contact-heading {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 576px) {
            .logo-responsive {
                max-width: 80px;
            }

            .contact-heading {
                font-size: 1.5rem;
                text-align: center;
            }

            .navbar-brand img {
                height: 5vh;
            }

            iframe {
                height: 250px;
            }
        }

        iframe {
            border: 0;
        }

        .copy-icon {
            cursor: pointer;
            margin-left: 5px;
        }

        .copy-icon:hover {
            color: #007bff;
        }

        /* From Uiverse.io by suda-code */
        button {
            padding: 7px 15px;
            border: 0;
            border-radius: 100px;
            background-color: rgb(255, 255, 255);
            color: #ffffff;
            font-weight: Bold;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        button:hover {
            background-color: #FFFAEB;
            box-shadow: 0 0 20px #6fc5ff50;
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand"
            href="@auth @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3) {{ url('home') }} @else {{ url('/') }} @endif @else {{ url('/') }} @endauth">
            <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid"
                    style="height: 6vh; max-height: 100%; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="@auth @if(Auth::user()->rol == 1 || Auth::user()->rol == 2|| Auth::user()->rol == 3) {{ url('home') }} @else {{ url('/') }} @endif @else {{ url('/') }} @endauth">Menú
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.clientes') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/proyectos">Proyectos</a></li>
                    @auth
                        @if(Auth::user()->rol == 1 || Auth::user()->rol == 2)
                            <li class="nav-item"><a class="nav-link" href="{{ route('carpinteros.index') }}">Carpinteros</a>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="/carpinteros">Carpinteros</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="/carpinteros">Carpinteros</a></li>
                    @endauth
                    <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
                    @auth
                        @if(Auth::user()->rol == 1)
                            <li class="nav-item"><a href="/dashboard" class="nav-link no-link">Admin</a></li>
                        @elseif(Auth::user()->rol == 2)
                            <li class="nav-item"><a href="/productos" class="nav-link no-link">Empleado</a></li>
                        @endif
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
                            <a href="{{ route('cart.view') }}">
                                <img src="{{ asset('media/carro-de-la-compra.png') }}" alt="Carrito" width="30" height="30">
                            </a>
                            <span class="mx-3">|</span>
                            <a href="{{ route('profile') }}">
                                <img src="{{ asset('media/boton-usuario.png') }}" alt="Profile" width="30" height="30">
                            </a>
                            <span class="mx-3">|</span>
                            <a href="{{ route('notificaciones') }}">
                                <img src="{{ asset('media/boton-notificaciones.png') }}" alt="Notificaciones" width="30"
                                    height="30">
                            </a>
                        @else
                            <div class="d-flex align-items-center">
                                <button style="font-size: 16px;">
                                    <a href="{{ route('login') }}" class="text-dark text-decoration-none">
                                        Iniciar Sesión / Regístrate
                                    </a>
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center">
                            <button style="font-size: 16px;">
                                <a href="{{ route('login') }}" class="text-dark text-decoration-none">
                                    Iniciar Sesión / Regístrate
                                </a>
                            </button>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Detalle del Proyecto</h1>

        <!-- Información del Proyecto -->
        <div class="card mb-4">
            <div class="card-header">
                Información del Proyecto
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $proyecto->id }}</p>
                <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
                <p><strong>Ciudad:</strong> {{ $proyecto->ciudad }}</p>
                <p><strong>Local:</strong> {{ $proyecto->local }}</p>
                <p><strong>Producto Asociado:</strong> {{ $proyecto->producto->nombre }}</p>
                <p>
                    <strong>Estado:</strong>
                    <span class="badge bg-{{ $proyecto->estado == 'Nuevo' ? 'success' : ($proyecto->estado == 'En proceso' ? 'warning' : 'secondary') }}">
                        {{ $proyecto->estado }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Cortes Asociados -->
        <h2 class="mb-3">Cortes Asociados</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Medidas</th>
                        <th>Tipo de Borde</th>
                        <th>Color de Borde</th>
                        <th>Descripción</th>
                        <th>Precio Total</th>
                        <th>Fecha de Corte</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proyecto->cortes as $corte)
                        <tr>
                            <td>{{ $corte->id }}</td>
                            <td>{{ $corte->cantidad }}</td>
                            <td>{{ $corte->medidas }}</td>
                            <td>{{ $corte->tipo_borde }}</td>
                            <td>{{ $corte->color_borde }}</td>
                            <td>{{ $corte->descripcion_corte }}</td>
                            <td>${{ number_format($corte->precio_total, 2) }}</td>
                            <td>{{ $corte->fecha_corte }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay cortes asociados a este proyecto.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Botón para regresar al listado -->
        <div class="text-center mt-4">
            <a href="{{ route('proyectos.index') }}" class="btn btn-regresar px-4 py-2">Regresar al Listado</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
