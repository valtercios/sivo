<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de consentimento livre e esclarecido</title>

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
            <h4>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO(TCLE)</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -15px;">
            <p>
                Eu, <span class="linha-campo">{{ $corpo->responsavelCorpo->nome }} </span>, na qualidade de <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->grau_parentesco }}</span>,
                domiciliado na <span class="linha-campo">{{ $corpo->responsavelCorpo->endereco->logradouro }}</span> nº
                <span class="linha-campo">{{ $corpo->responsavelCorpo->endereco->numero }}</span> bairro <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->endereco->bairro }}</span> cidade <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->endereco->cidade }}</span> identificado pelo
                documento {{$corpo->responsavelCorpo->tipo_documento ?? 'RG' }} nº <span
                class="linha-campo">{{$corpo->responsavelCorpo->numero_documento ?? $corpo->responsavelCorpo->rg }}</span>
                    @if(($corpo->responsavelCorpo->tipo_documento == null || $corpo->responsavelCorpo->tipo_documento == 'RG') && $corpo->responsavelCorpo->orgaoEmissor)
                    </span> orgão emissor <span
                    class="linha-campo">{{ $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelCorpo->estado_rg ? '/' . $corpo->responsavelCorpo->estado_rg : '' }}</span> responsabilizo-me
                    @endif
                    pelas informações fornecidas e pelos documentos apresentados do(a)
                falecido(a) <span class="linha-campo">{{ $corpo->nome }}</span>,
                aos {{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }} de idade
                ,
                com óbito ocorrido no dia <span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y') }}</span>
                Às <span class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('H') }}</span> horas e <span class="linha-campo">{{\Carbon\Carbon::parse($corpo->data_obito)->format('i')}}</span> minutos,
                e autorizio o(a) Dr(a)
                <span class="linha-campo">{{ $medico->name }}</span>,
                médico(a) patologista, CRM/RN nº <span class="linha-campo">{{ $medico->crm }}</span>, a realizar a
                Autopsia Verbal ou Necropsia.

            </p>
            <p>
                1-Declaro estar informado(a) da extensão do exame, autorizando, expressamente, o exame externo do corpo,
                em se tratando de
                doenças já diagnosticadas clinicamente, mas que o óbito tenha ocorrido em residência, ou naquelas de
                alto poder de infectividade, que
                podem expor a equipe à contaminação, como ocorreu na pandemia da COVID-19, ou, o exame com a abertura o
                cadáver e retirada
                de amostras teciduais ou peça anatômica, que se fizerem necessárias ao esclarecimento da causa da morte.
            </p>
            <p>
                2-Permito, ainda, que o exame se necessário possa ser documentado com fotografias, para estudo
                científico da doença, e que o caso seja incluído no Banco de informações de estatística de óbitos do
                SVO/RN, para estudo e uso em pesquisas realizadas pelo órgão, garantindo o SIGILO de modo que a
                A IDENTIDADE DO FALECIDO SERÁ PRESERVADA.
            </p>
            <p>
                3-Fui informado que, de acordo com o art. 162 do código de processo penal; "A autópsia será feita pelo
                menos 6 (seis) horas depois
                do óbito, salvo se os peritos, pela evidência dos sinais de morte, julgarem que possa ser feita antes
                daquele prazo". Concordo que o
                cadáver, quando terminado o exame e guardada a boa aparência externa, deverá ser colocado á disposição
                da família.
            </p>
            <p>
                <strong>NOTA 1:</strong>
                Este TCLE deverá ser <strong>ASSINADO NA PRESENÇA DO MEDICO PATOLOGISTA</strong> responsável pela
                realização
                do exame cadavérico.
            </p>
            <p>
                <strong>NOTA 2:</strong>
                Recomenda-se ao familiar responsável pela remoção do corpo, a conferência dos dados digitados no
                Documento de Declaração de óbito (DO) e o reconhecimento do cadáver.
            </p>
            <p>
                <strong>NOTA 3:</strong>
                É permitido pelo Ministério da Saúde que possíveis correções venham a ser feitas posteriormente no
                documento, exceto na parte relativa aos diagnósticos do médico. O SVO - Natal está disponível para esta
                retificação. Há um prazo legal de 15 dias para que a DO seja registrada em Cartório e seja emitida a
                Certidão de Óbito.
            </p>

            <div
                style="text-align: center; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}.</div>
                <div class="assinatura">Assinatura do Responsável pelo corpo</div>
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
