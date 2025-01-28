@extends('layouts.app2')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Editar Proyecto: {{ $proyecto->nombre }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Proyecto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ $proyecto->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Seleccionar Producto</label>
                            <select class="form-select" id="producto_id" name="producto_id" required>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ $proyecto->cortes->first()->producto_id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                        ({{ $producto->largo }}x{{ $producto->ancho }}x{{ $producto->espesor }} mm)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad de Cortes</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1"
                                value="{{ $proyecto->cortes->first()->cantidad }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="largo" class="form-label">Largo del Corte (mm)</label>
                                <input type="number" class="form-control" id="largo" name="largo" step="0.01"
                                    value="{{ $proyecto->cortes->first()->largo }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="ancho" class="form-label">Ancho del Corte (mm)</label>
                                <input type="number" class="form-control" id="ancho" name="ancho" step="0.01"
                                    value="{{ $proyecto->cortes->first()->ancho }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="espesor" class="form-label">Espesor del Corte (mm)</label>
                                <input type="number" class="form-control" id="espesor" name="espesor" step="0.01"
                                    value="{{ $proyecto->cortes->first()->espesor }}" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar Proyecto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection