<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOVOCENTRO - Editar Usuario</title>
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
            margin-bottom: 2rem;
        }

        .form-container {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #000;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
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
                    <a href="/facturacion" class="nav-item">
                        <span>Facturación</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <!-- Menú reducido para rol 2 -->
                    <a href="/productos" class="nav-item">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/facturacion" class="nav-item">
                        <span>Facturación</span>
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
            <h1>Editar Usuario</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombres">Nombre:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $user->nombres }}" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $user->apellidos }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $user->cedula }}" required>
                </div>

                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="1" {{ $user->rol == 1 ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ $user->rol == 2 ? 'selected' : '' }}>Empleado</option>
                        <option value="3" {{ $user->rol == 3 ? 'selected' : '' }}>Cliente</option>
                    </select>
                </div>

                <div class="form-actions">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

