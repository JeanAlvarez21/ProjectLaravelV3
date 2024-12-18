<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mi Aplicación')</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<form method="POST" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Correo Electrónico -->
        <div>
            <label for="email" style="display: block; margin-bottom: 5px;">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <label for="password" style="display: block; margin-bottom: 5px;">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @error('password')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="password-confirm" style="display: block; margin-bottom: 5px;">Confirmar Contraseña:</label>
            <input type="password" id="password-confirm" name="password_confirmation" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <!-- Botón -->
        <div>
            <button type="submit" 
                    style="background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%;">
                Restablecer Contraseña
            </button>
        </div>
    </form>
</body>
</html>
