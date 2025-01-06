<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo" style="text-align: center; margin-bottom: 2rem;">
                <a href="home">
                    <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid" style="height: 7vh; max-height: auto; width: 70%;">
                </a>
            </div>

            <nav>
                @if(auth()->user()->rol == 1)
                    <a href="/dashboard" class="nav-item">
                        <span>Dashboard</span>
                    </a>
                    <a href="/productos" class="nav-item active">
                        <span>Productos</span>
                    </a>
                    <a href="/inventario" class="nav-item">
                        <span>Inventario</span>
                    </a>
                    <a href="/usuarios" class="nav-item">
                        <span>Usuarios</span>
                    </a>
                    <a href="/facturacion" class="nav-item">
                        <span>Facturación</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @elseif(auth()->user()->rol == 2)
                    <a href="/productos" class="nav-item active">
                        <span>Productos</span>
                    </a>
                    <a href="/inventario" class="nav-item">
                        <span>Inventario</span>
                    </a>
                    <a href="/facturacion" class="nav-item">
                        <span>Facturación</span>
                    </a>
                    <a href="/reportes" class="nav-item">
                        <span>Reportes</span>
                    </a>
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar sesión</button>
                </form>
            </nav>
        </div>

        <!-- Main content -->
        <div class="content" style="flex-grow: 1; padding: 20px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-4">Crear Nuevo Producto</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="id_producto" class="form-label">ID del Producto</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="id_producto" name="id_producto" required>
                                    <button type="button" class="btn btn-secondary" id="checkId">Verificar ID</button>
                                </div>
                                <div id="idFeedback" class="form-text"></div>
                            </div>

                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" required min="0" step="1" 
                                    placeholder="Introduce la cantidad del producto">
                            </div>


                            <div class="mb-3">
                                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                                <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" required>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del Producto</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg" required>
                                <img id="preview" class="preview-image d-none">
                            </div>

                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoría</label>
                                <select class="form-control" id="id_categoria" name="id_categoria" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}">
                                            {{ $categoria->nombre_categoria }}
                                        </option>
                                    @endforeach
                                    <option value="nueva">+ Agregar nueva categoría</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="nuevaCategoriaDiv">
                                <label for="nueva_categoria" class="form-label">Nueva Categoría</label>
                                <input type="text" class="form-control" id="nueva_categoria" name="nueva_categoria">
                            </div>

                            <div class="mb-3">
                                <label for="visible" class="form-label">Visibilidad</label>
                                <select class="form-control" id="visible" name="visible" required>
                                    <option value="publico">Público</option>
                                    <option value="privado">Privado</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear Producto</button>
                        </form>
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
            if (this.value === 'nueva') {
                nuevaCategoriaDiv.classList.remove('d-none');
            } else {
                nuevaCategoriaDiv.classList.add('d-none');
            }
        });

        document.getElementById('checkId').addEventListener('click', function() {
            const id = document.getElementById('id_producto').value;
            if (!id) return;

            fetch(`/productos/check-id?id_producto=${id}`)
                .then(response => response.json())
                .then(data => {
                    const feedback = document.getElementById('idFeedback');
                    if (data.exists) {
                        feedback.innerHTML = `Este ID ya existe. ¿Deseas <a href="${data.edit_url}">editar el producto</a>?`;
                    } else {
                        feedback.innerHTML = 'ID disponible';
                    }
                });
        });
    </script>
</body>
</html>