@extends('layouts.app2')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Detalles del Proyecto: {{ $proyecto->nombre }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-body">
            <h5 class="card-title">Cortes</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Dimensiones (mm)</th>
                            <th>Precio Corte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyecto->cortes as $corte)
                            <tr>
                                <td>{{ $corte->producto->nombre }}</td>
                                <td>{{ $corte->cantidad }}</td>
                                <td>{{ $corte->largo }} x {{ $corte->ancho }} x {{ $corte->espesor }}</td>
                                <td>${{ number_format($corte->precio_corte, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Mis Proyectos
        </a>
        <form action="{{ route('proyectos.addToCart', $proyecto) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fas fa-cart-plus"></i> Agregar al Carrito
            </button>
        </form>
    </div>
</div>
@endsection