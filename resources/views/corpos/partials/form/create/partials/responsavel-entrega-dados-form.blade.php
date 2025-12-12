<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="nome_responsavel_entrega">Nome do responsável pela entrega do corpo:</label><span class="text-danger">
            *</span>
        <div class="position-relative">
            <input type="text" id="nome_responsavel_entrega"
                value="{{ old('nome_responsavel_entrega') ? old('nome_responsavel_entrega') : '' }}" required
                class="form-control" placeholder="Nome" name="nome_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="responsavel_entrega_igual">Responsável pela entrega é o mesmo que o responsável pelo
            corpo?</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="responsavel_entrega_igual" required onchange="verificarResponsavel()"
                id="responsavel_entrega_igual" class="form-control">
                <option value="" disabled {{ !old('responsavel_entrega_igual') ? 'selected' : '' }}>Selecione uma
                    opção</option>
                <option value="1" @if (old('responsavel_entrega_igual') !==null && old('responsavel_entrega_igual')=='1' ) {{ 'selected' }} @endif>Sim</option>
                <option value="0" @if (old('responsavel_entrega_igual') !==null && old('responsavel_entrega_igual')=='0' ) {{ 'selected' }} @endif>Não</option>
                <option value="2" @if (old('responsavel_entrega_igual') !==null && old('responsavel_entrega_igual')=='2' ) {{ 'selected' }} @endif>O responsável pelo
                    corpo não está presente</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-question-lg"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="sexo_responsavel_entrega">Sexo</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="sexo_responsavel_entrega" required id="" class="form-control">
                <option value="M" @if (old('sexo_responsavel_entrega') !==null && old('sexo_responsavel_entrega')=='M' ) {{ 'selected' }} @endif>Masculino</option>
                <option value="F" @if (old('sexo_responsavel_entrega') !==null && old('sexo_responsavel_entrega')=='F' ) {{ 'selected' }} @endif>Feminino</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_responsavel_entrega">CPF</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" name="responsavel_entrega_nao_possui_cpf" id="responsavel_entrega_nao_possui_cpf">
            <label class="form-check-label" for="">Não possui</label>
        </div>
        <div class="position-relative">
            <input type="text" id="cpf_responsavel_entrega"
                value="{{ old('cpf_responsavel_entrega') ? old('cpf_responsavel_entrega') : '' }}"
                class="form-control" placeholder="CPF" name="cpf_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="telefone_responsavel_entrega">Telefone</label>
        <div class="position-relative">
            <input type="text" id="telefone_responsavel_entrega"
                value="{{ old('telefone_responsavel_entrega') ? old('telefone_responsavel_entrega') : '' }}"
                class="form-control" placeholder="Telefone" name="telefone_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-telephone-fill"></i>
            </div>
        </div>
    </div>
</div>


