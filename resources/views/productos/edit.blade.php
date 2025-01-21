<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Novocentro</title>
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
            /* Rojo */
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
    <div class="d-flex">
        <!-- Sidebar -->
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
                    <a href="/productos" class="nav-item active">
                        <span>Productos</span>
                    </a>
                    <a href="/categorias" class="nav-item">
                        <span>Familias</span>
                    </a>
                    <a href="/usuarios" class="nav-item">
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


                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="mb-4">Editar Producto</h1>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="mb-3">
                                <label for="codigo_producto" class="form-label">Código del Producto</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="codigo_producto" name="codigo_producto" required value="{{$producto->codigo_producto}}">
                                </div>
                                <div id="codigoFeedback" class="form-text"></div>
                            </div>

                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre_producto" name="nombre" required value="{{ $producto->nombre}}">
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" required min="0" step="0.01" value="{{$producto->precio}}">
                            </div>

                            <div class="mb-3">
                                <label for="costo" class="form-label">Costo</label>
                                <input type="number" class="form-control" id="costo" name="costo" required min="0" step="0.01" value="{{$producto->costo}}">
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Cantidad en Inventario</label>
                                <input type="number" class="form-control" id="stock" name="stock" required min="0" step="1" value="{{$producto->stock}}">
                            </div>

                            <div class="mb-3">
                                <label for="min_stock" class="form-label">Stock Mínimo</label>
                                <input type="number" class="form-control" id="min_stock" name="min_stock" required min="0" step="1" value="{{$producto->min_stock}}">
                            </div>

                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Familia</label>
                                <select class="form-control" id="id_categoria" name="id_categoria" required>
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
                                <label for="nueva_categoria" class="form-label">Nombre de la Nueva Familia</label>
                                <input type="text" class="form-control" id="nueva_categoria" name="nueva_categoria">
                            </div>

                            <div class="mb-3 d-none" id="descripcionCategoriaDiv">
                                <label for="descripcion_categoria" class="form-label">Descripción de la Nueva Familia</label>
                                <input type="text" class="form-control" id="descripcion_categoria" name="descripcion_categoria" >      
                            </div>

                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Nombre de la Familia Actual</label>
                                <input type="text" class="form-control" value="{{ $producto->categoria->nombre_categoria }}" readonly>
                                <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">
                            </div>

                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Descripcion de la Familia Actual</label>
                                <input type="text" class="form-control" value="{{ $producto->categoria->descripcion_categoria }}" readonly>
                                <input type="hidden" name="id_categoria" value="{{ $producto->id_categoria }}">
                            </div>

                            <div class="mb-3">
                                        <label for="imagen_actual" class="form-label">Imagen Actual</label>
                                        <div>
                                            <img src="{{ asset($producto->link_imagen) }}" alt="Imagen del Producto" style="max-width: 200px; max-height: 200px;">
                                        </div>


                            <div class="mb-3">
                                <label for="imagen" class="form-label">Agregar imagen nueva</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg" >
                                <img id="preview" class="preview-image d-none">
                            </div>

                            <div class="mb-3">
                                <label for="nombre_sucursal" class="form-label">Nombre de la Sucursal</label>
                                <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal" required value="{{$producto->nombre_sucursal}}">
                            </div>

                            <div class="mb-3">
                                <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal</label>
                                <input type="text" class="form-control" id="direccion_sucursal" name="direccion_sucursal" required value="{{$producto->direccion_sucursal}}">
                            </div>

                            <div class="form-group">
                                <label for="visible">Visibilidad</label>
                                <select name="visible" class="form-control">
                                    <option value="1">Público</option>
                                    <option value="0">Privado</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Producto</button>
                        </form>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
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
            const descripcionCategoriaDiv  = document.getElementById('descripcionCategoriaDiv');

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