<div class="col-md-3 col-6">
    <div class="form-group has-icon-left">
        <label for="data-recebimento">Data de recebimento do corpo</label>
        <div class="position-relative">
            <input type="datetime-local" class="form-control" name="data_recebimento" max="9999-12-31T23:59"
                value="{{ $corpo->data_recebimento }}">
            <div class="form-control-icon">
                <i class="bi bi-calendar"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-12">
    <div class="form-group has-icon-left">
        <label for="observacoes">Pendências</label>
        <div class="form-group">
            <div class="position-relative">
                <select name="pendencias" id="" class="form-control">
                    <option value="0" @if($corpo->pendencias == 0) {{'selected'}} @endif>Sem pendências</option>
                    <option value="1" @if($corpo->pendencias == 1) {{'selected'}} @endif>Aguardando documento</option>
                    <option value="2" @if($corpo->pendencias == 2) {{'selected'}} @endif>Grau de parentesco</option>
                    <option value="3" @if($corpo->pendencias == 3) {{'selected'}} @endif>Outro</option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-exclamation"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-12">
    <div class="">
        <label for="observacoes">Observações</label>
        <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ $corpo->observacoes }}</textarea>
    </div>
</div>