<!-- Modal cadastrar novo papél -->
<div class="modal fade text-left" id="cadastrar-papel" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Cadastrar papél </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{route('papeisPermissoes.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <label>Papél: </label>
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nome do papél"
                        class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cadastrar</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>