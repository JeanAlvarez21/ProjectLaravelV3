<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Novocentro')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div class="loading-indicator d-none">
        <div class="loading-spinner"></div>
        <div class="loading-text mt-3">Generando PDF...</div>
    </div>

    <button class="btn btn-primary sidebar-toggle d-md-none" type="button" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    @include('partials.sidebar')

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <script src="{{ asset('js/pdf-export.js') }}"></script>

</body>

</html>