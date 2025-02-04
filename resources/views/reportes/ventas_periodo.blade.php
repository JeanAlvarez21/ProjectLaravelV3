@extends('layouts.app')

@section('title', 'Reporte de Ventas por Período')

@section('styles')
<style>
    .chart-container {
        width: 100%;
        height: 400px;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Reporte de Ventas</h1>
    <div>
        <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
            <i class="bi bi-file-pdf"></i> Exportar PDF
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}</h5>
        <div class="chart-container">
            <canvas id="ventasChart"></canvas>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Pedidos</th>
                        <th>Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                                                                        $totalVentas = 0;
                        $totalPedidos = 0; 
                    @endphp
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

<div class="row g-3">
    <div class="col-12 col-md-4">
        <div class="card h-100 bg-primary text-white">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Ventas</h6>
                <h3 class="card-title mb-0">${{ number_format($totalVentas, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card h-100 bg-success text-white">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Pedidos</h6>
                <h3 class="card-title mb-0">{{ $totalPedidos }}</h3>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card h-100 bg-info text-white">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Promedio por Pedido</h6>
                <h3 class="card-title mb-0">
                    ${{ $totalPedidos > 0 ? number_format($totalVentas / $totalPedidos, 2) : '0.00' }}
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
@endsection