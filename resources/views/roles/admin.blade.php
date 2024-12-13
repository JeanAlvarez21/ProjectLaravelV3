<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <span class="dropdown-item">Bienvenido, {{ Auth::user()->nombres }} has iniciado sesion como Administrador</span> <!-- Muestra el nombre del usuario -->
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
