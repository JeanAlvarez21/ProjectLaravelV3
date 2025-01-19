<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortes - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Lista de Cortes</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form method="GET" action="{{ route('cortes.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Buscar corte"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Buscar</button>
            </form>
            <a href="{{ route('cortes.create') }}" class="btn btn-primary">Añadir nuevo corte</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Medidas</th>
                        <th>Tipo de Borde</th>
                        <th>Color de Borde</th>
                        <th>Precio Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cortes as $corte)
                        <tr>
                            <td>{{ $corte->id }}</td>
                            <td>{{ $corte->proyecto->nombre ?? 'N/A' }}</td>
                            <td>{{ $corte->producto->nombre ?? 'N/A' }}</td>
                            <td>{{ $corte->cantidad }}</td>
                            <td>{{ $corte->medidas }}</td>
                            <td>{{ $corte->tipo_borde }}</td>
                            <td>{{ $corte->color_borde }}</td>
                            <td>{{ $corte->precio_total }}</td>
                            <td>
                                <a href="{{ route('cortes.edit', $corte->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('cortes.destroy', $corte->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este corte?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay cortes disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
