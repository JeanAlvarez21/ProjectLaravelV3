<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #ffcc00;
            padding: 20px;
        }

        .sidebar a {
            color: #000;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center">NOVOCENTRO</h4>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="#">Productos</a>
            <a href="#">Categorias</a>
            <a href="{{route('usuarios.index')}}">Usuarios</a>
            <a href="#">Facturación</a>
            <a href="#">Reportes</a>
            <hr>
            <a href="#">Configuración</a>
            <a href="#" onclick="document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

         <!-- Main Content -->
         <div class="flex-grow-1 p-4">
            <div class="container-fluid">
                <!-- Tarjetas Resumen -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm">
                            <h5>Usuarios Totales</h5>
                            <h3>40,689</h3>
                            <small class="text-success">8.5% Más que el mes pasado</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm">
                            <h5>Órdenes Totales</h5>
                            <h3>10,293</h3>
                            <small class="text-success">1.3% Más que el mes pasado</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm">
                            <h5>Ventas Totales</h5>
                            <h3>$89,000</h3>
                            <small class="text-danger">4.3% Menos que el mes pasado</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm">
                            <h5>Pedidos Pendientes</h5>
                            <h3>2040</h3>
                            <small class="text-success">1.8% Más que el mes pasado</small>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Ventas -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5>Detalles de las Ventas</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Tabla de Pedidos -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Detalles de Pedidos</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Producto</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>012</td>
                                    <td>Sebastián Mendieta</td>
                                    <td>12.09.2019 - 12:53 PM</td>
                                    <td>3</td>
                                    <td>$34,295</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm">Editar</button>
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                                <!-- Puedes añadir más filas aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para el gráfico -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['5k', '10k', '15k', '20k', '25k', '30k', '35k', '40k', '45k', '50k', '55k', '60k'],
                datasets: [{
                    label: 'Ventas',
                    data: [20, 40, 60, 80, 100, 60, 40, 90, 70, 65, 75, 80],
                    borderColor: 'blue',
                    fill: true,
                    backgroundColor: 'rgba(0, 123, 255, 0.1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>

</html>