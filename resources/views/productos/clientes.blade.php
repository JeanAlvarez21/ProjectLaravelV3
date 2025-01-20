<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos Disponibles</h1>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{ asset($producto->link_imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->costo, 2) }}</p>
                            <p class="card-text">
                                <strong>Stock:</strong> 
                                @if($producto->stock > 0)
                                    <span class="stock-display">{{ $producto->stock }}</span> unidades disponibles
                                @else
                                    <span class="text-danger">Agotado</span>
                                @endif
                            </p>
                            <form class="add-to-cart-form" action="{{ route('cart.add', $producto->id) }}" method="POST" @if($producto->stock == 0) style="display: none;" @endif>
                                @csrf
                                <div class="form-group">
                                    <label for="cantidad-{{ $producto->id }}">Cantidad:</label>
                                    <input type="number" name="quantity" id="cantidad-{{ $producto->id }}" min="1" max="{{ $producto->stock }}" value="1" class="form-control quantity-input" required data-stock="{{ $producto->stock }}">
                                </div>
                                <button type="submit" class="btn btn-warning mt-2">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity-input').on('input', function() {
                var input = $(this);
                var stock = parseInt(input.data('stock'));
                var value = parseInt(input.val());

                if (value > stock) {
                    input.val(stock);
                    alert('No puedes seleccionar más productos de los que hay en stock.');
                } else if (value < 1) {
                    input.val(1);
                }
            });

            $('.add-to-cart-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        alert(response.success);
                        // Update stock display
                        var quantityInput = form.find('.quantity-input');
                        var stockDisplay = form.siblings('.stock-display');
                        var newStock = parseInt(stockDisplay.text()) - parseInt(quantityInput.val());
                        stockDisplay.text(newStock);
                        if (newStock === 0) {
                            stockDisplay.parent().html('<strong>Stock:</strong> <span class="text-danger">Agotado</span>');
                            form.hide();
                        }
                        quantityInput.attr('max', newStock).data('stock', newStock);
                        if (newStock === 0) {
                            form.find('button[type="submit"]').prop('disabled', true);
                        }
                    },
                    error: function(xhr) {
                        alert('Error al agregar el producto al carrito');
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>