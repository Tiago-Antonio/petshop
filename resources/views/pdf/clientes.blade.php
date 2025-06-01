<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f8fafc;
        }

        .header {
            background-color: #1e3a8a;
            color: white;
            padding: 30px 40px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
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
            font-size: 28px;
            font-weight: 600;
            text-align: center;
        }

        .subtitle {
            margin: 5px 0 0;
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
            text-align: center;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 14px;
        }

        .table-clientes {
            width: 94%;
            border-collapse: collapse;
            margin: 0 3%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-clientes thead {
            background-color: #f1f5f9;
        }

        .table-clientes th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #334155;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .table-clientes td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .table-clientes tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .table-clientes tr:hover {
            background-color: #f1f5f9;
        }

        .footer {
            margin-top: 40px;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        .page-info {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }

        @media print {
            body {
                background-color: white;
            }

            .header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <!-- Cabeçalho -->
    <div class="header">
        <h1 class="title">Relatório de Clientes</h1>
        <p class="subtitle">Lista de clientes com total de pedidos realizados</p>
        <div class="report-info">
            <span>Data do Relatório: {{ now()->format('d/m/Y H:i') }}</span>
            <span>Total de Clientes: {{ count($clientes) }}</span>
        </div>
    </div>

    <!-- Tabela -->
    <table class="table-clientes">
        <thead>
            <tr>
                <th style="width: 40%;">Nome</th>
                <th style="width: 40%;">Email</th>
                <th style="width: 20%;">Total de Pedidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->orders_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rodapé -->
    <div class="footer">
        Relatório gerado em {{ now()->format('d/m/Y') }} | Sistema de Gestão de Clientes
    </div>

    <!-- Página -->
    <div class="page-info">Página <span class="page-number"></span></div>
</body>

</html>
