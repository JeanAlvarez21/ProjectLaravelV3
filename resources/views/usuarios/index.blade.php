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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="/logo.png" alt="NOVOCENTRO" height="40">
        </div>
        <nav>
            <a href="/dashboard" class="nav-item">
                <span>Dashboard</span>
            </a>
            <a href="/productos" class="nav-item">
                <span>Productos</span>
            </a>
            <a href="/inventario" class="nav-item">
                <span>Inventario</span>
            </a>
            <a href="/usuarios" class="nav-item active">
                <span>Usuarios</span>
            </a>
            <a href="/facturacion" class="nav-item">
                <span>Facturación</span>
            </a>
            <a href="/reportes" class="nav-item">
                <span>Reportes</span>
            </a>
        </nav>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Usuarios</h1>
            <div class="actions">
                <input type="text" class="search-bar" placeholder="Buscar...">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Añadir nuevo cliente</a>
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
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

