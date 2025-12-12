<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDO DE VERIFICAÇÃO DE ÓBITO</title>


    <style>
        #conteudo {
            font-size: .8rem;
        }

        * {
            margin: 0px 15px;
            padding: 0px;
        }

        body {
            padding-top: 80px;
        }


        p {
            text-align: justify;
            line-height: 30px;
            margin-top: 20px;
        }

        #main {

            margin: 10px;
        }

        #descricao-estado {

            text-align: center;
            margin-top: 25px;
        }

        #logo-estado {

            position: absolute;
            top: 20;
            left: 10;
        }

        #cabecalho {

            align-items: center;
            margin-bottom: 18px;
            margin-top: -80px;
        }

        #logo-svo {

            position: absolute;
            top: 8;
            right: 10;
        }

        #conteudo {
            padding: 10px;
            border: 3px solid black;
        }

        .subtitulo {
            text-align: center;
            padding: 10px;
            text-decoration: underline;
        }

        .logo-cabecalho {
            height: 80px;
            padding: 10px;
        }

        .assinatura {
            margin-top: 40px;
            border-top: 1px solid black;
            width: 300px;
            padding: 5px;
        }

        .linha {
            border-bottom: 1px solid black;
        }

        .assinatura {
            position: relative;
            left: 220px;
        }

        .linha-campo {
            border-bottom: 2px solid black;
            padding: 1px;
        }

        .titulo {
            border-bottom: 3px solid black;
            text-align: center;
            font-weight: bold;
            padding: 0px;
            margin: 0px;
            margin-left: -10px;
            margin-top: -8px;
            width: 103%;
        }

        .vo {
            font-weight: bold;
            text-decoration: underline;
            margin-right: 10px;
            float: right;
        }

        h4 {
            text-transform: uppercase;
            margin: 2px 6px;
        }

        .page_break {
            page-break-before: always;
        }

        .area-texto {
            padding-bottom: 20px;
            padding-top: 10px;
            width: 95%;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .page-number::before {
            content: counter(page);

        }

        .exames {}
    </style>
</head>

<body>
    <div id="main">

        <!-- INICIO CABEÇALHO -->
        <div id="cabecalho">
            <div id="logo-estado" class="logo-cabecalho">
                <img src="{{ baseImage64('assets/images/svo-800.jpg') }}" width="100px" alt="">
            </div>
            <div id="descricao-estado" style="color:green;">
                <h4>GOVERNO DO ESTADO DO RIO GRANDE DO NORTE</h4>
                <h4>SECRETARIA DE ESTADO DA SAÚDE PÚBLICA</h4>
                <h4>SERVIÇO DE VERIFICAÇÃO DE ÓBITOS</h4>
            </div>
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h5>LAUDO DE VERIFICAÇÃO DE ÓBITO Nº.: {{ $corpo->laudo }}</h5>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo">
            <div class="titulo">
                <span>IDENTIFICAÇÃO</span>
                <div class="vo">
                    <div>
                        @if($corpo->num_vo)
                            <a>
                                <label>Número VO</label> {{ $corpo->num_vo . "/" . ($corpo->ano_vo ?? \Carbon\Carbon::parse($corpo->created_at)->format('Y')) }}
                            </a>
                        @else
                            <span>Não possui</span>
                        @endif
                    </div>
                    {{-- Fim do bloco --}} 
                </div>
                    
            </div>

            <div style="font-weight: bold">
                NOME: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 55.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->nome }}</h4>
                IDADE: @if ($corpo->natimorto == 0)
                    <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">
                        {{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}</h4>
                @else
                    <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">
                        NATIMORTO</h4>
                @endif
            </div>
            <div style="font-weight: bold">
                SEXO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 15.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}</h4>
                @if ($corpo->natimorto == 0)
                    ESTADO CIVIL: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 32%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->estado_civil }}</h4>
                @endif
                COR: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 12%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->cor }}</h4>
            </div>
            <div style="font-weight:bold;">
                DOC: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 88%; font-weight: normal; position: relative; top: 5px;">
                    @if (
                        $corpo->rg &&
                            ($corpo->entrevistaInfo->documento_identificacao == null ||
                                $corpo->entrevistaInfo->documento_identificacao == 'RG'))
                        RG {{ $corpo->rg ?? 'Não possui' }}
                        - {{ $corpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->estado_rg ? '/' . $corpo->estado_rg : '' }}
                    @else
                        {{ $corpo->entrevistaInfo->documento_identificacao }}
                        - {{ $corpo->entrevistaInfo->num_documento }}
                    @endif

                </h4>


            </div>
            @if ($corpo->natimorto == 0)
                <div style="font-weight:bold;">
                    ESCOLARIDADE: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 40%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->escolaridade_corpo }}
                    </h4>
                    @if (
                        $corpo->entrevistaInfo->escolaridade_corpo_serie != null &&
                            $corpo->entrevistaInfo->escolaridade_corpo_serie != 'Ignorado')
                        SERIE: <h4 class="linha-campo"
                            style=" font-weight: bold;display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">
                            {{ $corpo->entrevistaInfo->escolaridade_corpo_serie }}
                        </h4>
                    @endif
                </div>
            @endif
            <div style="font-weight: bold">
                ENDEREÇO DO ÓBITO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 70%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoObito->logradouro }}, {{ $corpo->enderecoObito->numero }},
                    {{ $corpo->enderecoObito->bairro }},
                    {{ $corpo->enderecoObito->cidade }}/{{ $corpo->enderecoObito->estado }}</h4>
                COMPLEMENTO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 70%; font-weight: normal; position: relative; top: 5px;">
                    @if ($corpo->enderecoObito->complemento == null)
                        Sem Complemento
                    @else
                        {{ $corpo->enderecoObito->complemento }}
                    @endif
                </h4>
            </div>
            <div style="font-weight: bold">
                DATA DE ÓBITO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 9%; font-weight: normal; position: relative; top: 5px;">
                    {{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y') }}</h4>
                LOCAL: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 39.5%; font-weight: normal; position: relative; top: 5px;">
                    @if ($corpo->local_obito == 'Hospital' || $corpo->local_obito == 'Outros estab. saúde')
                        {{ $corpo->local_obito }} - {{ $corpo->estabelecimento_obito }}
                    @elseif ($corpo->local_obito == 'Outros' || $corpo->local_obito == 'Via pública')
                        {{ $corpo->situacao }}
                    @else
                        {{ $corpo->local_obito }}
                    @endif
                </h4>
                HORA: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 6%; font-weight: normal; position: relative; top: 5px;">
                    {{ \Carbon\Carbon::parse($corpo->data_obito)->format('H:i') }}</h4>
            </div>
            <div style="font-weight: bold">
                PAI: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 88.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->pai }}</h4>
                MÃE: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 87%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->mae }}</h4>
            </div>
            <div style="font-weight: bold">
                D. NASC.: @if ($corpo->natimorto == 0)
                    <h4 class="linha-campo"
                        style="font-weight: bold; display:inline-block; width: 9%; font-weight: normal; position: relative; top: 5px;">
                        {{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('d/m/Y') }}</h4>
                @else
                    <h4 class="linha-campo"
                        style="font-weight: bold; display:inline-block; width: 11%; font-weight: normal; position: relative; top: 9px;">
                        NATIMORTO</h4>
                @endif
                NATURALIDADE: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 22%; font-weight: normal; position: relative; top: 3px;">
                    {{ $corpo->entrevistaInfo->naturalidade }}</h4>
                TELEFONE: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 15.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->telefone ?? '' }}</h4>
            </div>
            <div style="font-weight: bold;">
                OCUPAÇÃO: <h4 class="linha-campo"
                    style=" font-weight: bold;display:inline-block; width: 80%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->ocupacao->ds_ocupacao ?? 'Sem ocupação' }}
                    @if ($corpo->entrevistaInfo->ocupacao_id != null && $corpo->entrevistaInfo->aposentado == 1)
                        {{ ' - APOSENTADO' }}
                    @endif
                </h4>
            </div>
            <div style="font-weight: bold">
                ENDEREÇO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 80%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->logradouro }}, {{ $corpo->enderecoCorpo->numero }},
                    {{ $corpo->enderecoCorpo->bairro }},
                    {{ $corpo->enderecoCorpo->cidade }}/{{ $corpo->enderecoCorpo->estado }}</h4>
                COMPLEMENTO: <h4 class="linha-campo"
                    style="font-weight: bold; display:inline-block; width: 75%; font-weight: normal; position: relative; top: 5px;">
                    @if ($corpo->enderecoCorpo->complemento == null)
                        Sem complemento
                    @else
                        {{ $corpo->enderecoCorpo->complemento }}
                    @endif
                </h4>
            </div>
            @if ($corpo->entrevistaInfo->obito_fetal == 1)
                <h4 style="margin-top: 5px; margin-left: 15px !important;">OBITO FETAL E MENOR DE 01 ANO:</h4>
                <div style="font-weight: bold">
                    IDADE DA MÃE: <h4 class="linha-campo"
                        style="font-weight: bold; display:inline-block; width: 17%; font-weight: normal; position: relative; top: 5px;">
                        {{ calcularIdade($corpo->entrevistaInfo->data_nascimento_mae, \Carbon\Carbon::now())->text }}
                    </h4>
                    OCUPAÇÃO: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 45.5%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->ocupacaoMae->ds_ocupacao ?? 'Sem ocupação' }}</h4>
                </div>
                <div style="font-weight: bold">
                    NM: <h4 class="linha-campo"
                        style="font-weight: bold; display:inline-block; width: 2.5%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->nm }}</h4>
                    NV: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 2.5%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->nv }}</h4>
                    TEMPO DE GESTAÇÃO: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 15%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->tempo_gestacao . ' semana(s)' }}</h4>
                    TIPO DE PARTO: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 14.5%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->tipo_de_parto }}</h4>
                </div>
                <div style="font-weight: bold">
                    ESCOLARIDADE: <h4 class="linha-campo"
                        style=" font-weight: bold;display:inline-block; width: 40%; font-weight: normal; position: relative; top: 5px;">
                        {{ $corpo->entrevistaInfo->escolaridade_mae ?? 'Sem escolaridade' }}</h4>

                    @if (!empty($corpo->laudoInfo->created_at))
                        DATA DO EXAME:<span class="linha-campo">
                            {{ \Carbon\Carbon::parse($corpo->laudoInfo->data_exame)->format('d/m/Y - H:i') }}
                    @endif
                </div>
            @endif
            <br>
            <div class="titulo" style="border-top: 3px solid black; text-align:left;">
                HISTÓRICO (INFORMANTE):
            </div>
            <br>
            @if ($corpo->laudoInfo->historico != null)
                <pre style="min-height: 60px;" class="area-texto">{{ $corpo->laudoInfo->historico ?? '-' }}</pre>
            @endif
            <br>
            @if ($corpo->laudoInfo->exame_microscopia != null)
                <div class="titulo"
                    style="border-top: 3px solid  black; text-align:left; width: 103.5%; position: relative; left: -3px; top: 0px;">
                </div>

                <div style="min-height: 150px; page-break-inside: avoid;">
                    <div class="titulo"
                        style="border-top: 3px solid  black; text-align:left; width: 108.8%; position: relative; left: -18px; top: 5px;">
                        <span style="margin-left: 3px;">MICROSCOPIA</span>
                    </div>
                    <pre class="area-texto">{{ $corpo->laudoInfo->exame_microscopia ?? '-' }}</pre>
                </div>
            @endif
            <br>
        </div>


        <div class="page-number"
            style="text-align: right; margin-top: 100px; display: flex; flex-direction: column; align-items: center;">
            Página </div>
        <!-- FIM CONTEUDO -->

        {{-- QUEBRA DE PAGINA --}}
        <div style="page-break-before: always;"></div>

        <div id="conteudo" style='border-top: none !important; padding-top: 0px !important; '>
            <div
                style="border-bottom: 3px solid black;
                text-align: left;
                font-weight: bold;
                padding: 0px;
                margin: 0px;
                margin-left: -10px;
                margin-top: -8px;
                width: 103%;
                border-top: 3px solid black;">
                <div>
                    EXAME NECROSCÓPICO:
                </div>
            </div>
            <div style="height: auto; page-break-inside: avoid;" class="exames">
                <div class="titulo"
                    style=" text-align:left; width: 108%; position: relative; left: -12px; top: -2px;margin-top:2px;">
                </div>

                <!--verificar se os campos tem conteudo-->
                GERAL:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_geral }}</pre>
                CABEÇA:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_cabeca }}</pre>
                TÓRAX:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_torax }}</pre>
                ABDOME:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_abdome }}</pre>
                ORGÃOS GENITAIS:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_genitalia }}</pre>
                MEMBROS:
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_membros }}</pre>
            </div>

        </div>
        

            @if (
                    $corpo->laudoInfo->causa_a != null ||
                    $corpo->laudoInfo->causa_b != null ||
                    $corpo->laudoInfo->causa_c != null ||
                    $corpo->laudoInfo->causa_d != null)
                <div id="conteudo" style='border-top: none !important; padding-top: 0px !important; '>
                    <div class="titulo"
                        style="border-top: 3px solid  black; text-align:left; width: 103%; position: relative;top: 5px;">
                        <span style="margin-left: 3px;">Causas da morte</span>
                    </div>
                    @if ($corpo->laudoInfo->causa_a != null)
                        CAUSA DA MORTE A:
                        <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_a->descricao }}</pre>
                    @endif
                    @if ($corpo->laudoInfo->causa_b != null)
                        CAUSA DA MORTE B:
                        <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_b->descricao }}</pre>
                    @endif
                    @if ($corpo->laudoInfo->causa_c != null)
                        CAUSA DA MORTE C:
                        <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_c->descricao }}</pre>
                    @endif
                    @if ($corpo->laudoInfo->causa_d != null)
                        CAUSA DA MORTE D:
                        <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_d->descricao }}</pre>
                    @endif
                </div>
            @endif
            @if ($corpo->laudoInfo->causa_outras1 != null || $corpo->laudoInfo->causa_outras2 != null)
            <div id="conteudo" style='border-top: none !important; padding-top: 0px !important; '>
                <div class="titulo"
                    style="border-top: 3px solid  black; text-align:left; width:103.2%; position: relative; top: 3px;">
                    <span style="margin-left: 2px;">Outras condições significativas que contribuiram para a
                        morte</span>
                </div>
                @if ($corpo->laudoInfo->causa_outras1 != null)
                    CAUSA 1 :
                    <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_outras1->descricao }}</pre>
                @endif
                @if ($corpo->laudoInfo->causa_outras2 != null)
                    CAUSA 2:
                    <pre class="area-texto" style="margin-top: 3px;">{{ $corpo->laudoInfo->causa_outras2->descricao }}</pre>
                @endif
            </div>
            @endif

        <div id="data" class="page-number"
            style="text-align: right; margin-top: 100px; display: flex; flex-direction: column; align-items: center;">
            Página
        </div>

        {{-- QUEBRA DE PAGINA --}}
        <div style="page-break-before: always;"></div>


        {{-- pagina 2 --}}
        <div id="conteudo" style='border-top: none !important; padding-top: 0px !important;'>
            <div style="min-height:410px; page-break-inside: avoid;">
                <div class="titulo"
                    style="border-top: 3px solid  black; text-align:left; width: 108.8%; position: relative; left: -18px; top: 5px;">
                    <span style="margin-left: 3px;">MACROSCOPIA</span>
                </div>
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_macroscopia ?? ' ' }}</pre>
            </div>

            <div class="titulo"
                style="border-top: 3px solid  black; text-align:left; width: 103.5%; position: relative; left: -3px; top: 0px;">
            </div>

            <div style="min-height: 410px; page-break-inside: avoid;">

                <div class="titulo"
                    style="border-top: 3px solid  black; text-align:left; width: 108.8%; position: relative; left: -18px; top: 5px;">
                    <span style="margin-left: 3px;">CONCLUSÕES DIAGNÓSTICAS</span>
                </div>
                <pre class="area-texto">{{ $corpo->laudoInfo->exame_conclusoes ?? ' ' }}</pre>

            </div>

        </div>
        <div
            style="text-align: center; position: relative; right: 80px; bottom: 0; margin-top:20px display: flex; flex-direction: column; align-items: center;">
            <div class="assinatura">Assinatura do médico patologista</div>
        </div>
        <div style="text-align: right; margin-top: 100px; display: flex; flex-direction: column; align-items: center;">
            <div id="data" class="page-number">Página - Natal {{ \Carbon\Carbon::now()->format('d') }}
                de {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }}
                de {{ \Carbon\Carbon::now()->format('Y') }} às {{ \Carbon\Carbon::now()->format('H:i:s') }}.
            </div>

        </div>


    </div>
</body>

</html>
