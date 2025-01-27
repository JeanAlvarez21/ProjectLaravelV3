<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido #{{ $pedido->id_pedido }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #495E57;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }

        .navbar {
            background-color: #FFD700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            max-height: 50px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #495E57 !important;
        }

        .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .navbar-toggler-icon {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .badge {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .logo-responsive {
                max-width: 100px;
            }
        }

        @media (max-width: 576px) {
            .logo-responsive {
                max-width: 80px;
            }
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

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 7px 15px;
            border-radius: 100px;
            font-weight: bold;
            transition: all 0.5s;
        }

        .btn-custom:hover {
            background-color: #FFFAEB;
            box-shadow: 0 0 20px #6fc5ff50;
            transform: scale(1.1);
        }

        .btn-custom:active {
            background-color: rgb(255, 255, 255);
            transition: all 0.25s;
            box-shadow: none;
            transform: scale(0.98);
        }

        body {
            background-color: #f8f9fa;
        }

        .order-details-card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
            border-radius: 1rem;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
        }

        .product-list {
            border-radius: 0.5rem;
        }

        .product-item {
            border-left: none;
            border-right: none;
            padding: 1rem;
        }

        .product-item:first-child {
            border-top: none;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .total-section {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .back-button {
            background-color: #FFD700;
            color: #000;
            border: none;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #FFC800;
            color: #000;
            transform: translateY(-1px);
        }

        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 70px;
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

        button {
            padding: 7px 15px;
            border: 0;
            border-radius: 100px;
            background-color: rgb(255, 255, 255);
            color: #ffffff;
            font-weight: Bold;
            transition: all 0.5s;
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
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid logo-responsive">
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
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card order-details-card">
                    <div class="card-header bg-white p-4 border-bottom-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Detalles de Pedido - Código de pedido #{{ $pedido->id_pedido }}</h4>
                            <a href="{{ route('profile') }}" class="btn back-button">
                                Volver al perfil
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Fecha del pedido:</strong><br>
                                    {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span
                                    class="badge status-badge {{ $pedido->estado === 'Completado' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $pedido->estado ?? 'Pendiente' }}
                                </span>
                            </div>
                        </div>

                        <div class="products-section mb-4">
                            <h5 class="mb-3">Productos</h5>
                            <div class="list-group product-list">
                                @foreach($pedido->detalles as $detalle)
                                    <div class="list-group-item product-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $detalle->producto->nombre }}</h6>
                                                <small class="text-muted">
                                                    Cantidad: {{ $detalle->cantidad }}
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <div>${{ number_format($detalle->producto->precio, 2) }} x
                                                    {{ $detalle->cantidad }}
                                                </div>
                                                <strong>${{ number_format($detalle->subtotal, 2) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="total-section mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Total del Pedido</h5>
                                <h4 class="mb-0">${{ number_format($pedido->total, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>