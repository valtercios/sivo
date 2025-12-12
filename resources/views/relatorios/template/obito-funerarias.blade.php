<html>

<head>
    <title>SIVO || RELATORIO DE OBITOS VINCULADOS A FUNERARIAS</title>
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

        .page-break {
            page-break-after: always;
        }

        .avoid-page-break {
            page-break-inside: avoid;
        }

        table:last-child {
            page-break-after: always;
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
    $totalObitosFunerarias = $dados['total_obitos_funerarias'];
    $funerarias = json_decode(base64_decode($dados['obitos']));
    $totalObitos = $dados['total_obitos'];
    
    $obitosPorTransporte = json_decode(base64_decode($dados['obitosPorTransporte']));
    //OBTEM DADOS PARA DETALHAR A ANALISE DA TABELA DE FUNERARIAS COM MAIS OBITOS
    $funeraria_com_mais_obitos = 0;
    $funeraria_com_mais_obitos_nome = '';
    foreach ($funerarias as $funeraria) {
        if ($funeraria['1'] > $funeraria_com_mais_obitos) {
            $funeraria_com_mais_obitos = $funeraria['1'];
            $funeraria_com_mais_obitos_nome = $funeraria['0'];
        }
    }
    //OBTEM DADOS PARA A DETALHAR ANALISE DA TABELA DE MEIO DE TRANSPORTE
    $meio_de_trasporte_com_mais_obitos = 0;
    $meio_de_trasporte_com_mais_obitos_nome = '';
    foreach ($obitosPorTransporte as $transporte) {
        if ($transporte['3'] > $meio_de_trasporte_com_mais_obitos) {
            $meio_de_trasporte_com_mais_obitos = $transporte['3'];
            $meio_de_trasporte_com_mais_obitos_nome = $transporte['0'];
        }
    }
    
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

    <div style="line-height: 3px; text-align: center;">
        <h3>RELATÓRIO OBITOS RELACIONADOS A FUNERARIAS</h3>
        <h5>(Período: {{ $dados['periodo'] }})
        </h5>
    </div>

    <!--adicionar texto falando o objetivo deste relatario-->
    <!--Adicionar semanas de gestação, media por tipo de parto-->
    <p>
        Este relatório apresenta uma análise detalhada dos óbitos relacionados às funerárias,
        incluindo informações sobre as estatísticas de mortalidade e os resultados das investigações
        realizadas nesse contexto específico. O objetivo deste relatório é fornecer uma visão geral
        dos óbitos relacionados às funerárias e destacar as tendências e padrões que foram identificados
        ao longo do tempo.
    </p>
    <p>
        Os óbitos relacionados às funerárias são de extrema importância dentro desse setor, pois envolvem o
        registro correto e a investigação das causas de morte para garantir a prestação de serviços funerários
        adequados. Neste relatório, serão apresentados gráficos e tabelas que ilustram as principais conclusões
        e dados relevantes sobre a mortalidade, as causas de morte mais comuns e as investigações realizadas no
        contexto das funerárias.
    </p>
    <p>
        A análise desses dados específicos ajudará a fornecer insights importantes para melhorar a eficácia dos serviços
        funerários e garantir a qualidade dos dados sobre mortalidade relacionados às funerárias. Além disso, este
        relatório
        servirá como uma ferramenta útil para os profissionais do setor funerário e formuladores de políticas que buscam
        entender
        melhor as tendências e padrões relacionados aos óbitos no contexto das funerárias.
    </p>
    <div style="text-aling:center;">
        <h4>MEIO DE TRANSPORTE DOS OBITOS</h4>


        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Meio de transporte</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obitosPorTransporte as $transporte)
                    <tr>
                        <td>{{ $transporte['0'] }}</td>
                        <td>{{ $transporte['3'] }}</td>
                        <td>{{ number_format(($transporte['3'] / $totalObitos) * 100, 2, ',', '.') }}%</td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td>TOTAL</td>
                    <td>{{ $totalObitos }}</td>
                    <td>100%</td>
                </tr>
            </tfoot>
        </table>

        <p>
            O grafico abaixo mostra a quantidade de corpos que foram trazidos para o SVO por cada meio de transporte.
        </p>

        <div style="text-align: center;">
            <img width="400px" src="{{ $dados['grafico_tipo_transporte'] }}" alt="">
        </div>

        <P>
            O meio de transporte que mais trouxe corpos para o SVO foi
            <strong>{{ $meio_de_trasporte_com_mais_obitos_nome }}</strong>
            com <strong>{{ $meio_de_trasporte_com_mais_obitos }}</strong> corpos. totalizando
            <strong>{{ number_format(($meio_de_trasporte_com_mais_obitos / $totalObitos) * 100, 2, ',', '.') }}%</strong>

        </P>

    </div>

    <div>
        <h4>OBITOS RELACIONADOS A FUNERARIAS</h4>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Funerária</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($funerarias as $obito)
                    <tr>
                        <td>{{ $obito['0'] }}</td>
                        <td>{{ $obito['1'] }}</td>
                        <td>{{ number_format(($obito['1'] / $totalObitosFunerarias) * 100, 2, ',', '.') }}%</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>TOTAL</td>
                    <td>{{ $totalObitosFunerarias }}</td>
                    <td>100%</td>
                </tr>
            </tfoot>
        </table>
        <p>
            o grafico abaixo mostra a quantidade de corpos que foram trazidos para o SVO por cada funeraria.
        </p>

        <div style="text-align: center;">
            <img width="400px" src="{{ $dados['grafico_obitos_funerarias'] }}" alt="">
        </div>
        <p>
            A funeraria que teve trouxe a maior quantidade de corpos para o SVO foi a
            <strong>{{ $funeraria_com_mais_obitos_nome }}</strong>
            com <strong>{{ $funeraria_com_mais_obitos }}</strong> corpos. totalizando
            <strong>{{ number_format(($funeraria_com_mais_obitos / $totalObitosFunerarias) * 100, 2, ',', '.') }}%</strong>
            do total de óbitos.
        </p>
    </div>

</body>
