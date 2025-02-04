@extends('layouts.app')

@section('title', 'Usuarios')

@section('styles')
<style>
    /* Search Component */
    .search-container {
        position: relative;
        max-width: 100%;
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.25);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Usuarios</h1>
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
                    <input type="text" id="usuarioSearchInput" class="search-input"
                        placeholder="Buscar usuario..." autocomplete="off">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody id="usuariosTableBody">
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <span class="fw-medium">{{ $user->nombres }} {{ $user->apellidos }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @switch($user->rol)
                                    @case(1)
                                        Administrador
                                        @break
                                    @case(2)
                                        Empleado
                                        @break
                                    @case(3)
                                        Cliente
                                        @break
                                    @default
                                        {{ $user->rol }}
                                @endswitch
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('usuarios.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-fill"></i>
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar al usuario
                                            "{{ $user->nombres }} {{ $user->apellidos }}"?</p>
                                        <p class="text-danger mb-0">Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form
                                            action="{{ route('usuarios.destroy', $user->id) }}"
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
                            <td colspan="5" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-people-fill display-4 text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No se encontraron usuarios</p>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeSearch('usuariosTableBody', 'usuarioSearchInput');
    });

    // Search functionality
    function initializeSearch(tableId, searchInputId) {
        const searchInput = document.getElementById(searchInputId);
        const tableBody = document.getElementById(tableId);
        let searchTimeout;

        if (!searchInput || !tableBody) return;

        // Guardar el contenido original de la tabla
        const originalTableContent = tableBody.innerHTML;

        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();

            // Clear previous timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            // Show loading state
            tableBody.closest('.table-responsive').classList.add('loading-table', 'active');

            // Debounce search
            searchTimeout = setTimeout(() => {
                const rows = tableBody.getElementsByTagName('tr');

                // Si el término de búsqueda está vacío, restablecer la tabla al estado original
                if (searchTerm === "") {
                    tableBody.innerHTML = originalTableContent;
                    tableBody.closest('.table-responsive').classList.remove('loading-table', 'active');
                    return;
                }

                Array.from(rows).forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });

                // Remove loading state
                tableBody.closest('.table-responsive').classList.remove('loading-table', 'active');

                // Show no results message if needed
                const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
                if (visibleRows.length === 0) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.innerHTML = `
                        <td colspan="5" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-search display-4 text-muted mb-2"></i>
                                <p class="text-muted mb-0">No se encontraron resultados para "${searchTerm}"</p>
                            </div>
                        </td>
                    `;
                    tableBody.innerHTML = '';
                    tableBody.appendChild(noResultsRow);
                }
            }, 300);
        });
    }
</script>
@endsection

