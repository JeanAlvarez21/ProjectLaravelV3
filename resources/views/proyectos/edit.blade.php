<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Editar Proyecto</h1>
        <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proyecto->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $proyecto->ciudad }}" required>
            </div>
            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" id="local" name="local" value="{{ $proyecto->local }}" required>
            </div>
            <div class="mb-3">
                <label for="pedido_id" class="form-label">Pedido Asociado</label>
                <select class="form-control" id="pedido_id" name="pedido_id" required>
                    @foreach($pedidos as $pedido)
                        <option value="{{ $pedido->id }}" {{ $proyecto->pedido_id == $pedido->id ? 'selected' : '' }}>
                            {{ $pedido->id }} - {{ $pedido->direccion_pedido }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>
