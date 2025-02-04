@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="h3 mb-4">Editar Usuario</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $user->nombres }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $user->apellidos }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula:</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $user->cedula }}" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="1" {{ $user->rol == 1 ? 'selected' : '' }}>Administrador</option>
                    <option value="2" {{ $user->rol == 2 ? 'selected' : '' }}>Empleado</option>
                    <option value="3" {{ $user->rol == 3 ? 'selected' : '' }}>Cliente</option>
                </select>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection