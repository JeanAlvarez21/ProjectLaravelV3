@extends('layouts.app2')

@section('title', 'Carpinteros')

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
                    <img src="{{ asset($carpintero->foto_perfil) }}" class="card-img-top"
                        alt="Foto de {{ $carpintero->nombre }}">
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
                    alert(`${copyType} copiado al portapapeles: ${textToCopy}`);
                }).catch(err => {
                    console.error('Error al copiar texto: ', err);
                });
            });
        });
    });
</script>
@endsection