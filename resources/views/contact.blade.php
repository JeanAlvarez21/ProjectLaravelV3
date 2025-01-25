<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
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
            height: 40px;
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

        .footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 40px 0;
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

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .1);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/media/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
            }
        }

        /* Nuevos estilos para el navbar */
        .navbar-nav {
            align-items: center;
        }

        .navbar .nav-link {
            padding: 0.5rem 1rem;
        }

        .btn-auth {
            padding: 0.375rem 0.75rem;
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-auth:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                text-align: center;
            }

            .navbar-nav {
                margin-bottom: 1rem;
            }

            .navbar .btn-auth {
                margin-top: 0.5rem;
            }
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
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.clientes') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/carpinteros">Carpinteros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/contacto">Contacto</a>
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
                                <button type="submit" class="btn btn-custom">Cerrar Sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-auth">
                                Iniciar Sesión / Regístrate
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-auth">
                            Iniciar Sesión / Regístrate
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 py-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h2 class="mb-4">Contáctanos</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Información de Contacto</h5>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Dirección</h6>
                                <p class="mb-0">Av. Salvador Bustamante Celi, Loja 110150</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-phone-alt mt-1 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Teléfono</h6>
                                <p class="mb-0">+593 7-257-9891</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-envelope mt-1 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Email</h6>
                                <p class="mb-0">info@novocentro.com</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="fas fa-clock mt-1 me-3 text-primary"></i>
                            <div>
                                <h6 class="mb-1">Horario de Atención</h6>
                                <p class="mb-0">Lunes a Viernes: 8:00 AM - 6:00 PM<br>
                                    Sábados: 9:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Nuestra Ubicación</h2>
                <div class="map-container"
                    style="position: relative; width: 100%; height: 0; padding-bottom: 75%; border-radius: 8px; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15920.540697406652!2d-79.214476!3d-3.9926127!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb49431a0ba2e9%3A0xdb9b6fdaadb9bc7d!2sNovocentro%20Distablasa%20Loja%20Valle!5e0!3m2!1ses!2sec!4v1737776651284!5m2!1ses!2sec"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Envíanos un Mensaje</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="asunto" class="form-label">Asunto</label>
                                        <input type="text" class="form-control" id="asunto" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mensaje" class="form-label">Mensaje</label>
                                        <textarea class="form-control" id="mensaje" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-custom">Enviar Mensaje</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
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
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>