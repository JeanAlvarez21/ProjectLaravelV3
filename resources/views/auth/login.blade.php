<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
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

        .ms_err {
            color: red;
            font-size: 0.9rem;
        }

        h2 {
            color: #333;
            text-align: left;
        }

        .btn-custom-warning {
            background-color: #ffdb01;
            /* Color amarillo personalizado */
            color: #000;
            /* Color del texto */
            border: none;
        }

        .btn-custom-warning:hover {
            background-color: #e6c501;
            /* Un amarillo más oscuro para el hover */
        }

        /* Estilo para el enfoque en los campos de entrada */
        input:focus {
            outline: none;
            border-color: #ffdb01;
            /* Borde amarillo al enfocar */
            box-shadow: 0px 0px 5px #ffdb01;
        }

        .save-password:checked {
            accent-color: #ffdb01;
            /* Cambia el color de la casilla a amarillo */
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
                        <h1 class="text-center text-dark">Inicia sesión</h1>
                        <p class="text-center text-muted">Si ya eres miembro, puedes iniciar sesión con tu dirección de
                            correo electrónico y contraseña.</p>
                    </header>

                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="ms_err">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="ms_err">{{ $message }}</div>
                            @enderror
                        </div>

                       <!--
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input save-password" id="save-password"
                                name="remember" value="1">
                            <label class="form-check-label" for="save-password">Guardar contraseña</label>
                        </div>
                        -->

                        <button type="submit" class="btn btn-custom-warning w-100">Iniciar Sesión</button>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="{{route('register')}}" class="text-primary">No tienes cuenta? Regístrate
                                    aquí.</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('password.request') }}" class="text-primary">¿Olvidaste tu
                                    contraseña?</a>
                            </div>
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