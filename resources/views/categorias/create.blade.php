@extends('layouts.app')

@section('title', 'Nueva Familia')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Nueva Familia</h1>
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Volver
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categorias.store') }}" method="POST" id="createCategoriaForm">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre_categoria" class="form-label">Nombre de la Familia</label>
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria"
                            value="{{ old('nombre_categoria') }}" required autofocus placeholder="Ej: Tableros MDF">
                        <div class="form-text">
                            El nombre debe ser único y descriptivo.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_categoria" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_categoria" name="descripcion_categoria" rows="4"
                            placeholder="Describe brevemente esta familia de productos">{{ old('descripcion_categoria') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i>
                            Guardar Familia
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('createCategoriaForm');
        const nombreInput = document.getElementById('nombre_categoria');

        form.addEventListener('submit', function (e) {
            if (!nombreInput.value.trim()) {
                e.preventDefault();
                alert('Por favor, ingrese un nombre para la familia');
                nombreInput.focus();
            }
        });

        // Capitalizar primera letra de cada palabra
        nombreInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
        });
    });
</script>
@endsection