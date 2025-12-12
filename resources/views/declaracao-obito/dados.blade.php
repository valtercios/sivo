<style>
    /* Objetos padres **************************************************************************************************************************************************/


    table {
        font-size: 10px;
        border: 1px;
        width: 100%;
    }

    th {
        background: #f3f3f3;
    }

    ul {
        margin-left: 30px;
    }

    table#relatorio th {
        border: 1px solid #c0c0c0;
    }


    fieldset {
        padding: 5px 8px 8px 8px;
    }

    legend {
        margin: 0px 0px 5px 5px;
        font-weight: bold;
        color: #000000;
    }

    .numeracao {
        font-size: 15px;
        font-weight: bold;
    }




    /* Classes **********************************************************************************************************************************************************/
    .botao_sec,
    .botao,
    .botao_maior,
    .botao_pesq,
    .botao_cad {
        font-size: 12px;
        font-family: verdana, arial, helvetica, sans-serif;
        border: 0;
    }

    .botao_sec,
    .botao {
        width: 85px;
    }

    .botao,
    .botao_maior {
        color: #FFF;
        background-color: #4b0900;
    }

    .botao_pesq,
    .botao_cad {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }


    .campo_filtro {
        width: auto;
        margin: 0px 5px 0px 5px;
        padding-right: 20px;
    }

    .ultimo_filtro {
        width: auto;
        margin: 0px 5px 0px 5px;
    }

    .campo {
        padding: 5px 5px 5px 5px;
        margin: 0px 5px 5px 0px;
        float: left;
        background-color: #e5e5e5;
        height: 35px;
        white-space: nowrap;
    }

    .campo2 {
        padding: 5px 5px 5px 5px;
        margin: 0px 5px 0px 0px;
        float: left;
        background-color: #e5e5e5;
        height: auto;
        white-space: nowrap;
    }

    .campotable {
        padding: 5px 5px 5px 5px;
        margin: 0px 5px 0px 0px;
        background-color: #e5e5e5;
        height: auto;
        white-space: nowrap;
        clear: both;
    }

    .campo label,
    .campo2 label,
    .campotable label {
        display: block;
        margin-bottom: 2px;
        white-space: nowrap;
    }

    .limpa {
        clear: both;
        height: .1em;
        line-height: .1em;
    }

    .item_vermelho {
        color: #FF0000;
    }

    

    /* to make sure that the image is aligned properly */
    img.cp_img {
        border-width: 0;
        vertical-align: top;
    }

    * html img.cp_img {
        vertical-align: text-bottom;
    }
</style>

