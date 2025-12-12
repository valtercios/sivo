<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERMO DE NÃO AUTORIZAÇÃO DE AUTOPSIA</title>


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
            <div id="logo-estado" class="logo-cabecalho" >
                <img src="{{ baseImage64('assets/images/logoestado.png') }}" width="65px" alt="">
            </div>
            <div id="descricao-estado" >
                <h4 >GOVERNO DO ESTADO DO RIO GRANDE DO NORTE</h4>
                <h4>SECRETARIA DE ESTADO DA SAÚDE PÚBLICA</h4>
                <h4>SERVIÇO DE VERIFICAÇÃO DE ÓBITOS</h4>
            </div>
            <div id="logo-svo" class="logo-cabecalho" >
                <img src="{{ baseImage64('assets/images/svo-800.jpg') }}" width="100px" alt="">
            </div>
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h4>TERMO DE NÃO AUTORIZAÇÃO DE AUTOPSIA</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo">
            <p>
                Eu, <span class="linha-campo">{{ $corpo->responsavelCorpo->nome }} </span>, na qualidade de <span class="linha-campo">{{ $corpo->responsavelCorpo->grau_parentesco }}</span>,
                residente <span class="linha-campo">{{ $corpo->responsavelCorpo->endereco->logradouro }}</span> nº <span class="linha-campo">{{ $corpo->responsavelCorpo->endereco->numero }}</span>, portador do RG <span class="linha-campo">{{ $corpo->responsavelCorpo->rg }}</span>, CPF <span class="linha-campo">{{ $corpo->responsavelCorpo->cpf }}</span> responsabilizo-me
                por todas as informações prestadas ao SERVIÇO DE VERIFICAÇÃO DE ÓBITOS/Natal-RN relacionadas ao falecido(a) <span class="linha-campo">{{ $corpo->nome }}</span>, RG <span class="linha-campo">{{ $corpo->rg ?? 'Não possui' }}</span>
                tendo óbito ocorrido no dia <span class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('d') }}/{{ \Carbon\Carbon::parse($corpo->data_obito)->format('m') }}/{{\Carbon\Carbon::parse($corpo->data_obito)->format('Y') }}</span> Às <span class="linha-campo">{{\Carbon\Carbon::parse($corpo->data_obito)->format('H') }}</span>:<span class="linha-campo">{{\Carbon\Carbon::parse($corpo->data_obito)->format('i') }}</span> h,
                declaro que <span class="linha-campo">não</span> <span class="linha-campo">autorizo</span>  o (a) médico(a) patologista  plantonista do S.V.O. a realizar necropsia  no referido cadáver e que estou ciente que a não autorização da autopsia do corpo, acarretará a não determinação da Causa Mortis e que fui informado (a) das consequências futuras (por exemplo, dificuldades em receber indenizações ou benefícios) que possam acontecer com a não definição da doença que ocasionou o óbito.

            </p>
            

            <div
                style="text-align: center; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de {{ \Carbon\Carbon::now()->format('Y') }}.</div>
                <div class="assinatura">Assinatura do Responsável pelo corpo</div>
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
