<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECLARAÇÃO DE GRAU DE PARENTESCO</title>

    

    <style>
        #conteudo {
            font-size: 0.7rem;
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
            line-height: 18px;
            margin-top: 10px;
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
            <h4>DECLARAÇÃO DE GRAU DE PARENTESCO</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -30px;">
            
            <p>
                <div>
                    Nome: <h4 class="linha-campo" style="display:inline-block; width: 86%; font-weight: normal; position: relative; top: 5px;">{{ $testemunhas['nome_parente'] ?? '-'}}</h4>
                </div>
                <div>
                    RG: <h4 class="linha-campo" style="display:inline-block; width: 87.5%; font-weight: normal; position: relative; top: 5px;">{{ $testemunhas['documento_parente']?? 'Não possui' }}</h4>
                </div>
                <div>
                    Data de nascimento: <h4 class="linha-campo" style="display:inline-block; width: 77%; font-weight: normal; position: relative; top: 5px;">{{ \Carbon\Carbon::parse($testemunhas['data_nascimento_parente'])->format('d/m/Y') }}</h4>
                </div>
                <div>
                    Nome da Mãe: <h4 class="linha-campo" style="display:inline-block; width: 80.5%; font-weight: normal; position: relative; top: 5px;">{{ $testemunhas['nome_mae'] ?? '' }}</h4>
                </div>
                <div>
                    Nome do Pai: <h4 class="linha-campo" style="display:inline-block; width: 81%; font-weight: normal; position: relative; top: 5px;">{{ $testemunhas['nome_pai'] ?? '' }}</h4>
                </div>
                <p style="font-size: .7rem; width: 85%; margin-left: 40px; margin-top: -8px;">
                    Sob pena de Responsabilidade, com amparo na LEI n° 10.406, de 10 de janeiro de 2002, no Capítulo II dos Direitos da Personalidade, Art. 12, Parágrafo Único e do Capítulo XI, Subtítulo II das Relações de Parentesco, Art. 1.591, Art. 1.592, Art. 1.593, Art. 1.594 e Art. 1.595, declaro o grau de parentesco, consanguíneo ou civil, em linha reta, colateral ou de afinidade da pessoa abaixo mencionada:
                </p>
                <div style="margin-left: 40px;">
                    Falecido(a): <h4 class="linha-campo" style="display:inline-block; width: 81%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->nome }}</h4>
                </div>
                <div style="margin-left: 40px;">
                    RG: <h4 class="linha-campo" style="display:inline-block; width: 40%; font-weight: normal; position: relative; top: 5px;">
                        @if($corpo->rg)
                            {{$corpo->rg}} - {{ $corpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->estado_rg ? '/' . $corpo->estado_rg : '' }}
                        @else
                            {{'Não possui'}}
                        @endif
                    </h4>
                    CPF: <h4 class="linha-campo" style="display:inline-block; width: 41%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->cpf ?? 'Não possui' }}</h4>
                </div>
                <p>
                    Cônjuge ( {{$testemunhas['grau_parentesco_responsavel']== 'Cônjuge' ? 'X' : '' }} )<br>
                    Companheiro(a) com comprovante de união estável ( {{$testemunhas['grau_parentesco_responsavel']== 'Companheiro(a) com comprovante de união estável' ? 'X' : '' }} ) <br>
                    1° Grau: ( {{$testemunhas['grau_parentesco_responsavel']== 'Filho' ? 'X' : '' }} ) Filho       ( {{$testemunhas['grau_parentesco_responsavel']== 'Pai' ? 'X' : '' }}  ) Pai         ( {{$testemunhas['grau_parentesco_responsavel']== 'Mãe' ? 'X' : '' }}  ) Mãe ( {{$testemunhas['grau_parentesco_responsavel']== 'Pai/Mãe' ? 'X' : '' }}  ) Pai/Mãe<br>
                    2° Grau: (  {{$testemunhas['grau_parentesco_responsavel']== 'Neto' ? 'X' : '' }} ) Neto       ( {{$testemunhas['grau_parentesco_responsavel']== 'Avós' ? 'X' : '' }}  ) Avós      (  {{$testemunhas['grau_parentesco_responsavel']== 'Irmãos' ? 'X' : '' }} ) Irmãos<br>
                    3° Grau: (  {{$testemunhas['grau_parentesco_responsavel']== 'Bisneto' ? 'X' : '' }} ) Bisneto  (  {{$testemunhas['grau_parentesco_responsavel']== 'Bisavós' ? 'X' : '' }} ) Bisavós  ( {{$testemunhas['grau_parentesco_responsavel']== 'Tios' ? 'X' : '' }}  ) Tios                      ( {{$testemunhas['grau_parentesco_responsavel']== 'Sobrinhos' ? 'X' : '' }}  ) Sobrinhos<br>
                    4° Grau: ( {{$testemunhas['grau_parentesco_responsavel']== 'Trineto' ? 'X' : '' }}  ) Trineto  ( {{$testemunhas['grau_parentesco_responsavel']== 'Trisavós' ? 'X' : '' }}  ) Trisavós (  {{$testemunhas['grau_parentesco_responsavel']== 'Sobrinho-neto' ? 'X' : '' }} ) Sobrinho-neto   ( {{$testemunhas['grau_parentesco_responsavel']== 'Tio-avô' ? 'X' : '' }}  ) Tio-avô ( {{$testemunhas['grau_parentesco_responsavel']== 'Primo' ? 'X' : '' }}  ) Primo<br>
                    Outros: ( {{$testemunhas['grau_parentesco_responsavel']== 'Outros' ? 'X' : '' }} ) {{ $testemunhas['grau_parentesco_responsavel'] == 'Outros' ? $testemunhas['grau_parentesco_responsavel_outro'] : ''}}
                </p>
                <p style="width: 90%;">
                    Assim, declaro para fins registrados, que as informações são verdadeiras, sob pena de responder por crime de falsidade ideológica, nos termos do Art. 299 do Decreto-Lei n° 2.848, de 7 de dezembro de 1940 – Código Penal.
                </p>
                
            </p>
            <br>
            <div>
                Declarante: <h4 class="linha-campo" style="display:inline-block; width: 83%; font-weight: normal; position: relative; top: 5px;"></h4>
            </div>
            <div
                style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center; margin-right: 60px;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de {{ \Carbon\Carbon::now()->format('Y') }}.</div>
            </div>

            <p style="display:inline-block">
                TESTEMUNHAS: <br>
                1) Nome: {{ $testemunhas['nome_testemunha_1'] }}<br>
                   CPF ou RG {{ $testemunhas['documento_testemunha_1'] }}<br>
                   Endereço: {{ "{$testemunhas['logradouro_testemunha_1']} nº {$testemunhas['numero_testemunha_1']} , {$testemunhas['bairro_testemunha_1']}, {$testemunhas['cidade_testemunha_1']}/{$testemunhas['estado_testemunha_1']}  " }}<br>
            </p>
            <p style="display:inline-block">
                <br>
                2) Nome: {{ $testemunhas['nome_testemunha_2'] }}<br>
                   CPF ou RG {{ $testemunhas['documento_testemunha_2'] }}<br>
                   Endereço: {{ "{$testemunhas['logradouro_testemunha_2']} nº {$testemunhas['numero_testemunha_2']} , {$testemunhas['bairro_testemunha_2']}, {$testemunhas['cidade_testemunha_2']}/{$testemunhas['estado_testemunha_2']}  " }}<br>
            </p>
            <div style="margin-top: -5px; font-size: .6rem;">
                <strong>
                    OBS: Esta Declaração deverá ser em 02 (duas) vias.<br><br>
                    Decreto-Lei n° 2.848, de 7 de dezembro de 1940, Art. 299 – Omitir, em documento público ou particular, declaração que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que deia ser escrita, com o fim de prejudicar direito, criar obrigação ou alterar verdade sobre fato juridicamente relevante:<br><br>
                    Pena – reclusão, de um a cinco anos, e multa, se o documento é público, e reclusão de um a três anos, e multa de quinhentos mil réis a cinco contos de réis, se o documento é particular.<br><br>
                    Parágrafo único – Se o agente é funcionário público, e o crime prevalecendo-se do cargo, ou se a falsificação ou alteração é de assentamento de registro civil, aumenta-se a pena de sexta parte.<br><br>
                </strong>
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
