<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCAMINHAMENTO DE MATERIAL PARA PESQUISA DE MICROORGANISMOS PELO LACEN</title>


    <style>
        #conteudo {
            font-size: .9rem;
        }

        * {
            margin: 0px 15px;
            padding: 0px;
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

        .assinatura{
            position: relative;
            left: 220px;
        }
        .linha-campo{
            border-bottom: 2px solid black;
            padding: 5px;
        }
        .titulo{
            border-bottom: 3px solid black;
            text-align: center;
            font-weight: bold;
            padding: 0px;
            margin: 0px;
            margin-left: -10px;
            margin-top: -8px;
            width: 103%;
        }
    </style>
</head>

<body>
    <div id="main">

        <!-- INICIO CABEÇALHO -->
        <div id="cabecalho">
            <div id="logo-estado" class="logo-cabecalho" >
                <img src="{{ baseImage64('assets/images/logo-svo-verde.jpg') }}" width="65px" alt="">
            </div>
            <div id="descricao-estado" style="color:green;" >
                <h4 >GOVERNO DO ESTADO DO RIO GRANDE DO NORTE</h4>
                <h4>SECRETARIA DE ESTADO DA SAÚDE PÚBLICA</h4>
                <h4>SERVIÇO DE VERIFICAÇÃO DE ÓBITOS</h4>
                <h4>LAUDO DE VERIFICAÇÃO DE ÓBITO</h4>
            </div>
            {{-- <div id="logo-svo" class="logo-cabecalho" >
                <img src="{{ asset('assets/images/logosvo.png') }}" width="65px" alt="">
            </div> --}}
        </div>
        <!-- FIM CABEÇALHO -->

        <!-- INICIO SUBTITULO -->

        <div class="subtitulo">
            <h5>ENCAMINHAMENTO DE MATERIAL PARA PESQUISA DE MICROORGANISMOS PELO LACEN</h5>
        </div>

        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo">
            <div class="titulo">
                IDENTIFICAÇÃO
            </div>
            
            <div style="font-weight: bold">
                NOME: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 40.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->nome }}</h4>
                IDADE: <h4 class="linha-campo" style=" font-weight: bold;display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}</h4>
            </div>
            <div style="font-weight: bold">
                DATA DE ÓBITO: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 15.5%; font-weight: normal; position: relative; top: 5px;">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y') }}</h4>
                LOCAL: 
                <h4 class="linha-campo" style=" font-weight: bold;display:inline-block; width: 20%; font-weight: normal; position: relative; top: 5px;">
                    @if($corpo->local_obito == "Hospital" || $corpo->local_obito == "Outros estab. saúde")
                        {{ $corpo->local_obito}} - {{ $corpo->estabelecimento_obito }}
                    @else
                        {{ $corpo->local_obito }}
                    @endif
                </h4>
                HORA: <h4 class="linha-campo" style=" font-weight: bold;display:inline-block; width: 5%; font-weight: normal; position: relative; top: 5px;">{{ \Carbon\Carbon::parse($corpo->data_obito)->format('H:i') }}</h4>
            </div>
            <div style="font-weight: bold">
                MÃE: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 80.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->entrevistaInfo->mae }}</h4>
            </div>
            <div style="font-weight: bold">
                D. NASC.: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 10.5%; font-weight: normal; position: relative; top: 5px;">{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('d/m/Y') }}</h4>
                NATURALIDADE: <h4 class="linha-campo" style=" font-weight: bold;display:inline-block; width: 10%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->entrevistaInfo->naturalidade }}</h4>
                OCUPAÇÃO: <h4 class="linha-campo" style=" font-weight: bold;display:inline-block; width: 10%; font-weight: normal; position: relative; top: 5px;">
                    {{ $corpo->entrevistaInfo->ocupacao->ds_ocupacao ?? "Sem ocupação" }}
                    @if($corpo->entrevistaInfo->ocupacao_id != null && $corpo->entrevistaInfo->aposentado == 1)
                    {{ ' - APOSENTADO' }}
                    @endif
                </h4>
            </div>
            <div style="font-weight: bold">
                ENDEREÇO: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 38.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->enderecoCorpo->logradouro }}, {{ $corpo->enderecoCorpo->numero }}, {{ $corpo->enderecoCorpo->bairro }}, {{ $corpo->enderecoCorpo->cidade }}/{{ $corpo->enderecoCorpo->estado }}</h4>
                TELEFONE: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 17.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->entrevistaInfo->telefone ?? '' }}</h4>
            </div>
            <div style="font-weight: bold">
                CPF: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 30.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->cpf ?? 'Não possui' }}</h4>
                RG: <h4 class="linha-campo" style="font-weight: bold; display:inline-block; width: 30.5%; font-weight: normal; position: relative; top: 5px;">{{ $corpo->rg ?? 'Não possui' }}</h4>
            </div>
            <br>
            <br>
            <div class="titulo" style="border-top: 3px solid black;">
                HISTÓRICO CLÍNICO
            </div>
            <div style="height: 200px;">
                {{ $corpo->laudoInfo->historico ?? '' }}
            </div>
            <div style="height:80px;">

                <h4>SOLICITO PESQUISA PARA</h4><br>
                <h4>FRAGMENTOS COLETADOS A FRESCO E NO FORMOL:</h4>
                {{ $dados['materiais_coleta'] }}

            </div>
            <div class="titulo" style="border-top: 3px solid black; text-align: left; border-bottom:none;">
                PATOLOGISTA RESPONSÁVEL
            </div>
            <div
                style="text-align: right; margin-top: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de {{ \Carbon\Carbon::now()->format('Y') }}.</div>
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
