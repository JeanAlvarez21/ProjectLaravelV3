<div class="sidebar">
    <div class="expand-sidebar-btn">
        <i class="bi bi-chevron-right"></i>
    </div>

    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid">
        </a>
    </div>

    <nav>
        @if(auth()->user()->rol == 1)
            <a href="/dashboard" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('productos.index') }}" class="nav-item {{ Request::is('productos*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Productos</span>
            </a>
            <a href="{{ route('categorias.index') }}" class="nav-item {{ Request::is('categorias*') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                <span>Familias</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('pedidos.index') }}" class="nav-item {{ Request::is('pedidos*') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                <span>Pedidos</span>
            </a>
            <a href="{{ route('reportes.index') }}" class="nav-item {{ Request::is('reportes*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Reportes</span>
            </a>
        @elseif(auth()->user()->rol == 2)
            <a href="{{ route('productos.index') }}" class="nav-item {{ Request::is('productos*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Productos</span>
            </a>
            <a href="{{ route('categorias.index') }}" class="nav-item {{ Request::is('categorias*') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                <span>Familias</span>
            </a>
            <a href="{{ route('pedidos.index') }}" class="nav-item {{ Request::is('pedidos*') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                <span>Pedidos</span>
            </a>
            <a href="{{ route('reportes.index') }}" class="nav-item {{ Request::is('reportes*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Reportes</span>
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </nav>
</div>