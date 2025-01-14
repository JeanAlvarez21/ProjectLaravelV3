<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carpinteros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Estilo de navbar */

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



        /* Estilo de contacto */
        .copy-icon {
            cursor: pointer;
            font-size: 0.8rem;
            color: #6c757d;
            margin-left: 0.3rem;
        }

        .copy-icon:hover {
            color: #0d6efd;
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
                            <li class="nav-item"><a class="nav-link active" href="{{ route('carpinteros.index') }}">Carpinteros</a>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link active" href="/carpinteros">Carpinteros</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link active" href="/carpinteros">Carpinteros</a></li>
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
                        <a href="#">
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
        <h1 class="text-center mb-4">Carpinteros Disponibles</h1>

        @auth
            @if(Auth::user()->rol == 1 || Auth::user()->rol == 2)
                <div class="text-center py-4">
                    <a href="{{ route('carpinteros.manage') }}" class="btn btn-warning">Agregar Carpintero</a>
                </div>
            @endif
        @endauth

        @if($carpinteros->isEmpty())
            <div class="text-center py-4">
                <p class="text-gray-600">No hay carpinteros disponibles en este momento.</p>
            </div>
        @else
            <div class="row">
                @foreach ($carpinteros as $carpintero)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="{{ $carpintero->foto_perfil }}" class="card-img-top"
                                alt="Foto de {{ $carpintero->nombre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $carpintero->nombre }}</h5>
                                <p class="card-text"><strong>Especialidad:</strong> {{ $carpintero->especialidad }}</p>
                                <p class="card-text">
                                    <strong>Teléfono:</strong>
                                    <span class="copyable">{{ $carpintero->telefono }}</span>
                                    <i class="bi bi-clipboard copy-icon" data-copy-text="{{ $carpintero->telefono }}"
                                        data-copy-type="teléfono" aria-label="Copiar teléfono"></i>
                                </p>
                                <p class="card-text">
                                    <strong>Email:</strong>
                                    <span class="copyable">{{ $carpintero->email }}</span>
                                    <i class="bi bi-clipboard copy-icon" data-copy-text="{{ $carpintero->email }}"
                                        data-copy-type="email" aria-label="Copiar email"></i>
                                </p>
                                <p class="card-text">
                                    <strong>Ubicación:</strong>
                                    <span class="copyable">{{ $carpintero->ubicacion }}</span>
                                    <i class="bi bi-clipboard copy-icon" data-copy-text="{{ $carpintero->ubicacion }}"
                                        data-copy-type="ubicación" aria-label="Copiar ubicación"></i>
                                </p>
                                <p class="card-text"><strong>Descripción:</strong> {{ $carpintero->descripcion }}</p>
                                <p class="card-text">
                                    <strong>Disponibilidad:</strong>
                                    @if($carpintero->disponibilidad == 1)
                                        <span class="badge bg-success">Disponible</span>
                                    @else
                                        <span class="badge bg-danger">No disponible</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Información Copiada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmationMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyIcons = document.querySelectorAll('.copy-icon');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const confirmationMessage = document.getElementById('confirmationMessage');

            copyIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const textToCopy = this.getAttribute('data-copy-text');
                    const copyType = this.getAttribute('data-copy-type');
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        // Set confirmation message
                        confirmationMessage.textContent = `El ${copyType} ha sido copiado al portapapeles.`;

                        // Show modal
                        confirmationModal.show();

                        // Hide modal after 3 seconds
                        setTimeout(() => {
                            confirmationModal.hide();
                        }, 3000);
                    });
                });
            });
        });
    </script>
</body>

</html>