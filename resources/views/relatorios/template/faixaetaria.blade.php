<html>

<head>
    <title>SIVO || RELATORIO POR FAIXA ETÁRIA</title>
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
            <h3>RELATÓRIO POR FAIXA ETÁRIA</h3>
            @if ($dados['periodo_relatorio'])
                <h5>(Período: {{ $dados['periodo_relatorio'] }})</h5>
            @endif
        </div>

        <p>Este relatório tem como objetivo apresentar dados e gráficos referentes à verificação de óbitos realizada
            pelo Serviço de Verificação de Óbito (SVO), organizados por faixa etária. O SVO é um serviço essencial que
            tem como finalidade investigar as causas de óbitos que ocorrem de forma súbita e sem explicação clara,
            contribuindo para a prevenção de doenças e aprimoramento do sistema de saúde.</p>

        <p>Os dados aqui apresentados foram coletados com base nos filtros definidos para cada faixa etária, de modo a
            oferecer uma análise mais precisa e detalhada. Espera-se que este relatório seja útil para profissionais da
            área de saúde, pesquisadores e gestores públicos, contribuindo para o aprimoramento do conhecimento e das
            políticas públicas relacionadas à saúde da população.</p>


        @php
            $obitos = json_decode(base64_decode($dados['dados_obitos']), true);
            $maior = json_decode(base64_decode($dados['maior']), true);
            $faixaMaior = str_replace('-', ' a ', $maior['faixaetaria']);
        @endphp

        <h4>ÓBITOS POR FAIXA ETÁRIA</h4>
        <p>A prevelência de óbitos está presente na população <strong>{{ $maior['tipo'] }}</strong>, na faixa de
            <strong>{{ $faixaMaior }}
                anos</strong>, com um total de {{ $maior['soma'] }} óbito(s). </p>
        <img width="700px" src="{{ $dados['grafico_faixa_etaria_sexo_barra'] }}" alt="">
        <table style="width:95%" id="table-faixa-etaria">
            <tr>
                <th>Faixa etária(anos)</th>
                <th>Homens</th>
                <th>Mulheres</th>
                <th>% em relação ao total</th>
                <th>Total</th>
            </tr>
            @foreach ($obitos as $obito)
                <tr class="avoid-page-break">
                    <td>{{ $obito['faixaetaria'] }}</td>
                    <td>{{ $obito['homens'] }}</td>
                    <td>{{ $obito['mulheres'] }}</td>
                    <td>{{ number_format((($obito['homens'] + $obito['mulheres']) / $totalObitos) * 100, 2, '.', '') }}%
                    </td>
                    <td>{{ $obito['homens'] + $obito['mulheres'] }}</td>
                </tr>
            @endforeach
        </table>







    </main>
</body>

</html>
