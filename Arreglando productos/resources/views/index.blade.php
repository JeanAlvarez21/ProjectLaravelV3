<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Cabecera -->
    <nav class="flex justify-between items-center px-6 py-4 bg-yellow-400 shadow-md">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 mr-3">
        </div>
        <div class="space-x-6">
            <a href="#" class="hover:underline font-semibold">Menú</a>
            <a href="#" class="hover:underline font-semibold">Inventario</a>
            <a href="#" class="hover:underline font-semibold">Tienda</a>
            <a href="#" class="hover:underline font-semibold">Carpinteros</a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Gestión de Inventario</h2>

        <!-- Botones principales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-xl mx-auto">
            <a href="{{ route('inventarios.index') }}" class="bg-yellow-200 p-6 rounded-lg shadow-md hover:bg-yellow-300 text-center">
                <h3 class="text-lg font-bold">Listar Inventario</h3>
                <p class="text-sm text-gray-600">Consulta y gestiona todos los elementos del inventario.</p>
            </a>

            <a href="{{ route('productos.index') }}" class="bg-blue-200 p-6 rounded-lg shadow-md hover:bg-blue-300 text-center">
                <h3 class="text-lg font-bold">Listar Productos</h3>
                <p class="text-sm text-gray-600">Revisa la lista completa de productos disponibles.</p>
            </a>

            <a href="{{ route('inventarios.create') }}" class="bg-yellow-200 p-6 rounded-lg shadow-md hover:bg-yellow-300 text-center">
                <h3 class="text-lg font-bold">Agregar al Inventario</h3>
                <p class="text-sm text-gray-600">Añade nuevos productos al inventario.</p>
            </a>

            <a href="{{ route('productos.create') }}" class="bg-blue-200 p-6 rounded-lg shadow-md hover:bg-blue-300 text-center">
                <h3 class="text-lg font-bold">Agregar Productos</h3>
                <p class="text-sm text-gray-600">Añade nuevos productos.</p>
            </a>
        </div>
    </div>
</body>
</html>
