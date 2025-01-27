<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Novocentro</title>
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

        /* Form Styles */
        .form-label {
            font-weight: 500;
            color: #344767;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
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

        /* Image Preview */
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .current-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Button Styles */
        .btn {
            padding: 0.75rem 1.5rem;
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

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
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
                    <a href="/pedidos" class="nav-item">
                        <i class="bi bi-cart-fill"></i>
                        <span>Pedidos</span>
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
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h1 class="h3 mb-0">Editar Producto</h1>
                                    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left"></i>
                                        Volver
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

                                <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="codigo_producto" class="form-label">Código del Producto</label>
                                                <input type="text" class="form-control" id="codigo_producto" name="codigo_producto" required value="{{$producto->codigo_producto}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                                <input type="text" class="form-control" id="nombre_producto" name="nombre" required value="{{ $producto->nombre}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ $producto->descripcion }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="precio" class="form-label">Costo de Adquisición</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="precio" name="precio" required min="0" step="0.01" value="{{$producto->precio}}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="costo" class="form-label">Precio de Venta al Público</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="costo" name="costo" required min="0" step="0.01" value="{{$producto->costo}}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Cantidad en Inventario</label>
                                                <input type="number" class="form-control" id="stock" name="stock" required min="0" step="1" value="{{$producto->stock}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="min_stock" class="form-label">Stock Mínimo</label>
                                                <input type="number" class="form-control" id="min_stock" name="min_stock" required min="0" step="1" value="{{$producto->min_stock}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="id_categoria" class="form-label">Familia</label>
                                                <select class="form-select" id="id_categoria" name="id_categoria" required>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id_categoria }}" 
                                                            {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                                                            {{ $categoria->nombre_categoria }}
                                                        </option>
                                                    @endforeach
                                                    <option value="nueva">+ Agregar nueva Familia</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 d-none" id="nuevaCategoriaDiv">
                                                <label for="nueva_categoria" class="form-label">Nueva Familia</label>
                                                <input type="text" class="form-control" id="nueva_categoria" name="nueva_categoria">
                                            </div>

                                            <div class="mb-3 d-none" id="descripcionCategoriaDiv">
                                                <label for="descripcion_categoria" class="form-label">Descripción de la Nueva Familia</label>
                                                <input type="text" class="form-control" id="descripcion_categoria" name="descripcion_categoria">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Familia Actual</label>
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <h6 class="card-subtitle mb-2">{{ $producto->categoria->nombre_categoria }}</h6>
                                                        <p class="card-text small text-muted mb-0">{{ $producto->categoria->descripcion_categoria }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Imagen Actual</label>
                                                @if($producto->link_imagen)
                                                    <div class="position-relative" style="max-width: 200px;">
                                                        <img src="{{ asset('storage/' . $producto->link_imagen) }}" 
                                                             alt="Imagen actual del producto" 
                                                             class="img-fluid rounded shadow-sm d-block mb-2"
                                                             style="width: 100%; height: auto; object-fit: cover;">
                                                    </div>
                                                @else
                                                    <div class="alert alert-info">
                                                        No hay imagen actual
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="imagen" class="form-label">Nueva Imagen</label>
                                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg">
                                                <div class="form-text">Deja este campo vacío si no deseas cambiar la imagen actual.</div>
                                                <img id="preview" class="img-fluid rounded shadow-sm mt-2 d-none" style="max-width: 200px;">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nombre_sucursal" class="form-label">Nombre de la Sucursal</label>
                                                <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal" required value="{{$producto->nombre_sucursal}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal</label>
                                                <select class="form-select" id="direccion_sucursal" name="direccion_sucursal" required>
                                                    <option value="Norte" {{ $producto->direccion_sucursal == 'Norte' ? 'selected' : '' }}>Norte</option>
                                                    <option value="Sur" {{ $producto->direccion_sucursal == 'Sur' ? 'selected' : '' }}>Sur</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="visible" class="form-label">Visibilidad</label>
                                                <select name="visible" class="form-select">
                                                    <option value="1" {{ $producto->visible ? 'selected' : '' }}>Público</option>
                                                    <option value="0" {{ !$producto->visible ? 'selected' : '' }}>Privado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-lg"></i>
                                                    Guardar Cambios
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
        document.getElementById('imagen').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const file = e.target.files[0];
            
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        });

        document.getElementById('id_categoria').addEventListener('change', function() {
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

