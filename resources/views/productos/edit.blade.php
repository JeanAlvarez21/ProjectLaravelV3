<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Producto - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">

    <style>

        .alert-warning {
            background-color: #fff8e1;
            border-color: #ffe57f;
            color: #b45309;
        }
        .image-preview-container {
        margin-bottom: 1rem;
    }

    .preview-wrapper {
        margin-top: 0.5rem;
        width: 150px;
        height: 150px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: all 0.3s ease;
    }

    .preview-wrapper:hover {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    </style>
</head>
<body>
    <!-- Loading Indicator -->
    <div class="loading-indicator">
        <div class="loading-spinner"></div>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-primary sidebar-toggle d-md-none" type="button" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="{{ url('/') }}">
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
            @else
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
            @endif

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
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

                            @if($producto->stock <= $producto->min_stock)
                                <div class="alert alert-warning mb-4">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    Este producto tiene un stock bajo ({{ $producto->stock }} unidades).
                                    El stock mínimo establecido es de {{ $producto->min_stock }} unidades.
                                </div>
                            @endif

                            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                                @csrf
                                @method('PUT')
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="codigo_producto" class="form-label">Código del Producto</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="codigo_producto"
                                                    name="codigo_producto" required 
                                                    value="{{ old('codigo_producto', $producto->codigo_producto) }}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre del Producto</label>
                                            <input type="text" class="form-control" id="nombre"
                                                name="nombre" required 
                                                value="{{ old('nombre', $producto->nombre) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Dimensiones</label>
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <label for="largo" class="form-label text-muted small">Largo (mm)</label>
                                                    <input type="number" class="form-control" id="largo" name="largo"
                                                        required min="1" 
                                                        value="{{ old('largo', $producto->largo) }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="ancho" class="form-label text-muted small">Ancho (mm)</label>
                                                    <input type="number" class="form-control" id="ancho" name="ancho"
                                                        required min="1" 
                                                        value="{{ old('ancho', $producto->ancho) }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="grosor" class="form-label text-muted small">Grosor (mm)</label>
                                                    <input type="number" class="form-control" id="grosor" name="grosor"
                                                        required min="1" 
                                                        value="{{ old('grosor', $producto->grosor) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="descripcion_opcional" class="form-label">Descripción adicional (opcional)</label>
                                            <textarea class="form-control" id="descripcion_opcional" name="descripcion_opcional"
                                                rows="4">{{ old('descripcion_opcional', $producto->descripcion_opcional) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="precio" name="precio"
                                                    required min="0" step="0.01" 
                                                    value="{{ old('precio', $producto->precio) }}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="costo" class="form-label">Costo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="costo" name="costo"
                                                    required min="0" step="0.01" 
                                                    value="{{ old('costo', $producto->costo) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Cantidad en Inventario</label>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                required min="0" step="1" 
                                                value="{{ old('stock', $producto->stock) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="min_stock" class="form-label">Stock Mínimo</label>
                                            <input type="number" class="form-control" id="min_stock" name="min_stock"
                                                required min="0" step="1" 
                                                value="{{ old('min_stock', $producto->min_stock) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="id_categoria" class="form-label">Familia</label>
                                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id_categoria }}"
                                                        {{ (old('id_categoria', $producto->id_categoria) == $categoria->id_categoria) ? 'selected' : '' }}>
                                                        {{ $categoria->nombre_categoria }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
    <label for="imagen" class="form-label">Imagen del Producto</label>
    <div class="image-preview-container">
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg">
        <div class="preview-wrapper">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                     alt="Imagen actual" 
                     class="current-image preview-image">
            @endif
            <img id="preview" class="preview-image" style="display: none;" alt="Vista previa">
        </div>
        <small class="text-muted">Deja este campo vacío si no deseas cambiar la imagen</small>
    </div>
</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nombre_sucursal" class="form-label">Nombre de la Sucursal</label>
                                            <input type="text" class="form-control" id="nombre_sucursal"
                                                name="nombre_sucursal" 
                                                value="{{ old('nombre_sucursal', $producto->nombre_sucursal) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal</label>
                                            <select class="form-select" id="direccion_sucursal" name="direccion_sucursal" required>
                                                <option value="Norte" {{ old('direccion_sucursal', $producto->direccion_sucursal) == 'Norte' ? 'selected' : '' }}>Norte</option>
                                                <option value="Sur" {{ old('direccion_sucursal', $producto->direccion_sucursal) == 'Sur' ? 'selected' : '' }}>Sur</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="visible" class="form-label">Visibilidad</label>
                                            <select name="visible" class="form-select">
                                                <option value="1" {{ old('visible', $producto->visible) == '1' ? 'selected' : '' }}>Público</option>
                                                <option value="0" {{ old('visible', $producto->visible) == '0' ? 'selected' : '' }}>Privado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-lg"></i>
                                                Actualizar Producto
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Mantener todo el código JavaScript existente

    // Añadir el código para la vista previa de imagen
    const imagen = document.getElementById('imagen');
    const preview = document.getElementById('preview');
    const currentImage = document.querySelector('.current-image');
    
    imagen.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validar el tipo de archivo
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('Por favor, selecciona una imagen válida (JPEG, PNG o JPG)');
                this.value = '';
                return;
            }

            // Validar el tamaño del archivo (máximo 5MB)
            const maxSize = 5 * 1024 * 1024; // 5MB en bytes
            if (file.size > maxSize) {
                alert('La imagen es demasiado grande. El tamaño máximo es 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (currentImage) {
                    currentImage.style.display = 'none';
                }
            }
            
            reader.onerror = function() {
                alert('Error al leer el archivo');
                this.value = '';
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            if (currentImage) {
                currentImage.style.display = 'block';
            }
        }
    });

    // ... (mantener el resto del código JavaScript existente) ...
});
</script>
</body>
</html>