<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Notificaciones - Novocentro</title>
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

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 40px 0;
            margin-top: 2rem;
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

        .notification-item {
            border-left: 4px solid var(--primary-color);
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: var(--light-bg);
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .notification-item.unread {
            background-color: white;
            border-left-color: var(--secondary-color);
        }

        .notification-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .notification-message {
            margin-bottom: 0.5rem;
        }

        .notification-date {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Centro de Notificaciones -->
    <div class="container mt-4">
        <h1 class="mb-4">Centro de Notificaciones</h1>

        <div class="mb-3">
            <select class="form-select" id="notificationFilter">
                <option value="all">Todas las notificaciones</option>
                <option value="unread">No leídas</option>
            </select>
        </div>

        <div id="notificationList">
            <!-- Las notificaciones se cargarán aquí dinámicamente -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
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
        // Datos de ejemplo para las notificaciones
        const notifications = [
            { id: 1, title: "Proyecto Muebles sala", message: "El proyecto 'Proyecto Muebles sala' se está empaquetando", date: "2023-04-15 10:30", isRead: false },
            { id: 2, title: "Nuevo producto disponible", message: "Se ha añadido un nuevo tipo de madera a nuestro catálogo", date: "2023-04-14 15:45", isRead: true },
            { id: 3, title: "Actualización de pedido", message: "Tu pedido #1234 ha sido enviado", date: "2023-04-13 09:00", isRead: false }
        ];

        function renderNotifications(filter = 'all') {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = '';

            const filteredNotifications = filter === 'all'
                ? notifications
                : notifications.filter(n => !n.isRead);

            filteredNotifications.forEach(notification => {
                const notificationElement = document.createElement('div');
                notificationElement.className = `notification-item ${notification.isRead ? '' : 'unread'}`;
                notificationElement.innerHTML = `
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-date">${notification.date}</div>
                    ${!notification.isRead ? `<button class="btn btn-sm btn-primary mt-2" onclick="markAsRead(${notification.id})">Marcar como leído</button>` : ''}
                `;
                notificationList.appendChild(notificationElement);
            });

            if (filteredNotifications.length === 0) {
                notificationList.innerHTML = '<p class="text-center">No hay notificaciones para mostrar.</p>';
            }
        }

        function markAsRead(id) {
            const notification = notifications.find(n => n.id === id);
            if (notification) {
                notification.isRead = true;
                renderNotifications(document.getElementById('notificationFilter').value);
            }
        }

        document.getElementById('notificationFilter').addEventListener('change', function () {
            renderNotifications(this.value);
        });

        // Inicializar la vista de notificaciones
        renderNotifications();
    </script>
</body>

</html>