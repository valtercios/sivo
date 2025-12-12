@can('corpos_atribuirvo')
    @if ($corpo->num_vo != null && $corpo->ano_vo != null)
    <div class="col-md-6 col-6">
            <div class="form-group has-icon-left">
                <label for="num_vo">Número VO</label><span class="text-danger"> *</span>
                <div class="form-group">
                    <div class="position-relative">
                        <input type="text" id="num_vo" required value="{{ old('num_vo', $corpo->num_vo) }}"
                            class="form-control" maxlength="10" placeholder="Número" name="num_vo">
                        <div class="form-control-icon">
                            <i class="bi bi-list-ol"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div>
                <div>
                    <div class="form-group has-icon-left">
                        <label for="ano_vo">Ano VO</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="ano_vo" required value="{{ old('ano_vo', $corpo->ano_vo) }}"
                                    class="form-control" maxlength="10" placeholder="Número" name="ano_vo">
                                <div class="form-control-icon">
                                    <i class="bi bi-list-ol"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan

<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_corpo">CPF</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary"
                {{ old('nao_possui_cpf', $corpo->cpf == null ? 'checked' : '') }} name="nao_possui_cpf" id="nao_possui_cpf">
            <label class="form-check-label" for="">Não possui</label>
        </div>


        <div class="position-relative">
            <input type="text" id="cpf_corpo" class="form-control" value="{{ old('cpf_corpo', $corpo->cpf) }}"
                {{ old('nao_possui_cpf', $corpo->cpf == null ? 'disabled' : '') }} placeholder="CPF do corpo" name="cpf_corpo" required>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            <div class="invalid-feedback" id="feedback-cpf-corpo" style="display:none;">
                <i class="bx bx-radio-circle"></i>
                CPF Inválido!
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="data_nascimento">Data de nascimento</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary"
                {{ old('natimorto', $corpo->natimorto == 1 ? 'checked' : '') }} name="natimorto" id="natimorto">
            <label class="form-check-label" for="">Natimorto</label>
        </div>
        <div class="position-relative">
            <input type="text" id="data_nascimento" required
                value="{{ old('data_nascimento', isset($corpo->data_nascimento) ? \Carbon\Carbon::parse($corpo->data_nascimento)->format('d/m/Y') : '') }}"
                {{ old('data_nascimento', $corpo->data_nascimento == null ? 'disabled' : '' ) }} class="form-control" data-mask="00/00/0000"
                placeholder="Data de nascimento" name="data_nascimento">
            <div class="form-control-icon">
                <i class="bi bi-calendar"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-8 col-12">
    <div class="form-group has-icon-left">
        <label for="nome_corpo">Nome</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="nome_corpo" required class="form-control" value="{{ old('nome_corpo', $corpo->nome) }}"
                placeholder="Nome do corpo" name="nome_corpo">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="sexo">Sexo</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="sexo_corpo" required id="" class="form-control">
                <option value="null" selected disabled>Selecione</option>
                <option value="M" @if (old('sexo_corpo', $corpo->sexo) == 'M') selected @endif>Masculino</option>
                <option value="F" @if (old('sexo_corpo', $corpo->sexo) == 'F') selected @endif>Feminino</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="tipo_documento">Documento de identificação</label>
        <div class="position-relative">
            <select name="tipo_documento" class="form-control" id="tipo_documento">
                <option value="Nao Possui" @if (old('tipo_documento', $corpo->tipo_documento) === null) selected @endif>Não Possui documento</option>
                <option value="RG" @if (old('tipo_documento', $corpo->tipo_documento) === 'RG' || $corpo->rg != null) selected @endif>RG</option>
                <option value="Certidão de nascimento" @if (old('tipo_documento', $corpo->tipo_documento) === 'Certidão de nascimento') selected @endif>Certidão de nascimento</option>
                <option value="Certidão de casamento" @if (old('tipo_documento', $corpo->tipo_documento) === 'Certidão de casamento') selected @endif>Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação" @if (old('tipo_documento', $corpo->tipo_documento) === 'Carteira Nacional de Habilitação') selected @endif>Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho" @if (old('tipo_documento', $corpo->tipo_documento) === 'Carteira de trabalho') selected @endif>Carteira de trabalho</option>
                <option value="Registro Geral - CPF" @if (old('tipo_documento', $corpo->tipo_documento) === 'Registro Geral - CPF') selected @endif>Registro Geral - CPF</option>
                <option value="Passaporte" @if (old('tipo_documento', $corpo->tipo_documento) === 'Passaporte') selected @endif>Passaporte</option>
                <option value="Outros" @if (old('tipo_documento', $corpo->tipo_documento) === 'Outros') selected @endif>Outros</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-8 col-8">
    <div class="form-group has-icon-left">
        <label for="numero_documento">Numero do documento</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="numero_documento" value="{{ old('numero_documento', $corpo->numero_documento) }}" required
                class="form-control" placeholder="Numero do documento do corpo" name="numero_documento">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12 d-none" id="div_rg_corpo">
    <div class="form-group has-icon-left">
        <label for="rg_corpo">RG</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="rg_corpo" value="{{ old('rg_corpo', $corpo->rg) }}" class="form-control"
                {{ old('nao_possui_rg') ? 'disabled' : '' }} placeholder="RG do corpo" name="rg_corpo">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12 d-none" id="div_orgao_emissor_corpo">
    <div class="form-group ">
        <label for="orgao_emissor_corpo">Orgão emissor</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="orgao_emissor_corpo" id="orgao_emissor_corpo" class="form-control" {{ old('nao_possui_rg') ? 'disabled' : '' }}>
                <option value="" selected disabled>Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                    <option @if(old('orgao_emissor', $corpo->orgao_emissor) == $orgao->id) {{'selected'}} @endif value="{{ $orgao->id }}">{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12 d-none" id="div_uf_corpo">
    <div class="form-group ">
        <label for="estado_rg">UF</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="estado_rg" id="estado_rg_corpo" class="form-control" {{ old('nao_possui_rg') ? 'disabled' : '' }}>
                <option value="" selected disabled>Selecione o estado</option>
                @foreach (getEstados() as $key => $estado)
                    <option @if(old('estado_rg', $corpo->estado_rg) == $key) {{'selected'}} @endif value="{{ $key }}">{{ $estado }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_corpo">CEP</label>
        <div class="position-relative">
            <input type="text" id="cep_corpo" class="form-control"
                value="{{ old('cep_corpo', $corpo->enderecoCorpo->cep) }}" required placeholder="CEP" name="cep_corpo"
                onblur="pesquisacep(this.value, '_corpo');">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_corpo')">Encontrar CEP</a>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_corpo">Logradouro</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="logradouro_corpo" required
                value="{{ old('logradouro_corpo', $corpo->enderecoCorpo->logradouro) }}" class="form-control" placeholder="Logradouro"
                name="logradouro_corpo">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero_corpo">Número</label><span id="numero_corpo_required" class="text-danger"
            style="display: none;">*</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_corpo" required value="{{ old('numero_corpo', $corpo->enderecoCorpo->numero) }}"
                    class="form-control" maxlength="10" placeholder="Número" name="numero_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="complemento_corpo">Complemento</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="complemento_corpo" value="{{ old('complemento_corpo', $corpo->enderecoCorpo->complemento) }}"
                    class="form-control" placeholder="Complemento" maxlength="30" name="complemento_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_corpo">Bairro</label><span id="bairro_corpo_required" class="text-danger"
            style="display: none;">*</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_corpo" required value="{{ old('bairro_corpo', $corpo->enderecoCorpo->bairro) }}"
                    class="form-control" placeholder="Bairro" name="bairro_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_corpo">Cidade</label><span id="cidade_corpo_required" class="text-danger"
            style="display: none;">*</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_corpo" required value="{{ old('cidade_corpo', $corpo->enderecoCorpo->cidade) }}"
                    class="form-control" placeholder="Cidade" name="cidade_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_corpo">Estado</label><span id="estado_corpo_required" class="text-danger"
            style="display: none;">*</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_corpo" required value="{{ old('estado_corpo', $corpo->enderecoCorpo->estado) }}"
                    class="form-control" placeholder="Estado" name="estado_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="nacionalidade_corpo">Nacionalidade</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" id="estrangeiro"
                name="estrangeiro_check" value="1" {{ old('estrangeiro_check', $corpo->estrangeiro_check) ? 'checked' : '' }}>
            <label class="form-check-label" for="estrangeiro">Estrangeiro</label>
        </div>
        <div class="position-relative">
            <input type="text" id="nacionalidade" value="{{ old('nacionalidade', $corpo->nacionalidade ?? 'Brasileiro') }}" required
                class="form-control" {{ !old('estrangeiro_check', $corpo->estrangeiro_check) ? 'disabled' : '' }} placeholder="Nacionalidade"
                name="nacionalidade">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
        <div class="form-group">
            <label for="endereco_postal_corpo">Endereço Postal</label>
            <div class="position-relative">
                <input type="text" id="endereco_postal_corpo"
                    value="{{$corpo->enderecoCorpo->endereco_postal ?? ''}}" required
                    class="form-control" {{ !old('estrangeiro_check') ? 'disabled' : '' }} placeholder="Endereço postal"
                    name="endereco_postal_corpo">
            </div>
        </div>
    </div>
