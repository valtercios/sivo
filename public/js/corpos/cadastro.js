var idDiv = "";
function limpa_formulário_cep(id = "") {
  //Limpa valores do formulário de cep.
  document.getElementById("logradouro" + id).value = "";
  document.getElementById("bairro" + id).value = "";
  document.getElementById("cidade" + id).value = "";
  document.getElementById("estado" + id).value = "";
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById("logradouro" + idDiv).value = conteudo.logradouro;
    document.getElementById("bairro" + idDiv).value = conteudo.bairro;
    document.getElementById("cidade" + idDiv).value = conteudo.localidade;
    document.getElementById("estado" + idDiv).value = conteudo.uf;
    document.getElementById("numero" + idDiv).focus();
  } //end if.
  else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
}

function pesquisacep(valor, id = "") {
  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, "");
  idDiv = id;

  //Verifica se campo cep possui valor informado.
  if (cep != "") {
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if (validacep.test(cep)) {
      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById("logradouro" + id).value = "...";
      document.getElementById("bairro" + id).value = "...";
      document.getElementById("cidade" + id).value = "...";
      document.getElementById("estado" + id).value = "...";

      //Cria um elemento javascript.
      var script = document.createElement("script");

      //Sincroniza com o callback.
      script.src =
        "https://viacep.com.br/ws/" + cep + "/json/?callback=meu_callback";

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);
    } //end if.
    else {
      //cep é inválido.
      limpa_formulário_cep(id);
      alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep(id);
  }
}

function verificarResponsavel() {
  let value = $("#responsavel_entrega_igual").val();
  if (value == 0) {
    $("#cadastro-responsavel-corpo").show();
    $("#cadastro-responsavel-corpo-info-adicional").hide();
    $("#cadastro-responsavel-corpo-info-adicional select").prop("disabled", true);
    $("#cadastro-responsavel-corpo input").prop("disabled", false);
    $("#cadastro-responsavel-corpo select").prop("disabled", false);
    $("#cadastro-responsavel-corpo input[id='numero_documento_responsavel']").prop("disabled", true);
    $("#cadastro-responsavel-corpo input[id='nacionalidade_responsavel']").prop("disabled", true);
    choiceOrgaoEmissorResponsavelCorpo.enable();
    choiceEstadoRGResponsavelCorpo.enable();
  }
  if (value == 1) {
    $("#cadastro-responsavel-corpo").hide();
    $("#cadastro-responsavel-corpo-info-adicional").show();
    $("#cadastro-responsavel-corpo-info-adicional select").prop("disabled", false);
    $("#cadastro-responsavel-corpo input").prop("disabled", true);
    $("#cadastro-responsavel-corpo select").prop("disabled", true);
    $("#cadastro-responsavel-corpo input[id='nacionalidade_responsavel_2']").prop("disabled", true);
    choiceOrgaoEmissorResponsavelCorpo.disable();
    choiceEstadoRGResponsavelCorpo.disable();
  }
  if (value == 2) {
    $("#cadastro-responsavel-corpo").hide();
    $("#cadastro-responsavel-corpo-info-adicional").hide();
    $("#cadastro-responsavel-corpo-info-adicional select").prop("disabled", true);
    $("#cadastro-responsavel-corpo input").prop("disabled", true);
    $("#cadastro-responsavel-corpo select").prop("disabled", true);
    $("#cadastro-responsavel-corpo input[name='nome_responsavel']").val(
      "NÃO ESTÁ PRESENTE"
    );
    choiceOrgaoEmissorResponsavelCorpo.disable();
    choiceEstadoRGResponsavelCorpo.disable();
  }
}
let pesquisacepAdicional = null;
let cepEncontrado = null;
let cidadePesquisada = null;
function buscarEndereco() {
  let busca = $("#endereco_busca").val();
  let cidadeInput = $("#cidade_busca_input").val();
  if (cidadeInput == "") {
    alert("Informe uma cidade para realizar a busca");
    return false;
  }
  if (busca == "") {
    alert("Informe o endereço para buscar");
    return false;
  }
  fetch("https://viacep.com.br/ws/RN/" + cidadeInput + "/" + busca + "/json/")
    .then((response) => response.json())
    .then((data) => {
      if (data.length > 0) {
        if (data.length > 1) {
          $("#main-pesquisa").hide();
          $("#selecionar-endereco").show();
          $("#btn-confirmar-modal-cep").hide();
          $("#btn-voltar-modal-cep").show();
          $("#selecionar-endereco table tbody").html("");
          $.each(data, function (key, value) {
            $("#selecionar-endereco table tbody").append(`
            <tr>
              <th>${value.cep}</th>
              <td>${value.logradouro}</td>
              <td>${value.bairro}</td>
              <td>${value.complemento}</td>
              <td class="text-center"><button type="button" data-id="${key}" class="btn btn-sm btn-primary select-endereco">Selecionar</button></td>
            </tr>
            `);
          });
          $(".select-endereco").on("click", function () {
            let id = $(this).attr("data-id");
            $("#cep_busca").html(data[id].cep);
            cepEncontrado = data[id].cep;
            $("#logradouro_busca").html(data[id].logradouro);
            $("#bairro_busca").html(data[id].bairro);
            $("#cidade_busca").html(data[id].localidade);
            $("#estado_busca").html(data[id].uf);
            confirmarBuscaEndereco();
          });
        } else {
          $("#resultado_busca").show();
          $("#cep_busca").html(data[0].cep);
          cepEncontrado = data[0].cep;
          $("#logradouro_busca").html(data[0].logradouro);
          $("#bairro_busca").html(data[0].bairro);
          $("#cidade_busca").html(data[0].localidade);
          $("#estado_busca").html(data[0].uf);
          $("#btn-confirmar-modal-cep").prop("disabled", false);
        }
      } else {
        alert("Nenhum endereço encontrado");
      }
    });
}

