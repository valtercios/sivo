<!-- Modal filtro corpos -->
<div class="modal fade text-left" id="filtro-entrevistas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Filtro </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('entrevistas.index') }}" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label>Data inicial: </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="dataInicial"
                                    value="{{ app('request')->input('dataInicial') ?? '' }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label>Data final: </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="dataFinal"
                                    value="{{ app('request')->input('dataFinal') ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label>Filtrar por corpo: </label>
                            <div class="form-group">
                                <select name="filtroCorpo" id="" class="form-control choices">
                                    <option value="" disabled selected>Selecione o corpo</option>
                                    @foreach ($corpos as $corpo)
                                        <option value="{{ $corpo->id }}">{{ $corpo->id }} - {{ $corpo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label>Filtrar por responsável: </label>
                            <div class="form-group">
                                <select name="filtroResponsavel" id="" class="form-control choices">
                                    <option value="" disabled selected>Selecione o responsável</option>
                                    @foreach ($entrevistas as $entrevista)
                                        @if ($entrevista->corpo->responsavel_corpo_id && $entrevista->corpo->responsavelCorpo)
                                            <option value="{{ $entrevista->corpo->responsavelCorpo->id }}">
                                                {{ $entrevista->corpo->responsavelCorpo->id }} -
                                                {{ $entrevista->corpo->responsavelCorpo->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
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
