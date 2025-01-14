<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

        .input-disabled {
            background-color: #f5f5f5;
            /* Color de fondo suave */
            color: #a9a9a9;
            /* Texto más claro */
            border: 1px solid #ddd;
            /* Borde suave */
            cursor: not-allowed;
            /* Indicador de que no se puede interactuar */
        }

        .nav-pills .nav-link {
            color: black;
        }

        .nav-pills .nav-link.active {
            background-color: #FFD700;
            color: black;
        }

        .nav-pills .nav-link.text-danger {
            color: red !important;
        }

        #editBtn,
        #editAddressBtn {
            background-color: #FFD700;
            color: black;
            border-color: #FFD700;
        }

        #editBtn:hover,
        #editAddressBtn:hover {
            background-color: #e6c200;
            border-color: #e6c200;
        }

        .navbar {
            background-color: #FFD700;
        }

        .no-link {
            text-decoration: none;
            color: inherit;
        }

        body {
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand"
                href="@auth @if(Auth::user()->rol == 1 || Auth::user()->rol == 2) {{ url('home') }} @else {{ url('/') }} @endif @else {{ url('/') }} @endauth">
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
                    <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Proyectos</a></li>
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
                        @if(Auth::user()->rol == 1 || Auth::user()->rol == 2)
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
        <div class="row">
            <div class="col-md-3">
                <div class="bg-light p-3 rounded" style="border-radius: 15px;">
                    <h4 class="mb-4 text-center">Hola {{ explode(' ', Auth::user()->nombres)[0] }}!</h4>
                    <div class="nav flex-column nav-pills">
                        <a class="nav-link active" href="#datos" data-bs-toggle="pill">Mi Perfil</a>
                        <a class="nav-link" href="#direcciones" data-bs-toggle="pill">Mis Direcciones</a>
                        <a class="nav-link" href="#pedidos" data-bs-toggle="pill">Mis Pedidos</a>
                        <a class="nav-link" href="#proyectos" data-bs-toggle="pill">Mis Proyectos</a>
                        <!-- Centrado del enlace "Cerrar Sesión" -->
                        <a class="nav-link text-danger text-center d-block" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="datos">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Datos Personales</h5>
                                <button class="btn btn-primary btn-sm" id="editBtn">Editar</button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                                    @csrf
                                    @method('PUT')

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nombres</label>
                                            <input type="text" class="form-control" name="nombres"
                                                value="{{ Auth::user()->nombres }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos"
                                                value="{{ Auth::user()->apellidos }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Cédula</label>
                                            <input type="text" class="form-control" name="cedula"
                                                value="{{ Auth::user()->cedula }}" disabled readonly
                                                class="input-disabled">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" name="telefono"
                                                value="{{ Auth::user()->telefono }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nueva Contraseña</label>
                                            <input type="password" class="form-control" name="password" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                disabled>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success d-none" id="saveBtn">Guardar
                                        Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="direcciones">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Mis Direcciones</h5>
                                <button class="btn btn-primary btn-sm" id="editAddressBtn">Editar</button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('address.update') }}" method="POST" id="addressForm">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nombres</label>
                                            <input type="text" class="form-control" name="nombres"
                                                value="{{ Auth::user()->nombres }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos"
                                                value="{{ Auth::user()->apellidos }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="direccion"
                                                value="{{ Auth::user()->direccion }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Celular</label>
                                            <input type="tel" class="form-control" name="telefono"
                                                value="{{ Auth::user()->telefono }}" disabled>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success d-none" id="saveAddressBtn">Guardar
                                        Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('editBtn').addEventListener('click', function () {
            const inputs = document.querySelectorAll('#profileForm input');
            const saveBtn = document.getElementById('saveBtn');

            inputs.forEach(input => {
                input.disabled = false;
            });

            this.classList.add('d-none');
            saveBtn.classList.remove('d-none');
        });

        document.getElementById('editAddressBtn').addEventListener('click', function () {
            const inputs = document.querySelectorAll('#addressForm input');
            const saveBtn = document.getElementById('saveAddressBtn');

            inputs.forEach(input => {
                input.disabled = false;
            });

            this.classList.add('d-none');
            saveBtn.classList.remove('d-none');
        });
    </script>
</body>

</html>