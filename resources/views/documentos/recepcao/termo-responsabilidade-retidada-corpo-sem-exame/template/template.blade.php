<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERMO DE RESPONSABILIDADE DE RETIRADA DE CADÁVER SEM EXAME DE NECROPSIA.</title>

    

    <style>
        #conteudo {
            font-size: 1rem;
        }

        body{
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
            left: 190px;
            top: 20px;
            text-align: center;
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
            width:100%;
            height:200px;
            border:1px solid;
        }

        div{
            margin: 10px 0px;
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
            <h4>TERMO DE RESPONSABILIDADE DE RETIRADA DE CADÁVER SEM EXAME DE NECROPSIA</h4>
        </div>


        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -30px;">

            <p style="width: 95%; text-align: justify">
               Eu <span class="linha-campo">{{ ($corpo->responsavelCorpo) ? $corpo->responsavelCorpo->nome : '' }} </span> RG <span class="linha-campo">{{ ($corpo->responsavelCorpo) ? $corpo->responsavelCorpo->rg : '' }} </span>
                    CPF <span class="linha-campo">{{ ($corpo->responsavelCorpo) ? $corpo->responsavelCorpo->cpf : '' }} </span> na qualidade de <span class="linha-campo">{{ ($corpo->responsavelCorpo) ? $corpo->responsavelCorpo->grau_parentesco : '' }} </span> 
                    , responsabilizo-me pela retirada do corpo de <span class="linha-campo">{{ $corpo->nome }} </span> no  Serviço de verificação de Óbito (SVO)-SESAP/RN.
                    
            </p>
            <br>
            
            <p>
                ( ) com declaracao de óbito N° : _________________
                <br>
                ( ) sem declaração de óbito
            </p>

            <div
                style="text-align: right; margin-top: 30px; margin-right: 18px; margin-bottom: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}</div>
                <br>
                <div class="assinatura">Responsavel pela retirada do corpo</div>
                <br>
                 <div class="assinatura">Responsavel pela entrega do corpo</div>
                 <br>
                <div class="assinatura">responsavel pela entrega dos documentos</div>

            </div>
            
        </div>

        <!-- FIM CONTEUDO -->
    </div>
    <div style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center;  font-size:10px ;">
        <div id="data">Impresso por: {{ auth()->user()->name }}
        </div>
    </div>
</body>

</html>
