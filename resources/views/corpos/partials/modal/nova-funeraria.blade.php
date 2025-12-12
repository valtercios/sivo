<!-- Modal filtro corpos -->
<div class="modal fade text-left modal-lg" id="nova-funeraria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Cadastrar funerária </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group has-icon-left ">
                            <label for="nome">Nome da funerária</label><span class="text-danger"> *</span>
                            <div class="position-relative">
                                <input type="text" id="nome_funeraria" class="form-control"
                                    placeholder="Nome da funerária" name="nome_funeraria">
                                <div class="form-control-icon">
                                    <i class="bi bi-grid-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cep">CEP</label><span class="text-danger"> *</span>

                            <div class="position-relative">
                                <input type="text" id="cep_funeraria" class="form-control" placeholder="CEP"
                                    name="cep_funeraria" onblur="pesquisacep(this.value, '_funeraria');" maxlength="9">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="logradouro">Logradouro</label><span class="text-danger"> *</span>

                            <div class="position-relative">
                                <input type="text" id="logradouro_funeraria" class="form-control" placeholder="Logradouro"
                                    name="logradouro_funeraria">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="numero">Número</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="numero_funeraria" class="form-control"
                                        placeholder="Numero da residência" name="numero_funeraria">
                                    <div class="form-control-icon">
                                        <i class="bi bi-list-ol"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="bairro">Bairro</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="bairro_funeraria" class="form-control" placeholder="Bairro"
                                        name="bairro_funeraria">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cidade">Cidade</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="cidade_funeraria" class="form-control" placeholder="Cidade"
                                        name="cidade_funeraria">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="estado">Estado</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="estado_funeraria" class="form-control" placeholder="Estado"
                                        name="estado_funeraria">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
                <button id="cadastrar-funeraria-btn" type="button" class="btn btn-primary ml-1">
                    <i class="bx bx-filter d-block d-sm-none"></i>
                    
                    <span class="d-none d-sm-block"><span class="spinner-border spinner-border-sm" style="display:none;" id="loadingNovaFuneraria" role="status" aria-hidden="true"></span> Cadastrar</span>
                </button>
            </div>
        </div>
    </div>
</div>
