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
                        <a href="{{ route('notificaciones.index') }}" class="nav-link">
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