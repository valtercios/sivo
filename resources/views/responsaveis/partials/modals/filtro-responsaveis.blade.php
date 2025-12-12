<!-- Modal filtro auditoria -->
<div class="modal fade text-left" id="filtro-responsaveis" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Filtro </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('responsaveis.index') }}" method="GET">
            <div class="modal-body">
                <div class="form-group ">
                    <label for="filtroCorpo">Filtro por corpo:</label>
                    <div class="position-relative">
                        <select name="filtroCorpo" id="filtroCorpo" class="choices form-control">
                            <option value="" selected disabled>Selecione um corpo</option>
                            @foreach ($corpos as $corpo)
                                <option value="{{ $corpo->id }}">{{ $corpo->id }} - {{ $corpo->nome }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-filter d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Filtrar</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>