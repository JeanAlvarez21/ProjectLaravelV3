@extends('layouts.app')

@section('title', 'Familias')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Familias</h1>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Nueva Familia
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

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="categoriaSearchInput" class="search-input" placeholder="Buscar familia..."
                        autocomplete="off">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody id="categoriasTableBody">
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id_categoria }}</td>
                            <td>
                                <span class="fw-medium">{{ $categoria->nombre_categoria }}</span>
                            </td>
                            <td>{{ Str::limit($categoria->descripcion_categoria, 50) }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('categorias.edit', $categoria->id_categoria) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-fill"></i>
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $categoria->id_categoria }}">
                                        <i class="bi bi-trash3-fill"></i>
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $categoria->id_categoria }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar la familia
                                            "{{ $categoria->nombre_categoria }}"?</p>
                                        <p class="text-danger mb-0">Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash3-fill"></i>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-folder-x display-4 text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No se encontraron familias</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/searchbar.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeSearch('categoriasTableBody', 'categoriaSearchInput');
    });
</script>
@endsection