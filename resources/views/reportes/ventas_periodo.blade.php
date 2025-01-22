<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Período</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Reporte de Ventas</h1>
            <div>
                <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">Volver</a>
                <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
                    Exportar PDF
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="ventasChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Pedidos</th>
                                    <th>Total Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalVentas = 0;
                                $totalPedidos = 0; @endphp
                                @foreach($ventas as $venta)
                                                                @php 
                                                                                                                                                                                                                                        $totalVentas += $venta->total_ventas;
                                                                    $totalPedidos += $venta->total_pedidos;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                                                                    <td>{{ $venta->total_pedidos }}</td>
                                                                    <td>${{ number_format($venta->total_ventas, 2) }}</td>
                                                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ $totalPedidos }}</strong></td>
                                    <td><strong>${{ number_format($totalVentas, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resumen</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h6 class="card-subtitle">Total Ventas</h6>
                                <h3 class="card-title">${{ number_format($totalVentas, 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h6 class="card-subtitle">Total Pedidos</h6>
                                <h3 class="card-title">{{ $totalPedidos }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h6 class="card-subtitle">Promedio por Pedido</h6>
                                <h3 class="card-title">
                                    ${{ $totalPedidos > 0 ? number_format($totalVentas / $totalPedidos, 2) : '0.00' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('ventasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($ventas->pluck('fecha')->map(function ($fecha) {
    return Carbon\Carbon::parse($fecha)->format('d/m');
})) !!},
                datasets: [{
                    label: 'Ventas Diarias',
                    data: {!! json_encode($ventas->pluck('total_ventas')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Ventas Diarias'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>