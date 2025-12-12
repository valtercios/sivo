<html>

<head>
    <title>SIVO || RELATORIO OBITOS FETAIS</title>
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
    $semanasGestacao = json_decode(base64_decode($dados['semanas_gestacao']));
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
        <h3>RELATÓRIO OBITOS FETAIS</h3>
        <h5>(Período: {{ $dados['periodo'] }})
        </h5>
    </div>

    <!--adicionar texto falando o objetivo deste relatario-->
    <!--Adicionar semanas de gestação, media por tipo de parto-->
    <p>
        Este relatório apresenta uma análise detalhada do serviço de verificação de óbitos fetais,
        incluindo informações sobre as estatísticas de mortalidade fetal e os resultados das investigações
        realizadas. O objetivo deste relatório é fornecer uma visão geral do serviço de verificação de óbitos
        fetais e destacar as tendências e padrões que foram identificados ao longo do tempo.
    </p>
    <p>
        O serviço de verificação de óbitos fetais é uma parte crucial do sistema de saúde pública, ajudando
        a garantir que as causas de morte fetal sejam corretamente registradas e investigadas. Neste relatório
        , serão apresentados gráficos e tabelas que ilustram as principais conclusões e dados relevantes sobre a
        mortalidade fetal, as causas de morte fetal mais comuns e as investigações realizadas pelo serviço..
    </p>
    <p>
        A análise desses dados ajudará a fornecer insights importantes para melhorar a eficácia do serviço de
        verificação de óbitos fetais e garantir a qualidade dos dados sobre a mortalidade fetal. Além disso, este
        relatório servirá como uma ferramenta útil para os profissionais de saúde e formuladores de políticas que
        buscam entender melhor as tendências e padrões relacionados aos óbitos fetais.
    </p>
    <div>
        {{-- <INICIO OBITOS POR SEMANAS DE GESTAÇÃO --}}
        <h4>OBITOS POR SEMANAS DE GESTAÇÃO</h4>

        <p>
            O periodo de gestação é um dos fatores que influenciam na mortalidade fetal. A tabela abaixo apresenta
            o total de óbitos fetais por semanas de gestação.
        </p>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50%;">SEMANAS DE GESTAÇÃO</th>
                    <th style="width: 50%;">TOTAL</th>
                    <th style="width: 25%;">PORCENTAGEM</th>
                </tr>
            </thead>
            @php
                $periodoMaiorNumeroObitos = '';
                $maiorNumeroObitos = 0;
            @endphp

            <tbody>
                @foreach ($semanasGestacao as $semana)
                    <tr>
                        <td>{{ $semana['0'] }}</td>
                        <td>{{ $semana['3'] }}</td>
                        <td>{{ number_format((intval($semana['3']) / $totalObitos) * 100, 2, ',', '.') }}%</td>
                    </tr>

                    @if (intval($semana['3']) > $maiorNumeroObitos)
                        @php
                            $periodoMaiorNumeroObitos = $semana['0'];
                            $maiorNumeroObitos = intval($semana['3']);
                        @endphp
                    @endif
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
            O grafico abaixo apresenta detalhadamente o total de óbitos fetais por sexo e semanas de gestação .</p>
        <div style="text-align: center;">
            <img width="350px" src="{{ $dados['grafico_obitos_semanas_gestacao'] }}" alt="">
        </div>
        <p>
            o periodo de gestação com maior numero de óbitos foi de<strong> {{ $periodoMaiorNumeroObitos }}
                semanas.</strong> Com um total de <strong>{{ $maiorNumeroObitos }}<strong> óbitos.
        </p>
    </div>
    {{-- FIM OBITOS POR SEMANAS DE GESTAÇÃO --}}

    <div>
        {{-- INICIO OBITOS POR TIPO DE PARTO --}}
        @php
            $tiposParto = json_decode(base64_decode($dados['tipos_parto']));
            $maiorTipoComObitos = '';
            $numeroMaiorTipoComObitos = 0;
        @endphp
        <h4>OBITOS POR TIPO DE PARTO</h4>

        <p>
            A tabela abaixo apresenta o total de óbitos fetais por tipo de parto.
        </p>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50%;">TIPO DE PARTO</th>
                    <th style="width: 25%;">QUANTIDADE</th>
                    <th style="width: 25%;">PORCENTAGEM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tiposParto as $tipoParto)
                    <tr>
                        <td>{{ $tipoParto->tipoparto }}</td>
                        @if ($tipoParto->tipoparto == 'Cesaria')
                            <td>{{ $tipoParto->total }}</td>
                        @elseif ($tipoParto->tipoparto == 'Vaginal')
                            <td>{{ $tipoParto->total }}</td>
                        @elseif ($tipoParto->tipoparto == 'Ignorado')
                            <td>{{ $tipoParto->total }}</td>
                        @endif
                        <td>{{ number_format(($tipoParto->total / $totalObitos) * 100, 2, ',', '.') }}%</td>
                    </tr>

                    @if ($tipoParto->total > $numeroMaiorTipoComObitos)
                        @php
                            $maiorTipoComObitos = $tipoParto->tipoparto;
                            $numeroMaiorTipoComObitos = $tipoParto->total;
                        @endphp
                    @endif
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
            O grafico abaixo apresenta detalhadamente o total de óbitos fetais por tipo de parto.</p>
        </p>
        <div style="text-align: center;">
            <img width="350px" src="{{ $dados['grafico_tipo_parto_gestacao'] }}" alt="">
        </div>
        <p>
            O tipo de parto com maior numero de óbitos foi o <strong>{{ $maiorTipoComObitos }}</strong> com um total de
            <strong>{{ $numeroMaiorTipoComObitos }}</strong> óbitos.
        </p>

    </div>
</body>
