@extends('layouts.app')

@section('title', 'Clientes Top')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Clientes Top</h1>
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
                        <th>Cliente</th>
                        <th>Cédula</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Total Pedidos</th>
                        <th>Total Gastado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->name }}</td>
                            <td>{{ $cliente->cedula }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->total_pedidos }}</td>
                            <td>${{ number_format($cliente->total_gastado, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection