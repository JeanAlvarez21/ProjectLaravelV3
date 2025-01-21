<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Clientes Top</title>
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
        <h1>Reporte de Clientes Top</h1>
        <p>Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Cédula</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Total Pedidos</th>
                <th>Total Gastado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->cedula }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->total_pedidos }}</td>
                    <td class="text-right">${{ number_format($cliente->total_gastado, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>