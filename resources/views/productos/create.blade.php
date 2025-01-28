<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Novocentro</title>
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

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
            margin: 0;
            width: 100%;
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

        /* Main Content Styles */
        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            max-width: 1200px;
        }

        /* Form Styles */
        .form-label {
            font-weight: 500;
            color: #344767;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.25);
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            background: #fff;
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Button Styles */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
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

        /* Image Preview */
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #dc3545;
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
                    <a href="/productos" class="nav-item active">
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
                    <a href="/facturacion" class="nav-item">
                        <i class="bi bi-receipt"></i>
                        <span>Facturación</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <a href="/productos" class="nav-item active">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <i class="bi bi-folder-fill"></i>
                        <span>Familias</span>
                    </a>
                    <a href="/facturacion" class="nav-item">
                        <i class="bi bi-receipt"></i>
                        <span>Facturación</span>
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
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="h3 mb-4">Crear Nuevo Producto</h1>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('productos.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="codigo_producto" class="form-label">Código del
                                                    Producto</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="codigo_producto"
                                                        name="codigo_producto" required>
                                                </div>
                                                <div id="codigoFeedback" class="form-text"></div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nombre_producto" class="form-label">Nombre del
                                                    Producto</label>
                                                <input type="text" class="form-control" id="nombre_producto"
                                                    name="nombre" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Dimensiones</label>
                                                <div class="row g-2">
                                                    <div class="col-md-4">
                                                        <label for="largo" class="form-label text-muted small">Largo
                                                            (mm)</label>
                                                        <input type="number" class="form-control" id="largo"
                                                            name="largo" placeholder="2440" required min="1">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="ancho" class="form-label text-muted small">Ancho
                                                            (mm)</label>
                                                        <input type="number" class="form-control" id="ancho"
                                                            name="ancho" placeholder="1220" required min="1">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="grosor" class="form-label text-muted small">Grosor
                                                            (mm)</label>
                                                        <input type="number" class="form-control" id="grosor"
                                                            name="grosor" placeholder="18" required min="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="descripcion_opcional" class="form-label">Descripción
                                                    adicional (opcional)</label>
                                                <textarea class="form-control" id="descripcion_opcional"
                                                    name="descripcion_opcional" rows="4"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="precio" class="form-label">Costo de Adquisición</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="precio" name="precio"
                                                        required min="0" step="0.01">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="costo" class="form-label">Precio de Venta al Público</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="costo" name="costo"
                                                        required min="0" step="0.01">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Cantidad en Inventario</label>
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    required min="0" step="1">
                                            </div>

                                            <div class="mb-3">
                                                <label for="min_stock" class="form-label">Stock Mínimo</label>
                                                <input type="number" class="form-control" id="min_stock"
                                                    name="min_stock" required min="0" step="1">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="id_categoria" class="form-label">Familia</label>
                                                <select class="form-select" id="id_categoria" name="id_categoria"
                                                    required>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id_categoria }}">
                                                            {{ $categoria->nombre_categoria }}
                                                        </option>
                                                    @endforeach
                                                    <option value="nueva">+ Agregar nueva Familia</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 d-none" id="nuevaCategoriaDiv">
                                                <label for="nueva_categoria" class="form-label">Nueva Familia</label>
                                                <input type="text" class="form-control" id="nueva_categoria"
                                                    name="nueva_categoria">
                                            </div>

                                            <div class="mb-3 d-none" id="descripcionCategoriaDiv">
                                                <label for="descripcion_categoria" class="form-label">Descripción de la
                                                    Nueva Familia</label>
                                                <input type="text" class="form-control" id="descripcion_categoria"
                                                    name="descripcion_categoria" placeholder="Breve descripción">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="imagen" class="form-label">Imagen del Producto</label>
                                                <input type="file" class="form-control" id="imagen" name="imagen"
                                                    accept="image/jpeg,image/png,image/jpg" required>
                                                <img id="preview" class="preview-image d-none">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nombre_sucursal" class="form-label">Nombre de la
                                                    Sucursal</label>
                                                <input type="text" class="form-control" id="nombre_sucursal"
                                                    name="nombre_sucursal" value="Loja" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="direccion_sucursal" class="form-label">Dirección de la
                                                    Sucursal</label>
                                                <select class="form-select" id="direccion_sucursal"
                                                    name="direccion_sucursal" required>
                                                    <option value="" disabled selected>Selecciona una opción</option>
                                                    <option value="Norte">Norte</option>
                                                    <option value="Sur">Sur</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="visible" class="form-label">Visibilidad</label>
                                                <select name="visible" class="form-select">
                                                    <option value="1">Público</option>
                                                    <option value="0">Privado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('productos.index') }}"
                                                    class="btn btn-secondary">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-lg me-1"></i>
                                                    Guardar Producto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('imagen').addEventListener('change', function (e) {
            const preview = document.getElementById('preview');
            const file = e.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        });

        document.getElementById('id_categoria').addEventListener('change', function () {
            const nuevaCategoriaDiv = document.getElementById('nuevaCategoriaDiv');
            const descripcionCategoriaDiv = document.getElementById('descripcionCategoriaDiv');

            if (this.value === 'nueva') {
                nuevaCategoriaDiv.classList.remove('d-none');
                descripcionCategoriaDiv.classList.remove('d-none');
            } else {
                nuevaCategoriaDiv.classList.add('d-none');
                descripcionCategoriaDiv.classList.add('d-none');
            }
        });
    </script>
</body>

</html>