<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Familias - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FFD700;
            --primary-dark: #E6C200;
            --sidebar-width: 280px;
            --header-height: 70px;
            --card-border-radius: 12px;
            --transition-speed: 0.3s;
        }

        .card {
            width: 100%;
            height: 150px;
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            padding: 1.5rem;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .logo {
            margin-bottom: 2.5rem;
            padding: 0.5rem;
            text-align: center;
        }

        .logo img {
            height: auto;
            width: 80%;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .nav-item {
            padding: 0.875rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 10px;
            color: rgba(0, 0, 0, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
        }

        .nav-item i {
            font-size: 1.25rem;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #000;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: #fff;
            color: #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Content Styles */
        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            max-width: 1200px;
        }

        /* Table Styles */
        .table {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #344767;
            border-bottom-width: 1px;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn i {
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #000;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #000;
        }

        .btn-success {
            background-color: #198754;
            border-color: #198754;
            color: white;
        }

        .btn-success:hover {
            background-color: #157347;
            border-color: #157347;
        }

        .btn-warning {
            color: #000;
        }

        .btn-danger {
            color: white;
        }

        .btn-logout {
            background-color: #fff;
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            margin-top: 2rem;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-logout:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            max-width: 300px;
        }

        .search-wrapper .form-control {
            padding-left: 2.5rem;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .search-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-wrapper .bi-search {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-input {
            padding-left: 2.5rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Badge Styles */
        .badge {
            padding: 0.5em 0.75em;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-item span {
                display: none;
            }

            .content {
                margin-left: 80px;
                width: calc(100% - 80px);
            }

            .logo img {
                width: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="home">
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
                    <a href="/categorias" class="nav-item active">
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
                    <a href="/categorias" class="nav-item active">
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

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="h3 mb-0">Familias</h1>
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                Nueva Familia
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('categorias.index') }}">
                                    <div class="search-wrapper">
                                        <i class="bi bi-search"></i>
                                        <input type="text" name="search" class="form-control search-input"
                                            placeholder="Buscar familia..." value="{{ old('search', $search) }}">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id_categoria }}</td>
                                            <td>
                                                <span class="fw-medium">{{ $categoria->nombre_categoria }}</span>
                                            </td>
                                            <td>{{ Str::limit($categoria->descripcion_categoria, 50) }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('categorias.edit', $categoria->id_categoria) }}"
                                                    class="btn btn-sm btn-warning me-2">
                                                    <i class="bi bi-pencil-fill"></i>
                                                    Editar
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $categoria->id_categoria }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal for each category -->
                                        <div class="modal fade" id="deleteModal{{ $categoria->id_categoria }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar la familia
                                                            "{{ $categoria->nombre_categoria }}"?</p>
                                                        <p class="text-danger mb-0">Esta acción no se puede deshacer.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form
                                                            action="{{ route('categorias.destroy', $categoria->id_categoria) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash3-fill"></i>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-folder-x display-4 text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">No se encontraron familias</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>