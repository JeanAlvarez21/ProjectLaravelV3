<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pedidos - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
</head>

<body>

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
                <a href="/productos" class="nav-item ">
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
                <a href="/pedidos" class="nav-item active">
                    <i class="bi bi-cart-fill"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/reportes" class="nav-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @else
                <a href="/productos" class="nav-item ">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
                <a href="/categorias" class="nav-item">
                    <i class="bi bi-folder-fill"></i>
                    <span>Familias</span>
                </a>
                <a href="/pedidos" class="nav-item active">
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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Pedidos</h1>
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="search-container">
                                <i class="bi bi-search search-icon"></i>
                                <input type="text" id="pedidoSearchInput" class="search-input"
                                    placeholder="Buscar pedido..." autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="pedidosTableBody">
                                @forelse($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->id_pedido }}</td>
                                        <td>{{ $pedido->usuario->nombres}} {{ $pedido->usuario->apellidos}}</td>
                                        <td>{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</td>
                                        <td>${{ number_format($pedido->total, 2) }}</td>
                                        <td>
                                            <select class="form-select form-select-sm estado-pedido"
                                                data-pedido-id="{{ $pedido->id_pedido }}">
                                                @foreach(\App\Models\EstadoPedido::all() as $estado)
                                                    <option value="{{ $estado->id }}" {{ $pedido->id_estado == $estado->id ? 'selected' : '' }}>
                                                        {{ $estado->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('pedidos.show', $pedido->id_pedido) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye-fill"></i>
                                                Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-cart-x display-4 text-muted mb-2"></i>
                                                <p class="text-muted mb-0">No se encontraron pedidos</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeSearch('pedidosTableBody', 'pedidoSearchInput');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeSearch('pedidosTableBody', 'pedidoSearchInput');

            // Manejar el cambio de estado del pedido
            document.querySelectorAll('.estado-pedido').forEach(select => {
                select.addEventListener('change', function () {
                    const pedidoId = this.dataset.pedidoId;
                    const nuevoEstadoId = this.value;

                    // Mostrar el indicador de carga
                    document.querySelector('.loading-indicator').style.display = 'flex';

                    // Realizar la petición AJAX para actualizar el estado
                    fetch(`/pedidos/${pedidoId}/actualizar-estado`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ id_estado: nuevoEstadoId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Estado actualizado con éxito');
                            } else {
                                console.error('Error al actualizar el estado');
                                this.value = this.dataset.lastValue;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.value = this.dataset.lastValue;
                        })
                        .finally(() => {
                            // Ocultar el indicador de carga
                            document.querySelector('.loading-indicator').style.display = 'none';
                        });

                    // Guardar el valor seleccionado para posible reversión
                    this.dataset.lastValue = this.value;
                });
            });
        });
    </script>

</body>

</html>