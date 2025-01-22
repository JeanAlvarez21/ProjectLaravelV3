<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Ver Cortes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFD700;
        }

        h1 {
            color: #333;
        }

        .btn-agregar {
            background-color: #FF6347;
            color: white;
        }

        .btn-agregar:hover {
            background-color: #FF4500;
        }

        .btn-guardar {
            background-color: #28a745;
            color: white;
        }

        .btn-guardar:hover {
            background-color: #218838;
        }

        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('media/logo.png') }}" alt="Logo" class="img-fluid" style="height: 6vh; max-height: 100%; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="/productos">Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/proyectos">Proyectos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Agregar / Ver Cortes del Proyecto: {{ $proyecto->nombre ?? $proyectoTemporal['nombre'] }}</h1>

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Lista de cortes existentes (si el proyecto está guardado) -->
        @if (isset($proyecto) && $proyecto->cortes->isNotEmpty())
            <div class="mt-5">
                <h2 class="mb-3">Cortes Existentes</h2>
                <table class="table table-bordered">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Cantidad</th>
                            <th>Medidas</th>
                            <th>Tipo de Borde</th>
                            <th>Color</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->cortes as $index => $corte)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $corte->cantidad }}</td>
                                <td>{{ $corte->medidas }}</td>
                                <td>{{ $corte->tipo_borde }}</td>
                                <td>{{ $corte->color_borde }}</td>
                                <td>${{ number_format($corte->precio_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Formulario para agregar cortes temporalmente -->
        @if (!isset($proyecto))
            <form action="{{ route('proyectos.guardarCorteTemporal') }}" method="POST">
                @csrf
                <!-- ID del producto -->
                <input type="hidden" name="id_producto" value="{{ $proyectoTemporal['id_producto'] ?? '' }}">
                <!-- Precio total por defecto -->
                <input type="hidden" name="precio_total" value="0">

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" required>
                </div>

                <div class="mb-3">
                    <label for="medidas" class="form-label">Medidas</label>
                    <input type="text" name="medidas" id="medidas" class="form-control" placeholder="Ejemplo: 70x150 mm" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_borde" class="form-label">Tipo de Borde</label>
                    <input type="text" name="tipo_borde" id="tipo_borde" class="form-control" placeholder="Ejemplo: Recto" required>
                </div>

                <div class="mb-3">
                    <label for="color_borde" class="form-label">Color de Borde</label>
                    <input type="text" name="color_borde" id="color_borde" class="form-control" placeholder="Ejemplo: Blanco" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-agregar px-4">Agregar Corte</button>
                </div>
            </form>
        @endif

        <!-- Lista de cortes temporales -->
        @if (session('cortes_temporales'))
            <div class="mt-5">
                <h2 class="mb-3">Cortes Agregados Temporalmente</h2>
                <table class="table table-bordered">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Cantidad</th>
                            <th>Medidas</th>
                            <th>Tipo de Borde</th>
                            <th>Color</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cortes_temporales') as $index => $corte)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $corte['cantidad'] }}</td>
                                <td>{{ $corte['medidas'] }}</td>
                                <td>{{ $corte['tipo_borde'] }}</td>
                                <td>{{ $corte['color_borde'] }}</td>
                                <td>${{ number_format($corte['precio_total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Botón para guardar el proyecto -->
        @if (!isset($proyecto))
            <div class="text-center mt-4">
                <form action="{{ route('proyectos.guardarProyecto') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-guardar px-4">Guardar Proyecto</button>
                </form>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