function exibirModalBuscaEndereco(cepParametroAdicional) {
  $("#resultado_busca").hide();
  $("#main-pesquisa").show();
  $("#btn-confirmar-modal-cep").show();
  $("#selecionar-endereco").hide();
  $("#btn-voltar-modal-cep").hide();
  $("#endereco_busca").val("");
  $("#cidade_busca_input").val("");
  $("#btn-confirmar-modal-cep").prop("disabled", true);
  cepEncontrado = null;
  $("#pesquisa-cep-endereco").modal("show");

  pesquisacepAdicional = cepParametroAdicional;
}

$("#btn-voltar-modal-cep").on("click", function () {
  $("#selecionar-endereco").hide();
  $("#btn-voltar-modal-cep").hide();
  $("#main-pesquisa").show();
  $("#btn-confirmar-modal-cep").show(); 
});

function confirmarBuscaEndereco() {
  if (!cepEncontrado) {
    alert("É necessário realizar uma pesquisa antes.");
    return false;
  }
  $('input[name="cep' + pesquisacepAdicional + '"]').val(cepEncontrado);
  pesquisacep(cepEncontrado, pesquisacepAdicional);
  $("#pesquisa-cep-endereco").modal("hide");
}

$(document).ready(function () {
  $("#cadastro-responsavel-corpo").hide();
  $("#cadastro-responsavel-corpo-info-adicional").hide();
});




$("#cpf_corpo").on("blur", function () {
  if ($(this).val() == "") return false;
  let verificarCPF = TestaCPF($(this).val());
  if (!verificarCPF) {
    $(this).addClass("is-invalid");
    $("#feedback-cpf-corpo").show();
  } else {
    $(this).removeClass("is-invalid");
    $("#feedback-cpf-corpo").hide();
  }
});
function TestaCPF(strCPF) {
  var Soma;
  var Resto;
  Soma = 0;
  strCPF = strCPF.replace(".", "");
  strCPF = strCPF.replace("-", "");
  strCPF = strCPF.replace(".", "");
  if (strCPF == "00000000000") return false;

  for (i = 1; i <= 9; i++)
    Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10))) return false;

  Soma = 0;
  for (i = 1; i <= 10; i++)
    Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11))) return false;
  return true;
}

$('#transporte_corpo_select').on('change', function(){
  let valueSelect = $(this).val();
  if(valueSelect == "Funeraria"){
    choicesFunerarias.enable();
    document.querySelector('#meio_transporte_outro').disabled = true
  }
  if(valueSelect == "SAMU"){
    choicesFunerarias.disable();
    document.querySelector('#meio_transporte_outro').disabled = true
  }
  if(valueSelect == "Outros"){
    choicesFunerarias.disable();
    document.querySelector('#meio_transporte_outro').disabled = false
  }
});

$('select[name="local_obito"]').on("change", function () {
  let value = $(this).val();
  let logradouroObito = document.getElementById('logradouro_obito');
  let cepObito = document.getElementById('cep_obito');

  let cepCorpo = document.querySelector('input[name="cep_corpo"]');
  let logradouroCorpo = document.querySelector('input[name="logradouro_corpo"]');
  let numeroCorpo = document.querySelector('input[name="numero_corpo"]');
  let bairroCorpo = document.querySelector('input[name="bairro_corpo"]');
  let cidadeCorpo = document.querySelector('input[name="cidade_corpo"]');
  let estadoCorpo = document.querySelector('input[name="estado_corpo"]');
  let complementoCorpo = document.querySelector('input[name="complemento_corpo"]');

  let nomeEstabelecimentoElement = document.querySelector(
    "#estabelecimento_obito"
  );
  let cnesEstabelecimentoElement = document.querySelector(
    "#cnes_estabelecimento"
  );
  let situacao = document.querySelector(
    "#situacao"
  );
  let Numero = document.querySelector(
    "#numero_obito"
  );
  let logradouro = document.querySelector(
    "#logradouro_obito"
  );
  if (value == "Hospital" || value == "Outros estab. saúde" || value == "Outros") {
    nomeEstabelecimentoElement.disabled = false;
    if(value !== "Outros"){
      cnesEstabelecimentoElement.disabled = false;
    }
  } else {
    nomeEstabelecimentoElement.disabled = true;
    cnesEstabelecimentoElement.disabled = true;
  }
  if(value == "Outros" || value == "Via pública") {
    situacao.disabled = false
    Numero.removeAttribute("required")
  } else {
    situacao.disabled = true
    Numero.setAttribute("required", "required")
  }
  if(value == "Domicílio"){
    if(logradouroObito.value == "" && cepObito.value == ""){
      document.querySelector('input[name="cep_obito"]').value = cepCorpo.value;
      document.querySelector('input[name="logradouro_obito"]').value = logradouroCorpo.value;
      document.querySelector('input[name="numero_obito"]').value = numeroCorpo.value;
      document.querySelector('input[name="bairro_obito"]').value = bairroCorpo.value;
      document.querySelector('input[name="cidade_obito"]').value = cidadeCorpo.value;
      document.querySelector('input[name="estado_obito"]').value = estadoCorpo.value;
      document.querySelector('input[name="complemento_obito"]').value = complementoCorpo.value;
    }
  }
});
