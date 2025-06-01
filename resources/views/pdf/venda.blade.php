<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>Relatório - Últimos Pedidos</title>
    <style>
        /* Estilos Base */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f8fafc;
        }

        /* Cabeçalho */
        .header {
            background-color: #1e3a8a;
            color: white;
            padding: 25px 30px;
            margin-bottom: 30px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
        }

        .title {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            text-align: center;
        }

        .subtitle {
            margin: 8px 0 0;
            font-size: 15px;
            font-weight: 400;
            opacity: 0.9;
            text-align: center;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 6px;
        }

        /* Card de Pedido */
        .pedido {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .pedido h2 {
            margin: 0 0 15px 0;
            color: #1e3a8a;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 18px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
            gap: 10px;
        }

        .info strong {
            color: #4a5568;
            min-width: 70px;
        }

        /* Tabela de Itens */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 14px;
        }

        th {
            background-color: #f1f5f9;
            color: #2d3748;
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        /* Status */
        .pedido_pendente {
            color: #3b82f6;
            font-weight: 600;
        }

        .pedido_cancelado {
            color: #ef4444;
            font-weight: 600;
        }

        .pedido_finalizado {
            color: #10b981;
            font-weight: 600;
        }

        /* Total */
        .total {
            margin-top: 15px;
            font-weight: bold;
            font-size: 16px;
            text-align: right;
            color: #1e3a8a;
            padding-top: 10px;
            border-top: 1px dashed #cbd5e0;
        }

        /* Responsividade */
        @media print {
            body {
                padding: 0;
                background-color: white;
            }

            .header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                box-shadow: none;
                border-radius: 0;
            }

            .pedido {
                page-break-inside: avoid;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="title">Relatório de Vendas</h1>
        <p class="subtitle">Últimos pedidos registrados no sistema</p>
        <div class="report-info">
            <span>Data do Relatório: {{ now()->format('d/m/Y H:i') }}</span>
            <span>Total de Pedidos: {{ count($orders) }}</span>
        </div>
    </div>

    @foreach ($orders as $order)
        <div class="pedido">
            <h2>Pedido #{{ $order->id }} - {{ $order->created_at->format('d/m/Y H:i') }}</h2>
            <div class="info"><strong>Cliente:</strong> {{ $order->client->name }}</div>
            <div class="info"><strong>Vendedor:</strong> {{ $order->user->name }}</div>
            <div class="info"><strong>Status:</strong>
                @if ($order->status == 'pendente')
                    <span class="pedido_pendente">{{ ucfirst($order->status) }}</span>
                @elseif($order->status == 'cancelado')
                    <span class="pedido_cancelado">{{ ucfirst($order->status) }}</span>
                @else
                    <span class="pedido_finalizado">{{ ucfirst($order->status) }}</span>
                @endif
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderitem as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Produto excluído' }}</td>
                            <td>
                                @if ($item->quantity == 0)
                                    {{ $item->snapshot_quantity }}
                                @else
                                    {{ $item->quantity }}
                                @endif
                            </td>
                            <td>R$ {{ number_format($item->product->sale_price ?? 0, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">Total do Pedido: R$ {{ number_format($order->total_amount, 2, ',', '.') }}</div>
        </div>
    @endforeach

</body>

</html>
