<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Producto - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <style>
        :root {
    --primary-color: #FFD700;
    --primary-dark: #E6C200;
    --sidebar-width: 280px;
    --header-height: 70px;
    --card-border-radius: 12px;
    --transition-speed: 0.3s;
}

/* Loading Indicators */
.loading-indicator {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-indicator.active {
    display: flex;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid var(--primary-color);
    animation: spin 1s linear infinite;
}

.loading-table {
    position: relative;
    min-height: 200px;
}

.loading-table::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
}

.loading-table.active::after {
    content: '⌛ Cargando...';
}

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

/* Base Styles */
body {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    background-color: #f8f9fa;
    display: flex;
    min-height: 100vh;
    margin: 0;
    width: 100%;
}

/* Sidebar Styles */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    min-height: 100vh;
    padding: 1.5rem;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
    z-index: 1000;
    overflow-y: auto;
    transition: transform var(--transition-speed) ease;
}

.logo {
    margin-bottom: 2.5rem;
    padding: 0.5rem;
    text-align: center;
}

.logo img {
    height: auto;
    width: 80%;
    max-width: 200px;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.nav-item {
    padding: 0.875rem 1.25rem;
    margin-bottom: 0.5rem;
    border-radius: 10px;
    color: rgba(0, 0, 0, 0.8);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--transition-speed) ease;
    font-weight: 500;
}

.nav-item i {
    font-size: 1.25rem;
}

.nav-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #000;
    transform: translateX(5px);
}

.nav-item.active {
    background-color: #fff;
    color: #000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Content Styles */
.content {
    margin-left: var(--sidebar-width);
    padding: 2rem;
    width: calc(100% - var(--sidebar-width));
    transition: margin-left var(--transition-speed) ease;
}

/* Card Styles */
.card {
    border: none;
    border-radius: var(--card-border-radius);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
    transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
    margin-bottom: 1.5rem;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

/* Button Styles */
.btn-logout {
    background-color: #fff;
    color: #dc3545;
    border: 1px solid #dc3545;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    cursor: pointer;
    text-align: center;
    width: 100%;
    margin-top: 2rem;
    font-weight: 500;
    transition: all var(--transition-speed) ease;
}

.btn-logout:hover {
    background-color: #dc3545;
    color: #fff;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .sidebar {
        width: 80px;
    }

    .sidebar .nav-item span,
    .sidebar .btn-logout span {
        display: none;
    }

    .content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .logo img {
        width: 40px;
    }
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .content {
        margin-left: 0;
        width: 100%;
    }

    .sidebar-toggle {
        display: block;
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1001;
    }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
            margin-top: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #344767;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        .card {
            border: none;
            box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.15);
        }

        .card-body {
            padding: 2rem;
        }
    </style>
