<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Histórico de Ações</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 20px;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
        }

        .container {
            max-width: 800px;
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

        .historico-item {
            margin-bottom: 20px;
            padding: 15px;
            border-left: 4px solid #0d6efd;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
        }

        .historico-item-titulo {
            font-weight: 600;
            color: #212529;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .historico-item-data {
            color: #6c757d;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .historico-item-conteudo {
            color: #495057;
            font-size: 12px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
        }

        .vazio {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
            border: 1px solid #dee2e6;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
        <div class="container">
            <div class="header">
                <h1>Histórico de Ações</h1>
                <p>Documento gerado em: {{ now()->translatedFormat('d \d\e F \d\e Y \à\s H:i:s') }}</p>
            </div>

            <div class="corpo-info">
                <p><strong>Corpo:</strong> {{ $corpo->nome }}</p>
                <p><strong>CPF:</strong> {{ $corpo->cpf ?? '-' }}</p>
                <p><strong>RG:</strong> {{ $corpo->rg ?? '-' }}</p>
                <p><strong>Data de Entrada:</strong> {{ $corpo->data_entrada ? \Carbon\Carbon::parse($corpo->data_entrada)->translatedFormat('d \d\e F \d\e Y') : 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $corpo->status_texto ?? 'N/A' }}</p>
            </div>

            @if($historico && count($historico) > 0)
                @foreach($historico as $item)
                    <div class="historico-item">
                        <div class="historico-item-titulo">{{ $item->titulo }}</div>
                        <div class="historico-item-data">
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d \d\e F \d\e Y \à\s H:i') }}
                        </div>
                        <div class="historico-item-conteudo">{{ $item->conteudo }}</div>
                    </div>
                @endforeach
            @else
                <div class="vazio">
                    <p>Não há histórico de ações para este corpo.</p>
                </div>
            @endif

            <div class="footer">
                <p>Sistema de Verificação de Óbitos - SIVO</p>
                <p>{{ config('app.name') }} - {{ now()->year }}</p>
            </div>
        </div>
</body>
</html>
