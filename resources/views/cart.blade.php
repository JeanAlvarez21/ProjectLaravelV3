<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Novocentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #495E57;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: var(--text-color);
            padding-top: 76px;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .navbar-brand img {
            height: 40px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 40px 0;
        }

        .footer h4 {
            color: var(--primary-color);
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .social-icons a {
            font-size: 1.5rem;
            margin-right: 10px;
            color: white;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .1);
        }

        .card-header {
            background-color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/media/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
            }
        }

        .text-custom {
            color: var(--text-color);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Novocentro Logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.clientes') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/carpinteros">Carpinteros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacto">Contacto</a>
                        @auth
                                @if(Auth::user()->rol == 1)
                                    <li class="nav-item"><a href="/dashboard" class="nav-link no-link">Admin</a></li>
                                @elseif(Auth::user()->rol == 2)
                                    <li class="nav-item"><a href="/productos" class="nav-link no-link">Empleado</a></li>
                                @endif
                        @endauth
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ route('cart.view') }}" class="btn btn-link active">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-primary">{{ count((array) session('cart')) }}</span>
                        </a>
                        <a href="{{ route('profile') }}" class="btn btn-link">
                            <i class="fas fa-user"></i>
                        </a>
                        <a href="{{ route('notificaciones') }}" class="nav-link">
                            <i class="fas fa-bell"></i>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-custom">Cerrar Sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h1 class="text-center mb-5">Carrito de Compras</h1>
        <div id="alert-container"></div>
        @if(session('cart'))
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr data-id="{{ $id }}">
                                        <td>
                                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}"
                                                class="img-thumbnail" width="50">
                                            {{ $details['name'] }}
                                        </td>
                                        <td>
                                            <div class="input-group" style="width: 130px;">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                                    class="form-control quantity" min="1" max="{{ $details['stock'] }}"
                                                    style="width: 70px;" />
                                                <button class="btn btn-primary btn-sm update-cart">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>${{ number_format($details['price'], 2) }}</td>
                                        <td class="product-subtotal">
                                            ${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
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

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4>Novocentro</h4>
                    <p>Transformando la industria de la madera con innovación y calidad desde 1995.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h4>Enlaces Rápidos</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                        <li><a href="{{ route('productos.clientes') }}">Productos</a></li>
                        <li><a href="/proyectos">Proyectos</a></li>
                        <li><a href="/carpinteros">Carpinteros</a></li>
                        <li><a href="/contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Síguenos</h4>
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2023 Novocentro. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function showAlert(message, type) {
                var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
                $('#alert-container').html(alertHtml);
            }

            function updateCartTotal() {
                var total = 0;
                $('.product-subtotal').each(function () {
                    total += parseFloat($(this).text().replace('$', ''));
                });
                $('#cart-total').text('$' + total.toFixed(2));
            }

            $(".update-cart").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                var quantity = ele.closest('tr').find('.quantity').val();
                var id = ele.closest('tr').data('id');

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "POST",  // Changed from PATCH to POST
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function (response) {
                        if (response.success) {
                            showAlert('El carrito se ha actualizado', 'success');
                            var price = parseFloat(ele.closest('tr').find('td:eq(2)').text().replace('$', ''));
                            var subtotal = price * quantity;
                            ele.closest('tr').find('.product-subtotal').text('$' + subtotal.toFixed(2));
                            updateCartTotal();
                        } else {
                            showAlert('Error al actualizar el carrito', 'danger');
                        }
                    },
                    error: function (xhr) {
                        showAlert('Error al actualizar el carrito', 'danger');
                    }
                });
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                var id = ele.closest('tr').data('id');

                if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "POST",  // Changed from DELETE to POST
                        data: {
                            id: id
                        },
                        success: function (response) {
                            showAlert(response.message, 'success');
                            ele.closest('tr').remove();
                            updateCartTotal();
                            // Update cart count in navbar
                            var cartCount = $('.badge.bg-primary').text();
                            $('.badge.bg-primary').text(parseInt(cartCount) - 1);
                        },
                        error: function (xhr) {
                            showAlert(xhr.responseJSON.message || 'Error al eliminar el producto del carrito', 'danger');
                        }
                    });
                }
            });

            $('.quantity').on('input', function () {
                var max = parseInt($(this).attr('max'));
                var value = parseInt($(this).val());

                if (value > max) {
                    $(this).val(max);
                    showAlert('La cantidad seleccionada excede el stock disponible.', 'warning');
                }
            });
        });
    </script>
</body>

</html>