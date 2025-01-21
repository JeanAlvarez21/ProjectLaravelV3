<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOVOCENTRO - Usuarios</title>
    <style>
        :root {
            --primary-color: #FFD700;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            min-height: 100vh;
            padding: 1rem;
        }

        .logo {
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .nav-item {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item.active {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-bar {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            width: 300px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #000;
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: #000;
            border: none;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #FF0000;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #D40000;
        }

        /* Estilo para el botón de cerrar sesión */
        .btn-logout {
            background-color: #FF6347; /* Un color rojo para el botón */
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            text-align: center;
            width: 100%;
            display: block;
            margin-top: auto;
        }

        .btn-logout:hover {
            background-color: #D44C3C;
        }
 /* Sidebar Styles */
 .sidebar {
            width: 250px;
            background-color: #FFD700;
            min-height: 100vh;
            padding: 1rem;
        }

        .sidebar .logo {
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .sidebar .nav-item {
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar .nav-item.active {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar .btn-logout {
            background-color: #FF6347;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            text-align: center;
            width: 100%;
            display: block;
            margin-top: auto;
        }

        .sidebar .btn-logout:hover {
            background-color: #D44C3C;
        }
        
    </style>
</head>
<body>
<div class="sidebar">
            <div class="logo" style="text-align: center; margin-bottom: 2rem;">
                <a href="home">
                    <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid"
                        style="height: 7vh; max-height: auto; width: 70%;">
                </a>
            </div>

            <nav>
            @if(auth()->user()->rol == 1)
                    <!-- Menú completo para rol 3 -->
                    <a href="/dashboard" class="nav-item">
                        <span>Dashboard</span>
                    </a>
                    <a href="/productos" class="nav-item">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/usuarios" class="nav-item active">
                        <span>Usuarios</span>
                    </a>
                    <a href="/pedidos" class="nav-item">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <!-- Menú reducido para rol 2 -->
                    <a href="/productos" class="nav-item active">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/pedidos" class="nav-item">
                        <span>Pedidos</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @endif

                <!-- Botón de cerrar sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar sesión</button>
                </form>
            </nav>
        </div>

    <div class="main-content">
        <div class="header">
            <h1>Usuarios</h1>
            <div class="actions">
                <input type="text" class="search-bar" placeholder="Buscar...">
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombres y Apellidos</th>
                    <th>Rol</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->nombres }} {{ $user->apellidos }}
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td>
                        @switch($user->rol)
                            @case(1)
                                Administrador
                                @break
                            @case(2)
                                Empleado
                                @break
                            @case(3)
                                Cliente
                                @break
                            @default
                                {{ $user->rol }}
                        @endswitch
                    </td>
                    <td>{{ $user->created_at->format('d F Y') }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-edit">Editar</a>

                        <!-- Botón de eliminar -->
                        <form action="{{ route('usuarios.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
