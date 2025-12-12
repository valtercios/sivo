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
        h4{
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
            <h4>TERMO DE RECONHECIMENTO DE CADÁVER</h4>
        </div>
        <div class="subtitulo" >
                    <span style="position: relative; left:180;"> LAUDO N°: _________</span>
            </h4>
        </div>

        <!-- No campo 'filho(a) de', será o nome do pai e mãe, no espaço que está, cabe ambos? ok

        No endereço, está até o campo 'bairro', tem como adicionar a cidade e estado?

        Na assinatura do patologista, vou questionar se esse campo deve vir preenchido do sistema, ou se obrigatoriamente deverá ser a assinatura física. -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -30px;">

            <p>
                Aos<u> _{{ \Carbon\Carbon::now()->format('d') }}_</u> dias do mês de <u>__{{  ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }}__</u> 
                do ano de <u>_{{ \Carbon\Carbon::now()->format('Y') }}_</u> , compareceu ao Serviço de
                Verificação de Óbitos (SVO), o(a) Sr(a). <u>__{{$corpo->responsavelCorpo->nome}}__</u>,
                que alegou, na qualidade de <u>_{{$corpo->responsavelCorpo->grau_parentesco}}_</u>
                do falecido e que, em minha presença e nas das testemunhas abaxo assinadas e identificadas,
                reconheceu e afirmou ser o cadaver de <u>_{{$corpo->nome}}_</u>, CPF n° <u>_{{$corpo->cpf}}_</u>,
                de cor  <u>_{{$corpo->entrevistaInfo->cor ?? "______________________"}}_</u>, idade de <u>_{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}_</u>,
                natural de <u>_{{$corpo->entrevistaInfo->naturalidade}}_</u>,estado civil <u>_{{$corpo->entrevistaInfo->estado_civil}}_</u>, nacionalidade <u>_{{$corpo->nacionalidade ?? "Brasileiro"}}_</u>,
                com profissão de <u>_{{$ocupacaoCorpo->ds_ocupacao ?? "______________________"}}_</u>,
                filho(a) de <u>_{{$corpo->entrevistaInfo->pai ?? "_______________________________________"}}_</u> e <u>_{{$corpo->entrevistaInfo->mae ?? "____________________________________________________"}}_</u>,
                residente na <u>_{{$corpo->enderecoCorpo->logradouro ?? "______________________"}}_</u>, n° <u>_{{$corpo->enderecoCorpo->numero ?? "________"}}_</u>,
                bairro <u>_{{$corpo->enderecoCorpo->bairro ?? "______________________"}}_</u>, cidade <u>_{{$corpo->enderecoCorpo->cidade ?? "______________________"}}_</u>,
                estado <u>_{{$corpo->enderecoCorpo->estado ?? "______________________"}}_</u>.
                E, por ser verdade, assume o declarante a inteira responsabilidade pelas declarações feitas acima.
            </p>

            <div
                style="text-align: center; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal - RN, em {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}.</div>
               
            </div>

            <p style="text-align: justify;">
                Assinatura do declarante: _____________________________________________________________________________
                CPF n°: <u>_{{$corpo->responsavelCorpo->cpf ??"____________________"}}</u>______________________________________________ <br>
                Residencia: <u>{{$corpo->responsavelCorpo->endereco->logradouro ?? "______________________"}},_ n° {{$corpo->responsavelCorpo->endereco->numero ?? "________________"}},_
                {{$corpo->responsavelCorpo->endereco->bairro ?? "______________________"}},_  {{$corpo->responsavelCorpo->endereco->cidade ?? "______________________"}} - 
                {{$corpo->responsavelCorpo->endereco->estado}}_________________</u> <br>
                Documento de identificação n°:__<u>{{$corpo->responsavelCorpo->rg ?? $corpo->responsavelCorpo->tipo_documento ."_". $corpo->responsavelCorpo->numero_documento }} ____ </u> orgão Expeditor:_<u>{{$corpo->responsavelCorpo->orgaoEmissor->nome ?? "___________"}} </u> <br><br>

                Assinatura da Testemunha 1: __________________________________________________________________________ <br>
                CPF n°: ________________________________________________________________________________________ <br>
                Residencia: __________________________________________________________________________________
                Documento de identificação n°: ______________________________ Orgão Expeditor: _______________
                <br>
                Assinatura da Testemunha 2: ________________________________________________________________________ <br>
                CPF n°: ______________________________ <br>
                Residencia: ________________________________________________________________________________________
                Documento de identificação n°: ______________________________ Orgão Expeditor: _______________
            </p>
            <div class="assinatura" style="text-align: center;" >PATOLOGISTA</div>
        </div>
        <!-- FIM CONTEUDO -->
    </div>
    <div style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center;  font-size:10px ;">
        <div id="data">Impresso por: {{ auth()->user()->name }}
        </div>
    </div>
</body>

</html>
