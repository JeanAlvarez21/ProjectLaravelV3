@extends('layouts.app2')

@section('title', 'Editar Carpintero')

@section('content')
<h1 class="text-center mb-5">Editar Carpintero</h1>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Información del Carpintero</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('carpinteros.update', $carpintero->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $carpintero->nombre }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad"
                        value="{{ $carpintero->especialidad }}" required>
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono"
                        value="{{ $carpintero->telefono }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $carpintero->email }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="ubicacion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                        value="{{ $carpintero->ubicacion }}" required>
                </div>
                <div class="col-md-6">
                    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                    @if($carpintero->foto_perfil)
                        <img src="{{ asset($carpintero->foto_perfil) }}" alt="Foto de perfil actual" class="mt-2"
                            style="max-width: 100px;">
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                    <select class="form-select" id="disponibilidad" name="disponibilidad" required>
                        <option value="1" {{ $carpintero->disponibilidad ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ !$carpintero->disponibilidad ? 'selected' : '' }}>No Disponible</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"
                        required>{{ $carpintero->descripcion }}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-custom">Actualizar</button>
                <a href="{{ route('carpinteros.manage') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection