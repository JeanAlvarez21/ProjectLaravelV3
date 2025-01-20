<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Listado de Pedidos</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id_pedido }}</td>
                                    <td>{{ $pedido->usuario->name }}</td>
                                    <td>
                                        @if($pedido->fecha_pedido instanceof \Carbon\Carbon)
                                            {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                        @endif
                                    </td>
                                    <td>${{ number_format($pedido->total, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $pedido->estado == 'Completado' ? 'success' : 'warning' }}">
                                            {{ $pedido->estado ?? 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('pedidos.show', $pedido->id_pedido) }}"
                                            class="btn btn-sm btn-primary">
                                            Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>