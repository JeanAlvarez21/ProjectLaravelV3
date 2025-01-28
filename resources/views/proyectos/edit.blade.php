<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - Novocentro</title>
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
        .btn-guardar,
        .btn-agregar-corte,
        .btn-eliminar-corte {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover,
        .btn-guardar:hover,
        .btn-agregar-corte:hover,
        .btn-eliminar-corte:hover {
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
        <h1 class="mb-4">Editar Proyecto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proyecto->nombre }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $proyecto->ciudad }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" id="local" name="local" value="{{ $proyecto->local }}" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="Nuevo" {{ $proyecto->estado == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                    <option value="En proceso" {{ $proyecto->estado == 'En proceso' ? 'selected' : '' }}>En proceso
                    </option>
                    <option value="Finalizado" {{ $proyecto->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto</label>
                <select class="form-select" id="id_producto" name="id_producto" required>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" {{ $proyecto->id_producto == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <h2 class="mt-4 mb-3">Cortes del Proyecto</h2>

            <div id="cortes-container">
                @foreach($proyecto->cortes as $index => $corte)
                    <div class="corte-item mb-3 p-3 border rounded">
                        <h4>Corte #{{ $index + 1 }}</h4>
                        <input type="hidden" name="cortes[{{ $index }}][id]" value="{{ $corte->id }}">

                        <div class="mb-2">
                            <label for="cortes[{{ $index }}][cantidad]" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cortes[{{ $index }}][cantidad]"
                                value="{{ $corte->cantidad }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="cortes[{{ $index }}][medidas]" class="form-label">Medidas</label>
                            <input type="text" class="form-control" name="cortes[{{ $index }}][medidas]"
                                value="{{ $corte->medidas }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="cortes[{{ $index }}][tipo_borde]" class="form-label">Tipo de Borde</label>
                            <input type="text" class="form-control" name="cortes[{{ $index }}][tipo_borde]"
                                value="{{ $corte->tipo_borde }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="cortes[{{ $index }}][color_borde]" class="form-label">Color de Borde</label>
                            <input type="text" class="form-control" name="cortes[{{ $index }}][color_borde]"
                                value="{{ $corte->color_borde }}" required>
                        </div>

                        <button type="button" class="btn btn-eliminar-corte mt-2" onclick="eliminarCorte(this)">Eliminar
                            Corte</button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-agregar-corte mb-3" onclick="agregarCorte()">Agregar Nuevo
                Corte</button>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-guardar">Guardar Cambios</button>
            </div>
        </form>
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
                        <li><a href="{{ route('proyectos.index') }}">Proyectos</a></li>
                        <li><a href="{{ route('carpinteros.index') }}">Carpinteros</a></li>
                        <li><a href="{{ route('contact.index') }}">Contacto</a></li>
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
    <script>
        function agregarCorte() {
            const cortesContainer = document.getElementById('cortes-container');
            const nuevoIndex = cortesContainer.children.length;
            const nuevoCorte = document.createElement('div');
            nuevoCorte.className = 'corte-item mb-3 p-3 border rounded';
            nuevoCorte.innerHTML = `
                <h4>Corte #${nuevoIndex + 1}</h4>
                <input type="hidden" name="cortes[${nuevoIndex}][id]" value="">
                
                <div class="mb-2">
                    <label for="cortes[${nuevoIndex}][cantidad]" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cortes[${nuevoIndex}][cantidad]" required>
                </div>
                
                <div class="mb-2">
                    <label for="cortes[${nuevoIndex}][medidas]" class="form-label">Medidas</label>
                    <input type="text" class="form-control" name="cortes[${nuevoIndex}][medidas]" required>
                </div>
                
                <div class="mb-2">
                    <label for="cortes[${nuevoIndex}][tipo_borde]" class="form-label">Tipo de Borde</label>
                    <input type="text" class="form-control" name="cortes[${nuevoIndex}][tipo_borde]" required>
                </div>
                
                <div class="mb-2">
                    <label for="cortes[${nuevoIndex}][color_borde]" class="form-label">Color de Borde</label>
                    <input type="text" class="form-control" name="cortes[${nuevoIndex}][color_borde]" required>
                </div>
                
                <button type="button" class="btn btn-eliminar-corte mt-2" onclick="eliminarCorte(this)">Eliminar Corte</button>
            `;
            cortesContainer.appendChild(nuevoCorte);
        }

        function eliminarCorte(button) {
            const corteItem = button.closest('.corte-item');
            corteItem.remove();
            actualizarNumeracionCortes();
        }

        function actualizarNumeracionCortes() {
            const cortesItems = document.querySelectorAll('.corte-item');
            cortesItems.forEach((item, index) => {
                const titulo = item.querySelector('h4');
                titulo.textContent = `Corte #${index + 1}`;
            });
        }
    </script>
</body>

</html>