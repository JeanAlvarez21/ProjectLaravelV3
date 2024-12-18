<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restablecer Contraseña</title>

    <style>
        /* General */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffdb01; /* Fondo amarillo */
            color: #1a1a1a; /* Texto gris oscuro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #f8f8f8; /* Fondo blanco */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center; /* Centrar texto dentro del formulario */
        }

        div {
            display: flex;
            flex-direction: column; /* Apilar elementos verticalmente */
            align-items: center; /* Centrar horizontalmente */
            margin-bottom: 15px; /* Espaciado entre bloques */
        }

        label {
            font-size: 1rem;
            color: #1a1a1a; /* Gris oscuro */
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            max-width: 300px; /* Limitar ancho de los campos */
            padding: 10px;
            border: 1px solid #ccc; /* Borde amarillo */
            border-radius: 4px;
            background-color: #fff; /* Fondo blanco */
            color: #000; /* Texto negro */
        }

        input:focus {
            outline: none;
            border-color: #ffdb01; /* Borde amarillo al enfocar */
            box-shadow: 0px 0px 5px #ffdb01;
        }

        button {
            background-color: #ffdb01; /* Fondo amarillo */
            color: #1a1a1a; /* Texto oscuro */
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            display: block; /* Asegurar que se comporte como un bloque */
            margin: 0 auto; /* Centrar el botón */
        }

        button:hover {
            background-color: #e6b800; /* Amarillo más oscuro al pasar el ratón */
        }

        span {
            font-size: 0.9rem;
            color: #ff6b6b; /* Rojo para mensajes de error */
        }

        /* Responsividad */
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }

            button {
                font-size: 0.9rem;
            }

            input {
                max-width: 100%; /* Ajustar ancho en dispositivos pequeños */
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Correo Electrónico -->
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="password-confirm">Confirmar Contraseña:</label>
            <input type="password" id="password-confirm" name="password_confirmation" required>
        </div>

        <!-- Botón -->
        <div>
            <button type="submit">Restablecer Contraseña</button>
        </div>
    </form>
</body>
</html>