<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="tipo_documento_responsavel_entrega">Documento de identificação</label>
        <div class="position-relative">
            <select name="tipo_documento_responsavel_entrega" class="form-control" id="tipo_documento_responsavel_entrega">
                <option value="" disabled {{ old('tipo_documento_responsavel_entrega') == null ? 'selected' : '' }}>Selecione o tipo de documento</option>
                <option value="RG" {{ old('tipo_documento_responsavel_entrega') == 'RG' ? 'selected' : '' }}>RG</option>
                <option value="Certidão de nascimento" {{ old('tipo_documento_responsavel_entrega') == 'Certidão de nascimento' ? 'selected' : '' }}>Certidão de nascimento</option>
                <option value="Certidão de casamento" {{ old('tipo_documento_responsavel_entrega') == 'Certidão de casamento' ? 'selected' : '' }}>Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação" {{ old('tipo_documento_responsavel_entrega') == 'Carteira Nacional de Habilitação' ? 'selected' : '' }}>Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho" {{ old('tipo_documento_responsavel_entrega') == 'Carteira de trabalho' ? 'selected' : '' }}>Carteira de trabalho</option>
                <option value="Registro Geral - CPF" {{ old('tipo_documento_responsavel_entrega') == 'Registro Geral - CPF' ? 'selected' : '' }}>Registro Geral - CPF</option>
                <option value="Passaporte" {{ old('tipo_documento_responsavel_entrega') == 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                <option value="Nao Possui" {{ old('tipo_documento_responsavel_entrega') == 'Nao Possui' ? 'selected' : '' }}>Nao Possui</option>
                <option value="Outros" {{ old('tipo_documento_responsavel_entrega') == 'Outros' ? 'selected' : '' }}>Outros</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>


<div class="col-md-8 col-8">
    <div class="form-group has-icon-left">
        <label for="numero_documento_responsavel_entrega">Numero do documento</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="numero_documento_responsavel_entrega" disabled value="{{ old('numero_documento_responsavel_entrega') ? old('numero_documento_responsavel_entrega') : '' }}" class="form-control" placeholder="Numero do documento do corpo" name="numero_documento_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12" style="display: none" id="div_rg_corpo_responsavel_entrega">
    <div class="form-group has-icon-left">
        <label for="rg_responsavel_entrega">RG</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="rg_responsavel_entrega"
                value="{{ old('rg_responsavel_entrega') ? old('rg_responsavel_entrega') : '' }}"
                class="form-control" placeholder="Informe o RG" name="rg_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" style="display: none" id="div_div_orgao_emissor_responsavel_entrega_responsavel_entrega">
    <div class="form-group ">
        <label for="div_orgao_emissor_responsavel_entrega_responsavel_entrega">Orgão emissor</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="orgao_emissor_responsavel_entrega" id="orgao_emissor_responsavel_entrega_select" class="form-control">
                <option value="" {{ !old('orgao_emissor_responsavel_entrega') ? 'selected' : '' }} disabled>
                    Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                <option @if (old('orgao_emissor_responsavel_entrega') !==null && old('orgao_emissor_responsavel_entrega')==$orgao->id) {{ 'selected' }} @endif value="{{ $orgao->id }}">
                    {{ $orgao->sigla }} - {{ $orgao->nome }}
                </option>
                @endforeach
            </select>

        </div>
    </div>
</div>
<div class="col-md-4 col-12" style="display: none" id="estado_rg_responsavel_entrega">
    <div class="form-group ">
        <label for="estado_rg_responsavel_entrega">UF</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="estado_rg_responsavel_entrega" id="estado_rg_responsavel_entrega_select" class="form-control">
                <option value="" {{ !old('estado_rg_responsavel_entrega') ? 'selected' : '' }} disabled>Selecione
                    o estado</option>
                @foreach (getEstados() as $key => $estado)
                <option value="{{ $key }}" @if (old('estado_rg_responsavel_entrega') !==null && old('estado_rg_responsavel_entrega')==$key) {{ 'selected' }} @endif>
                    {{ $estado }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_responsavel_entrega">CEP</label>

        <div class="position-relative">
            <input type="text" id="cep_responsavel_entrega" class="form-control" placeholder="CEP"
                name="cep_responsavel_entrega" onblur="pesquisacep(this.value, '_responsavel_entrega');"
                value="{{ old('cep_responsavel_entrega') ? old('cep_responsavel_entrega') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_responsavel_entrega')">Encontrar CEP</a>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_responsavel_entrega">Logradouro</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="logradouro_responsavel_entrega"
                value="{{ old('logradouro_responsavel_entrega') ? old('logradouro_responsavel_entrega') : '' }}"
                class="form-control" placeholder="Logradouro" name="logradouro_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero_responsavel_entrega">Número</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_responsavel_entrega"
                    value="{{ old('numero_responsavel_entrega') ? old('numero_responsavel_entrega') : '' }}" required
                    class="form-control" placeholder="Número" maxlength="10" name="numero_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="complemento_responsavel_entrega">Complemento</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="complemento_responsavel_entrega"
                    value="{{ old('complemento_responsavel_entrega') ? old('complemento_responsavel_entrega') : '' }}"
                    maxlength="30" class="form-control" placeholder="Complemento"
                    name="complemento_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_responsavel_entrega">Bairro</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_responsavel_entrega"
                    value="{{ old('bairro_responsavel_entrega') ? old('bairro_responsavel_entrega') : '' }}" required
                    class="form-control" placeholder="Bairro" name="bairro_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_responsavel_entrega">Cidade</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_responsavel_entrega"
                    value="{{ old('cidade_responsavel_entrega') ? old('cidade_responsavel_entrega') : '' }}" required
                    class="form-control" placeholder="Cidade" name="cidade_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_responsavel_entrega">Estado</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_responsavel_entrega"
                    value="{{ old('estado_responsavel_entrega') ? old('estado_responsavel_entrega') : '' }}" required
                    class="form-control" placeholder="Estado" name="estado_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let tipo_documento_responsavel_entrega = $('#tipo_documento_responsavel_entrega');
        let div_rg_corpo_responsavel_entrega = $('#div_rg_corpo_responsavel_entrega');
        let div_orgao_emissor_responsavel_entrega = $('#div_div_orgao_emissor_responsavel_entrega_responsavel_entrega');
        let estado_rg_responsavel_entrega = $('#estado_rg_responsavel_entrega');
        let numero_documento_responsavel_entrega = $('#numero_documento_responsavel_entrega');
        let cpf_responsavel_entrega = $('#cpf_responsavel_entrega');
        let responsavel_entrega_nao_possui_cpf = $('#responsavel_entrega_nao_possui_cpf');


        let rg_responsavel_entrega_input = $('#rg_responsavel_entrega');
        let orgao_emissor_responsavel_entrega_input = $('#orgao_emissor_responsavel_entrega_select');
        let estado_rg_responsavel_entrega_input = $('#estado_rg_responsavel_entrega_select');

        tipo_documento_responsavel_entrega.on('change', function() {
            if ($(this).val() === 'RG') {
                div_rg_corpo_responsavel_entrega.show();
                div_orgao_emissor_responsavel_entrega.show();
                estado_rg_responsavel_entrega.show();
                numero_documento_responsavel_entrega.prop('disabled', true);
                rg_responsavel_entrega_input.prop('required', true);
                orgao_emissor_responsavel_entrega_input.prop('required', true);
                estado_rg_responsavel_entrega_input.prop('required', true);
            } else if ($(this).val() === 'Nao Possui') {
                div_rg_corpo_responsavel_entrega.hide();
                div_orgao_emissor_responsavel_entrega.hide();
                estado_rg_responsavel_entrega.hide();
                numero_documento_responsavel_entrega.prop('disabled', true);
                rg_responsavel_entrega_input.prop('required', false);
                orgao_emissor_responsavel_entrega_input.prop('required', false);
                estado_rg_responsavel_entrega_input.prop('required', false);
            } else {
                div_rg_corpo_responsavel_entrega.hide();
                div_orgao_emissor_responsavel_entrega.hide();
                estado_rg_responsavel_entrega.hide();
                numero_documento_responsavel_entrega.prop('disabled', false);
                rg_responsavel_entrega_input.prop('required', false);
                orgao_emissor_responsavel_entrega_input.prop('required', false);
                estado_rg_responsavel_entrega_input.prop('required', false);
            }
        }).trigger('change'); // Trigger change event on page load

        responsavel_entrega_nao_possui_cpf.on('change', function() {
            if ($(this).is(':checked')) {
                cpf_responsavel_entrega.prop('disabled', true);
            } else {
                cpf_responsavel_entrega.prop('disabled', false);
            }
        }).trigger('change'); // Trigger change event on page load
    });
</script>