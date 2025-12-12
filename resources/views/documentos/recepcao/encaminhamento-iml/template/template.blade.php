<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECLARAÇÃO DE GRAU DE PARENTESCO</title>



    <style>
        #conteudo {
            font-size: 1rem;
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
                <img src="{{ baseImage64('assets/images/svo-800.jpg') }}" width="100px" alt="">
            </div>
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h4>TERMO DE AUTORIZAÇÃO PARA RETIRADA DO CORPO E ENCAMINHAMENTO PARA O IML</h4>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -20px;">

            <div style="text-align: center;">Em conformidade com a Portaria Conjunta S/N° - SESAP – ITEP de 18 de abril
                de 2017</div>
            <div style="line-height: 25px; text-align: justify; width: 98%;">
                
                Eu, <span class="linha-campo">{{ $dados['nome_responsavel'] }} </span>
                Portador(a) do 
                {{$dados['tipo_documento_responsavel'] ?? 'RG'}}: <span class="linha-campo">{{ $dados['numero_documento_responsavel'] ?? '-'}} </span>
                @if($dados['tipo_documento_responsavel'] == 'RG' || $dados['tipo_documento_responsavel'] == null)
                {{ $dados['orgao_emissor_responsavel'] ?? '-' }}/{{ $dados['estado_rg_responsavel'] ?? 'RN' }}
                @endif
                , CPF:<span class="linha-campo">{{ $dados['cpf_responsavel'] ?? 'NÃO POSSUI'}} </span>, residente e
                domiciliado(a) a <span class="linha-campo">{{ $dados['logradouro'] }} </span>
                Nº <span class="linha-campo">{{ $dados['numero'] }} </span> bairro <span
                    class="linha-campo">{{ $dados['bairro'] }} </span>, cidade <span
                    class="linha-campo">{{ $dados['cidade'] }} </span>, telefone <span
                    class="linha-campo">{{ $dados['telefone_contato'] }} </span>, Estado Federativo <span
                    class="linha-campo">{{ $dados['estado'] }} </span>, afirmo
                ter o grau de parentesco ou outro grau de
                responsabilidade (abaixo assinalado) com o morto de nome <span class="linha-campo">{{ $corpo->nome }}
                </span>
                nascido em <span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('d') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('m') }}</span>/<span
                    class="linha-campo">{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('Y') }}</span>,
                cujo corpo encontra-se no SVO-SESAP/RN.
                
            </div>
            <h5>GRAU DE PARENTESCO:</h5>
                Cônjuge ( {{ $dados['grau_parentesco_responsavel'] == 'Cônjuge' ? 'X' : '' }} )<br>
                Companheiro(a) com comprovante de união estável (
                {{ $dados['grau_parentesco_responsavel'] == 'Companheiro(a) com comprovante de união estável' ? 'X' : '' }}
                ) <br>
                1° Grau: ( {{ $dados['grau_parentesco_responsavel'] == 'Filho' ? 'X' : '' }} ) Filho (
                {{ $dados['grau_parentesco_responsavel'] == 'Pai' ? 'X' : '' }} ) Pai (
                {{ $dados['grau_parentesco_responsavel'] == 'Mãe' ? 'X' : '' }} ) Mãe (
                {{ $dados['grau_parentesco_responsavel'] == 'Pai/Mãe' ? 'X' : '' }} ) Pai/Mãe
                <br>
                2° Grau: ( {{ $dados['grau_parentesco_responsavel'] == 'Neto' ? 'X' : '' }} ) Neto (
                {{ $dados['grau_parentesco_responsavel'] == 'Avós' ? 'X' : '' }} ) Avós (
                {{ $dados['grau_parentesco_responsavel'] == 'Irmãos' ? 'X' : '' }} ) Irmãos<br>
                3° Grau: ( {{ $dados['grau_parentesco_responsavel'] == 'Bisneto' ? 'X' : '' }} ) Bisneto (
                {{ $dados['grau_parentesco_responsavel'] == 'Bisavós' ? 'X' : '' }} ) Bisavós (
                {{ $dados['grau_parentesco_responsavel'] == 'Tios' ? 'X' : '' }} ) Tios (
                {{ $dados['grau_parentesco_responsavel'] == 'Sobrinhos' ? 'X' : '' }} ) Sobrinhos<br>
                4° Grau: ( {{ $dados['grau_parentesco_responsavel'] == 'Trineto' ? 'X' : '' }} ) Trineto (
                {{ $dados['grau_parentesco_responsavel'] == 'Trisavós' ? 'X' : '' }} ) Trisavós (
                {{ $dados['grau_parentesco_responsavel'] == 'Sobrinho-neto' ? 'X' : '' }} ) Sobrinho-neto (
                {{ $dados['grau_parentesco_responsavel'] == 'Tio-avô' ? 'X' : '' }} ) Tio-avô
                {{ $dados['grau_parentesco_responsavel'] == 'Primo' ? 'X' : '' }} ) Primo<br>
            <br>
            <div>
                Através deste instrumento, eu acima identificado, autorizo a Empresa
                Funerária <span class="linha-campo">{{ $dados['funeraria'] }} </span> a retirar e encaminhar o corpo da
                pessoa acima mencionada ao IML-NATAL/RN,
                para exame necroscópico.

            </div>
            <div
                style="text-align: right; margin-top: 10px; display: flex; flex-direction: column; align-items: center; margin-right: 60px;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}.</div>
            </div>

            <div
                style="text-align: center; margin-top: 10px; display: flex; flex-direction: column; align-items: center;">
                <div class="assinatura">Parente Responsável Pela Retirada do Corpo</div>
            </div>

            <div
                style="text-align: center; margin-top: 10px; display: flex; flex-direction: column; align-items: center;">

                <div class="assinatura">Funcionário da Empresa Funerária com respectivo RG, Responsável Pelo Transporte
                    do Corpo</div>
            </div>

            <div
                style="text-align: center; margin-top: 10px; display: flex; flex-direction: column; align-items: center;">

                <div class="assinatura">Necrotomista do SVO/NATAL Responsável Pela Entrega do Corpo</div>
            </div>

            <div
                style="text-align: center; margin-top: 10px; display: flex; flex-direction: column; align-items: center;">
                <div class="assinatura">Atendente Responsável Pela Entrega dos Documentos</div>
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
