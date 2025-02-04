@extends('layouts.app')

@section('title', 'Productos - Novocentro')

@section('styles')
<link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Lista de Productos</h1>
                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Nuevo Producto
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <div class="search-container">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="productSearchInput" class="search-input"
                            placeholder="Buscar por código o nombre..." autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="categoriaFilter" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Visibilidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productosTableBody">
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->codigo_producto }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->categoria->nombre_categoria }}</td>
                                <td>${{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    @if($producto->stock <= $producto->min_stock && $producto->stock > 0)
                                        <span class="badge bg-warning text-dark">Bajo stock</span>
                                    @elseif($producto->stock <= 0)
                                        <span class="badge bg-danger">Agotado</span>
                                    @else
                                        <span class="badge bg-success">En stock</span>
                                    @endif
                                </td>
                                <td>
                                    @if($producto->visible)
                                        <span class="badge bg-success">Visible</span>
                                    @else
                                        <span class="badge bg-danger">Oculto</span>
                                    @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('productos.edit', $producto->id) }}"
                                            class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                                onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        initializeSearch('productosTableBody', 'productSearchInput');

        // Category filter functionality
        const categoriaFilter = document.getElementById('categoriaFilter');
        categoriaFilter.addEventListener('change', function () {
            const selectedCategoria = this.value;
            const rows = document.querySelectorAll('#productosTableBody tr');

            rows.forEach(row => {
                const categoriaCell = row.cells[2]?.textContent || '';
                if (!selectedCategoria || categoriaCell.includes(categoriaFilter.options[categoriaFilter.selectedIndex].text)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Show no results message if needed
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            if (visibleRows.length === 0) {
                const noResultsRow = document.createElement('tr');
                noResultsRow.innerHTML = `
                        <td colspan="7" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-search display-4 text-muted mb-2"></i>
                                <p class="text-muted mb-0">No se encontraron productos en esta categoría</p>
                            </div>
                        </td>
                    `;
                document.getElementById('productosTableBody').innerHTML = '';
                document.getElementById('productosTableBody').appendChild(noResultsRow);
            }
        });
    });



</script>
@endsection