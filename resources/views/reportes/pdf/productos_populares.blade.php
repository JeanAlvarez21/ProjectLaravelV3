<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Productos Populares</title>
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

        .header {
            margin-bottom: 20px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Productos Populares</h1>
        <p>Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Total Ingresos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->total_vendido }}</td>
                    <td class="text-right">${{ number_format($producto->total_ingresos, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>