<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('{{ asset("assets/Contacto.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 70px; /* Added padding to prevent content from being hidden behind the fixed navbar */
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

        button:active {
            background-color: rgb(255, 255, 255);
            transition: all 0.25s;
            -webkit-transition: all 0.10s;
            box-shadow: none;
            transform: scale(0.98);
        }

        .content-wrapper {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid rgb(125, 125, 125, 0.50); /* Adding a golden border to match the navbar color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: adds a subtle shadow for more depth */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">  <!-- Update: navbar class changed to fixed-top -->
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
                                <li class="nav-item"><a class="nav-link" href="{{ route('carpinteros.index') }}">Carpinteros</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="/carpinteros">Carpinteros</a></li>
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link" href="/carpinteros">Carpinteros</a></li>
                        @endauth
                        <li class="nav-item"><a class="nav-link active" href="/contacto">Contacto</a></li>
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
                                    <!-- Botón de Login/Register -->
                                    <button style="font-size: 16px;">
                                        <a href="{{ route('login') }}" class="text-dark text-decoration-none">
                                            Iniciar Sesión / Regístrate
                                        </a>
                                    </button>
                                </div>
                            @endif
                        @else
                            <div class="d-flex align-items-center">
                                <!-- Botón de Login/Register para no autenticados -->
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
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="contact-heading">CONTACTO</h1>
                    <div class="mb-4">
                        <h3>
                            +593 964256002
                            <i class="bi bi-clipboard copy-icon" data-copy-text="+593 964256002" data-copy-type="teléfono" aria-label="Copiar teléfono"></i>
                        </h3>
                        <p class="lead">
                            Calle Cuenca, y Guayaquil
                            <i class="bi bi-clipboard copy-icon" data-copy-text="Calle Cuenca, y Guayaquil" data-copy-type="dirección" aria-label="Copiar dirección"></i>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ratio ratio-4x3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15920.540697406652!2d-79.214476!3d-3.9926127!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb49431a0ba2e9%3A0xdb9b6fdaadb9bc7d!2sNovocentro%20Distablasa%20Loja%20Valle!5e0!3m2!1ses!2sec!4v1736372496827!5m2!1ses!2sec"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid logo-responsive">
                </div>
                <div class="col-md-4 text-center">
                    <p class="mb-0">
                        <i class="bi bi-telephone"></i> +593 964256002
                        <i class="bi bi-clipboard copy-icon" data-copy-text="+593 964256002" data-copy-type="teléfono" aria-label="Copiar teléfono"></i>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <p class="mb-0">
                        Loja, El Valle<br> 110101
                        <i class="bi bi-clipboard copy-icon" data-copy-text="Loja, El Valle 110101" data-copy-type="dirección" aria-label="Copiar dirección"></i>
                    </p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <a href="#" class="text-dark text-decoration-none">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyIcons = document.querySelectorAll('.copy-icon');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const confirmationMessage = document.getElementById('confirmationMessage');

            copyIcons.forEach(icon => {
                icon.addEventListener('click', function() {
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

