<style>
    .copy-icon {
        cursor: pointer;
    }
</style>
<!-- Modal pesquisar cep pelo endereço -->
<div class="modal fade text-left" id="pesquisa-ocupacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Pesquisar ocupação</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-12">
                    <label for="pesquisa_ocupacao">Pesquise pelo código ou termo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class=" bi-search"></i></span>
                        <input id="pesquisa_ocupacao" type="text" class="form-control"
                            placeholder="Pesquise uma ocupação">
                        <button class="btn btn-primary" type="button"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing Order"
                            id="button-addon2" onclick="pesquisaOcupacao()">
                            <span class="spinner-border spinner-border-sm" id="loadingOcupacaoBusca"
                                style="display:none;" role="status" aria-hidden="true"></span> Buscar</button>
                    </div>
                </div>
                <div class="col-12">
                    <div id="resultado_busca_ocupacao" style="display:none; height: 350px; overflow:auto;">
                        <h6>Resultado da pesquisa</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Tipo</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="resultado_busca_ocupacao_tbody">

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
            </div>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script>
        let idChoices;
        function searchByCode(choicesElement, code) {
            for (var i = 0; i < choicesElement.length; i++) {
                if (choicesElement[i].label.includes(code)) {
                    
                    return choicesElement[i].value;
                }
            }
            // Se não encontrar nenhum elemento com o código, pode retornar null ou outra coisa que faça sentido para o seu caso
            return null;
        }
        function pesquisaOcupacao() {
            var pesquisa = $('#pesquisa_ocupacao').val();
            var url = "{{ route('api.buscarocupacao') }}";
            $('#loadingOcupacaoBusca').show();
            url += '/' + pesquisa;
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    //foreach data
                    if (data.message) {
                        toastr.error(data.message);
                        return false;
                    }
                    $('#resultado_busca_ocupacao').show();
                    $('#resultado_busca_ocupacao_tbody').html('');
                    $.each(data, function(key, value) {
                        $('#resultado_busca_ocupacao_tbody').append(`
                    <tr>
                        <td>
                            ${value.co_cbo}<i class="bi bi-files copy-icon" data-ocupacao="${value.co_cbo}" data-bs-toggle="tooltip" data-bs-placement="right" title="Copiar"></i>
                        </td>
                        <td>
                            ${value.ds_ocupacao}
                        </td>
                        <td>
                            ${value.TIPO}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary select-ocupacao" data-ocupacao="${value.co_cbo}">Selecionar</button>
                        </td>   
                    </tr>
                    
                    `);
                    });
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    })
                    $('.copy-icon').click(function() {
                        var text = $(this).attr('data-ocupacao');
                        var el = $(this);
                        copy(text, el);
                    });
                    $('.select-ocupacao').click(function() {
                        var ocupacao = $(this).attr('data-ocupacao');
                        var choicesElement = initChoice[idChoices];
                        var lista = choicesElement.config.choices;
                        var codigo = searchByCode(lista, ocupacao);
                        choicesElement.setChoiceByValue(codigo);
                        $("#pesquisa-ocupacao").modal("hide");

                    });
                    $('#loadingOcupacaoBusca').hide();
                }
            });
        }

        function copy(text, target) {
            setTimeout(function() {
                $('#copied_tip').remove();
            }, 800);
            navigator.clipboard.writeText(text).then(function() {
                $(target).append(
                    "<div class='tip' id='copied_tip' style='color:green; font-size: 12px;'>Copiado!</div>");
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }

        function exibirModalOcupacao(id){
            idChoices = id;
            $("#pesquisa-ocupacao").modal("show");
        }
    </script>
@endsection