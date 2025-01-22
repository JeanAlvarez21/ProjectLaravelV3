<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas por Período</title>
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

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
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
        <h1>Reporte de Ventas por Período</h1>
        <p>Período: {{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total Pedidos</th>
                <th>Total Ventas</th>
            </tr>
        </thead>
        <tbody>
            @php $totalVentas = 0;
            $totalPedidos = 0; @endphp
            @foreach($ventas as $venta)
                        @php 
                                            $totalVentas += $venta->total_ventas;
                            $totalPedidos += $venta->total_pedidos;
                        @endphp
                        <tr>
                            <td>{{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $venta->total_pedidos }}</td>
                            <td class="text-right">${{ number_format($venta->total_ventas, 2) }}</td>
                        </tr>
            @endforeach
            <tr class="total-row">
                <td>Total</td>
                <td>{{ $totalPedidos }}</td>
                <td class="text-right">${{ number_format($totalVentas, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <p><strong>Resumen:</strong></p>
        <ul>
            <li>Total Ventas: ${{ number_format($totalVentas, 2) }}</li>
            <li>Total Pedidos: {{ $totalPedidos }}</li>
            <li>Promedio por Pedido: ${{ $totalPedidos > 0 ? number_format($totalVentas / $totalPedidos, 2) : '0.00' }}
            </li>
        </ul>
    </div>
</body>

</html>