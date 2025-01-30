@extends('layouts.app2')

@section('title', 'Carrito de Compras')

@section('styles')
<style>
    :root {
        --primary-color: #ffd700;
        --secondary-color: #495e57;
        --background-color: #f0f4f8;
        --text-color: #333;
        --card-bg: #ffffff;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        font-family: 'Poppins', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .card {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .table thead th {
        border-bottom: none;
        text-transform: uppercase;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .table tbody tr {
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        transform: scale(1.02);
    }

    .btn-custom {
        background-color: var(--primary-color);
        color: white;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: var(--primary-color);
    }

    .quantity-input {
        max-width: 70px;
        text-align: center;
        border-radius: 20px;
        border: 2px solid var(--primary-color);
    }

    .update-cart,
    .remove-from-cart {
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .update-cart:hover,
    .remove-from-cart:hover {
        transform: rotate(15deg);
    }

    #cart-total {
        font-size: 1.5rem;
        color: var(--secundary-color);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection

@section('content')
<main class="container my-5">
    <h1 class="text-center mb-5 fw-bold" style="color: var(--secundary-color); font-size: 3rem;">Tu Carrito de Compras
    </h1>
    <div id="alert-container"></div>

    @if(!empty($cart))
        <div class="card shadow fade-in">
            <div class="card-body">
                <div class="alert alert-info text-center mb-4" style="background-color: #e3f2fd; border-color: #90caf9;">
                    <i class="bi bi-info-circle-fill me-2" style="color: var(--secondary-color);"></i>
                    <strong>Nota:</strong> Los proyectos tienen una tarifa adicional de <strong
                        style="color: var(--secondary-color);">$5.00 USD</strong> por el servicio de corte.
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto/Proyecto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                                @php 
                                    $subtotal = floatval($details['price']) * intval($details['quantity']);
                                @endphp
                                <tr data-id="{{ $id }}" data-type="{{ $details['type'] }}" class="fade-in"
                                    style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}"
                                                class="cart-item-image me-3">
                                            <div>
                                                <h6 class="mb-0">{{ $details['name'] }}</h6>
                                                @if($details['type'] == 'proyecto')
                                                    <span class="badge bg-info">Proyecto</span>
                                                    <span class="badge" style="background-color: var(--secondary-color);">(+$5
                                                        USD)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" class="form-control quantity-input"
                                                value="{{ $details['quantity'] }}" min="1" @if($details['type'] == 'producto')
                                                max="{{ $details['stock'] }}" @endif>
                                            <button class="btn btn-outline-primary update-cart">
                                                <i class="bi bi-check2"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td class="subtotal fw-bold">${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger remove-from-cart">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <h3>Total: <span id="cart-total">${{ number_format($total, 2) }}</span></h3>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4 fade-in" style="animation-delay: 0.5s;">
            <a href="{{ route('productos.clientes') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Continuar Comprando
            </a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-custom btn-lg">
                Proceder al Checkout <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    @else
        <div class="text-center py-5 fade-in">
            <i class="bi bi-cart-x empty-cart-icon mb-3 d-block"></i>
            <h2 class="mb-3">Tu carrito está vacío</h2>
            <p class="mb-4">¿Por qué no agregas algunos productos increíbles?</p>
            <a href="{{ route('productos.clientes') }}" class="btn btn-custom btn-lg">Explorar Productos</a>
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
                confirmButtonColor: '#4a90e2',
                cancelButtonColor: '#f39c12',
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
                            ele.closest('tr').fadeOut(300, function () {
                                $(this).remove();
                                $('#cart-total').text('$' + response.total);
                                showAlert('Producto eliminado del carrito');

                                if ($('tbody tr').length === 0) {
                                    location.reload();
                                }
                            });
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