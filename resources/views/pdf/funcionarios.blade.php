<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Relatório de Funcionários</title>
    <style type="text/css">
        /* Reset e configurações básicas */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #333;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            padding-bottom: 50px;
            /* Espaço para o footer */
        }

        /* Cabeçalho */
        .header {
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 25px 30px;
            margin-bottom: 25px;
            position: relative;
            page-break-after: avoid;
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
        }

        .title {
            font-size: 22pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 14pt;
            text-align: center;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .report-info {
            display: table;
            width: 100%;
            font-size: 10pt;
            margin-top: 10px;
        }

        .report-info span {
            display: table-cell;
            width: 50%;
        }

        .report-info span:last-child {
            text-align: right;
        }

        /* Tabela */
        .employee-table {
            width: 96%;
            margin: 0 2%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        .employee-table thead {
            background-color: #f1f5f9;
        }

        .employee-table th {
            padding: 10px 12px;
            text-align: left;
            font-weight: bold;
            color: #334155;
            border-bottom: 2px solid #e2e8f0;
            font-size: 10pt;
        }

        .employee-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 10pt;
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .employee-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* Rodapé */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px 0;
            font-size: 9pt;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            background-color: #ffffff;
        }

        /* Numeração de páginas */
        .page-number {
            position: fixed;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #94a3b8;
        }

        /* Quebras de página */
        @media print {
            .page-break {
                page-break-before: always;
            }

            body {
                padding-top: 20px;
            }

            .header {
                position: relative;
                top: -20px;
            }
        }
    </style>
</head>

<body>
    <!-- Cabeçalho do Relatório -->
    <div class="header">
        <h1 class="title">Relatório de Funcionários</h1>
        <p class="subtitle">Lista completa de colaboradores do sistema</p>
        <div class="report-info">
            <span>Data do Relatório: {{ now()->format('d/m/Y H:i') }}</span>
            <span>Total de Funcionários: {{ count($funcionarios) }}</span>
        </div>
    </div>

    <!-- Tabela de Funcionários -->
    <table class="employee-table">
        <thead>
            <tr>
                <th style="width: 25%;">Nome</th>
                <th style="width: 25%;">E-mail</th>
                <th style="width: 20%;">Cargo</th>
                <th style="width: 15%;">Telefone</th>
                <th style="width: 15%;">Contratado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role }}</td>
                    <td>{{ $item->phone ?? 'N/A' }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>

                @if ($loop->iteration % 25 == 0)
                    <tr class="page-break">
                        <td colspan="5"></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Rodapé -->
    <div class="footer">
        Relatório gerado em {{ now()->format('d/m/Y') }} | Sistema de Gestão de Funcionários
    </div>

    <!-- Número da Página -->
    <div class="page-number">Página <span class="page"></span></div>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 8;
                $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
                $pdf->text(520, 810, $pageText, $font, $size);
            ');
        }
    </script>
</body>

</html>
