<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">Informações médicas</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha as
            informações médicas adicionais.</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class=" col-12">
                <div class="form-group mb-3">
                    <label for="historico" class="form-label">Histórico</label>
                    <textarea class="form-control" id="historico" name="historico" rows="5">{{ $laudo->historico }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>