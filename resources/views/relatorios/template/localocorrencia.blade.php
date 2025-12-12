<html>

<head>
    <title>SIVO || RELATORIO POR LOCAL DE OCORRÊNCIA</title>
    <style>
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;
            height: 50px;
            z-index: 1;
            margin-bottom: 120px;

        }

        /* body {
            padding-top: 60px;
        } */


        main {
            position: relative;
            z-index: 1;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }



        footer .pagenum:before {
            content: counter(page);
        }


        .text-center {
            text-align: center;
            align-content: center
        }

        .bold {
            font-weight: bold;
        }

        .font {
            font-size: 25px;
        }

        .right {
            float: right;
            font-size: 15px;
            width: 180px;
            color: #FFF;
            height: 20px;
            text-align: center;
        }

        h5,
        h6,
            {
            margin: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 13px;
        }

        td {
            padding: 2px 5px;
        }


        .text-sm {
            font-size: 14px;
        }

        .list {
            list-style: none;
            font-size: 18px;
        }

        p {
            text-indent: 10px;
        }
    </style>
</head>
@php
    $totalObitos = $dados['total_obitos'];
@endphp

<body style="padding-top: 20px;">
    <header>
        <div>
            <div class="image" style="top:40px; position:absolute; top: 5px">
                <img src="{{ $logoGovBase64 }}" class="mx-3 ugtsic" width="70" alt="logo ugtsic" />
            </div>
            <ol class="bold text-center font list " style="font-size: 15px; position: relative; right: 35px;">
                <li>GOVERNO DO ESTADO DO RIO GRANDE DO NORTE</li>
                <li>SECRETARIA DO ESTADO DA SAÚDE PÚBLICA</li>
                <li>SERVIÇO DE VERIFICAÇÃO DE ÓBITO</li>
            </ol>
            <div class="image" style="top:40px; position:absolute; top: 8px; right: 10px;">
                <img src="{{ $logoSivoBase64 }}" class="mx-3 ugtsic" width="90" alt="logo ugtsic" />
            </div>
        </div>
    </header>
    <footer>
        <div class="pagenum-container">Página <span class="pagenum"></span>
            <div class="text-center text-sm">
                {{ \Carbon\Carbon::now()->format('d/m/Y \à\s H:i:s') }} | Gerado por: {{ \Auth::user()->name }}
            </div>
            <div class="text-center bold text-sm"> SIVO | SISTEMA DE INFORMAÇÃO DE VERIFICAÇÃO DE ÓBITO
            </div>
        </div>
    </footer>
    <main>

        <div style="
    line-height: 3px;
    text-align: center;
    ">
            <h3>RELATÓRIO POR LOCAL DE OCORRÊNCIA</h3>
            @if ($dados['periodo_relatorio'])
                <h5>(Período: {{ $dados['periodo_relatorio'] }})</h5>
            @endif
        </div>

        <p>O Serviço de Verificação de Óbito (SVO) é responsável por realizar a investigação das causas e circunstâncias
            dos óbitos ocorridos fora do ambiente hospitalar, com o objetivo de contribuir para a melhoria das políticas
            públicas de saúde. Nesse contexto, é fundamental analisar os dados referentes à localização desses óbitos, a
            fim de identificar possíveis fatores de risco ou demandas específicas de saúde em determinadas regiões.</p>
        <p>Este relatório apresenta dados e gráficos referentes à localização dos óbitos atendidos pelo SVO, com base
            nos filtros definidos, com o objetivo de proporcionar uma visão ampla e detalhada sobre a distribuição
            geográfica dos óbitos investigados pelo serviço. A partir dessa análise, é possível traçar estratégias mais
            eficazes para prevenção de mortes prematuras e melhoria da qualidade de vida da população.</p>


        @php
            $obitosLocalOcorrencia = json_decode(base64_decode($dados['obitos_local_ocorrencia']), true);
        @endphp
        <h4>ÓBITOS POR LOCAL DE OCORRÊNCIA</h4>
        <p>No quesito local de ocorrência o maior número de óbitos foi relacionada ao campo de
            <strong>{{ $obitosLocalOcorrencia['maior'][0] }}</strong> com um total de
            {{ $obitosLocalOcorrencia['maior'][1] }} óbito(s)
            ({{ $obitosLocalOcorrencia['maior'][1] == 0 ? 0 : number_format((float) ($obitosLocalOcorrencia['maior'][1] / $totalObitos) * 100, 2, '.', '') . '%' }})
            em relação a um total óbitos de <strong>{{ $totalObitos }}
                óbito(s).</strong>
        </p>
        <img width="750px" src="{{ $dados['grafico_local_ocorrencia'] }}" alt="">
        <table style="width:95%" id="table-obitos-municipio">
            <tr>
                <th>Local de ocorrência</th>
                <th>Número de óbitos</th>
                <th>% em relação ao total</th>
            </tr>
            @foreach ($obitosLocalOcorrencia['data'] as $key => $obito)
                <tr class="avoid-page-break">
                    <td>{{ $obito[0] }}</td>
                    <td>{{ $obito[1] }}</td>
                    <td>{{ $obito[1] == 0 ? 0 : number_format((float) ($obito[1] / $totalObitos) * 100, 2, '.', '') . '%' }}
                    </td>
                </tr>
            @endforeach

        </table>
        <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos: 7 óbitos</div>

    </main>
</body>

</html>
