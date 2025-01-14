<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carpinteros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }

        .no-link {
            text-decoration: none;
            color: inherit;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('home') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid"
                    style="height: 6vh; max-height: 100%; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/home">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Proyectos</a></li>
                    <li class="nav-item active"><a href="{{ route('carpinteros.index') }}"
                            class="nav-link no-link">Carpinteros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                    @auth
                        @if(Auth::user()->rol == 1)
                            <li class="nav-item"><a href="/dashboard" class="nav-link no-link">Admin</a></li>
                        @elseif(Auth::user()->rol == 2)
                            <li class="nav-item"><a href="/productos" class="nav-link no-link">Empleado</a></li>
                        @endif
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ route('profile') }}">
                            <img src="{{ asset('media/boton-usuario.png') }}" alt="Profile" width="30" height="30">
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('media/boton-usuario.png') }}" alt="Login/Register" width="30" height="30">
                        </a>
                    @endauth
                    <span class="mx-3">|</span>
                    <a href="{{ route('notificaciones') }}">
                        <img src="{{ asset('media/boton-notificaciones.png') }}" alt="Notificaciones" width="30"
                            height="30">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestión de Carpinteros</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('carpinteros.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="especialidad" class="form-control" placeholder="Especialidad" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
                </div>
                <div class="col-md-4">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-4">
                    <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación">
                </div>
                <div class="col-md-4">
                    <input type="file" name="foto_perfil" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6">
                    <textarea name="descripcion" class="form-control" placeholder="Descripción"></textarea>
                </div>
                <div class="col-md-3">
                    <select name="disponibilidad" class="form-control">
                        <option value="1">Disponible</option>
                        <option value="0">No disponible</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar Carpintero</button>
                <a href="{{ route('carpinteros.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>

        <h2 class="mt-5">Lista de Carpinteros</h2>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Ubicación</th>
                    <th>Foto</th>
                    <th>Descripción</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carpinteros as $carpintero)
                    <tr>
                        <td>{{ $carpintero->nombre }}</td>
                        <td>{{ $carpintero->especialidad }}</td>
                        <td>{{ $carpintero->telefono }}</td>
                        <td>{{ $carpintero->email }}</td>
                        <td>{{ $carpintero->ubicacion }}</td>
                        <td>
                            @if($carpintero->foto_perfil)
                                <img src="{{ $carpintero->foto_perfil }}" alt="Foto de perfil" width="50" height="50">
                            @else
                                <span>No disponible</span>
                            @endif
                        </td>
                        <td>{{ $carpintero->descripcion }}</td>
                        <td>
                            @if($carpintero->disponibilidad == 1)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-danger">No disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('carpinteros.edit', $carpintero->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('carpinteros.destroy', $carpintero->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No hay carpinteros registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

