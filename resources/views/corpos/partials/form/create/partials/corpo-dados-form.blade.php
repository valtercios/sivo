<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_corpo">CPF</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" name="nao_possui_cpf" id="nao_possui_cpf" {{ old('nao_possui_cpf') ? 'checked' : '' }} value="1">
            <label class="form-check-label" for="">Não possui</label>
        </div>

        <div class="position-relative">
            <input type="text" id="cpf_corpo" class="form-control" {{ old('nao_possui_cpf') ? 'disabled' : '' }} placeholder="CPF do corpo" name="cpf_corpo" value="{{ old('cpf_corpo') ? old('cpf_corpo') : '' }}" required>
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
            <input type="checkbox" class="form-check-input form-check-primary" name="natimorto" id="natimorto" value="1" {{ old('natimorto') ? 'checked' : '' }}>
            <label class="form-check-label" for="">Natimorto</label>
        </div>
        <div class="position-relative">
            <input type="text" id="data_nascimento" {{ old('natimorto') ? 'disabled' : '' }} value="{{ old('data_nascimento') ? old('data_nascimento') : '' }}" required class="form-control" data-mask="00/00/0000" placeholder="Data de nascimento" name="data_nascimento">
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
            <input type="text" id="nome_corpo" value="{{ old('nome_corpo') ? old('nome_corpo') : '' }}" required class="form-control" placeholder="Nome do corpo" name="nome_corpo">
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
                <option value="" selected disabled> Selecione </option>
                <option value="M" @if(old('sexo_corpo') !==null && old('sexo_corpo')=="M" ) {{'selected'}} @endif>Masculino</option>
                <option value="F" @if(old('sexo_corpo') !==null && old('sexo_corpo')=="F" ) {{'selected'}} @endif>Feminino</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="tipo_documento">Documento de identificação</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="tipo_documento" class="form-control" id="tipo_documento" required>
                <option value="" disabled {{ old('tipo_documento') == null ? 'selected' : '' }}>Selecione o tipo de documento</option>
                <option value="RG" {{ old('tipo_documento') == 'RG' ? 'selected' : '' }}>RG</option>
                <option value="Certidão de nascimento" {{ old('tipo_documento') == 'Certidão de nascimento' ? 'selected' : '' }}>Certidão de nascimento</option>
                <option value="Certidão de casamento" {{ old('tipo_documento') == 'Certidão de casamento' ? 'selected' : '' }}>Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação" {{ old('tipo_documento') == 'Carteira Nacional de Habilitação' ? 'selected' : '' }}>Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho" {{ old('tipo_documento') == 'Carteira de trabalho' ? 'selected' : '' }}>Carteira de trabalho</option>
                <option value="Registro Geral - CPF" {{ old('tipo_documento') == 'Registro Geral - CPF' ? 'selected' : '' }}>Registro Geral - CPF</option>
                <option value="Passaporte" {{ old('tipo_documento') == 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                <option value="Nao Possui" {{ old('tipo_documento') == 'Nao Possui' ? 'selected' : '' }}>Nao Possui</option>
                <option value="Outros" {{ old('tipo_documento') == 'Outros' ? 'selected' : '' }}>Outros</option>
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
            <input type="text" id="numero_documento" disabled value="{{ old('numero_documento') ? old('numero_documento') : '' }}" required class="form-control" placeholder="Numero do documento do corpo" name="numero_documento">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12" style="display: none" id="div_rg_corpo">
    <div class="form-group has-icon-left">
        <label for="rg_corpo">RG</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="rg_corpo" value="{{ old('rg_corpo') ? old('rg_corpo') : '' }}" class="form-control" {{ old('nao_possui_rg') ? 'disabled' : '' }} placeholder="RG do corpo" name="rg_corpo">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12" style="display: none" id="div_orgao_emissor_corpo">
    <div class="form-group ">
        <label for="orgao_emissor_corpo">Orgão emissor</label>
        <div class="position-relative">
            <select name="orgao_emissor_corpo" id="" class="form-control" {{ old('nao_possui_rg') ? 'disabled' : '' }}>
                <option value="" selected disabled>Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                <option @if(old('orgao_emissor_corpo') !==null && old('orgao_emissor_corpo')==$orgao->id) {{'selected'}} @endif value="{{ $orgao->id }}">{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
<div class="col-md-4 col-12" style="display: none" id="div_uf_corpo">
    <div class="form-group ">
        <label for="estado_rg">UF</label>
        <div class="position-relative">
            <select name="estado_rg" id="" class="form-control" {{ old('nao_possui_rg') ? 'disabled' : '' }}>
                <option value="" selected disabled>Selecione o estado</option>
                @foreach (getEstados() as $key => $estado)
                <option @if(old('estado_rg') !==null && old('estado_rg')==$key) {{'selected'}} @endif value="{{ $key }}">{{ $estado }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_corpo">CEP</label>

        <div class="position-relative">
            <input type="text" id="cep_corpo" class="form-control" value="{{ old('cep_corpo') ? old('cep_corpo') : '' }}" required placeholder="CEP" name="cep_corpo"
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
        <label for="logradouro_corpo">Logradouro</label><span class="text-danger required-asterisk"> *</span>

        <div class="position-relative">
            <input type="text" id="logradouro_corpo" required class="form-control" value="{{ old('logradouro_corpo') ? old('logradouro_corpo') : '' }}" placeholder="Logradouro" name="logradouro_corpo">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero_corpo">Número</label><span class="text-danger required-asterisk"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_corpo" required class="form-control" value="{{ old('numero_corpo') ? old('numero_corpo') : '' }}" maxlength="10" placeholder="Número" name="numero_corpo">
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
                <input type="text" id="complemento_corpo" class="form-control" value="{{ old('complemento_corpo') ? old('complemento_corpo') : '' }}" maxlength="30" placeholder="Complemento" name="complemento_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_corpo">Bairro</label><span class="text-danger required-asterisk"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_corpo" required value="{{ old('bairro_corpo') ? old('bairro_corpo') : '' }}" class="form-control" placeholder="Bairro" name="bairro_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_corpo">Cidade</label><span class="text-danger required-asterisk"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_corpo" value="{{ old('cidade_corpo') ? old('cidade_corpo') : '' }}" required class="form-control" placeholder="Cidade" name="cidade_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_corpo">Estado</label><span class="text-danger required-asterisk"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_corpo" value="{{ old('estado_corpo') ? old('estado_corpo') : '' }}" required class="form-control" placeholder="Estado" name="estado_corpo">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="nacionalidade">Nacionalidade</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" id="estrangeiro"
                name="estrangeiro_check" value="1">
            <label class="form-check-label" for="estrangeiro">Estrangeiro</label>
        </div>
        <div class="position-relative">
            <input type="text" id="nacionalidade" value="{{ old('nacionalidade') ? old('nacionalidade') : '' }}" required class="form-control" {{ !old('estrangeiro_check') ? 'disabled' : '' }} placeholder="Nacionalidade" name="nacionalidade">
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
                class="form-control" {{ !old('estrangeiro_check') ? 'disabled' : '' }} placeholder="Endereço postal"
                name="endereco_postal_corpo">
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Verificar se tipo_documento tem valor RG
    let tipo_documento = $('#tipo_documento');
    let rg_corpo = $('#div_rg_corpo');
    let orgao_emissor = $('#div_orgao_emissor_corpo');
    let estado_rg = $('#div_uf_corpo');
    let numero_documento = $('#numero_documento');
    let rg_corpo_input = $('#rg_corpo');

    tipo_documento.on('change', function() {
        if ($(this).val() === 'RG') {
            rg_corpo.show();
            orgao_emissor.show();
            estado_rg.show();
            numero_documento.prop('disabled', true);
            rg_corpo_input.prop('required', true);
        } else if ($(this).val() === 'Nao Possui') {
            rg_corpo.hide();
            orgao_emissor.hide();
            estado_rg.hide();
            numero_documento.prop('disabled', true);
            rg_corpo_input.prop('required', false);
        } else {
            rg_corpo.hide();
            orgao_emissor.hide();
            estado_rg.hide();
            numero_documento.prop('disabled', false);
            rg_corpo_input.prop('required', false);
        }
    }).trigger('change'); // Executar ao carregar a página

    // Verificar se o checkbox de natimorto está marcado
    let natimorto = $('#natimorto');
    natimorto.on('change', function() {
        if ($(this).is(':checked')) {
            $('#nao_possui_cpf').prop('checked', true);
            $('#cpf_corpo').prop('disabled', true);
            tipo_documento.val('Nao Possui').trigger('change');
        } else {
            $('#cpf_corpo').prop('disabled', false);
            $('#nao_possui_cpf').prop('checked', false);
        }
    }).trigger('change'); // Executar ao carregar a página

    // Certifique-se de que o jQuery está carregado antes deste script.
    $(function() {
        $('#estrangeiro').on('change', function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="nacionalidade"]').attr('disabled', false);
                $('input[name="endereco_postal_corpo"]').attr('disabled', false);
                $('input[name="cep_corpo"]').attr('disabled', true);
                $('input[name="logradouro_corpo"]').removeAttr('required');
                $('input[name="bairro_corpo"]').removeAttr('required');
                $('input[name="numero_corpo"]').removeAttr('required');
                $('input[name="cidade_corpo"]').removeAttr('required');
                $('input[name="estado_corpo"]').removeAttr('required');

                // Remove o asterisco visual
                $('.required-asterisk').hide();
            } else {
                $('input[name="nacionalidade"]').attr('disabled', true);
                $('input[name="endereco_postal_corpo"]').attr('disabled', true);
                $('input[name="cep_corpo"]').attr('disabled', false);
                $('input[name="logradouro_corpo"]').attr('required', true);
                $('input[name="numero_corpo"]').attr('required', true);
                $('input[name="cidade_corpo"]').attr('required', true);
                $('input[name="estado_corpo"]').attr('required', true);

                // Mostra o asterisco visual
                $('.required-asterisk').show();
            }
        });
    });
</script>