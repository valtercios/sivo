<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FICHA DE NOTIFICAÇÃO DE CÂNCER</title>


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
            <h4>FICHA DE NOTIFICAÇÃO DE CÂNCER</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo">
            <p>
                Ano: {{ $dados->ano }} <span class="espaco"> </span> Fonte Notificadora: {{ $dados->fontenotificadora ?? 'Não informado'}}<br>
                Identificação do Paciente <br>
                Prontuário: {{ $dados->prontuario ?? 'Não informado'}}<br>
                Cartão SUS: {{ $dados->cartaosus ?? 'Não informado'}} <span class="espaco"> </span> CPF: {{ $dados->cpf }} <span class="espaco"> </span> Documento: RG - {{ $dados->rg }} - {{ $corpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->estado_rg ? '/' . $corpo->estado_rg : '' }} <br>
                Nome completo do paciente: {{ $corpo->nome }} <br>
                Nome da mãe: {{ $dados->mae ?? 'Não informado'}} <br>
                Sexo: {{ $dados->sexo ?? 'Não informado'}} <span class="espaco"> </span> Data de nacimento: {{ \Carbon\Carbon::parse($dados->data_nascimento)->format('d/m/Y') }} <span class="espaco"> </span> Idade: {{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }} <br>
                Raça/Cor: {{ $dados->cor ?? 'Não informado'}} <br>
                Nacionalidade: {{$corpo->nacionalidade ?? 'Brasileiro'}} <span class="espaco"> </span> Naturalidade: {{ $dados->naturalidade ?? 'Não informado'}} <br>
                Estado Civil: {{ $dados->estado_civil ?? 'Não informado'}} <br>
                Escolaridade: {{ $dados->escolaridade ?? 'Não informado' }}<br>
                Ocupação/Profissão: {{ $dados->ocupacao ?? 'Não informada' }} <br>
                Endereço<br>
                Logradouro: {{ $dados->logradouro }}<br>
                Número: {{ $dados->numero }}<span class="espaco"> Complemento: Sem complemento<span class="espaco"> Bairro: {{ $dados->bairro }} <br>
                CEP: {{ $dados->cep }}<span class="espaco"> Município: {{ $dados->cidade }}<span class="espaco"> UF: {{ $dados->estado }} <br>
                Procedência: {{ $dados->procedencia ?? 'Não informado'}}<span class="espaco"> </span> Nº Exame: {{ $dados->numexame ?? 'Não informado'}}<span class="espaco"> </span> <br>
                Topografia: {{ $dados->topografia ?? 'Não informado'}} <span class="espaco"> </span> Morfologia: {{ $dados->morfologia ?? 'Não informado'}}<span class="espaco"> </span> <br>
                Meio de Diagnóstico: {{ $dados->meio_diagnostico ?? 'Não informado'}}<span class="espaco"> </span> <br>
                Extensão da Doença: {{ $dados->extensao_doenca ?? 'Não informado'}} <span class="espaco"> </span> <br>
                Data do Diagnóstico: {{ \Carbon\Carbon::parse($dados->data_diagnostico)->format('d/m/Y') }} <span class="espaco"> </span> Data do Óbito: {{ \Carbon\Carbon::parse($dados->data_obito)->format('d/m/Y') }} <span class="espaco"> </span> Data da Coleta: {{ \Carbon\Carbon::parse($dados->data_coleta)->format('d/m/Y') }} <span class="espaco"> </span> <br>
                Registrador: {{ auth()->user()->name }}

            </p>
            

        </div>

        <!-- FIM CONTEUDO -->
    </div>
    <div style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center;  font-size:10px ;">
        <div id="data">Impresso por: {{ auth()->user()->name }}
        </div>
    </div>
</body>

</html>
