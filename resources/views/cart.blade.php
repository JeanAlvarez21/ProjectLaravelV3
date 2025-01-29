@extends('layouts.app2')

@section('title', 'Carrito de Compras')

@section('styles')
<style>
    .cart-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    .quantity-input {
        max-width: 80px;
    }

    .table td {
        vertical-align: middle;
    }

    .empty-cart-icon {
        font-size: 4rem;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<main class="container my-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Tu Carrito de Compras</h1>
    <div id="alert-container"></div>

    @if(session('cart'))
        <div class="card shadow">
            <div class="card-body">
                <div class="alert alert-info text-center mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Nota:</strong> Los proyectos tienen una tarifa adicional de <strong class="text-primary">$5.00
                        USD</strong> por el servicio de corte.
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
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = floatval($details['price']) * intval($details['quantity']);
                                @endphp
                                <tr data-id="{{ $id }}" data-type="{{ $details['type'] }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}"
                                                class="cart-item-image rounded me-3">
                                            <div>
                                                <h6 class="mb-0">{{ $details['name'] }}</h6>
                                                @if($details['type'] == 'proyecto')
                                                    <span class="badge bg-info">Proyecto</span>
                                                    <span class="badge bg-danger">(+$5 USD)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-control-sm quantity-input"
                                                value="{{ $details['quantity'] }}" min="1" @if($details['type'] == 'producto')
                                                max="{{ $details['stock'] }}" @endif>
                                            <button class="btn btn-outline-secondary btn-sm update-cart">
                                                <i class="bi bi-cart-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td class="subtotal fw-bold">${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm remove-from-cart">
                                            <i class="bi bi-cart-x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2" id="cart-total" class="fw-bold fs-5 text-primary">
                                    ${{ number_format($total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('productos.clientes') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Continuar Comprando
            </a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                Proceder al Checkout <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x empty-cart-icon mb-3 d-block"></i>
            <h2 class="mb-3">Tu carrito está vacío</h2>
            <p class="mb-4">¿Por qué no agregas algunos productos increíbles?</p>
            <a href="{{ route('productos.clientes') }}" class="btn btn-primary">Explorar Productos</a>
        </div>
    @endif
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showAlert(message, type = 'success') {
            const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
            $('#alert-container').html(alertHtml);
        }

        $('.update-cart').click(function (e) {
            e.preventDefault();
            var ele = $(this);
            var quantity = ele.closest('tr').find('.quantity-input').val();
            var id = ele.closest('tr').attr('data-id');

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "PATCH",
                data: {
                    id: id,
                    quantity: quantity
                },
                success: function (response) {
                    ele.closest('tr').find('.subtotal').text('$' + response.subtotal);
                    $('#cart-total').text('$' + response.total);
                    showAlert('Carrito actualizado exitosamente');
                },
                error: function (xhr, status, error) {
                    console.error("Error en la actualización del carrito:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);

                    if (xhr.status === 400 && xhr.responseJSON) {
                        showAlert(xhr.responseJSON.error, 'danger');
                        if (xhr.responseJSON.available_stock) {
                            ele.closest('tr').find('.quantity-input').val(xhr.responseJSON.available_stock);
                        }
                    } else {
                        showAlert('Error al actualizar el carrito: ' + error, 'danger');
                    }
                }
            });
        });
        $('.remove-from-cart').click(function (e) {
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
                            id: ele.closest('tr').attr('data-id')
                        },
                        success: function (response) {
                            ele.closest('tr').remove();
                            $('#cart-total').text('$' + response.total);
                            showAlert('Producto eliminado del carrito');

                            if ($('tbody tr').length === 0) {
                                location.reload();
                            }
                        },
                        error: function () {
                            showAlert('Error al eliminar el producto', 'danger');
                        }
                    });
                }
            });
        });

        $('.quantity-input').on('input', function () {
            if ($(this).val() < 1) {
                $(this).val(1);
            }
        });
    });
</script>
@endsection