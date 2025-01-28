@extends('layouts.app2')

@section('title', 'Contacto')

@section('styles')
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
        height: 50px;
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

    @media (max-width: 768px) {
        .navbar-brand img {
            height: 30px;
        }
    }

    .navbar-nav {
        align-items: center;
    }

    .navbar .nav-link {
        padding: 0.5rem 1rem;
    }

    .btn-auth {
        padding: 0.375rem 0.75rem;
        background-color: var(--primary-color);
        color: var(--text-color);
        border: none;
        border-radius: 0.25rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-auth:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            text-align: center;
        }

        .navbar-nav {
            margin-bottom: 1rem;
        }

        .navbar .btn-auth {
            margin-top: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-5 py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="mb-4">Contáctanos</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Información de Contacto</h5>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i>
                        <div>
                            <h6 class="mb-1">Dirección</h6>
                            <p class="mb-0">Av. Salvador Bustamante Celi, Loja 110150</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-phone-alt mt-1 me-3 text-primary"></i>
                        <div>
                            <h6 class="mb-1">Teléfono</h6>
                            <p class="mb-0">+593 7-257-9891</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-envelope mt-1 me-3 text-primary"></i>
                        <div>
                            <h6 class="mb-1">Email</h6>
                            <p class="mb-0">info@novocentro.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="fas fa-clock mt-1 me-3 text-primary"></i>
                        <div>
                            <h6 class="mb-1">Horario de Atención</h6>
                            <p class="mb-0">Lunes a Viernes: 8:00 AM - 6:00 PM<br>
                                Sábados: 9:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h2 class="mb-4">Nuestra Ubicación</h2>
            <div class="map-container"
                style="position: relative; width: 100%; height: 0; padding-bottom: 75%; border-radius: 8px; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15920.540697406652!2d-79.214476!3d-3.9926127!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb49431a0ba2e9%3A0xdb9b6fdaadb9bc7d!2sNovocentro%20Distablasa%20Loja%20Valle!5e0!3m2!1ses!2sec!4v1737776651284!5m2!1ses!2sec"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-- ... (keep the existing content) ... -->

    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Envíanos un Mensaje</h3>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="asunto" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5"
                                        required></textarea>
                                    <div id="contador-caracteres" class="form-text"></div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-custom">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mensajeTextarea = document.getElementById('mensaje');
        const contadorCaracteres = document.getElementById('contador-caracteres');

        function actualizarContador() {
            const caracteresRestantes = {{ $maxMessageLength }} - mensajeTextarea.value.length;
            contadorCaracteres.textContent = `Caracteres restantes: ${caracteresRestantes}`;
            if (caracteresRestantes < 0) {
                contadorCaracteres.style.color = 'red';
            } else {
                contadorCaracteres.style.color = '';
            }
        }

        mensajeTextarea.addEventListener('input', actualizarContador);
        actualizarContador(); // Llamada inicial para establecer el contador
    });
</script>
@endsection