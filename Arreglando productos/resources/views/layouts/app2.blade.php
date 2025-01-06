<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #FFD700;"> <!-- Cambiado a amarillo -->
        <div class="container">
            <a class="navbar-brand text-dark" href="/">Inventario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('inventarios.index') }}">Inventarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer 
    <footer class="bg-warning text-dark text-center py-3 mt-4">  Ajustado a amarillo 
        <p class="mb-0">&copy; {{ date('Y') }} Inventario.</p>
    </footer>
    -->
</body>
</html>
