<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido #{{ $pedido->id_pedido }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            /* Added padding to prevent content from being hidden behind the fixed navbar */
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card order-details-card">
                    <div class="card-header bg-white p-4 border-bottom-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Detalles del Pedido #{{ $pedido->id_pedido }}</h4>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>