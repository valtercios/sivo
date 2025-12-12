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
            <h3>RELATÓRIO DE ÓBITOS POR MÊS</h3>
            @if ($dados['periodo_relatorio'])
                <h5>(Período: {{ $dados['periodo_relatorio'] }})</h5>
            @endif
        </div>

        <p>Este relatório apresenta uma análise dos óbitos registrados pelo Serviço de Verificação de Óbitos (SVO) ao
            longo dos últimos meses. O SVO é responsável por verificar as causas das mortes em situações em que elas
            ocorrem fora de hospitais ou em circunstâncias suspeitas.</p>
        <p>Com base nos dados coletados pelo serviço, este relatório busca apresentar uma compreensão mais clara das
            tendências e padrões de mortalidade na região, bem como das principais causas de óbito. A análise mês a mês
            permite identificar variações significativas e acompanhar a evolução dos casos, fornecendo informações
            importantes para a gestão da saúde pública e a implementação de políticas eficazes de prevenção e controle
            de doenças.</p>

        @php
            $obitosMes = json_decode(base64_decode($dados['obitos_mes']), true);
        @endphp

        <h4>ÓBITOS POR MÊS</h4>
        
        <p>O maior número e percentual de óbitos revelam que ocorreu o maior número de registros nos meses de
            {{ $obitosMes['maior'] }} com
            {{ $obitosMes['data'][$obitosMes['maior']] }} óbito(s)
            @if ($obitosMes['maior2'])
                e {{ $obitosMes['maior2'] }} com {{ $obitosMes['data'][$obitosMes['maior2']] }} óbito(s)
            @endif
            , e registrou uma
            mínima no
            mês de {{ $obitosMes['menor'] }} com {{ $obitosMes['data'][$obitosMes['menor']] }} óbito(s).
        </p>
        <div style="clear:both;"></div>
        <div style="margin-top: 50px;">
            <img width="350px" src="{{ $dados['grafico_obitos_mes_line'] }}" alt="">
            <img width="350px" src="{{ $dados['grafico_obitos_mes_area'] }}" alt="">

        </div>

        <table style="width:95%" id="table-faixa-etaria">
            <tr>
                <th>Mês</th>
                <th>Número de óbitos</th>
                <th>% em relação ao total</th>
            </tr>
            @foreach ($obitosMes['data'] as $key => $obito)
                @if($obito != 0)
                    <tr class="">
                        <td>{{ $key }}</td>
                        <td>{{ $obito }}</td>
                        <td>{{ $obito == 0 ? 0 : number_format((float) ($obito / $totalObitos) * 100, 2, '.', '') . '%' }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </main>
</body>

</html>
