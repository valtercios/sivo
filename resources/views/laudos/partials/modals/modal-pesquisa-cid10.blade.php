<!-- Modal pesquisar cep pelo endereço -->
<div class="modal fade text-left" id="pesquisa-cid10" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Pesquisar na CID10</h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
            <div class="modal-body">
                <div class="col-md-12 mb-12">
                    <label for="pesquisa_cid10">Pesquise pelo código ou descrição</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class=" bi-search"></i></span>
                        <input id="pesquisa_cid10" type="text" class="form-control" placeholder="Pesquise uma causa morte">
                        <button class="btn btn-primary" type="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing Order"
                            id="button-addon2" onclick="pesquisaCID10()">Buscar</button>
                    </div>
                </div>
                <div class="col-12">
                    <div id="resultado_busca" style="display:none; height: 350px; overflow:auto;">
                        <h6>Resultado da pesquisa</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody id="resultado_busca_tbody" >

                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
            </div>
    </div>
</div>
</div>

<script>
    function pesquisaCID10() {
        var pesquisa = $('#pesquisa_cid10').val();
        var url = "{{ route('cid10.pesquisa') }}";
        url += '/' + pesquisa;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                //foreach data
                if(data.message){
                    toastr.error(data.message);
                    return false;
                }
                $('#resultado_busca').show();
                $('#resultado_busca_tbody').html('');
                $.each(data, function (key, value) {
                    $('#resultado_busca_tbody').append('<tr><td>' + value.CO_CATEGORIA_SUBCATEGORIA + '</td><td>' + value.NO_CATEGORIA_SUBCATEGORIA + '</td></tr>');
                });
            }
        });
    }
    function usarCID10(e){

    }
</script>