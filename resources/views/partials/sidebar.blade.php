<div class="sidebar">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid">
        </a>
    </div>

    <nav>
        @if(auth()->user()->rol == 1)
            <a href="/dashboard" class="nav-item">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
            <a href="/productos" class="nav-item">
                <i class="bi bi-box-seam-fill"></i>
                <span>Productos</span>
            </a>
            <a href="/categorias" class="nav-item">
                <i class="bi bi-folder-fill"></i>
                <span>Familias</span>
            </a>
            <a href="/usuarios" class="nav-item">
                <i class="bi bi-people-fill"></i>
                <span>Usuarios</span>
            </a>
            <a href="/pedidos" class="nav-item">
                <i class="bi bi-cart-fill"></i>
                <span>Pedidos</span>
            </a>
            <a href="/reportes" class="nav-item">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Reportes</span>
            </a>
        @elseif(auth()->user()->rol == 2)
            <a href="/productos" class="nav-item">
                <i class="bi bi-box-seam-fill"></i>
                <span>Productos</span>
            </a>
            <a href="/categorias" class="nav-item">
                <i class="bi bi-folder-fill"></i>
                <span>Familias</span>
            </a>
            <a href="/pedidos" class="nav-item">
                <i class="bi bi-cart-fill"></i>
                <span>Pedidos</span>
            </a>
            <a href="/reportes" class="nav-item">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Reportes</span>
            </a>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </nav>
</div>