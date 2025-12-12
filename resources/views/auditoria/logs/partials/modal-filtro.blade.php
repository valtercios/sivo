<!-- Modal filtro auditoria -->
<div class="modal fade text-left" id="filtro-auditoria" tabindex="-1" role="dialog"
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
        <form action="{{ route('auditoria.logs') }}" method="GET">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label>Data inicial: </label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="dataInicial" value="{{ app('request')->input('dataInicial') ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Data final: </label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="dataFinal" value="{{ app('request')->input('dataFinal') ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>Filtrar por usuário: </label>
                        <div class="form-group">
                            <select name="filtroUsuario" id="" class="form-control choices">
                                <option value="" disabled>Selecione o usuário</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ app('request')->input('filtroUsuario') == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
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