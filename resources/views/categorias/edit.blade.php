@extends('layouts.app')

@section('title', 'Editar Familia')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Editar Familia</h1>
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

                @if($categoria->productos->count() > 0)
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Esta familia contiene {{ $categoria->productos->count() }} producto(s).
                        Los cambios afectarán a todos los productos asociados.
                    </div>
                @endif

                <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST"
                    id="editCategoriaForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre_categoria" class="form-label">Nombre de la Familia</label>
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria"
                            value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                        <div class="form-text">
                            El nombre debe ser único y descriptivo.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_categoria" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_categoria" name="descripcion_categoria"
                            rows="4">{{ old('descripcion_categoria', $categoria->descripcion_categoria) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i>
                            Actualizar Familia
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
        const form = document.getElementById('editCategoriaForm');
        const nombreInput = document.getElementById('nombre_categoria');
        const nombreOriginal = nombreInput.value;

        form.addEventListener('submit', function (e) {
            if (!nombreInput.value.trim()) {
                e.preventDefault();
                alert('Por favor, ingrese un nombre para la familia');
                nombreInput.focus();
                return;
            }

            if (nombreInput.value !== nombreOriginal) {
                const hasProducts = {{ $categoria->productos->count() }};
                if (hasProducts && !confirm(`Esta familia contiene ${hasProducts} producto(s). ¿Está seguro de que desea cambiar el nombre?`)) {
                    e.preventDefault();
                }
            }
        });

        // Capitalizar primera letra de cada palabra
        nombreInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
        });
    });
</script>
@endsection