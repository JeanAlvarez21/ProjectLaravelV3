@extends('layouts.app')

@section('title', 'Reportes')


@section('content')

<h1 class="mb-4">Reportes y Consultas</h1>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Ventas por Período</h5>
                <p class="card-text">Analiza las ventas realizadas en un período específico.</p>
                <form action="{{ route('reportes.ventas-periodo') }}" method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="date" name="fecha_inicio" class="form-control"
                                value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="fecha_fin" class="form-control"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ver</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('reportes.ventas-periodo', ['export' => 'pdf']) }}" class="btn btn-secondary">
                    <i class="bi bi-file-pdf"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Productos más Populares</h5>
                <p class="card-text">Visualiza los productos más vendidos y sus estadísticas.</p>
                <form action="{{ route('reportes.productos-populares') }}" method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="date" name="fecha_inicio" class="form-control"
                                value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="fecha_fin" class="form-control"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ver</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('reportes.productos-populares', ['export' => 'pdf']) }}" class="btn btn-secondary">
                    <i class="bi bi-file-pdf"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Inventario Bajo</h5>
                <p class="card-text">Revisa los productos con stock bajo que necesitan reposición.</p>
                <a href="{{ route('reportes.inventario-bajo') }}" class="btn btn-primary mb-2">Ver</a>
                <a href="{{ route('reportes.inventario-bajo', ['export' => 'pdf']) }}" class="btn btn-secondary">
                    <i class="bi bi-file-pdf"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Clientes Top</h5>
                <p class="card-text">Identifica a tus mejores clientes por volumen de compras.</p>
                <form action="{{ route('reportes.clientes-top') }}" method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="date" name="fecha_inicio" class="form-control"
                                value="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="fecha_fin" class="form-control"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ver</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('reportes.clientes-top', ['export' => 'pdf']) }}" class="btn btn-secondary">
                    <i class="bi bi-file-pdf"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection