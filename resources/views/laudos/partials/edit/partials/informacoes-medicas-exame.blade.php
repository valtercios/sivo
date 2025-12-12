<div class="row">
    <div class="col-md-5 col-12">
        <div class="form-group has-icon-left">
            <label for="data-exame">Data e hora da realização do exame</label><span class="text-danger">
                *</span>
            <div class="position-relative">
                <input type="datetime-local" required class="form-control" name="data_exame" id="data_exame"
                    max="9999-12-31T23:59" value="{{ $laudo->data_exame ?? '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_geral" class="form-label">Geral</label>
            <textarea class="form-control" id="exame_geral" name="exame_geral" rows="5">{{ $laudo->exame_geral ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_cabeca" class="form-label">Cabeça</label>
            <textarea class="form-control" id="exame_cabeca" name="exame_cabeca" rows="5">{{ $laudo->exame_cabeca ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_torax" class="form-label">Tórax</label>
            <textarea class="form-control" id="exame_torax" name="exame_torax" rows="5">{{ $laudo->exame_torax ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_abdome" class="form-label">Abdome</label>
            <textarea class="form-control" id="exame_abdome" name="exame_abdome" rows="5">{{ $laudo->exame_abdome ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_genitalia" class="form-label">Genitália</label>
            <textarea class="form-control" id="exame_genitalia" name="exame_genitalia" rows="5">{{ $laudo->exame_genitalia ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_membros" class="form-label">Membros</label>
            <textarea class="form-control" id="exame_membros" name="exame_membros" rows="5">{{ $laudo->exame_membros ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">Macroscopia</label>
            <textarea class="form-control" id="exame_macroscopia" name="exame_macroscopia" rows="5">{{ $laudo->exame_macroscopia ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_microscopia" class="form-label">Microscopia</label>
            <textarea class="form-control" id="exame_microscopia" name="exame_microscopia" rows="5">{{ $laudo->exame_microscopia ?? "" }}</textarea>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="exame_conclusoes" class="form-label">Conclusões diagnósticas</label>
            <textarea class="form-control" id="exame_conclusoes" name="exame_conclusoes" rows="5">{{ $laudo->exame_conclusoes ?? "" }}</textarea>
        </div>
    </div>
</div>