<form name="Informe" action="" method="post">
    <table id="relatorio">
        <tbody>
            <tr>
                <td colspan="2">
                    Município de Digitação: RN - NATAL <br>
                    Micro: 0010 <br>
                    Nível: Municipal
                </td>
                <td width="162">
                    <div align="center">
                        <font color="#000000" size="1" type="Arial, Helvetica, sans-serif">Data:&nbsp; 02/12/2022
                        </font>
                    </div>
                </td>
                <td width="125">
                    <div align="center">
                        <font color="#000000" size="1" type="Arial, Helvetica, sans-serif">Hora:&nbsp; 10:56
                        </font>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio">
        <tbody>
            <tr>
                <td width="262" bgcolor="#f3f3f3">
                    <font size="1" type="Arial, Helvetica, sans-serif"><b>Número da DO:&nbsp; 33747306-4</b>
                    </font>
                </td>
            </tr>
        </tbody>
    </table>



    <div id="Topo_brasao" name="Topo_brasao">
        <center>
            <table id="relatorio">
                <tbody>
                    <tr>
                        <td width="40%">
                            <table id="relatorio" style="left: 0px; position: relative;">
                                <tbody>
                                    <tr valign="middle">
                                        <td align="left">
                                            <img src="http://localhost/svo/public/assets/images/do/brasao_maior.jpg"
                                                border="0">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table style="left: 0px; position: relative;" aid="relatorio">
                                <tbody>
                                    <tr>
                                        <td width="" bgcolor="#999999">
                                            <font color="#ffffff" size="2"><b>Declaração de Óbito</b></font>
                                        </td>
                                        <td width="" bgcolor="#cccccc">
                                            <font size="2"><b>Nº &nbsp;&nbsp;33747306</b></font>
                                        </td>
                                        <td width="" bgcolor="#999999">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>

    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">I</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_cartorio.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--Dados sobre o cartorio-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td width="70%" class="titulo"><b>1-Cartório</b></td>
                                <td width="10%" class="titulo"><b>Código</b></td>
                                <td width="10%" class="titulo"><b>2-Registro</b></td>
                                <td width="10%" class="titulo"><b>3-Data</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td width="70%" class="td_left">4º OFICIO DE REGISTRO CIVIL E TABELIONATO DE NOTAS
                                </td>
                                <td width="10%" class="td_center">4447</td>
                                <td width="10%" class="td_center">13121412</td>
                                <td width="10%" class="td_right">02/12/2022</td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="3"><b>4-Município</b></td>
                                <td width="10%" class="titulo"><b>5-UF</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_last_left" colspan="3">NATAL</td>
                                <td width="10%" class="td_last_right">RN</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">II</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_identificacao.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--dados de identificação-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td width="20%" class="titulo"><b>7-Tipo de Óbito</b></td>
                                <td width="20%" class="titulo"><b>8-Data do Óbito</b></td>
                                <td width="15%" class="titulo"><b>Hora</b></td>
                                <td width="20%" class="titulo"><b>9-Cartão SUS</b></td>
                                <td width="25%" class="titulo"><b>10-Naturalidade</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td width="20%" class="td_left">2-Não Fetal</td>
                                <td width="20%" class="td_center">02/12/2022</td>
                                <td width="15%" class="td_center">02:00</td>
                                <td width="20%" class="td_center">&nbsp;</td>
                                <td width="25%" class="td_right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="5"><b>11-Nome do Falecido </b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_right" colspan="5">JOAO ANDRE SILVEIRA </td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="3"><b>12-Nome do Pai</b></td>
                                <td class="titulo" colspan="2"><b>13-Nome da Mãe</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_left" colspan="3">JOAO PRIMEIRO DA SILVA</td>
                                <td class="td_right" colspan="2">MARIA JOAQUINA SILVEIRA</td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="2"><b>14-Data de Nascimento</b></td>
                                <td class="titulo"><b>15-Idade</b></td>
                                <td class="titulo"><b>16-Sexo</b></td>
                                <td class="titulo"><b>17-Raça/Cor</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_left" colspan="2">05/10/1995</td>
                                <td class="td_center">
                                    27&nbsp;Anos
                                </td>
                                <td class="td_center">M-Masculino</td>
                                <td class="td_right">1-Branca</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo"><b>18-Estado Civil</b></td>
                                <td class="titulo"><b>19-Escolaridade</b>(Em anos de estudos concluídos)</td>
                                <td class="titulo"><b>20-Ocupação habitual e ramo de atividade</b>(se
                                    aposentado,<br>colocar a ocupação habitual anterior)</td>
                                <td class="titulo"><b>Código:</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_last_left">1-Solteiro</td>
                                <td class="td_last_center">3-De 4 a 7&nbsp;</td>
                                <td class="td_last_center">PEDREIRO</td>
                                <td class="td_last_right">715210</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">III</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_residencia.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--Dados da Residência-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo"><b>21-Logradouro</b></td>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo"><b>Número</b></td>
                                <td class="titulo"><b>Complemento</b></td>
                                <td class="titulo"><b>22-CEP</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td width="30%" class="td_left">RUA CARANGOLA</td>
                                <td width="10%" class="td_center">000000000312</td>
                                <td width="15%" class="td_center">131</td>
                                <td width="30%" class="td_center">&nbsp;</td>
                                <td width="15%" class="td_right">59084-270</td>
                            </tr>
                            <tr>
                                <td class="titulo"><b>23-Bairro/Distrito</b></td>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo"><b>24-Município</b></td>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo"><b>25-UF</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_left">NEOPOLIS</td>
                                <td class="td_center">3333</td>
                                <td class="td_center">NATAL</td>
                                <td class="td_center">240810</td>
                                <td class="td_right">RN</td>
                            </tr>
                            <tr>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo" colspan="4"><b>Pais</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_last_left">1</td>
                                <td class="td_last_right" colspan="4">BRASIL</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">IV</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_local_ocorrencia.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--dados da ocorrencia-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td width="30%" class="titulo"><b>26-Local da Ocorrência do Óbito</b></td>
                                <td class="titulo" colspan="2"><b>27-Estabelecimento</b></td>
                                <td width="10%" class="titulo"><b>Código</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="30%" class="td_left">3-Domicílio</td>
                                <td class="td_center" colspan="2">&nbsp;</td>
                                <td class="td_right">
                                    &nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo"><b>28-Endereço da ocorrência, se fora do estabelec.<br> ou da
                                        residência</b></td>
                                <td class="titulo"><b>Número</b></td>
                                <td width="20%" class="titulo"><b>Complemento</b></td>
                                <td width="10%" class="titulo"><b>29-CEP</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_left">
                                    RUA CARANGOLA</td>
                                <td class="td_center">
                                    312</td>
                                <td width="20%" class="td_center">
                                    &nbsp;</td>
                                <td width="10%" class="td_right">
                                    59084-270</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo"><b>30-Bairro/Distrito</b></td>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo"><b>31-Município</b></td>
                                <td class="titulo"><b>Código</b></td>
                                <td class="titulo"><b>32-UF</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_last_left">
                                    NEOPOLIS</td>
                                <td class="td_last_center">
                                    3333</td>
                                <td class="td_last_center">NATAL</td>
                                <td class="td_last_center">240810</td>
                                <td class="td_last_right">RN</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">V</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_fetal_ou_menor.jpg">
                </td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--Fetal ou menor que um ano-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo_maior"><b>PREENCHIMENTO EXCLUSIVO PARA ÓBITOS FETAIS E DE MENORES DE
                                        1 ANO</b></td>
                            </tr>
                            <tr>
                                <td class="titulo_maior">INFORMAÇÕES SOBRE A MÃE</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td width="10%" class="titulo" rowspan="2"><b>33-Idade</b></td>
                                <td width="15%" class="titulo" rowspan="2"><b>34-Escolaridade</b></td>
                                <td width="40%" class="titulo" colspan="2"><b>35-Ocupação habitual e ramo de
                                        atividade da mãe</b></td>
                                <td width="20%" class="titulo" valign="top" colspan="2"><b>36-Número de
                                        filhos tidos</b><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="titulo_menor" valign="top">&nbsp;</td>
                                <td class="titulo_menor" valign="top"><b>Código</b></td>
                                <td class="titulo_menor" valign="top"><b>Nasc. Vivos</b></td>
                                <td class="titulo_menor" valign="top"><b>Nasc. Mortos</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_left">&nbsp;&nbsp;&nbsp;Anos</td>
                                <td class="td_center">&nbsp;</td>
                                <td class="td_center">- </td>
                                <td class="td_center">- </td>
                                <td class="td_center">&nbsp;</td>
                                <td class="td_right">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td width="55%">
                                    <table id="relatorio">
                                        <tbody>
                                            <tr>
                                                <td width="36%" class="td_titulo_2"><b>37-Duração da Gestação</b>
                                                </td>
                                                <td class="td_titulo_2"><b>38-Tipo de Gravidez</b></td>
                                                <td class="td_titulo_2_right"><b>39-Tipo de Parto</b></td>
                                            </tr>
                                            <tr>
                                                <td width="33%" class="td_last_left">
                                                    &nbsp;
                                                    &nbsp;</td>
                                                <td width="33%" class="td_last_center">&nbsp;</td>
                                                <td width="33%" class="td_last_right">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table id="relatorio">
                                        <tbody>
                                            <tr>
                                                <td class="titulo" colspan="2"><b>40-Morte em Relação ao Parto</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td_right" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="titulo"><b>41-Peso ao Nascer</b></td>
                                                <td class="titulo"><b>42-Núm. da Declar. de Nascidos Vivos</b></td>
                                            </tr>

                                            <tr>
                                                <td class="td_last_left">&nbsp;&nbsp;&nbsp;Gramas</td>
                                                <td class="td_last_right">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">VI</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_condicoes_causas.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <!--Fetal ou menor que um ano-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <!--Condições e causa do obito-->
                        <tbody>
                            <tr>
                                <td class="titulo_maior" colspan="2"><b>ÓBITOS EM MULHERES</b></td>
                                <td class="titulo_maior"><b>ASSISTÊNCIA MÉDICA</b></td>
                            </tr>
                            <tr>
                                <td class="titulo"><b>43-A morte ocorreu durante a gravidez, parto ou aborto?</b></td>
                                <td width="33%" class="titulo"><b>44-A morte ocorreu durante o puerpério?</b></td>
                                <td class="titulo"><b>45-Recebeu assist. médica durante a doença que ocasionou a
                                        morte?</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_left">&nbsp;</td>
                                <td class="td_center">&nbsp;</td>
                                <td class="td_right">2-Não</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo_maior" colspan="3"><b>DIAGNÓSTICO CONFIRMADO POR:</b></td>
                            </tr>
                            <tr>
                                <td class="titulo"><b>46-Exame Complementar?</b></td>
                                <td class="titulo"><b>47-Cirurgia?</b></td>
                                <td class="titulo"><b>48-Necrópsia?</b></td>
                            </tr>
                            <tr bgcolor="#f3f3f3">
                                <td class="td_left">2-Não&nbsp;</td>
                                <td class="td_center">2-Não</td>
                                <td class="td_right">1-Sim</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--Causas da Morte-->
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo_maior" colspan="4"><b>49-CAUSAS DA MORTE</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="10%" class="titulo_maior"><b>PARTE I</b></td>
                                <td width="2%" class="titulo_maior"><b>&nbsp;</b></td>
                                <td width="73%" class="titulo_maior"><b>&nbsp;</b></td>
                                <td width="15%" class="titulo">Tempo aproximado entre o início da doença e a morte
                                </td>
                                <td width="5%" class="titulo">CID</td>
                            </tr>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td width="2%" class="titulo"><b>a</b></td>
                                <td width="73%" class="td_center" id="orient_scb_11" name="orient_scb_11">
                                    P234 - Pneumonia congenita devida a Escherichia coli <br>&nbsp;
                                </td>
                                <td width="10%" class="td_center">
                                    &nbsp;
                                </td>
                                <td width="5%" class="td_right">P234&nbsp;</td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="10%"><b>&nbsp;</b></td>
                                <td width="2%"><b>&nbsp;</b></td>
                                <td width="73%" class="titulo_menor">Devido ou como consequência de:</td>
                                <td width="15%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td width="2%" class="titulo"><b>b</b></td>
                                <td width="73%" class="td_center" id="orient_scb_12" name="orient_scb_12">

                                    P230 - Pneumonia congenita devida a agente viral <br>&nbsp;
                                    <b> </b>
                                </td>
                                <td width="10%" class="td_center">
                                    &nbsp;
                                </td>
                                <td width="5%" class="td_right">P230&nbsp;</td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="10%"><b>&nbsp;</b></td>
                                <td width="2%"><b>&nbsp;</b></td>
                                <td width="73%" class="titulo_menor">Devido ou como consequência de:</td>
                                <td width="15%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td width="2%" class="titulo"><b>c</b></td>
                                <td width="73%" class="td_center" id="orient_scb_13" name="orient_scb_13">
                                    J111 - Influenza [gripe] com outras manifestacoes respiratorias, devida a virus nao
                                    identificado <br>&nbsp;
                                </td>
                                <td width="10%" class="td_center">
                                    &nbsp;
                                </td>
                                <td width="5%" class="td_right">J111&nbsp;</td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="10%"><b>&nbsp;</b></td>
                                <td width="2%"><b>&nbsp;</b></td>
                                <td width="73%" class="titulo_menor">Devido ou como consequência de:</td>
                                <td width="15%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%" class="titulo_last_center">&nbsp;</td>
                                <td width="2%" class="titulo"><b>d</b></td>
                                <td width="73%" class="td_center" id="orient_scb_14" name="orient_scb_14">
                                    A90 - Dengue [dengue classico] <br>&nbsp;
                                </td>
                                <td width="10%" class="td_center">
                                    &nbsp;
                                </td>
                                <td width="5%" class="td_right">A90&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%" class="titulo"><b>PARTE II</b></td>
                                <td width="2%"><b>&nbsp;</b></td>
                                <td width="73%">&nbsp;</td>
                                <td width="15%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%" class="titulo_last_center">&nbsp;</td>
                                <td width="2%" class="titulo">&nbsp;</td>
                                <td width="73%" class="td_last_center" id="orient_scb_15" name="orient_scb_15">
                                    &nbsp;
                                </td>
                                <td width="10%" class="td_last_center">
                                    &nbsp;&nbsp;
                                </td>
                                <td width="5%" class="td_last_right">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo" colspan="4">
                                    <b>Causa Básica - SCB</b>
                                </td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_last_right">
                                    J111 - Influenza [gripe] com outras manifestacoes respiratorias, devida a virus nao
                                    identificado &nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">VII</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_medico.jpg"></td>
                <td>&nbsp;</td>
                <td width="94%">
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td class="titulo" colspan="2"><b>50-Nome do Médico</b></td>
                                <td class="titulo" colspan="1"><b>51-CRM</b></td>
                                <td class="titulo" colspan="1"> <b>52-O Médico que assina atendeu ao falecido?</b>
                                </td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_left" colspan="2">
                                    ABDO FARRET NETO&nbsp;
                                </td>
                                <td class="td_center" colspan="1">
                                    3332
                                </td>
                                <td class="td_right" colspan="1">
                                    4-SVO
                                </td>
                            </tr>
                            <tr>
                                <td class="titulo"><b>53-Meio de Contato:</b></td>
                                <td class="titulo" colspan="3"><b>54-Data do atestado:</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td class="td_last_left">
                                    &nbsp;
                                </td>
                                <td class="td_last_right" colspan="3">02/12/2022&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="relatorio" style="
    margin: 5px 0px 5px -23px;
    width: fit-content;
