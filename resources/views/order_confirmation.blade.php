@extends('layouts.app2')

@section('title', 'Confirmación de Pedido')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Confirmación de Pedido</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumen del Pedido</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto/Proyecto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                                <tr>
                                    <td>
                                        {{ $details['name'] }}
                                        @if($details['type'] == 'proyecto')
                                            <span class="badge bg-info">Proyecto</span>
                                        @endif
                                    </td>
                                    <td>{{ $details['quantity'] ?? 1 }}</td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td>${{ number_format(($details['price'] * ($details['quantity'] ?? 1)), 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>${{ number_format($total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>

                    <form action="{{ route('pedidos.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="direccion_pedido" class="form-label">Dirección de Entrega</label>
                            <textarea name="direccion_pedido" id="direccion_pedido" class="form-control"
                                required>{{ old('direccion_pedido', Auth::user()->direccion) }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Confirmar y Ver Detalles</button>
                            <a href="{{ route('cart.view') }}" class="btn btn-secondary">Volver al Carrito</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection