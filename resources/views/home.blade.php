<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Personalización adicional */
        .hero-section {
            background: url('{{ asset('media/background_main.png') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 10px;
        }

        .carousel-item img {
            max-height: 200px;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto;
        }

        body {
            padding-top: 70px;
        }

        .navbar {
            background-color: #FFD700;
        }

        .no-link {
            text-decoration: none;
            color: inherit;
        }

        .navbar-brand img {
            height: 6vh;
            max-height: 100%;
            width: auto;
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                height: 5vh;
            }
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

        button:active {
            background-color: rgb(255, 255, 255);
            transition: all 0.25s;
            -webkit-transition: all 0.10s;
            box-shadow: none;
            transform: scale(0.98);
        }

        /* Estilos para los botones del carrusel */
        .carousel-control-prev,
        .carousel-control-next {
            margin-left: 20px;
            margin-right: 20px;
            z-index: 5;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #495E57;
            border-radius: 50%;
            padding: 15px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
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
                            href="@auth @if(Auth::user()->rol == 1 || Auth::user()->rol == 2) {{ url('home') }} @else {{ url('/') }} @endif @else {{ url('/') }} @endauth">
                            Menú
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.clientes') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="proyectos">Proyectos</a></li>

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

    <!-- Hero Section -->
    <section class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container hero-overlay">
            <h1 class="fw-bold">Optimiza tu Proyecto con Madera de <span class="text-warning">Alta Calidad</span></h1>
            <p>Descubre cómo nuestra tecnología de vanguardia garantizan madera cortada y acabada según tus necesidades
                específicas</p>
            <a href="/contacto" class="btn btn-light">Contáctanos</a>
        </div>
    </section>

    <!-- Sección de Carrusel de Tipos de Paneles -->
    <section class="container my-5 text-center">
        <h2 class="fw-bold mb-4">Tipos de Paneles</h2>

        <!-- Carrusel de Bootstrap -->
        <div id="panelCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Primer Item del Carrusel -->
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/2.jpg') }}" class="card-img-top"
                                    alt="MDP Enchapado">
                                <div class="card-body">
                                    <h5 class="card-title">MDP Enchapado</h5>
                                    <ul>
                                        <li>✔ Económico</li>
                                        <li>❌ Poco resistente</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/1.jpg') }}" class="card-img-top"
                                    alt="MDP Enchapado">
                                <div class="card-body">
                                    <h5 class="card-title">MDF Enchapado</h5>
                                    <ul>
                                        <li>✔ Resistencia y estabilidad</li>
                                        <li>✔ Mayor peso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/3.jpg') }}" class="card-img-top" alt="Plywood">
                                <div class="card-body">
                                    <h5 class="card-title">Plywood</h5>
                                    <ul>
                                        <li>✔ Exteriores</li>
                                        <li>❌ Mayor costo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Segundo Item del Carrusel -->
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/1.jpg') }}" class="card-img-top"
                                    alt="Panel de Madera">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Madera</h5>
                                    <ul>
                                        <li>✔ Natural</li>
                                        <li>✔ Alta resistencia</li>
                                        <li>❌ Puede ser costoso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/2.jpg') }}" class="card-img-top"
                                    alt="Panel de Vidrio">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Vidrio</h5>
                                    <ul>
                                        <li>✔ Estético</li>
                                        <li>✔ Transparente</li>
                                        <li>❌ Fragilidad</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('assets/productos/3.jpg') }}" class="card-img-top"
                                    alt="Panel de Acero">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Acero</h5>
                                    <ul>
                                        <li>✔ Alta durabilidad</li>
                                        <li>✔ Resistente al fuego</li>
                                        <li>❌ No es económico</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles del Carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#panelCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#panelCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Botón "Crear Proyecto" -->
        <a href="/proyectos/create" class="btn btn-primary mt-4">Crear un Proyecto</a>
    </section>

    <!-- Modal de Login / Registro -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Iniciar Sesión o Registrarse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Opciones Login / Register -->
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-success">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>