@extends('layouts.app')

@section('title', 'Editar Producto - Novocentro')

@section('content')
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

                    <form action="{{ route('productos.update', $producto->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="codigo_producto" class="form-label">Código del Producto</label>
                                    <input type="text" class="form-control" id="codigo_producto" name="codigo_producto"
                                        value="{{ old('codigo_producto', $producto->codigo_producto) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre', $producto->nombre) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Dimensiones</label>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label for="largo" class="form-label text-muted small">Largo (mm)</label>
                                            <input type="number" class="form-control" id="largo" name="largo"
                                                value="{{ old('largo', $largo) }}" required min="1">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ancho" class="form-label text-muted small">Ancho (mm)</label>
                                            <input type="number" class="form-control" id="ancho" name="ancho"
                                                value="{{ old('ancho', $ancho) }}" required min="1">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="grosor" class="form-label text-muted small">Grosor (mm)</label>
                                            <input type="number" class="form-control" id="grosor" name="grosor"
                                                value="{{ old('grosor', $grosor) }}" required min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="descripcion_opcional" class="form-label">Descripción adicional
                                        (opcional)</label>
                                    <textarea class="form-control" id="descripcion_opcional" name="descripcion_opcional"
                                        rows="4">{{ old('descripcion_opcional', $descripcion_opcional) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio" name="precio"
                                            value="{{ old('precio', $producto->precio) }}" required min="0" step="0.01">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="costo" class="form-label">Costo</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="costo" name="costo"
                                            value="{{ old('costo', $producto->costo) }}" required min="0" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_categoria" class="form-label">Categoría</label>
                                    <select class="form-select" id="id_categoria" name="id_categoria" required>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                                                {{ $categoria->nombre_categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock', $producto->stock) }}" required min="0">
                                </div>

                                <div class="mb-3">
                                    <label for="min_stock" class="form-label">Stock Mínimo</label>
                                    <input type="number" class="form-control" id="min_stock" name="min_stock"
                                        value="{{ old('min_stock', $producto->min_stock) }}" required min="0">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="visible" class="form-label">Visibilidad</label>
                                    <select class="form-select" id="visible" name="visible" required>
                                        <option value="1" {{ old('visible', $producto->visible) == 1 ? 'selected' : '' }}>
                                            Visible</option>
                                        <option value="0" {{ old('visible', $producto->visible) == 0 ? 'selected' : '' }}>
                                            No visible</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nombre_sucursal" class="form-label">Nombre de la Sucursal</label>
                                    <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal"
                                        value="{{ old('nombre_sucursal', $producto->nombre_sucursal) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal</label>
                                    <input type="text" class="form-control" id="direccion_sucursal"
                                        name="direccion_sucursal"
                                        value="{{ old('direccion_sucursal', $producto->direccion_sucursal) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">Imagen del Producto</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                    @if($producto->link_imagen)
                                        <img src="{{ asset('storage/' . $producto->link_imagen) }}"
                                            alt="Imagen actual del producto" class="mt-2" style="max-width: 200px;">
                                    @endif
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
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/searchbar.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mantener todo el código JavaScript existente

        // Añadir el código para la vista previa de imagen
        const imagen = document.getElementById('imagen');
        const preview = document.getElementById('preview');
        const currentImage = document.querySelector('.current-image');

        imagen.addEventListener('change', function (e) {
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

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                }

                reader.onerror = function () {
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
@endsection