<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #212529;
            line-height: 1.5;
            margin: 20px;
            background-color: #fff;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #212529;
        }

        .header p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 12px;
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #212529;
            margin: 0;
        }

        .card-subtitle {
            font-size: 12px;
            color: #6c757d;
            margin: 5px 0 0 0;
        }

        .corpo-info {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
            border-radius: 0.25rem;
        }

        .corpo-info p {
            margin: 5px 0;
            font-size: 12px;
            color: #212529;
        }

        .corpo-info strong {
            display: inline-block;
            width: 150px;
            color: #495057;
            font-weight: 600;
        }

        /* Accordion styling */
        .accordion-item {
            border: 1px solid #dee2e6;
            margin-bottom: 10px;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .accordion-header {
            background-color: transparent;
            padding: 0;
            margin: 0;
        }

        .accordion-button {
            display: block;
            width: 100%;
            padding: 12px 15px;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            text-align: left;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: background-color 0.15s ease-in-out;
        }

        .accordion-button:hover {
            background-color: #0b5ed7;
        }

        .accordion-button small {
            display: block;
            font-weight: 400;
            font-size: 11px;
            margin-top: 3px;
            opacity: 0.95;
            color: #e9ecef;
        }

        .accordion-body {
            padding: 15px;
            background-color: #fff;
            display: block;
        }

        .justificativa-section {
            background-color: #cfe2ff;
            border: 1px solid #b6d4fe;
            border-left: 4px solid #0d6efd;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 12px;
            border-radius: 0.25rem;
            color: #084298;
        }

        .justificativa-section strong {
            color: #084298;
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .justificativa-section p {
            margin: 0;
            color: #084298;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }

        table thead {
            background-color: #212529;
            color: #fff;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #dee2e6;
            background-color: #212529;
            color: #fff;
        }

        table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #f1f3f5;
        }

        table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            color: #212529;
        }

        table td strong {
            color: #212529;
            font-weight: 600;
        }

        .valor-antigo {
            color: #842029;
            font-weight: 500;
        }

        .valor-novo {
            color: #0f5132;
            font-weight: 500;
        }

        .nenhuma-alteracao {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 0.25rem;
            color: #6c757d;
            font-size: 13px;
            border: 1px solid #dee2e6;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #dee2e6;
            font-size: 10px;
            color: #6c757d;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
    <title>Histórico de Alterações</title>
</head>
<body>
    <div class="header">
        <h1>Histórico de Alterações</h1>
        <p>Documento gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="card-header">
        <p class="card-title">Histórico de Alterações</p>
        <p class="card-subtitle">Histórico de alterações referentes ao corpo</p>
    </div>

    <div class="corpo-info">
        <p><strong>Nome:</strong> {{ $corpo->nome }}</p>
        <p><strong>CPF:</strong> {{ $corpo->cpf ? substr($corpo->cpf, 0, 3) . '.' . substr($corpo->cpf, 3, 3) . '.' . substr($corpo->cpf, 6, 3) . '-' . substr($corpo->cpf, 9) : 'N/A' }}</p>
        <p><strong>RG:</strong> {{ $corpo->rg ?? 'N/A' }}</p>
        <p><strong>Data de Entrada:</strong> {{ $corpo->data_entrada ? \Carbon\Carbon::parse($corpo->data_entrada)->format('d/m/Y H:i:s') : 'N/A' }}</p>
    </div>

    @if (count($justificativa) > 0)
        <div class="accordion" id="historicoAccordion">
            @foreach ($justificativa as $index => $item)
                @php
                    $alteracoes = json_decode($item->alteracoes, true);
                @endphp

                @if ($alteracoes)
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <button class="accordion-button" type="button">
                                Registro: {{ $item->tabela }}
                                <small>alterado em {{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') : 'Data desconhecida' }}</small>
                                <small>por {{ $nome[$item->user_id] ?? 'Usuário desconhecido' }}</small>
                            </button>
                        </div>
                        <div class="accordion-body">
                            @if ($item->justificativa)
                                <div class="justificativa-section">
                                    <strong>Justificativa:</strong>
                                    <p>{!! $item->justificativa !!}</p>
                                </div>
                            @endif

                            <table>
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Antigo</th>
                                        <th>Novo Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alteracoes as $alteracao)
                                        <tr>
                                            <td><strong>{{ $alteracao['campo'] }}</strong></td>
                                            <td class="valor-antigo">{{ $alteracao['antigo'] !== null ? $alteracao['antigo'] : 'N/A' }}</td>
                                            <td class="valor-novo">{{ $alteracao['novo'] !== null ? $alteracao['novo'] : 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="nenhuma-alteracao">
            <p>Nenhuma alteração registrada para este corpo.</p>
        </div>
    @endif

    <div class="footer">
        <p><strong>Sistema SIVO - Serviço de Investigação de Vítimas Óbito</strong></p>
        <p>Este documento foi gerado automaticamente em {{ \Carbon\Carbon::now()->format('d/m/Y') }} às {{ \Carbon\Carbon::now()->format('H:i:s') }}</p>
        <p>Informações confidenciais - Uso restrito a usuários autorizados</p>
    </div>
</body>
</html>
