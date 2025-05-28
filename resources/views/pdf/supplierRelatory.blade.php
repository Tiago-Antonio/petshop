<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>Relatório de Funcionários</title>
    <style>
        /* Estilos Base */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f8fafc;
        }

        /* Cabeçalho */
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

        /* Tabela de Funcionários */
        .employee-table {
            width: 94%;
            border-collapse: collapse;
            margin: 0 3%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .employee-table thead {
            background-color: #f1f5f9;
        }

        .employee-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #334155;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .employee-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .employee-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .employee-table tr:hover {
            background-color: #f1f5f9;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        /* Informações da Página */
        .page-info {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }

        /* Avatar */
        .employee-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            vertical-align: middle;
        }

        /* Responsividade */
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
    <!-- Cabeçalho do Relatório -->
    <div class="header">
        <h1 class="title">Relatório de Fornecedores</h1>
        <p class="subtitle">Lista completa de fornecedores</p>
        <div class="report-info">
            <span>Data do Relatório: {{ now()->format('d/m/Y H:i') }}</span>
            <span>Total de Fornecedores: {{ count($suppliers) }}</span>
        </div>
    </div>

    <!-- Tabela de Funcionários -->
    <table class="employee-table">
        <thead>
            <tr>
                <th style="width: 25%;">Nome</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 20%;">Telefone</th>
                <th style="width: 15%;">Endereço</th>
                <th style="width: 15%;">Ativo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->active }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rodapé -->
    <div class="footer">
        Relatório gerado em {{ now()->format('d/m/Y') }} | Sistema de Gestão de Funcionários
    </div>

    <!-- Número da Página (será preenchido pelo gerador de PDF) -->
    <div class="page-info">Página <span class="page-number"></span></div>
</body>

</html>
