@extends('layouts.app2')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Mis Proyectos</h1>
    <div class="text-end mb-3">
        <a href="{{ route('proyectos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Crear Nuevo Proyecto
        </a>
    </div>

    @if($proyectos->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No tienes proyectos creados. ¡Comienza creando uno nuevo!
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($proyectos as $proyecto)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                            <p class="card-text">Creado el: {{ $proyecto->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-project"
                                    data-id="{{ $proyecto->id }}">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('.delete-project').click(function () {
            var projectId = $(this).data('id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/proyectos/' + projectId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (result) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El proyecto ha sido eliminado.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar el proyecto.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endsection