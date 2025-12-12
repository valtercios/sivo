<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="data-obito">Data e hora do óbito</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="datetime-local" required class="form-control" name="data_obito" max="9999-12-31T23:59"
                value="{{ old('data_obito') ? old('data_obito') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-calendar"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="local_obito">Local do óbito</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="local_obito" class="form-control" required>
                <option value="" disabled {{ !old('local_obito') ? 'selected' : '' }}>Selecione um local do óbito</option>
                <option value="Hospital" @if(old('local_obito') !== null && old('local_obito') == 'Hospital') {{'selected'}} @endif>Hospital</option>
                <option value="Outros estab. saúde" @if(old('local_obito') !== null && old('local_obito') == 'Outros estab. saúde') {{'selected'}} @endif>Outros estab. saúde</option>
                <option value="Domicílio" @if(old('local_obito') !== null && old('local_obito') == 'Domicílio') {{'selected'}} @endif>Domicílio</option>
                <option value="Via pública" @if(old('local_obito') !== null && old('local_obito') == 'Via pública') {{'selected'}} @endif>Via pública</option>
                <option value="Outros" @if(old('local_obito') !== null && old('local_obito') == 'Outros') {{'selected'}} @endif>Outros</option>
                <option value="Aldeia Indígena" @if(old('local_obito') !== null && old('local_obito') == 'Aldeia Indígena') {{'selected'}} @endif>Aldeia Indígena</option>
                <option value="Ignorado" @if(old('local_obito') !== null && old('local_obito') == 'Ignorado') {{'selected'}} @endif>Ignorado</option>
            </select>

            <div class="form-control-icon">
                <i class="bi bi-geo-alt-fill"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-12">
    <div class="form-group has-icon-left">
        <label for="situacao">Situação</label>

        <div class="position-relative">
            <input type="text" id="situacao" required disabled class="form-control" placeholder="Descreva a Situação"
                name="situacao" {{ old('situacao') ? old('situacao') : '' }}>
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estabelecimento_obito">Nome do estabelecimento</label>

        <div class="position-relative">
            <input type="text" id="estabelecimento_obito" class="form-control" disabled
                placeholder="Nome do estabelecimento" name="estabelecimento_obito"
                value="{{ old('estabelecimento_obito') ? old('estabelecimento_obito') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-building"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cnes_estabelecimento">Código CNES</label>

        <div class="position-relative">
            <input type="text" id="cnes_estabelecimento" disabled data-mask="0000000" class="form-control"
                placeholder="Código CNES do Estabelecimento" name="cnes_estabelecimento" value="{{ old('cnes_estabelecimento') ? old('cnes_estabelecimento') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_obito">CEP</label>

        <div class="position-relative">
            <input type="text" id="cep_obito" required class="form-control" placeholder="CEP" name="cep_obito"
                onblur="pesquisacep(this.value, '_obito');" value="{{ old('cep_obito') ? old('cep_obito') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_obito')">Encontrar CEP</a>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_obito">Logradouro</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="logradouro_obito" required class="form-control" placeholder="Logradouro"
                name="logradouro_obito" value="{{ old('logradouro_obito') ? old('logradouro_obito') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero_obito">Número</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_obito" required class="form-control" maxlength="10" placeholder="Número"
                    name="numero_obito" value="{{ old('numero_obito') ? old('numero_obito') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="complemento_obito">Complemento</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="complemento_obito" class="form-control" maxlength="30" placeholder="Complemento"
                    name="complemento_obito" value="{{ old('complemento_obito') ? old('complemento_obito') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_obito">Bairro</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_obito" required class="form-control" placeholder="Bairro"
                    name="bairro_obito" value="{{ old('bairro_obito') ? old('bairro_obito') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_obito">Cidade</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_obito" required class="form-control" placeholder="Cidade"
                    name="cidade_obito" value="{{ old('cidade_obito') ? old('cidade_obito') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_obito">Estado</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_obito" required class="form-control" placeholder="Estado"
                    name="estado_obito" value="{{ old('estado_obito') ? old('estado_obito') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="meio_transporte">Meio de transporte do corpo</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <select name="meio_transporte" id="transporte_corpo_select" class="form-control" required>
                    <option value="" disabled {{ !old('meio_transporte') ? 'selected' : '' }}>Selecione uma opção</option>
                    <option value="Funeraria" @if(old('meio_transporte') !== null && old('meio_transporte') == 'Funerária') {{'selected'}} @endif>Funerária</option>
                    <option value="SAMU" @if(old('meio_transporte') !== null && old('meio_transporte') == 'SAMU') {{'selected'}} @endif>SAMU</option>
                    <option value="Carro particular" @if(old('meio_transporte') !== null && old('meio_transporte') == 'Carro particular') {{'selected'}} @endif>Carro particular</option>
                    <option value="Outros" @if(old('meio_transporte') !== null && old('meio_transporte') == 'Outros') {{'selected'}} @endif>Outros</option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="meio_transporte_outro">Outro</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="meio_transporte_outro" disabled class="form-control"
                    placeholder="Outro meio de transporte" name="meio_transporte_outro" value="{{ old('meio_transporte_outro') ? old('meio_transporte_outro') : '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-12">
    <div class="form-group has-icon-left">
        <label for="funeraria">Funerária que trouxe o corpo</label><span class="text-danger"> *</span>
        <button class="btn btn-sm btn-primary float-end mb-2" type="button"
            data-bs-toggle="modal"data-bs-target="#nova-funeraria"> <i class="bi bi-plus"></i> Nova
            funerária</button>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="position-relative">
                <select name="funeraria" id="funeraria-select" class="form-control" required>
                    <option value="" disabled {{ !old('funeraria') ? 'selected' : '' }}>Selecione a funerária</option>
                    @foreach ($funerarias as $funeraria)
                        <option @if(old('funeraria') !== null && old('funeraria') == $funeraria->id) {{ 'selected' }} @endif value="{{ $funeraria->id }}">{{ $funeraria->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
