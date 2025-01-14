<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carpintero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Carpintero</h1>

        <form action="{{ route('carpinteros.update', $carpintero->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $carpintero->nombre }}" required>
                </div>
                <div class="col-md-6">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" value="{{ $carpintero->especialidad }}"
                        required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $carpintero->telefono }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $carpintero->email }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" value="{{ $carpintero->ubicacion }}">
                </div>
                <div class="col-md-6">
                    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                    <input type="file" name="foto_perfil" class="form-control" accept="image/*">
                    @if($carpintero->foto_perfil)
                        <img src="{{ $carpintero->foto_perfil }}" alt="Foto actual" class="mt-2" style="max-width: 100px;">
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $carpintero->descripcion }}</textarea>
                </div>
                <div class="col-md-3">
                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                    <select name="disponibilidad" class="form-control">
                        <option value="1" {{ $carpintero->disponibilidad ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ !$carpintero->disponibilidad ? 'selected' : '' }}>No disponible</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ route('carpinteros.manage') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</body>

</html>

