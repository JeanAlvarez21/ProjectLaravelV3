@extends('layouts.app')

@section('title', 'Productos Populares')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Productos Populares</h1>
    <div>
        <a href="{{ route('reportes.index') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn btn-primary">
            <i class="bi bi-file-pdf"></i> Exportar PDF
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                        <th>Total Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->total_vendido }}</td>
                            <td>${{ number_format($producto->total_ingresos, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection