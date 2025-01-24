<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Novocentro - Soluciones en Madera de Alta Calidad</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos originales del blade con mejoras */
        :root {
            --primary-color: #FFD700;
            --secondary-color: #495E57;
            --text-color: #333;
            --light-bg: #f8f9fa;
        }

        body {
            padding-top: 70px;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .navbar-brand img {
            height: 6vh;
            max-height: 100%;
            width: auto;
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

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }

        .carousel-item img {
            max-height: 300px;
            object-fit: cover;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        footer {
            background-color: rgb(0, 0, 0);
            color: white;
            padding: 40px 0;
        }


        @media (max-width: 576px) {
            .navbar-brand img {
                height: 5vh;
            }
        }

        /* Login/Register button styles */
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

        /* Reset styles for carousel buttons */
        .carousel-control-prev,
        .carousel-control-next {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            width: auto;
            height: auto;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: none;
            box-shadow: none;
            transform: none;
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
                            href="@auth @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3) {{ url('home') }} @else {{ url('/') }} @endif @else {{ url('/') }} @endauth">Menú
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
                                <button class="btn-auth" style="font-size: 16px;">
                                    <a href="{{ route('login') }}" class="text-dark text-decoration-none">
                                        Iniciar Sesión / Regístrate
                                    </a>
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center">
                            <button class="btn-auth" style="font-size: 16px;">
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
            <p class="lead">Descubre cómo nuestra tecnología de vanguardia garantiza madera cortada y acabada según tus
                necesidades específicas</p>
            <a href="/contacto" class="btn btn-custom btn-lg mt-3">Contáctanos</a>
        </div>
    </section>

    <!-- Sección de Carrusel de Tipos de Paneles -->
    <section class="container my-5">
        <h2 class="fw-bold text-center mb-4">Nuestros Paneles de Madera</h2>

        <div id="panelCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/productos/1.jpg') }}" class="d-block w-100" alt="MDP Enchapado">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>MDP Enchapado</h5>
                        <p>Económico y versátil para proyectos interiores</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/productos/2.jpg') }}" class="d-block w-100" alt="MDF Enchapado">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>MDF Enchapado</h5>
                        <p>Alta resistencia y estabilidad para acabados finos</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/productos/3.jpg') }}" class="d-block w-100" alt="Plywood">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Plywood</h5>
                        <p>Excelente para exteriores y proyectos estructurales</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#panelCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#panelCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <div class="text-center mt-4">
            <a href="/proyectos/create" class="btn btn-custom btn-lg">Crear un Proyecto</a>
        </div>
    </section>

    <!-- Sección "Por qué elegir Novocentro" -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">¿Por qué elegir Novocentro?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-cogs feature-icon"></i>
                            <h3 class="card-title">Tecnología de Vanguardia</h3>
                            <p class="card-text">Utilizamos la última tecnología en corte y acabado para garantizar la
                                precisión en cada proyecto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-tree feature-icon"></i>
                            <h3 class="card-title">Sostenibilidad</h3>
                            <p class="card-text">Comprometidos con el medio ambiente, utilizamos madera de fuentes
                                sostenibles y procesos eco-amigables.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users feature-icon"></i>
                            <h3 class="card-title">Asesoría Experta</h3>
                            <p class="card-text">Nuestro equipo de expertos te guiará en cada etapa de tu proyecto,
                                desde el diseño hasta la instalación.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Contáctanos</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Correo Electrónico" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-custom btn-lg">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4 class="text-warning">Novocentro</h4>
                    <p>Transformando la industria de la madera con innovación y calidad desde 1995.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4 class="text-warning">Enlaces Rápidos</h4>
                    <ul class="list-unstyled">
                        <li><a href="/home" class="text-white">Inicio</a></li>
                        <li><a href="/productos" class="text-white">Productos</a></li>
                        <li><a href="/proyectos" class="text-white">Proyectos</a></li>
                        <li><a href="/carpinteros" class="text-white">Carpinteros</a></li>
                        <li><a href="/contacto" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="text-warning">Síguenos</h4>
                    <div class="social-icons">
                        <a target="_blank" href="https://www.facebook.com/novocentrodistablasa/?locale=es_LA"><i class="fab fa-facebook"></i></a>
                        <a target="_blank" href="https://x.com/novocentrogarz1"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="https://www.instagram.com/novocentrodistablasa/?hl=es"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://ec.linkedin.com/company/distablasa-novopan"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3 border-light">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2023 Novocentro. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

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
                        <a href="{{ route('login') }}" class="btn btn-custom">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-custom">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>