">
        <tbody>
            <tr>
                <td width="3%" align="center" class="numeracao">VIII</td>
                <td width="3%" class="td_titulo" bgcolor="#999999" style="
    text-align: center;
"><img
                        src="http://localhost/svo/public/assets/images/do/title_causa_externas.jpg">
                </td>
                <td>&nbsp;</td>
                <td width="94%">
                    <table id="relatorio" style="
    border: solid 1px darkgrey;
">
                        <tbody>
                            <tr>
                                <td align="left" class="titulo_maior" colspan="3">
                                    <b>PROVÁVEIS CIRCUNSTÂNCIAS DE MORTE NÃO NATURAL (informações de carater
                                        estritamente epidemológico)</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" class="titulo"><b>56-Tipo</b></td>
                                <td width="35%" class="titulo"><b>57-Acidente do trabalho</b></td>
                                <td width="35%" class="titulo"><b>58-Fonte de informação</b></td>
                            </tr>
                            <tr style="
    background: #f3f3f3;
">
                                <td width="40%" class="td_left">
                                    &nbsp;&nbsp;
                                </td>
                                <td width="35%" class="td_center">
                                    &nbsp;
                                </td>
                                <td width="35%" class="td_right">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="3"><b>59-Descrição sumária do evento, incluindo o tipo
                                        de local de ocorrência:</b></td>
                            </tr>
                            <tr>
                                <td class="td_right" colspan="3" style="
    background: #f3f3f3;
">
                                    &nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="titulo" colspan="3"><b>60-Logradouro ( Rua, praça, avenida etc ):</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_last_right" colspan="3" style="
    background: #f3f3f3;
">
                                    &nbsp;&nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


</form>
