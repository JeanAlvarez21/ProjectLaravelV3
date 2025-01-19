<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corte - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Editar Corte</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cortes.update', $corte->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="proyecto_id" class="form-label">Proyecto</label>
                <select name="proyecto_id" id="proyecto_id" class="form-control" required>
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ $corte->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="producto_id" id="producto_id" class="form-control" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" {{ $corte->producto_id == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $corte->cantidad }}" required>
            </div>
            <div class="mb-3">
                <label for="medidas" class="form-label">Medidas</label>
                <input type="text" name="medidas" id="medidas" class="form-control" value="{{ $corte->medidas }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo_borde" class="form-label">Tipo de Borde</label>
                <input type="text" name="tipo_borde" id="tipo_borde" class="form-control" value="{{ $corte->tipo_borde }}" required>
            </div>
            <div class="mb-3">
                <label for="color_borde" class="form-label">Color de Borde</label>
                <input type="text" name="color_borde" id="color_borde" class="form-control" value="{{ $corte->color_borde }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_corte" class="form-label">Descripción</label>
                <textarea name="descripcion_corte" id="descripcion_corte" class="form-control" rows="3">{{ $corte->descripcion_corte }}</textarea>
            </div>
            <div class="mb-3">
                <label for="precio_total" class="form-label">Precio Total</label>
                <input type="number" step="0.01" name="precio_total" id="precio_total" class="form-control" value="{{ $corte->precio_total }}" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>
