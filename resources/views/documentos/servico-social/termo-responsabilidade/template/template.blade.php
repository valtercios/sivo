<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERMO DE RESPONSABILIDADE</title>

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
            font-family: Arial, Helvetica, sans-serif;
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
        h4{
            text-transform: uppercase;
        }
        .area-texto{
            padding-bottom: 20px; 
            padding-top: 10px;
            width:95%; 
            white-space: pre-wrap; 
            word-wrap: break-word;
        }
        strong{
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
                <img src="{{ baseImage64('assets/images/svo-800.jpg') }}" width="100px" alt="">
            </div>
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h4>TERMO DE RESPONSABILIDADE</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo">

            <p>
                Eu, <span class="linha-campo">{{ $corpo->responsavelCorpo->nome }}</span>, brasileiro, estado civil:
                {{ $corpo->entrevistaInfo->estado_civil }},
                {{ $corpo->responsavelCorpo->tipo_documento ?? 'RG'}} : {{$corpo->responsavelCorpo->numero_documento ?? $corpo->responsavelCorpo->rg }}
                ,@if($corpo->responsavelCorpo->tipo_documento == 'RG' || $corpo->responsavelCorpo->tipo_documento == null ) 
                @if($corpo->responsavelCorpo->orgaoEmissor)
                Órgao expedidor <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelCorpo->estado_rg ? '/' . $corpo->responsavelCorpo->estado_rg : '' }} -
                    {{ $corpo->responsavelCorpo->orgaoEmissor->nome ?? '' }}</span>
                @endif
                @endif
                , CPF: {{ $corpo->responsavelCorpo->cpf ?? 'NÃO POSSUI'}}, domiciliado em: domiciliado na <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->endereco->logradouro }}</span> nº <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->endereco->numero }}</span>,
                declaro para todos os fins, que trouxe ao serviço de verificação de óbitos de Natal, o corpo de
                {{ $corpo->nome }}, RG: {{ $corpo->rg ?? 'Não possui' }}, CPF: {{ $corpo->cpf ?? 'Não possui' }}, nascido em
                {{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('d') }}/{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('m') }}/{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('Y') }},
                falecido em
                {{ \Carbon\Carbon::parse($corpo->data_obito)->format('d') }}/{{ \Carbon\Carbon::parse($corpo->data_obito)->format('m') }}/{{ \Carbon\Carbon::parse($corpo->data_obito)->format('Y') }},
                endereço: <span class="linha-campo">{{ $corpo->enderecoCorpo->logradouro }}</span> nº <span
                    class="linha-campo">{{ $corpo->enderecoCorpo->numero }}

            </p>

            <p>
                Local de falecimento:
                @if ($corpo->local_obito == 'Hospital' || $corpo->local_obito == 'Outros estab. saúde')
                    {{ $corpo->local_obito }} - {{ $corpo->estabelecimento_obito }}
                @elseif($corpo->local_obito == 'Outros' || $corpo->local_obito == 'Via pública')
                    {{ $corpo->situacao }}
                @else
                    {{ $corpo->local_obito }}
                @endif
            </p>
            <p>
                Declaro também, que desconheço que o falecido possua algum parente vivo, que possa se responsabilizar
                pela liberação, sepultamento e registro do óbito.
            </p>

            <p>
                Relação com a pessoa falecida: {{ $corpo->responsavelCorpo->grau_parentesco }}
            </p>
            <p>
                Perante esse termo de responsabilidade me coloco a disposição para resolver todo o trâmite do funeral ao
                registro de óbito na forma da lei.
            </p>

            <div
                style="text-align: center; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}.</div>
            </div>
        </div>

        <!-- FIM CONTEUDO -->
    </div>
    <div style="text-align: right; margin-top: 100px; display: flex; flex-direction: column; align-items: center;  font-size:10px ;">
        <div id="data">Impresso por: {{ auth()->user()->name }} em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>

</html>
