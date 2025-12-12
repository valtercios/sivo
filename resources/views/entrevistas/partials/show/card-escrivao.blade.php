<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do responsável pelo preenchimento dos dados da entrevista</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Informações referentes ao responsável
                    pelo preenchimento dos dados da entrevista.</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Escrivão</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $entrevista->entrevistador->name ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>