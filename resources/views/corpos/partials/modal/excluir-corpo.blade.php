<!--Receber corpo modal -->
<div class="modal fade text-left" id="excluircorpo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Verificar identidade </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="post" id="form-ex">
            @csrf
                <div class="modal-body">
                    <div id="logarform-ex">
                        <p>É necessário realizar o login novamente para confirmar que é você mesmo.</p>
                        <label>CPF: </label>
                        <div class="form-group">
                            <input type="text" placeholder="CPF" class="form-control" name="cpf_excluir"
                                id="cpf_excluir">
                        </div>
                        <label>Senha: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Senha" class="form-control" name="senha_excluir"
                                id="senha_excluir">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fechar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" onclick="confirmar_exclusao()" id="confirmarexclusao">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Entrar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
