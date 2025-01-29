@extends('layouts.app2')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Catálogo de Productos</h1>
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="{{ asset($producto->link_imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                        <p class="card-text">
                            <strong>Stock:</strong>
                            @if($producto->stock > 0)
                                <span class="stock-display">{{ $producto->stock }}</span> unidades disponibles
                            @else
                                <span class="text-danger">Agotado</span>
                            @endif
                        </p>
                        @auth
                            <form class="add-to-cart-form" data-product-name="{{ $producto->nombre }}"
                                action="{{ route('cart.add') }}" method="POST" @if($producto->stock == 0) style="display: none;"
                                @endif>
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto->id }}">
                                <div class="form-group">
                                    <label for="cantidad-{{ $producto->id }}">Cantidad:</label>
                                    <input type="number" name="quantity" id="cantidad-{{ $producto->id }}" min="1"
                                        max="{{ $producto->stock }}" value="1" class="form-control quantity-input" required
                                        data-stock="{{ $producto->stock }}">
                                </div>
                                <button type="submit" class="btn btn-custom mt-2">Agregar al carrito</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-custom mt-2">Iniciar sesión para comprar</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Mensaje Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Mensaje del sistema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartForms = document.querySelectorAll('.add-to-cart-form');
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        const messageContent = document.getElementById('messageContent');

        // Función para crear notificación
        async function createNotification(productName, quantity) {
            try {
                const response = await fetch('{{ route("notificaciones.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: 'Producto agregado al carrito',
                        message: `Has agregado ${quantity} unidad(es) de ${productName} a tu carrito de compras.`,
                        user_id: {{ Auth::check() ? Auth::id() : 'null' }}
                    })
                });

                if (!response.ok) {
                    throw new Error('Error al crear la notificación');
                }

                return await response.json();
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Manejar envío del formulario
        addToCartForms.forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const quantityInput = this.querySelector('.quantity-input');
                const stock = parseInt(quantityInput.dataset.stock);
                const quantity = parseInt(quantityInput.value);
                const productName = this.dataset.productName;

                if (quantity > stock) {
                    messageContent.textContent = "La cantidad seleccionada supera el stock disponible.";
                    messageModal.show();
                    quantityInput.value = stock;
                    return;
                }

                try {
                    const formData = new FormData(this);
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Error al agregar al carrito');
                    }

                    // Crear notificación
                    await createNotification(productName, quantity);

                    // Actualizar contador del carrito
                    const cartBadge = document.querySelector('.badge.bg-primary');
                    if (cartBadge) {
                        const currentCount = parseInt(cartBadge.textContent || '0');
                        cartBadge.textContent = currentCount + 1;
                    }

                    messageContent.textContent = data.success || "Producto agregado al carrito con éxito.";
                    messageModal.show();

                } catch (error) {
                    console.error('Error:', error);
                    messageContent.textContent = "Ocurrió un error al procesar tu solicitud: " + error.message;
                    messageModal.show();
                }
            });
        });
    });
</script>
@endsection