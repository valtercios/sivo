<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECLARAÇÃO DE RETIRADA DO CORPO E DA DECLARAÇÃO DE ÓBITO NO SERVIÇO DE VERIFICAÇÃO DE ÓBITO(SVO)</title>

    

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
{{--        @dd($dados)--}}
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
            <h4>DECLARAÇÃO DE RETIRADA DO CORPO E DA DECLARAÇÃO DE ÓBITO NO SERVIÇO DE VERIFICAÇÃO DE ÓBITO(SVO)</h4>
        </div>


        <!-- FIM SUBTITULO -->

        <!-- INICIO CONTEUDO -->

        <div id="conteudo" style="margin-top: -30px;">

            <p style="width: 95%; text-align: justify">
                Declaro que recebi o corpo, reconhecido por mim, e a Declaração de Óbito de  <span class="linha-campo">{{ $corpo->nome }} </span> sexo <span class="linha-campo">{{ $corpo->sexo == "M" ? "Masculino" : "Feminino" }} </span>
                    idade <span class="linha-campo">{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}</span> às <span class="linha-campo">{{ \Carbon\Carbon::now()->format('H\hi\m\i\n') }} </span> do dia
                    <span class="linha-campo">{{ \Carbon\Carbon::now()->format('d/m/Y') }} </span> o qual identifiquei sendo o cadáver acima e que todos os dados aqui
                    contidos foram fornecidos por mim e pelos quais me responsabilizo.
            </p>
            <br>

            <div style="margin-top: 30px">
                <div style="text-align: center; margin-bottom: 20px;">
                    <h4 style="text-decoration: underline; font-weight: bold;">DADOS DO RECEPTOR</h4>
                </div>

                <table style="width: 100%; font-size: 1rem; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20%; font-weight: bold;">Nome:</td>
                        <td class="linha-campo">{{ $dados['nome_responsavel'] ?? $corpo->responsavelCorpo->nome ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Grau de parentesco:</td>
                        <td class="linha-campo">{{ $dados['grau_parentesco_responsavel_outro'] ?? $dados['grau_parentesco_responsavel'] ?? $corpo->responsavelCorpo->grau_parentesco }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">{{ $dados['tipo_documento_responsavel'] ?? 'RG' }}:</td>
                        <td class="linha-campo">{{ $dados['numero_documento_responsavel'] ?? $corpo->responsavelCorpo->rg ?? '-' }}</td>
                    </tr>
                    @if($dados['tipo_documento_responsavel'] == 'RG' || $dados['tipo_documento_responsavel'] == null)
                        <tr>
                            <td style="font-weight: bold;">Órgão expedidor:</td>
                            <td class="linha-campo">{{ $dados['orgao_emissor_responsavel'] ?? $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '-' }}/{{ $dados['estado_rg_responsavel_corpo'] ?? '-' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="font-weight: bold;">CPF:</td>
                        <td class="linha-campo">{{ $dados['cpf_responsavel'] ?? ($corpo->responsavelCorpo->cpf ?? 'NÃO POSSUI') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Telefone:</td>
                        <td class="linha-campo">{{ $dados['telefone_contato'] ?? 'NÃO POSSUI' }}</td>
                    </tr>
                </table>
            </div>

            <div
                style="text-align: right; margin-top: 30px; margin-right: 18px; margin-bottom: 30px; display: flex; flex-direction: column; align-items: center;">
                <div id="data">Natal {{ \Carbon\Carbon::now()->format('d') }} de
                    {{ ucfirst(\Carbon\Carbon::now()->translatedFormat('F')) }} de
                    {{ \Carbon\Carbon::now()->format('Y') }}</div>
                <div class="assinatura">Assinatura do Declarante</div>
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
