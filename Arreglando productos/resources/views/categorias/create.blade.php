<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Categoría - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Añadir Nueva Categoría</h1>
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre de Categoría</label>
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir Categoría</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
</body>

</html>