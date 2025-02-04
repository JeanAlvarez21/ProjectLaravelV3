<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario Bajo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .warning {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Inventario Bajo</h1>
        <p>Fecha: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Stock Actual</th>
                <th>Stock Mínimo</th>
                <th>Reabastecer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->min_stock }}</td>
                    <td>{{ $producto->stock < $producto->min_stock ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>