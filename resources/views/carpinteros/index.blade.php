@extends('layouts.app2')

@section('title', 'Carpinteros')

@section('styles')
<style>
    .card-img-container {
        height: 250px;
        /* Altura fija para todas las imágenes */
        overflow: hidden;
        position: relative;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Mantiene la proporción y cubre el espacio */
        object-position: center;
        /* Centra la imagen */
    }

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .copy-icon {
        cursor: pointer;
        color: #6c757d;
        margin-left: 5px;
        transition: color 0.2s ease;
    }

    .copy-icon:hover {
        color: #0d6efd;
    }
</style>
@endsection

@section('content')
<h1 class="text-center mb-5">Carpinteros Disponibles</h1>

@auth
    @if(Auth::user()->rol == 1 || Auth::user()->rol == 2)
        <div class="text-center py-4">
            <a href="{{ route('carpinteros.manage') }}" class="btn btn-custom">Agregar Carpintero</a>
        </div>
    @endif
@endauth

@if($carpinteros->isEmpty())
    <div class="alert alert-info text-center" role="alert">
        No hay carpinteros disponibles en este momento.
    </div>
@else
    <div class="row">
        @foreach ($carpinteros as $carpintero)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-img-container">
                        <img src="{{ asset($carpintero->foto_perfil) }}" class="card-img-top"
                            alt="Foto de {{ $carpintero->nombre }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $carpintero->nombre }} {{ $carpintero->apellido }}</h5>
                        <p class="card-text"><strong>Especialidad:</strong> {{ $carpintero->especialidad }}</p>
                        <p class="card-text">
                            <strong>Teléfono:</strong>
                            <span class="copyable">{{ $carpintero->telefono }}</span>
                            <i class="fas fa-copy copy-icon" data-copy-text="{{ $carpintero->telefono }}"
                                data-copy-type="teléfono" aria-label="Copiar teléfono"></i>
                        </p>
                        <p class="card-text">
                            <strong>Email:</strong>
                            <span class="copyable">{{ $carpintero->email }}</span>
                            <i class="fas fa-copy copy-icon" data-copy-text="{{ $carpintero->email }}" data-copy-type="email"
                                aria-label="Copiar email"></i>
                        </p>
                        <p class="card-text"><strong>Direccion:</strong> {{ $carpintero->ubicacion }} </p>
                        <p class="card-text"><strong>Descripcion:</strong> {{ $carpintero->descripcion }} </p>
                    </div>
                    <div class="card-footer">
                        <span class="badge bg-{{ $carpintero->disponibilidad == 1 ? 'success' : 'danger' }}">
                            {{ $carpintero->disponibilidad == 1 ? 'Disponible' : 'No disponible' }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyIcons = document.querySelectorAll('.copy-icon');

        copyIcons.forEach((icon) => {
            icon.addEventListener('click', function () {
                const textToCopy = this.dataset.copyText;
                const copyType = this.dataset.copyType;

                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Crear una notificación toast en lugar de un alert
                    const toast = document.createElement('div');
                    toast.className = 'toast-notification';
                    toast.textContent = `${copyType} copiado al portapapeles`;
                    document.body.appendChild(toast);

                    // Eliminar el toast después de 3 segundos
                    setTimeout(() => {
                        toast.remove();
                    }, 3000);
                }).catch(err => {
                    console.error('Error al copiar texto: ', err);
                });
            });
        });
    });
</script>

<style>
    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #333;
        color: white;
        padding: 12px 24px;
        border-radius: 4px;
        z-index: 1000;
        animation: slideIn 0.3s, fadeOut 0.3s 2.7s;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>
@endsection