</head>
<body>
    <!-- Loading Indicator -->
    <div class="loading-indicator">
        <div class="loading-spinner"></div>
    </div>

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
                <a href="/productos" class="nav-item active">
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
                <a href="/pedidos" class="nav-item">
                    <i class="bi bi-cart-fill"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/reportes" class="nav-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Reportes</span>
                </a>
            @else
                <a href="/productos" class="nav-item active">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Productos</span>
                </a>
                <a href="/categorias" class="nav-item">
                    <i class="bi bi-folder-fill"></i>
                    <span>Familias</span>
                </a>
                <a href="/pedidos" class="nav-item">
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
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h1 class="h3 mb-0">Crear Nuevo Producto</h1>
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

                            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" id="createProductForm">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="codigo_producto" class="form-label">Código del Producto</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="codigo_producto"
                                                    name="codigo_producto" required value="{{ old('codigo_producto') }}"
                                                    placeholder="Ej: PRD001">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre del Producto</label>
                                            <input type="text" class="form-control" id="nombre"
                                                name="nombre" required value="{{ old('nombre') }}"
                                                placeholder="Ej: Tablero MDF">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Dimensiones</label>
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <label for="largo" class="form-label text-muted small">Largo (mm)</label>
                                                    <input type="number" class="form-control" id="largo" name="largo"
                                                        placeholder="2440" required min="1" value="{{ old('largo') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="ancho" class="form-label text-muted small">Ancho (mm)</label>
                                                    <input type="number" class="form-control" id="ancho" name="ancho"
                                                        placeholder="1220" required min="1" value="{{ old('ancho') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="grosor" class="form-label text-muted small">Grosor (mm)</label>
                                                    <input type="number" class="form-control" id="grosor" name="grosor"
                                                        placeholder="18" required min="1" value="{{ old('grosor') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="descripcion_opcional" class="form-label">Descripción adicional (opcional)</label>
                                            <textarea class="form-control" id="descripcion_opcional" name="descripcion_opcional"
                                                rows="4" placeholder="Ingrese una descripción detallada del producto">{{ old('descripcion_opcional') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="precio" name="precio"
                                                    required min="0" step="0.01" value="{{ old('precio') }}"
                                                    placeholder="0.00">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="costo" class="form-label">Costo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="costo" name="costo"
                                                    required min="0" step="0.01" value="{{ old('costo') }}"
                                                    placeholder="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Cantidad en Inventario</label>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                required min="0" step="1" value="{{ old('stock', 0) }}"
                                                placeholder="0">
                                        </div>

                                        <div class="mb-3">
                                            <label for="min_stock" class="form-label">Stock Mínimo</label>
                                            <input type="number" class="form-control" id="min_stock" name="min_stock"
                                                required min="0" step="1" value="{{ old('min_stock', 5) }}"
                                                placeholder="5">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="id_categoria" class="form-label">Familia</label>
                                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                                <option value="">Seleccione una familia</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id_categoria }}"
                                                        {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                                        {{ $categoria->nombre_categoria }}
                                                    </option>
                                                @endforeach
                                                <option value="nueva">+ Agregar nueva Familia</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 d-none" id="nuevaCategoriaDiv">
                                            <label for="nueva_categoria" class="form-label">Nueva Familia</label>
                                            <input type="text" class="form-control" id="nueva_categoria"
                                                name="nueva_categoria" value="{{ old('nueva_categoria') }}"
                                                placeholder="Nombre de la nueva familia">
                                        </div>

                                        <div class="mb-3 d-none" id="descripcionCategoriaDiv">
                                            <label for="descripcion_categoria" class="form-label">Descripción de la Nueva Familia</label>
                                            <input type="text" class="form-control" id="descripcion_categoria"
                                                name="descripcion_categoria" value="{{ old('descripcion_categoria') }}"
                                                placeholder="Breve descripción de la familia">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="imagen" class="form-label">Imagen del Producto</label>
                                            <input type="file" class="form-control" id="imagen" name="imagen"
                                                accept="image/jpeg,image/png,image/jpg" required>
                                            <img id="preview" class="preview-image d-none" alt="Vista previa de la imagen">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nombre_sucursal" class="form-label">Nombre de la Sucursal</label>
                                            <input type="text" class="form-control" id="nombre_sucursal"
                                                name="nombre_sucursal" value="Loja" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="direccion_sucursal" class="form-label">Dirección de la Sucursal</label>
                                            <select class="form-select" id="direccion_sucursal" name="direccion_sucursal" required>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="Norte" {{ old('direccion_sucursal') == 'Norte' ? 'selected' : '' }}>Norte</option>
                                                <option value="Sur" {{ old('direccion_sucursal') == 'Sur' ? 'selected' : '' }}>Sur</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="visible" class="form-label">Visibilidad</label>
                                            <select name="visible" class="form-select">
                                                <option value="1" {{ old('visible', '1') == '1' ? 'selected' : '' }}>Público</option>
                                                <option value="0" {{ old('visible') == '0' ? 'selected' : '' }}>Privado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-lg"></i>
                                                Guardar Producto
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview
            const imagen = document.getElementById('imagen');
            const preview = document.getElementById('preview');
            
            imagen.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    
                    reader.readAsDataURL(file);
                } else {
                    preview.classList.add('d-none');
                    preview.src = '';
                }
            });

            // Nueva categoria toggle
            const idCategoria = document.getElementById('id_categoria');
            const nuevaCategoriaDiv = document.getElementById('nuevaCategoriaDiv');
            const descripcionCategoriaDiv = document.getElementById('descripcionCategoriaDiv');
            const nuevaCategoria = document.getElementById('nueva_categoria');
            const descripcionCategoria = document.getElementById('descripcion_categoria');

            idCategoria.addEventListener('change', function() {
                if (this.value === 'nueva') {
                    nuevaCategoriaDiv.classList.remove('d-none');
                    descripcionCategoriaDiv.classList.remove('d-none');
                    nuevaCategoria.required = true;
                    descripcionCategoria.required = true;
                } else {
                    nuevaCategoriaDiv.classList.add('d-none');
                    descripcionCategoriaDiv.classList.add('d-none');
                    nuevaCategoria.required = false;
                    descripcionCategoria.required = false;
                }
            });

            // Form validation
            const form = document.getElementById('createProductForm');
            form.addEventListener('submit', function(e) {
                if (idCategoria.value === 'nueva' && !nuevaCategoria.value.trim()) {
                    e.preventDefault();
                    alert('Por favor, ingrese el nombre de la nueva familia');
                    nuevaCategoria.focus();
                }
            });
        });
        // Search functionality
function initializeSearch(tableId, searchInputId) {
    const searchInput = document.getElementById(searchInputId);
    const tableBody = document.getElementById(tableId);
    let searchTimeout;

    if (!searchInput || !tableBody) return;

    searchInput.addEventListener('input', function(e) {
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
                    <td colspan="7" class="text-center py-4">
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

// Loading handlers
function showLoading() {
    const loadingIndicator = document.querySelector('.loading-indicator');
    if (loadingIndicator) {
        loadingIndicator.classList.add('active');
    }
}

function hideLoading() {
    const loadingIndicator = document.querySelector('.loading-indicator');
    if (loadingIndicator) {
        loadingIndicator.classList.remove('active');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add loading indicator for form submissions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', () => {
            showLoading();
        });
    });

    // Add loading indicator for links
    const links = document.querySelectorAll('a:not([href^="#"])');
    links.forEach(link => {
        link.addEventListener('click', () => {
            showLoading();
        });
    });

    // Initialize sidebar toggle
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    }
});
    </script>
</body>
</html>