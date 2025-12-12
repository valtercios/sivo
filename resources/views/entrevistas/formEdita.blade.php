@include('entrevistas.partials.edit.card-corpo')

@if($entrevista->digitador_id != null && Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
    @include('components.select-escrivao')
@endif
@include('entrevistas.partials.edit.card-corpo-adicionais')

@if($entrevista->obito_fetal == 1)
    @include('entrevistas.partials.edit.card-obito-fetal')
@endif

@if($status == 6)
    <div class="col-12">
        <div class="card border-warning">
            
            <div class="card-content">
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <strong>⚠️ Atenção:</strong> Você está editando um caso que foi finalizado pelo médico. 
                        É obrigatório descrever o motivo das alterações para auditoria do sistema.
                    </div>
                    <div class="form-group">
                        <label for="justificativa"><strong>Motivo da Reedição *</strong></label>
                        <textarea 
                            name="justificativa" 
                            id="justificativa" 
                            class="form-control" 
                            rows="5"
                            placeholder="Descreva claramente o motivo das alterações..."
                            required
                        ></textarea>
                        <small class="form-text text-muted">
                            Este campo é obrigatório. Descreva o que está sendo alterado e por quê.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif