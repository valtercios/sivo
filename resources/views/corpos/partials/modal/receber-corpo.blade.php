<!--Receber corpo modal -->
<div class="modal fade text-left" id="recebercorpo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Verificar identidade </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="post" id="form">
            @csrf
                <div class="modal-body">
                    <div id="logarform">
                        <p>É necessário realizar o login novamente para confirmar que é você mesmo.</p>
                        <label>CPF: </label>
                        <div class="form-group">
                            <input type="text" placeholder="CPF" class="form-control" name="cpf"
                                id="cpf">
                        </div>
                        <label>Senha: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Senha" class="form-control" name="senha"
                                id="senha">
                        </div>
                    </div>
                    <div id="necrotomistaform" style="display:none;">
                        <p>Informe os pertences para receber o corpo</p>
                        <div class="form-group mb-3">
                            <label for="pertences" class="form-label">Pertences</label>
                            <textarea class="form-control" id="pertences" name="pertences" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fechar</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" onclick="verificarIdentidade()" id="verificarbutton">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Entrar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" style="display:none;" id="confirmarbutton">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Confirmar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('form').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        return false;
    }
});
</script>