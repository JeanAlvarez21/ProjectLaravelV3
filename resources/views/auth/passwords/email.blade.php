<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffdb01; /* Fondo amarillo */
            color: #000; /* Texto negro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #f8f8f8; /* Fondo blanco */
            color: #000; /* Texto negro */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-label {
            color: #000; /* Texto negro */
        }

        .form-control {
            background-color: #fff; /* Fondo blanco */
            border: 1px solid #ccc; /* Borde gris claro */
            border-radius: 4px;
            color: #000; /* Texto negro */
        }

        .form-control:focus {
            box-shadow: 0px 0px 5px #ffdb01;
            border-color: #ffdb01; /* Amarillo */
        }

        .btn-warning {
            background-color: #ffdb01; /* Amarillo brillante */
            color: #1a1a1a; /* Texto oscuro */
            border: none;
        }

        .btn-warning:hover {
            background-color: #e6b800; /* Amarillo más oscuro */
        }

        .text-muted {
            color: #6c757d !important; /* Gris estándar */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="mb-3">Recuperar Contraseña</h1>
        <p class="text-muted mb-4">Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        <!-- Mensaje de confirmación -->
        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning w-100">Enviar enlace de recuperación</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
