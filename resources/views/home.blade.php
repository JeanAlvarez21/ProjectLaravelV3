<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .navbar {
            background-color: #FFD700;
            /* Amarillo similar */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid"
                    style="height: 6vh; max-height: 100%; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- Agregamos mx-auto para centrar los items -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Carpinteros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminsito') }}">Admin</a>
                    </li>
                </ul>
                <!-- Botón de Login/Register y Notificaciones -->
                <div class="d-flex align-items-center">
                    <!-- Botón de Login/Register -->
                    <a href="{{ route('login') }}">
                        <img src="{{ asset('media/boton-usuario.png') }}" alt="Login/Register" width="30" height="30">
                    </a>

                    <!-- Espacio entre los botones -->
                    <span class="mx-3">|</span>

                    <!-- Botón de Notificaciones -->
                    <a href="{{ route('notificaciones') }}">
                        <img src="{{ asset('media/boton-notificaciones.png') }}" alt="Notificaciones" width="30"
                            height="30">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container hero-overlay">
            <h1 class="fw-bold">Optimiza tu Proyecto con Madera de <span class="text-warning">Alta Calidad</span></h1>
            <p>Descubre cómo nuestra tecnología de vanguardia garantizan madera cortada y acabada según tus necesidades
                específicas</p>
            <a href="#" class="btn btn-light">Contáctanos</a>
        </div>
    </section>
    <!-- Sección de Carrusel de Tipos de Paneles -->
    <section class="container my-5 text-center">
        <h2 class="fw-bold mb-4">Tipos de Paneles</h2>

        <!-- Carrusel de Bootstrap -->
        <div id="panelCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Primer Item del Carrusel -->
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <!-- Tarjetas 1 a 4 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="MDP Enchapado">
                                <div class="card-body">
                                    <h5 class="card-title">MDP Enchapado</h5>
                                    <ul>
                                        <li>✔ Económico</li>
                                        <li>❌ Poco resistente</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="MDF Enchapado">
                                <div class="card-body">
                                    <h5 class="card-title">MDF Enchapado</h5>
                                    <ul>
                                        <li>✔ Resistencia y estabilidad</li>
                                        <li>✔ Mayor peso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Plywood">
                                <div class="card-body">
                                    <h5 class="card-title">Plywood</h5>
                                    <ul>
                                        <li>✔ Exteriores</li>
                                        <li>❌ Mayor costo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Segundo Item del Carrusel -->
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <!-- Tarjetas 5 a 7 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Panel de Madera">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Madera</h5>
                                    <ul>
                                        <li>✔ Natural</li>
                                        <li>✔ Alta resistencia</li>
                                        <li>❌ Puede ser costoso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Panel de Vidrio">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Vidrio</h5>
                                    <ul>
                                        <li>✔ Estético</li>
                                        <li>✔ Transparente</li>
                                        <li>❌ Fragilidad</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Panel de Acero">
                                <div class="card-body">
                                    <h5 class="card-title">Panel de Acero</h5>
                                    <ul>
                                        <li>✔ Alta durabilidad</li>
                                        <li>✔ Resistente al fuego</li>
                                        <li>❌ No es económico</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Controles del Carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#panelCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#panelCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Estilos personalizados para los botones -->
            <style>
                /* Asegura que los botones no se superpongan a las tarjetas y tengan suficiente espacio */
                .carousel-control-prev,
                .carousel-control-next {
                    margin-left: 20px;
                    /* Espacio más grande entre los botones */
                    margin-right: 20px;
                    /* Espacio más grande entre los botones */
                    z-index: 5;
                    /* Asegura que los botones estén sobre el contenido */
                }

                /* Estilo para el círculo alrededor de las flechas */
                .carousel-control-prev-icon,
                .carousel-control-next-icon {
                    background-color: #495E57;
                    /* Color del círculo */
                    border-radius: 50%;
                    /* Hacer el fondo circular */
                    padding: 15px;
                    /* Aumenta el tamaño del círculo */
                }

                /* Asegura que los botones estén bien posicionados respecto al carrusel */
                .carousel-control-prev,
                .carousel-control-next {
                    position: absolute;
                    /* Posicionamiento absoluto para sacarlos del flujo normal */
                    top: 50%;
                    /* Centra verticalmente */
                    transform: translateY(-50%);
                    /* Ajusta el centro exacto */
                }

                /* Asegura que el botón "previous" esté a la izquierda */
                .carousel-control-prev {
                    left: 10px;
                    /* Ajusta el espacio desde el borde izquierdo */
                }

                /* Asegura que el botón "next" esté a la derecha */
                .carousel-control-next {
                    right: 10px;
                    /* Ajusta el espacio desde el borde derecho */
                }
            </style>


            <!-- Botón "Crear Proyecto" -->
            <a href="/crear-proyecto" class="btn btn-primary mt-4">Crear un Proyecto</a>
    </section>


    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal de Login / Registro -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Iniciar Sesión o Registrarse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Opciones Login / Register -->
                    <div class="d-flex justify-content-around">
                        <!-- Redirigir a la página de Login -->
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                        <!-- Redirigir a la página de Registro -->
                        <a href="{{ route('register') }}" class="btn btn-success">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>