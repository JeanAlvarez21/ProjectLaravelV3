<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
            height: 100vh;
        }

        .left {
            position: relative;
            background-color: #ffdb01;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .left img {
            width: 100%;
            height: auto;
            max-height: 100vh;
            object-fit: cover;
            object-position: right;
        }

        h2 {
            color: #333;
            text-align: left;
        }

        .btn-custom-warning {
            background-color: #ffdb01;
            color: #000;
            border: none;
        }

        .btn-custom-warning:hover {
            background-color: #e6c501;
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Mitad izquierda -->
            <div class="col-md-6 left">
                <h2>Juntos transformamos<br>la madera</h2>
                <img src="{{asset('assets/fondo-home 3.png')}}">
            </div>

            <!-- Mitad derecha -->
            <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
                <div class="w-75">
                    <header class="mb-4">
                        <h1 class="text-center text-dark">Regístrate</h1>
                        <p class="text-center text-muted">Completa los campos para crear tu cuenta.</p>
                    </header>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombres" class="form-label">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres"
                                    value="{{ old('nombres') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    value="{{ old('apellidos') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="{{ old('direccion') }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cedula" class="form-label">Cédula:</label>
                                <input type="text" class="form-control" id="cedula" name="cedula"
                                    value="{{ old('cedula') }}" required>
                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono"
                                    value="{{ old('telefono') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom-warning w-100">Registrarse</button>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-primary">Ya tienes una cuenta? Inicia sesión
                                aquí.</a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>