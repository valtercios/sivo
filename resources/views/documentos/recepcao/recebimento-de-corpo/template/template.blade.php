<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENTRADA DE CORPOS NO SERVIÇO DE VERIFICAÇÃO DE ÓBITO (SVO)</title>



    <style>
        #conteudo {
            font-size: 0.9rem;
        }

        body {
            padding: 20px;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        p {
            text-align: justify;
            line-height: 30px;
            margin-top: 20px;
        }

        #main {
            border: 1px solid black;
            margin: 10px;
        }

        #descricao-estado {
            text-align: center;
            margin-top: 25px;
        }

        #logo-estado {
            border-right: 1px solid black;
            position: absolute;
            top: 16;
            left: 20;

        }

        #logo-estado img {
            margin-top: 15px;
        }

        #logo-svo img {
            margin-top: 15px;
        }

        #cabecalho {
            align-items: center;
            margin-bottom: 18px;
        }

        #logo-svo {
            border-left: 1px solid black;
            position: absolute;
            top: 16;
            right: 20;
        }



        #conteudo {
            padding: 10px;
        }

        .subtitulo {
            text-align: center;
            padding: 10px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            background-color: #dbdbdbd4;
        }

        .logo-cabecalho {
            height: 100px;
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
            border-bottom: 1px solid black;
            padding: 5px;
        }

        li {
            display: flex;
        }

        li .dots {
            border-bottom: 1px dotted black;
            flex: 1;
        }

        .container {
            width: 100%;
            height: 200px;
            border: 1px solid;
        }

        div {
            margin: 10px 0px;
        }

        h4 {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div id="main">
        <!-- INICIO CABEÇALHO -->
        <div id="cabecalho">
            <div id="logo-estado" class="logo-cabecalho">
                <img src="{{ baseImage64('assets/images/logoestado.png') }}" width="65px" alt="">
            </div>
            <div id="descricao-estado">
                <h4>GOVERNO DO ESTADO DO RIO GRANDE DO NORTE</h4>
                <h4>SECRETARIA DE ESTADO DA SAÚDE PÚBLICA</h4>
                <h4>SERVIÇO DE VERIFICAÇÃO DE ÓBITOS</h4>
            </div>
            <div id="logo-svo" class="logo-cabecalho">
                <img src="{{ baseImage64('assets/images/svo-800.jpg') }}" width="95px" alt="">
            </div>
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h4>ENTRADA DE CORPOS NO SERVIÇO DE VERIFICAÇÃO DE ÓBITO (SVO)</h4>
        </div>
        <div class="subtitulo">
            <h4>Data de entrada do corpo: <span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_entrada)->format('d') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_entrada)->format('m') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_entrada)->format('Y') }}</span> Horário:
                <span class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_entrada)->format('H:i') }}</span>
                @if ($corpo->num_vo != null)
                    Número VO: <span class="linha-campo">{{ $corpo->num_vo }}</span>/<span
                        class="linha-campo">{{ $corpo->ano_vo ?? \Carbon\Carbon::parse($corpo->created_at)->format('Y') }}</span>
                @endif
            </h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->
        {{-- @dd($corpo); --}}

        <div id="conteudo" style="margin-top: -30px;">

            <p>
                <strong>1. Falecido(a)</strong><br>
            <div>
                Nome: <h4 class="linha-campo"
                    style="display:inline-block; width: 60%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->nome }}
                </h4>
                Sexo: <h4 class="linha-campo"
                    style="display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->sexo == 'M' ? '(  ) F ( X ) M' : '( X ) F (  ) M ' }}
                </h4>
            </div>

            <div>
                {{ $corpo->tipo_documento }}: <h4 class="linha-campo"
                    style="display:inline-block; width: 50%; font-weight: normal; position: relative; top: 5px;">
                    @if ($corpo->tipo_documento == 'RG')
                        {{ $corpo->rg ?? '-' }} - {{ $corpo->orgaoEmissor->sigla ?? '-' }} -
                        {{ $corpo->estado_rg ? '/' . $corpo->estado_rg : '' }}
                    @else
                        {{ $corpo->numero_documento ?? 'Não possui' }}
                    @endif
                </h4>
                <br>
                CPF: <h4 class="linha-campo"
                    style="display:inline-block; width: 30.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->cpf ?? 'Não possui' }}</h4>
            </div>
            <div>
                Endereço: <h4 class="linha-campo"
                    style="display:inline-block; width: 50%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->logradouro }}, nº {{ $corpo->enderecoCorpo->numero }}</h4>
                Complemento: <h4 class="linha-campo"
                    style="display:inline-block; width: 23%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->complemento }}</h4>
            </div>
            <div>
                Bairro: <h4 class="linha-campo"
                    style="display:inline-block; width: 24.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->bairro }}</h4>
                Cidade: <h4 class="linha-campo"
                    style="display:inline-block; width: 23%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->cidade }}</h4>
                Estado: <h4 class="linha-campo"
                    style="display:inline-block; width: 23%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoCorpo->estado }}</h4>



            </div>
            <br>
            <strong>2. Data do óbito <span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('d') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('m') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('Y') }}</span></strong>
            <span style="float:right; margin-right: 20px; font-weight:bold;">Horário: <span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('H:i') }}</span></span>
            <br>
            <div>
                Local do óbito: <h4 class="linha-campo"
                    style="display:inline-block; width: 81.5%; font-weight: normal; position: relative; top: 5px;">
                    @if ($corpo->local_obito == 'Hospital' || $corpo->local_obito == 'Outros estab. saúde')
                        {{ $corpo->local_obito }} - {{ $corpo->estabelecimento_obito }}
                    @elseif ($corpo->local_obito == 'Via pública' || $corpo->local_obito == 'Outros') 
                        {{ $corpo->local_obito }} - {{ $corpo->situacao }}
                    @else
                        {{ $corpo->local_obito }}
                    @endif
                </h4>
            </div>

            <div>
                Endereço: <h4 class="linha-campo"
                    style="display:inline-block; width: 86%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoObito->logradouro ?? '-' }}, nº {{ $corpo->enderecoObito->numero ?? '-' }}</h4>
            </div>
            <div>
                Bairro: <h4 class="linha-campo"
                    style="display:inline-block; width: 24.5%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoObito->bairro }}</h4>
                Cidade: <h4 class="linha-campo"
                    style="display:inline-block; width: 23%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoObito->cidade }}</h4>
                Estado: <h4 class="linha-campo"
                    style="display:inline-block; width: 23%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->enderecoObito->estado }}</h4>

            </div>

            <strong>3. Funerária que trouxe o corpo </strong>
            <h4 class="linha-campo"
                style="display:inline-block; width: 65.5%; font-weight: normal; position: relative; top: 5px;">
                @if ($corpo->funeraria)
                    {{ $corpo->funeraria->nome }}
                @else
                    @if ($corpo->meio_transporte)
                        <br>
                        <strong>Meio de Transporte:</strong>
                        {{ $corpo->meio_transporte }}
                        {{ $corpo->meio_transporte_outro ? ' - ' . $corpo->meio_transporte_outro : '' }}
                    @else
                        <br>
                        Não há funerária ou meio de transporte
                    @endif
                @endif
            </h4>
            <br>
            <strong>4. Responsável pelo corpo </strong>
            <h4 class="linha-campo"
                style="display:inline-block; width: 71%; font-weight: normal; position: relative; top: 5px;">
                {{ $corpo->responsavelCorpo->nome ?? $corpo->responsavelEntrega->nome }}</h4><br>

            {{-- preenche com dados do responsavel pelo corpo --}}
            @if ($corpo->responsavel_corpo_id)
                <div>
                    {{ $corpo->responsavelCorpo->tipo_documento ?? 'RG' }}<h4 class="linha-campo"
                        style="display:inline-block; width: 40%; font-weight: normal; position: relative; top: 5px;">
                        @if (
                            ($corpo->responsavel_corpo_id && $corpo->responsavelCorpo->tipo_documento == 'RG') ||
                                $corpo->responsavelCorpo->tipo_documento == null)
                            {{ $corpo->responsavelCorpo->rg ?? '-' }} -
                            {{ $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelCorpo->estado_rg ? '/' . $corpo->responsavelCorpo->estado_rg : '' }}
                    </h4>
                @elseif($corpo->responsavelCorpo->tipo_documento != 'RG')
                    {{ ':  ' . $corpo->responsavelCorpo->numero_documento }}
                @else
                    {{ $corpo->responsavelCorpo->rg ?? '-' }} -
                    {{ $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '-' }}{{ $corpo->responsavelCorpo->estado_rg ? '/' . $corpo->responsavelCorpo->estado_rg : '' }}
                    </h4>
            @endif
            </h4>
            CPF: <h4 class="linha-campo"
                style="display:inline-block; width: 30%; font-weight: normal; position: relative; top: 5px;">
                @if ($corpo->responsavelCorpo->cpf == null && $corpo->responsavelCorpo->cpf == null)
                    Não possui
                @else
                    {{ $corpo->responsavelCorpo->cpf ?? '-' }}
            </h4>
            @endif
        </div>
        <div>
            Grau de parentesco: <h4 class="linha-campo"
                style="display:inline-block; width: 45%; font-weight: normal; position: relative; top: 5px;">
                {{ $corpo->responsavelCorpo->grau_parentesco ?? '' }}</h4>
            Telefone: <h4 class="linha-campo"
                style="display:inline-block; width: 21.5%; font-weight: normal; position: relative; top: 5px;">
                {{ $corpo->responsavelCorpo->telefone ?? '' }}</h4>
        </div>

        {{-- preenche com os dados do responsavel pela entrega --}}
    @else
        <div>
            {{ $corpo->responsavelEntrega->tipo_documento ?? 'RG' }}<h4 class="linha-campo"
                style="display:inline-block; width: 40%; font-weight: normal; position: relative; top: 5px;">
                @if (
                    ($corpo->responsavel_corpo_id && $corpo->responsavelEntrega->tipo_documento == 'RG') ||
                        $corpo->responsavelEntrega->tipo_documento == null)
                    {{ $corpo->responsavelEntrega->rg }} -
                    {{ $corpo->responsavelEntrega->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelEntrega->estado_rg ? '/' . $corpo->responsavelEntrega->estado_rg : '' }}
            </h4>
        @elseif($corpo->responsavelEntrega->tipo_documento != 'RG')
            {{ ':  ' . $corpo->responsavelEntrega->numero_documento }}
        @else
            {{ $corpo->responsavelEntrega->rg }} -
            {{ $corpo->responsavelEntrega->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelEntrega->estado_rg ? '/' . $corpo->responsavelEntrega->estado_rg : '' }}
            </h4>
            @endif
            </h4>
            CPF: <h4 class="linha-campo"
                style="display:inline-block; width: 30%; font-weight: normal; position: relative; top: 5px;">
                @if ($corpo->responsavelEntrega->cpf == null && $corpo->responsavelEntrega->cpf == null)
                    Não possui
                @else
                    {{ $corpo->responsavelEntrega->cpf ?? $corpo->responsavelEntrega->cpf }}
            </h4>
            @endif
        </div>


        @endif
        <div>
            Endereço: <h4 class="linha-campo"
                style="display:inline-block; width: 85.5%; font-weight: normal; position: relative; top: 5px;">
                {{ $corpo->responsavelCorpo->endereco->logradouro ?? $corpo->responsavelEntrega->endereco->logradouro }},
                {{ $corpo->responsavelCorpo->endereco->numero ?? $corpo->responsavelEntrega->endereco->numero }} -
                {{ $corpo->responsavelCorpo->endereco->bairro ?? $corpo->responsavelEntrega->endereco->bairro }} -
                {{ $corpo->responsavelCorpo->endereco->cidade ?? $corpo->responsavelEntrega->endereco->cidade }}/{{ $corpo->responsavelCorpo->endereco->estado ?? $corpo->responsavelEntrega->endereco->estado }}
            </h4>
        </div>
        {{--            <strong>5. Familiar informa que o corpo será: </strong>{{ ucfirst($corpo->corposera ?? $corpo->corposera) }}<br> --}}
        {{--            </p> --}}



        <strong>5. Familiar informa que o corpo será:
        </strong>{{ $corpo->corpoSera ?? '(Responsável não estava presente para informar)' }}<br>
        </p>


        <div style="text-align: center; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
            <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                {{ \Carbon\Carbon::now()->format('Y') }}.</div>
            <div class="assinatura">Assinatura do Responsável (Declarante)</div>
        </div>
        <strong>6. Responsável pelo preenchimento </strong>
        <h4 class="linha-campo"
            style="display:inline-block; width: 61%; font-weight: normal; position: relative; top: 5px;">
            {{ optional($corpo->user)->name }} </h4><br>
        {{-- optional($corpo->user)->name ?? \App\Models\User::find($corpo->cadastradopor)?->name ?? '-'  --}}
        <strong>7. Necrotomista que recebeu o corpo </strong>
        <h4 class="linha-campo"
            style="display:inline-block; width: 59.5%; font-weight: normal; position: relative; top: 5px;">
            {{ $corpo->necrotomista->name ?? (\App\Models\User::find($corpo->necrotomista_id)?->name ?? '-') }}</h4>
        <br>
        <strong>8. Pertences do(a) falecido(a):</strong>
        <h4 class="linha-campo"
            style="display:inline-block; min-width: 66%; font-weight: normal; position: relative; top: 5px;">
            {{ $corpo->pertences ?? 'Nenhum pertence' }}</h4>
    </div>

    <!-- FIM CONTEUDO -->
    </div>
    <div
        style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center;  font-size:10px ;">
        <div id="data">Impresso por: {{ auth()->user()->name }}
        </div>
    </div>
</body>

</html>
