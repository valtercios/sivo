<div class="row">
    <div class="col-md-12 col-12">
        <div class="form-group has-icon-left ">
            <label for="solicitante">Solicitante</label><span class="text-danger"> *</span>
            <div class="position-relative">
                <input type="text" id="solicitante" class="form-control" value="{{ auth()->user()->name }}" disabled name="solicitante">
                <div class="form-control-icon">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-12">
        <div class="form-group has-icon-left ">
            <label for="tipo_exame">Tipo do exame</label><span class="text-danger"> *</span>
            <div class="position-relative">
                <input type="text" id="tipo_exame" class="form-control" placeholder="Digite o tipo do exame" name="tipo_exame">
                <div class="form-control-icon">
                    <i class="bi bi-clipboard2"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group ">
            <label for="corpo">Exame referente ao corpo de</label><span class="text-danger"> *</span>
            <div class="position-relative">
                <select name="corpo_id" id="corpo_id" class="choices form-control">
                    <option value="" selected disabled>Selecione um corpo</option>
                    @foreach ($corpos as $corpo)
                        <option value="{{ $corpo->id }}">{{ $corpo->id }} - {{ $corpo->nome }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>
    <div class=" col-12">
        <div class="form-group mb-3">
            <label for="observacao" class="form-label">Observações</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="5"></textarea>
        </div>
    </div>
    

</div>
