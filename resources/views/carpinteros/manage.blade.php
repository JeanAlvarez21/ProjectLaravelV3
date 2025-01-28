@extends('layouts.app2')

@section('title', 'Gestión de Carpinteros')

@section('content')
<h1 class="text-center mb-5">Gestión de Carpinteros</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0">Agregar Nuevo Carpintero</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('carpinteros.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad" required>
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="ubicacion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                </div>
                <div class="col-md-6">
                    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                </div>
                <div class="col-md-6">
                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                    <select class="form-select" id="disponibilidad" name="disponibilidad" required>
                        <option value="1">Disponible</option>
                        <option value="0">No Disponible</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-custom">Guardar Carpintero</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Lista de Carpinteros</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Foto de Perfil</th>
                        <th>Descripción</th>
                        <th>Disponibilidad</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carpinteros as $carpintero)
                        <tr>
                            <td>{{ $carpintero->nombre }}</td>
                            <td>{{ $carpintero->especialidad }}</td>
                            <td>{{ $carpintero->telefono }}</td>
                            <td>{{ $carpintero->email }}</td>
                            <td>
                                @if($carpintero->foto_perfil)
                                    <img src="{{ asset($carpintero->foto_perfil) }}" alt="Foto de perfil" class="img-thumbnail"
                                        style="width: 50px; height: 50px;">
                                @else
                                    <span class="text-muted">Sin foto</span>
                                @endif
                            </td>
                            <td>{{ $carpintero->descripcion }}</td>
                            <td>
                                @if($carpintero->disponibilidad)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">No Disponible</span>
                                @endif
                            </td>
                            <td>{{ $carpintero->ubicacion }}</td>
                            <td>
                                <a href="{{ route('carpinteros.edit', $carpintero->id) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('carpinteros.destroy', $carpintero->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este carpintero?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection