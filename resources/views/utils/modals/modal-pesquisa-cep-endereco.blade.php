<!-- Modal pesquisar cep pelo endereço -->
<div class="modal fade text-left" id="pesquisa-cep-endereco" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Pesquisar Endereço </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="" method="GET">
            <div class="modal-body">
                <div id="main-pesquisa" style="display: none;">
                    <div class="col-md-12 mb-12">
                        <label for="cidade_busca_input">Informe a cidade</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class=" bi-geo-alt-fill"></i></span>
                            <input id="cidade_busca_input" type="text" class="form-control" placeholder="Digite uma cidade, Ex: Natal">
                        </div>
                        <label for="endereco_busca">Informe o endereço</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class=" bi-search"></i></span>
                            <input id="endereco_busca" type="text" class="form-control" placeholder="Digite um endereço para pesquisar">
                            <button class="btn btn-primary" type="button"
                                id="button-addon2" onclick="buscarEndereco('carangola')">Buscar</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="resultado_busca" style="display:none;">
                            <h6>Resultado da pesquisa</h6>
                            <span>CEP</span><span class="float-end" id="cep_busca">59084-270</span><br>
                            <span>Logradouro</span><span class="float-end" id="logradouro_busca">Rua carangola</span><br>
                            <span>Bairro</span><span class="float-end" id="bairro_busca">Neópolis</span><br>
                            <span>Cidade</span><span class="float-end" id="cidade_busca">Natal</span><br>
                            <span>Estado</span><span class="float-end" id="estado_busca">RN</span><br>
                        </div>
                        
                        
                    </div>
                </div>

                <div id="selecionar-endereco" style="display: block;">
                    <h5>Resultados:</h5>
                    <small>Foi encontrado mais de um resultado, é necessário que você selecione o que mais adequa a sua necessidade.</small>
                    <div style="max-height: 250px;">
                        <table class="table table-striped table-bordered mt-2" style="font-size: 15px;">
                            <thead>
                              <tr>
                                <th scope="col">CEP</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Complemento</th>
                                <th scope="col">#</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                              
                            </tbody>
                          </table>
                    </div>
                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal" id="btn-fechar-modal-cep">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
                <button type="button" class="btn btn-light-secondary" id="btn-voltar-modal-cep" style="display:none;">
                    <i class="bi bi-arrow-left d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Voltar</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" id="btn-confirmar-modal-cep" onclick="confirmarBuscaEndereco()" disabled="true">
                    <i class="bx bx-filter d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Confirmar</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>