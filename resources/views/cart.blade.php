@extends('layouts.app2')

@section('title', 'Carrito de Compras')

@section('content')
<main class="container my-5">
    <h1 class="text-center mb-5">Carrito de Compras</h1>
    <div id="alert-container"></div>
    
    @if(session('cart'))
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning text-center">
                    <strong>Nota:</strong> Los proyectos tienen una tarifa adicional de <strong>$5.00 USD</strong> por el servicio de corte.
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Producto/Proyecto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr data-id="{{ $id }}" data-name="{{ $details['name'] }}" data-type="{{ $details['type'] }}">
                                    <td>
                                        {{ $details['name'] }}
                                        @if($details['type'] == 'proyecto')
                                            <span class="badge bg-info">Proyecto</span>
                                            <span class="text-danger fw-bold">(+$5 USD)</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="input-group" style="width: 130px;">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                                class="form-control quantity" min="1" 
                                                @if($details['type'] == 'producto') max="{{ $details['stock'] }}" @endif
                                                style="width: 70px;" />
                                            <button class="btn btn-primary btn-sm update-cart">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td class="product-subtotal">
                                        ${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-from-cart">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td id="cart-total">${{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('productos.clientes') }}" class="btn btn-custom">Continuar Comprando</a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceder al Checkout</a>
        </div>
    @else
        <div class="alert alert-info text-center" role="alert">
            Tu carrito está vacío. <a href="{{ route('productos.clientes') }}">Continuar comprando</a>
        </div>
    @endif
</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.update-cart').click(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    id: ele.parents("tr").attr("data-id"), 
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $('.remove-from-cart').click(function(e) {
            e.preventDefault();
            var ele = $(this);
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres eliminar este producto del carrito?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "DELETE",
                        data: {
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El producto ha sido eliminado del carrito.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error',
                                'Ha ocurrido un error al eliminar el producto.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endsection