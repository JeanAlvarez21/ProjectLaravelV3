<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #ffcc00;
            padding: 20px;
        }

        .sidebar a {
            color: #000;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center">NOVOCENTRO</h4>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="#">Productos</a>
            <a href="#">Inventario</a>
            <a href="{{route('usuarios.index')}}">Usuarios</a>
            <a href="#">Facturación</a>
            <a href="#">Reportes</a>
            <hr>
            <a href="#">Configuración</a>
            <a href="#" onclick="document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>

</html>