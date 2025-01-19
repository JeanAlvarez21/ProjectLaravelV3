<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carpintero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
                        @if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
                            <a href="#">
                                <img src="{{ asset('media/carro-de-la-compra.png') }}" alt="Carrito" width="30" height="30">
                            </a>
                                
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
        <h1 class="text-center mb-4">Editar Carpintero</h1>

        <form action="{{ route('carpinteros.update', $carpintero->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $carpintero->nombre }}" required>
                </div>
                <div class="col-md-6">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" value="{{ $carpintero->especialidad }}"
                        required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $carpintero->telefono }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $carpintero->email }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" value="{{ $carpintero->ubicacion }}">
                </div>
                <div class="col-md-6">
                    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                    <input type="file" name="foto_perfil" class="form-control" accept="image/*">
                    @if($carpintero->foto_perfil)
                        <img src="{{ $carpintero->foto_perfil }}" alt="Foto actual" class="mt-2" style="max-width: 100px;">
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $carpintero->descripcion }}</textarea>
                </div>
                <div class="col-md-3">
                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                    <select name="disponibilidad" class="form-control">
                        <option value="1" {{ $carpintero->disponibilidad ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ !$carpintero->disponibilidad ? 'selected' : '' }}>No disponible</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ route('carpinteros.manage') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</body>

</html>