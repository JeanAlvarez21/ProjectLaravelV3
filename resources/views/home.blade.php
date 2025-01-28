@extends('layouts.app2')

@section('title', 'Bienvenido a Novocentro - Soluciones en Madera de Alta Calidad')

@section('styles')
<style>
    /* Reset de márgenes */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    /* Hero Section ajustado */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('{{ asset('media/background_main.png') }}') no-repeat center center;
        background-size: cover;
        color: white;
        height: 80vh;
        width: 100vw;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin-top: -76px;
        padding-top: 76px;
    }

    .hero-content {
        max-width: 800px;
        text-align: center;
        padding: 2rem;
        z-index: 2;
    }

    .hero-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 600;
        margin-bottom: 1rem;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .hero-text {
        font-size: clamp(1rem, 1.5vw, 1.1rem);
        margin-bottom: 1.5rem;
        line-height: 1.6;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Botón mejorado */
    .btn-contacto {
        background-color: var(--primary-color);
        color: var(--text-color);
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid transparent;
    }

    .btn-contacto:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: var(--text-color);
        border-color: var(--primary-color);
    }

    /* Carrusel mejorado */
    .carousel {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    .carousel-item {
        height: 400px;
    }

    .carousel-item img {
        height: 100%;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 8px;
        padding: 1.5rem;
        max-width: 500px;
        margin: 0 auto;
        bottom: 2rem;
    }

    .carousel-caption h5 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Características mejoradas */
    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1.25rem;
        transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }

    /* Formulario de contacto mejorado */
    .contact-section {
        background-color: var(--light-bg);
        border-radius: 12px;
        padding: 3rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    }

    /* Títulos de sección mejorados */
    .section-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-size: 2rem;
        animation: bounce 2s infinite;
        cursor: pointer;
        opacity: 0.8;
        z-index: 2;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0) translateX(-50%);
        }

        40% {
            transform: translateY(-30px) translateX(-50%);
        }

        60% {
            transform: translateY(-15px) translateX(-50%);
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            Optimiza tu Proyecto con Madera de
            <span class="text-warning">Alta Calidad</span>
        </h1>
        <p class="hero-text">
            Descubre cómo nuestra tecnología de vanguardia garantiza madera cortada y acabada
            según tus necesidades específicas
        </p>
        <a href="{{ route('contact.index') }}" class="btn-contacto">
            CONTÁCTANOS
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <div class="scroll-indicator" id="scrollIndicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<div id="content">
    <!-- Carrusel de Paneles -->
    <section class="container my-5">
        <h2 class="section-title">Nuestros Paneles de Madera</h2>
        <div id="panelCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/productos/1.jpg') }}" class="d-block w-100" alt="MDP Enchapado">
                    <div class="carousel-caption">
                        <h5>MDP Enchapado</h5>
                        <p>Económico y versátil para proyectos interiores</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/productos/2.jpg') }}" class="d-block w-100" alt="MDF Enchapado">
                    <div class="carousel-caption">
                        <h5>MDF Enchapado</h5>
                        <p>Alta resistencia y estabilidad para acabados finos</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/productos/3.jpg') }}" class="d-block w-100" alt="Plywood">
                    <div class="carousel-caption">
                        <h5>Plywood</h5>
                        <p>Excelente para exteriores y proyectos estructurales</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#panelCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#panelCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <!-- Características -->
    <section class="container my-5">
        <h2 class="section-title">¿Por qué elegir Novocentro?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-cogs feature-icon"></i>
                    <h3 class="h5 mb-3">Tecnología de Vanguardia</h3>
                    <p class="mb-0">Utilizamos la última tecnología en corte y acabado para garantizar la precisión.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-tree feature-icon"></i>
                    <h3 class="h5 mb-3">Sostenibilidad</h3>
                    <p class="mb-0">Comprometidos con el medio ambiente y procesos eco-amigables.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-users feature-icon"></i>
                    <h3 class="h5 mb-3">Asesoría Experta</h3>
                    <p class="mb-0">Nuestro equipo te guiará en cada etapa de tu proyecto.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-section">
                    <h2 class="section-title">Contáctanos</h2>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="asunto" class="form-control" placeholder="Asunto" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="mensaje" class="form-control" rows="4" placeholder="Mensaje"
                                required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-contacto">
                                Enviar Mensaje
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const scrollIndicator = document.getElementById('scrollIndicator');
        const content = document.getElementById('content');

        scrollIndicator.addEventListener('click', function () {
            content.scrollIntoView({ behavior: 'smooth' });
        });

        window.addEventListener('scroll', function () {
            if (window.scrollY > 100) {
                scrollIndicator.style.opacity = '0';
            } else {
                scrollIndicator.style.opacity = '0.8';
            }
        });
    });
</script>
@endsection