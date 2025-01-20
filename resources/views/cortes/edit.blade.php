<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corte - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
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
    <div class="container mt-5">
        <h1>Editar Corte</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cortes.update', $corte->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="proyecto_id" class="form-label">Proyecto</label>
                <select name="proyecto_id" id="proyecto_id" class="form-control" required>
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ $corte->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="producto_id" id="producto_id" class="form-control" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" {{ $corte->producto_id == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $corte->cantidad }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="medidas" class="form-label">Medidas</label>
                <input type="text" name="medidas" id="medidas" class="form-control" value="{{ $corte->medidas }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="tipo_borde" class="form-label">Tipo de Borde</label>
                <input type="text" name="tipo_borde" id="tipo_borde" class="form-control"
                    value="{{ $corte->tipo_borde }}" required>
            </div>
            <div class="mb-3">
                <label for="color_borde" class="form-label">Color de Borde</label>
                <input type="text" name="color_borde" id="color_borde" class="form-control"
                    value="{{ $corte->color_borde }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_corte" class="form-label">Descripción</label>
                <textarea name="descripcion_corte" id="descripcion_corte" class="form-control"
                    rows="3">{{ $corte->descripcion_corte }}</textarea>
            </div>
            <div class="mb-3">
                <label for="precio_total" class="form-label">Precio Total</label>
                <input type="number" step="0.01" name="precio_total" id="precio_total" class="form-control"
                    value="{{ $corte->precio_total }}" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>