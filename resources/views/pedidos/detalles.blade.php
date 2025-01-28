@extends('layouts.app2')

@section('title', 'Detalles del Pedido #' . $pedido->id_pedido)

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .order-details-card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        border-radius: 1rem;
    }

    .status-badge {
        font-size: 0.9rem;
        padding: 0.5em 1em;
    }

    .product-list {
        border-radius: 0.5rem;
    }

    .product-item {
        border-left: none;
        border-right: none;
        padding: 1rem;
    }

    .product-item:first-child {
        border-top: none;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .total-section {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
    }

    .back-button {
        background-color: #FFD700;
        color: #000;
        border: none;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: #FFC800;
        color: #000;
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card order-details-card">
                <div class="card-header bg-white p-4 border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Detalles de Pedido - Código de pedido #{{ $pedido->id_pedido }}</h4>
                        <a href="{{ route('profile') }}" class="btn back-button">
                            Volver al perfil
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Fecha del pedido:</strong><br>
                                {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i:s') }}
                            </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span
                                class="badge status-badge {{ $pedido->estado === 'Completado' ? 'bg-success' : 'bg-warning' }}">
                                {{ $pedido->estado ?? 'Pendiente' }}
                            </span>
                        </div>
                    </div>

                    <div class="products-section mb-4">
                        <h5 class="mb-3">Productos y Proyectos</h5>
                        <div class="list-group product-list">
                            @foreach($pedido->detalles as $detalle)
                                <div class="list-group-item product-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($detalle->producto_id)
                                                <h6 class="mb-1">{{ $detalle->producto->nombre }}</h6>
                                                <small class="text-muted">
                                                    Cantidad: {{ $detalle->cantidad }}
                                                </small>
                                            @elseif($detalle->proyecto_id)
                                                <h6 class="mb-1">Proyecto: {{ $detalle->proyecto->nombre }}</h6>
                                                <small class="text-muted">
                                                    Cantidad: {{ $detalle->cantidad }}
                                                </small>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <div>${{ number_format($detalle->precio, 2) }} x {{ $detalle->cantidad }}</div>
                                            <strong>${{ number_format($detalle->subtotal, 2) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="total-section mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Total del Pedido</h5>
                            <h4 class="mb-0">${{ number_format($pedido->total, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Aquí puedes agregar cualquier script específico para esta vista si es necesario
</script>
@endsection