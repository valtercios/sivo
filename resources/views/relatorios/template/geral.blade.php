<html>

<head>
    <title>SIVO || RELATORIO GERAL</title>
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
            <h3>RELATÓRIO GERAL DE EVENTOS</h3>
            <h5>(Período: {{ $dados['periodo'] }})
            </h5>
        </div>

        <p> Este relatório apresenta uma análise detalhada do serviço de verificação de óbitos, incluindo informações
            sobre as estatísticas de mortalidade e os resultados das investigações realizadas. O objetivo deste
            relatório é fornecer uma visão geral do serviço de verificação de óbitos e destacar as tendências e padrões
            que foram identificados ao longo do tempo.</p>
        <p>O serviço de verificação de óbitos é uma parte crucial do sistema de saúde pública, ajudando a garantir que
            as causas de morte sejam corretamente registradas e investigadas. Neste relatório, serão apresentados
            gráficos e tabelas que ilustram as principais conclusões e dados relevantes sobre a mortalidade, as causas
            de morte mais comuns e as investigações realizadas pelo serviço.</p>
        <p>A análise desses dados ajudará a fornecer insights importantes para melhorar a eficácia do serviço de
            verificação de óbitos e garantir a qualidade dos dados sobre mortalidade. Além disso, este relatório servirá
            como uma ferramenta útil para os profissionais de saúde e formuladores de políticas que buscam entender
            melhor as tendências e padrões relacionados à mortalidade.</p>

        @php
            $opcoesRelatorio = json_decode(base64_decode($dados['configuracoes-relatorio-input']));
        @endphp


        {{-- RELATORIO DE OBITOS POR MUNICIPIO --}}

        @if (in_array('obitos_municipio', $opcoesRelatorio))
            @php
                $obitosMunicipio = json_decode(base64_decode($dados['obitos_municipio']), true);
            @endphp

            <h4>ÓBITOS POR MUNICIPIO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>O maior número de óbitos ocorre no município de
                    <strong>{{ $obitosMunicipio[key($obitosMunicipio)]['nome'] }}</strong> com
                    {{ $obitosMunicipio[key($obitosMunicipio)]['obitos'] }} óbitos
                    ({{ $obitosMunicipio[key($obitosMunicipio)]['obitos'] == 0 ? 0 : number_format((float) ($obitosMunicipio[key($obitosMunicipio)]['obitos'] / $totalObitos) * 100, 2, '.', '') . '%' }})
                    de registros de
                    um total de <strong>{{ $totalObitos }}
                        óbitos</strong>.
                </p>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Município</th>
                        <th>Óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>

                    @foreach ($obitosMunicipio as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['nome'] }}</td>
                            <td>{{ $obito['obitos'] }}</td>
                            <td>{{ $obito['obitos'] == 0 ? 0 : number_format((float) ($obito['obitos'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}



        {{-- RELATORIO DE ÓBITOS POR BAIRRO --}}

        @if (in_array('obitos_bairro', $opcoesRelatorio))
            @php
                $obitosBairro = json_decode(base64_decode($dados['obitos_bairro']), true);
            @endphp
            <h4>ÓBITOS POR BAIRRO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>O maior número de óbitos ocorre no bairro de
                    <strong>{{ $obitosBairro[key($obitosBairro)]['nome'] }}</strong> com
                    {{ $obitosBairro[key($obitosBairro)]['obitos'] }} óbitos
                    ({{ $obitosBairro[key($obitosBairro)]['obitos'] == 0 ? 0 : number_format((float) ($obitosBairro[key($obitosBairro)]['obitos'] / $totalObitos) * 100, 2, '.', '') . '%' }})
                    de registros de
                    um total de <strong>{{ $totalObitos }}
                        óbitos.</strong>
                </p>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Bairro</th>
                        <th>Óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>

                    @foreach ($obitosBairro as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['nome'] }}</td>
                            <td>{{ $obito['obitos'] }}</td>
                            <td>{{ $obito['obitos'] == 0 ? 0 : number_format((float) ($obito['obitos'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS ENCAMINHADOS AO ITEP --}}

        @if (in_array('obitos_encaminhados_itep', $opcoesRelatorio))
            @php
                $dadosEncaminhadosITEP = json_decode(base64_decode($dados['encaminhados_itep']), true);
            @endphp
            <h4>ÓBITOS ENCAMINHADOS AO ITEP</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>No quesito de óbitos encaminhados ao ITEP foi registrado um maior número de óbitos em
                    <strong>{{ $dadosEncaminhadosITEP['data'][$dadosEncaminhadosITEP['maior']]['label'] }}</strong>,
                    registrando um
                    total de <strong>{{ $dadosEncaminhadosITEP['data'][$dadosEncaminhadosITEP['maior']]['value'] }}
                        óbitos</strong>.
                </p>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Tipo</th>
                        <th>Óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>

                    @foreach ($dadosEncaminhadosITEP['data'] as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['label'] }}</td>
                            <td>{{ $obito['value'] }}</td>
                            <td>{{ $obito['value'] == 0 ? 0 : number_format((float) ($obito['value'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS ENCAMINHADOS A LIGA --}}

        @if (in_array('obitos_encaminhados_liga', $opcoesRelatorio))
            @php
                $dadosEncaminhadosLIGA = json_decode(base64_decode($dados['encaminhados_liga']), true);
            @endphp
            <h4>ÓBITOS ENCAMINHADOS A LIGA</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>No quesito de óbitos encaminhados a LIGA foi registrado um maior número de óbitos em
                    <strong>{{ $dadosEncaminhadosLIGA['data'][$dadosEncaminhadosLIGA['maior']]['label'] }}</strong>,
                    registrando um
                    total de <strong>{{ $dadosEncaminhadosLIGA['data'][$dadosEncaminhadosLIGA['maior']]['value'] }}
                        óbitos</strong>.
                </p>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Tipo</th>
                        <th>Óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>

                    @foreach ($dadosEncaminhadosLIGA['data'] as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['label'] }}</td>
                            <td>{{ $obito['value'] }}</td>
                            <td>{{ $obito['value'] == 0 ? 0 : number_format((float) ($obito['value'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS QUE UTILIZARAM MÉDICO INTERNO/EXTERNO --}}

        @if (in_array('obitos_medico_interno_externo', $opcoesRelatorio))
            @php
                $dadosMedicoExternoInterno = json_decode(base64_decode($dados['medico_externo_interno']), true);
            @endphp
            <h4>ÓBITOS QUE UTILIZARAM MÉDICO INTERNO/EXTERNO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>No quesito de óbitos realizados por médico interno/externo foi registrado um maior número de óbitos
                    em
                    <strong>{{ $dadosMedicoExternoInterno['data'][$dadosMedicoExternoInterno['maior']]['label'] }}</strong>,
                    registrando um
                    total de
                    <strong>{{ $dadosMedicoExternoInterno['data'][$dadosMedicoExternoInterno['maior']]['value'] }}
                        óbitos</strong>.
                </p>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Tipo</th>
                        <th>Óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>

                    @foreach ($dadosMedicoExternoInterno['data'] as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['label'] }}</td>
                            <td>{{ $obito['value'] }}</td>
                            <td>{{ $obito['value'] == 0 ? 0 : number_format((float) ($obito['value'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- INICIO OBITOS EM RELAÇÃO AO PARTO --}}
        @if (in_array('obitos_parto', $opcoesRelatorio))

            @php
                $obitosFaseParto = json_decode(base64_decode($dados['obitos_parto']), true);
            @endphp
            <h4>ÓBITOS EM RELAÇÃO AO PARTO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                @if (isset($obitosFaseParto[0]['morte_relacao_parto']) && !empty($obitosFaseParto[0]['morte_relacao_parto']))
                    <p>No quesito óbitos em relação ao parto o maior número de óbitos foi registrado na fase
                        <strong>{{ $obitosFaseParto[0]['morte_relacao_parto'] }} do parto</strong>
                        com um total de <strong>{{ $obitosFaseParto[0]['total'] . ' óbito(s)' }}</strong>.
                    </p>
                @endif
            @endif

            @if (in_array('exibir_tabelas', $opcoesRelatorio))

                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Morte em relação ao parto</th>
                        <th>Número de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                    @foreach ($obitosFaseParto as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['morte_relacao_parto'] }}</td>
                            <td>{{ $obito['total'] }}</td>
                            <td>{{ $obito['total'] == 0 ? 0 : number_format((float) ($obito['total'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ array_sum(array_column($obitosFaseParto, 'total')) }} óbito(s)</div>
            @endif

        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}


        {{-- RELATORIO DE ÓBITOS POR LOCAL DE OCORRÊNCIA --}}

        @if (in_array('obitos_local_ocorrencia', $opcoesRelatorio))
            @php
                $obitosLocalOcorrencia = json_decode(base64_decode($dados['obitos_local_ocorrencia']), true);
            @endphp
            <h4>ÓBITOS POR LOCAL DE OCORRÊNCIA</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>No quesito local de ocorrência o maior número de óbitos foi relacionada ao campo de
                    <strong>{{ $obitosLocalOcorrencia['maior'][0] }}</strong> com um total de
                    {{ $obitosLocalOcorrencia['maior'][1] }} óbito(s)
                    ({{ $obitosLocalOcorrencia['maior'][1] == 0 ? 0 : number_format((float) ($obitosLocalOcorrencia['maior'][1] / $totalObitos) * 100, 2, '.', '') . '%' }})
                    em relação a um total óbitos de <strong>{{ $totalObitos }}
                        óbito(s).</strong>
                </p>
            @endif
            @if (in_array('exibir_graficos', $opcoesRelatorio))
                <div style="text-align: center;">
                    <img width="500px" src="{{ $dados['grafico_local_ocorrencia'] }}" alt="">
                </div>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
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
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif
        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS POR MÊS --}}

        @if (in_array('obitos_mes', $opcoesRelatorio))

            @php
                $obitosMes = json_decode(base64_decode($dados['obitos_mes']), true);
            @endphp

            <h4>ÓBITOS POR MÊS</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>Os números e percentuais de óbitos revelam que ocorreu o maior número de registros nos meses de
                    <strong>
                        {{ $obitosMes['maior'] }} </strong> com <strong>
                        {{ $obitosMes['data'][$obitosMes['maior']] }} óbito(s)</strong>
                    @if ($obitosMes['maior2'])
                        e <strong>{{ $obitosMes['maior2'] }}</strong> com
                        <strong>{{ $obitosMes['data'][$obitosMes['maior2']] }} óbito(s)</strong>
                    @endif
                    , e registrou uma
                    mínima no
                    mês de <strong>{{ $obitosMes['menor'] }}</strong> com
                    <strong>{{ $obitosMes['data'][$obitosMes['menor']] }} óbito(s)</strong>.
                </p>
            @endif
            @if (in_array('exibir_graficos', $opcoesRelatorio))
                <div style="text-align: center;">
                    <img width="500px" src="{{ $dados['grafico_obitos_mes_line'] }}" alt="">
                </div>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-faixa-etaria">
                    <tr>
                        <th>Mês</th>
                        <th>Número de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                    @foreach ($obitosMes['data'] as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $key }}</td>
                            <td>{{ $obito }}</td>
                            <td>{{ $obito == 0 ? 0 : number_format((float) ($obito / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif

        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- INICIO OBITOS POR OCUPACAO --}}
        @if (in_array('obitos_ocupacao', $opcoesRelatorio))

            @php
                $obitosOcupacao = json_decode(base64_decode($dados['obitos_ocupacao']), true);
            @endphp
            <h4>ÓBITOS POR OCUPAÇÃO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                @if (isset($obitosOcupacao[0]['ocupacao_nome']) && !empty($obitosOcupacao[0]['ocupacao_nome']))
                    <p>No quesito ocupação o maior número de óbitos foi registrado na ocupação de
                        <strong>{{ $obitosOcupacao[0]['ocupacao_nome'] }}</strong>
                        com um total de <strong>{{ $obitosOcupacao[0]['total'] . ' óbitos' }}</strong>.
                    </p>
                @endif
            @endif
            @if (in_array('exibir_graficos', $opcoesRelatorio))
                <div style="text-align: center;">
                    <img width="500px" src="{{ $dados['grafico_obitos_ocupacao'] }}" alt="">
                </div>
            @endif

            @if (in_array('exibir_tabelas', $opcoesRelatorio))

                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Ocupação</th>
                        <th>Número de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                    @foreach ($obitosOcupacao as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['ocupacao_nome'] }}</td>
                            <td>{{ $obito['total'] }}</td>
                            <td>{{ $obito['total'] == 0 ? 0 : number_format((float) ($obito['total'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif

        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS POR FAIXA ETÁRIA --}}

        @if (in_array('obitos_faixa_etaria', $opcoesRelatorio))

            @php
                $obitosFaixaEtaria = json_decode(base64_decode($dados['dados_faixa_etaria']), true);
                $maiorFaixaEtaria = json_decode(base64_decode($dados['maior_faixa_etaria']), true);
                $faixaMaior = str_replace('-', ' a ', $maiorFaixaEtaria['faixaetaria']);
            @endphp

            <h4>ÓBITOS POR FAIXA ETÁRIA</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>A prevalência de óbitos está presente na população <strong>{{ $maiorFaixaEtaria['tipo'] }}</strong>,
                    na faixa
                    de
                    <strong>{{ $faixaMaior }}
                        anos</strong>, com um total de {{ $maiorFaixaEtaria['soma'] }} óbito(s).
                </p>
            @endif
            @if (in_array('exibir_graficos', $opcoesRelatorio))
                <div style="text-align: center;">
                    <img width="500px" src="{{ $dados['grafico_faixa_etaria_sexo_barra'] }}" alt="">
                </div>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-faixa-etaria">
                    <tr>
                        <th>Faixa etária(anos)</th>
                        <th>Homens</th>
                        <th>Mulheres</th>
                        <th>% em relação ao total</th>
                        <th>Total</th>
                    </tr>
                    @foreach ($obitosFaixaEtaria as $obito)
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
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif

        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

        {{-- RELATORIO DE ÓBITOS POR SEXO --}}

        @if (in_array('obitos_sexo', $opcoesRelatorio))
            @php
                $dadosObitosSexo = json_decode(base64_decode($dados['obitos_sexo_dados']), true);
            @endphp

            <h4>ÓBITOS POR SEXO</h4>
            @if (in_array('exibir_introducao', $opcoesRelatorio))
                <p>A maior incidência de óbitos prevalece no sexo
                    <strong>{{ $dadosObitosSexo['data'][$dadosObitosSexo['maior']]['label'] }}</strong> registrando um
                    total de
                    <strong>{{ $dadosObitosSexo['data'][$dadosObitosSexo['maior']]['value'] }} óbitos</strong>, na qual
                    representa um percentual de
                    <strong>{{ $dadosObitosSexo['data'][$dadosObitosSexo['maior']]['value'] == 0 ? 0 : number_format((float) ($dadosObitosSexo['data'][$dadosObitosSexo['maior']]['value'] / $totalObitos) * 100, 2, '.', '') . '%' }}</strong>
                    em relação ao total.
                </p>
            @endif
            @if (in_array('exibir_graficos', $opcoesRelatorio))
                <div style="text-align: center;">
                    <img width="400px" src="{{ $dados['grafico_sexo_pie'] }}" alt="">
                </div>
            @endif
            @if (in_array('exibir_tabelas', $opcoesRelatorio))
                <table style="width:95%" id="table-obitos-municipio">
                    <tr>
                        <th>Sexo</th>
                        <th>Total de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                    @foreach ($dadosObitosSexo['data'] as $key => $obito)
                        <tr class="avoid-page-break">
                            <td>{{ $obito['label'] }}</td>
                            <td>{{ $obito['value'] }}</td>
                            <td>{{ $obito['value'] == 0 ? 0 : number_format((float) ($obito['value'] / $totalObitos) * 100, 2, '.', '') . '%' }}
                            </td>
                        </tr>
                    @endforeach


                </table>
                <div style="float:right; font-size: 14px; margin-right: 5%; font-weight: bold;">Total de óbitos:
                    {{ $totalObitos }} óbitos</div>
            @endif

        @endif

        {{-- FIM SEÇÃO DO RELATORIO --}}

    </main>
</body>

</html>
