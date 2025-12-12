<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="nome_responsavel">Nome do responsável pelo corpo</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="nome_responsavel" value="{{ old('nome_responsavel') ? old('nome_responsavel') : '' }}" required class="form-control" placeholder="Nome" name="nome_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="grau_parentesco">Grau de parentesco</label><span class="text-danger"> *</span>
        <div class="position-relative">

            <select class="form-control" id="grau_parentesco_responsavel_id" required name="grau_parentesco_responsavel" onchange="verificaParentesco()">
                <option value="" disabled {{ !old('grau_parentesco_responsavel') ? 'selected' : '' }}>Selecione o grau de parentesco</option>
                <optgroup label="Grau por afinidade">
                    <option value="Cônjuge" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Cônjuge" ) {{'selected'}} @endif>Cônjuge</option>
                    <option value="Companheiro(a) com comprovante de união estável" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Companheiro(a) com comprovante de união estável" ) {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
                    <option value="Companheiro(a) sem comprovante de união estável" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Companheiro(a) sem comprovante de união estável" ) {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
                </optgroup>
                <optgroup label="1° Grau">
                    <option value="Filho(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Filho(a)" ) {{'selected'}} @endif>Filho(a)</option>
                    <option value="Pai/Mãe" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Pai/Mãe" ) {{'selected'}} @endif>Pai/Mãe</option>
                </optgroup>
                <optgroup label="2° Grau">
                    <option value="Neto(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Neto(a)" ) {{'selected'}} @endif>Neto(a)</option>
                    <option value="Avô/Avó" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Avô/Avó" ) {{'selected'}} @endif>Avô/Avó</option>
                    <option value="Irmão(ã)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Irmão(ã)" ) {{'selected'}} @endif>Irmão(ã)</option>
                </optgroup>
                <optgroup label="3° Grau">
                    <option value="Bisneto(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Bisneto(a)" ) {{'selected'}} @endif>Bisneto(a)</option>
                    <option value="Bisavô/Bisavó" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Bisavô/Bisavó" ) {{'selected'}} @endif>Bisavô/Bisavó</option>
                    <option value="Tio(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Tio(a)" ) {{'selected'}} @endif>Tio(a)</option>
                    <option value="Sobrinho(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Sobrinho(a)" ) {{'selected'}} @endif>Sobrinho(a)</option>
                </optgroup>
                <optgroup label="4° Grau">
                    <option value="Trineto(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Trineto(a)" ) {{'selected'}} @endif>Trineto(a)</option>
                    <option value="Trisavô/Trisavó" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Trisavô/Trisavó" ) {{'selected'}} @endif>Trisavô/Trisavó</option>
                    <option value="Sobrinho(a)-neto(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Sobrinho(a)-neto(a)" ) {{'selected'}} @endif>Sobrinho(a)-neto(a)</option>
                    <option value="Tio(a)-avô(ó)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Tio(a)-avô(ó)" ) {{'selected'}} @endif>Tio(a)-avô(ó)</option>
                    <option value="Primo(a)" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Primo(a)" ) {{'selected'}} @endif>Primo(a)</option>
                </optgroup>
                <optgroup label="Outras opções">
                    <option value="Outros" @if(old('grau_parentesco_responsavel') !==null && old('grau_parentesco_responsavel')=="Outros" ) {{'selected'}} @endif>Outros</option>
                </optgroup>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12" id='grau_parentesco_responsavel_outro' style="display: none;">
    <div class="form-group has-icon-left">
        <label for="grau-parentesco">Outro grau de parentesco</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" class="form-control" id="grau_parentesco_responsavel_outro" name="grau_parentesco_responsavel_outro" value="{{ old('grau_parentesco_responsavel_outros') }}" placeholder="Digite o grau de parentesco">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="sexo_responsavel">Sexo</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="sexo_responsavel" required id="" class="form-control">
                <option value="M" @if(old('sexo_responsavel') !==null && old('sexo_responsavel')=="M" ) {{'selected'}} @endif>Masculino</option>
                <option value="F" @if(old('sexo_responsavel') !==null && old('sexo_responsavel')=="F" ) {{'selected'}} @endif>Feminino</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_responsavel">CPF</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" name="responsavel_nao_possui_cpf" id="responsavel_nao_possui_cpf">
            <label class="form-check-label" for="">Não possui</label>
        </div>
        <div class="position-relative">
            <input type="text" id="cpf_responsavel" value="{{ old('cpf_responsavel') ? old('cpf_responsavel') : '' }}" required class="form-control" placeholder="CPF" name="cpf_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="telefone_responsavel">Telefone</label>
        <div class="position-relative">
            <input type="text" id="telefone_responsavel" value="{{ old('telefone_responsavel') ? old('telefone_responsavel') : '' }}" class="form-control" placeholder="Telefone" name="telefone_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-telephone-fill"></i>
            </div>
        </div>
    </div>
</div>


<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="label_tipo_documento_responsavel">Documento de identificação</label>
        <div class="position-relative">
            <select name="tipo_documento_responsavel" class="form-control" id="tipo_documento_responsavel">
                <option value="" selected disabled>Selecione o tipo de documento</option>
                <option value="RG">RG</option>
                <option value="Certidão de nascimento">Certidão de nascimento</option>
                <option value="Certidão de casamento">Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação">Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho">Carteira de trabalho</option>
                <option value="Registro Geral - CPF">Registro Geral - CPF</option>
                <option value="Passaporte">Passaporte</option>
                <option value="Nao Possui">Nao Possui</option>
                <option value="Outros">Outros</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-8 col-8">
    <div class="form-group has-icon-left">
        <label for="label_numero_documento_responsavel">Numero do documento</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="numero_documento_responsavel" disabled value="{{ old('numero_documento_responsavel') ? old('numero_documento_responsavel') : '' }}" class="form-control" placeholder="Numero do documento do corpo" name="numero_documento_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>



<div class="col-md-4 col-12" style="display: none" id="div_rg_corpo_responsavel">
    <div class="form-group has-icon-left">
        <label for="rg_responsavel">RG</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="rg_responsavel" value="{{ old('rg_responsavel') ? old('rg_responsavel') : '' }}" class="form-control" placeholder="Informe o RG" name="rg_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" style="display: none" id="div_div_orgao_emissor_responsavel">
    <div class="form-group">
        <label for="orgao_emissor_responsavel">Orgão emissor</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="orgao_emissor_responsavel" id="orgao_emissor_responsavel_select" class="form-control">
                <option value="" {{ !old('orgao_emissor_responsavel') ? 'selected' : '' }} disabled>Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                <option value="{{ $orgao->id }}" @if(old('orgao_emissor_responsavel') !==null && old('orgao_emissor_responsavel')==$orgao->id) {{'selected'}} @endif>{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" style="display: none" id="estado_rg_responsavel">
    <div class="form-group ">
        <label for="estado_rg_responsavel_corpo">UF</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <select name="estado_rg_responsavel_corpo" id="estado_rg_responsavel_corpo_select" class="form-control">
                <option value="" {{ !old('estado_rg_responsavel_corpo') ? 'selected' : '' }} disabled>Selecione o estado</option>
                @foreach (getEstados() as $key => $estado)
                <option value="{{ $key }}" @if(old('estado_rg_responsavel_corpo') !==null && old('estado_rg_responsavel_corpo')==$key) {{'selected'}} @endif>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_responsavel">CEP</label>

        <div class="position-relative">
            <input type="text" id="cep_responsavel" required class="form-control" placeholder="CEP" name="cep_responsavel"
                onblur="pesquisacep(this.value, '_responsavel');" value="{{ old('cep_responsavel') ? old('cep_responsavel') : '' }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_responsavel')">Encontrar CEP</a>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_responsavel">Logradouro</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="logradouro_responsavel" value="{{ old('logradouro_responsavel') ? old('logradouro_responsavel') : '' }}" required class="form-control" placeholder="Logradouro" name="logradouro_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero_responsavel">Número</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_responsavel" value="{{ old('numero_responsavel') ? old('numero_responsavel') : '' }}" required class="form-control" placeholder="Número" maxlength="10" name="numero_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="complemento_responsavel">Complemento</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="complemento_responsavel" value="{{ old('complemento_responsavel') ? old('complemento_responsavel') : '' }}" class="form-control" maxlength="30" placeholder="Complemento" name="complemento_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_responsavel">Bairro</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_responsavel" value="{{ old('bairro_responsavel') ? old('bairro_responsavel') : '' }}" required class="form-control" placeholder="Bairro" name="bairro_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_responsavel">Cidade</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_responsavel" value="{{ old('cidade_responsavel') ? old('cidade_responsavel') : '' }}" required class="form-control" placeholder="Cidade" name="cidade_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_responsavel">Estado</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_responsavel" value="{{ old('estado_responsavel') ? old('estado_responsavel') : '' }}" required class="form-control" placeholder="Estado" name="estado_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="corpoSera">Familia informa que o corpo será</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <select name="corpoSera" class="form-control" required id="corpoSera">
                    <option value="" disabled {{ !old('corpoSera') ? 'selected' : '' }}>Selecione uma opção</option>
                    <option value="sepultado" @if(old('corpoSera') !==null && old('corpoSera')=="sepultado" ) {{'selected'}} @endif>Sepultado</option>
                    <option value="cremado" @if(old('corpoSera') !==null && old('corpoSera')=="cremado" ) {{'selected'}} @endif>Cremado</option>
                    <option value="Doado" @if(old('corpoSera') !==null && old('corpoSera')=="doado" ) {{'selected'}} @endif>Doado</option>
                    <option value="outros" @if(old('corpoSera') !==null && old('corpoSera')=="outros" ) {{'selected'}} @endif>Outros</option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="destino_do_corpo">Destino do corpo</label>
        <div class="position-relative">
            <input type="text" class="form-control" id="destino_do_corpo" name="destino_do_corpo" placeholder="Destino do corpo">
            <div class="form-control-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function verificaParentescos() {
            var grau_parentesco = $("#grau_parentesco_responsavel option:selected").val();
            var outro_parentesco = $('#grau_parentesco_responsavel_outro');
            console.log(grau_parentesco);
            if (grau_parentesco === "Outros") {
                outro_parentesco.show();
            } else {
                outro_parentesco.hide();
            }
        }

        $('#grau_parentesco_responsavel').on('change', verificaParentescos);

        $('#tipo_documento_responsavel').on('change', function() {
            let tipo_documento = $(this).val();
            let div_rg_corpo_responsavel = $('#div_rg_corpo_responsavel');
            let div_orgao_emissor_responsavel = $('#div_div_orgao_emissor_responsavel');
            let estado_rg_responsavel = $('#estado_rg_responsavel');
            let numero_documento_responsavel = $('#numero_documento_responsavel');
            let rg_responsavel_input = $('#rg_responsavel');
            let orgao_emissor_responsavel_input = $('#orgao_emissor_responsavel_select');
            let estado_rg_responsavel_input = $('#estado_rg_responsavel_corpo_select');

            if (tipo_documento === 'RG') {
                div_rg_corpo_responsavel.show();
                div_orgao_emissor_responsavel.show();
                estado_rg_responsavel.show();
                numero_documento_responsavel.prop('disabled', true);
                rg_responsavel_input.prop('required', true);
                orgao_emissor_responsavel_input.prop('required', true);
                estado_rg_responsavel_input.prop('required', true);
            } else if (tipo_documento === 'Nao Possui') {
                div_rg_corpo_responsavel.hide();
                div_orgao_emissor_responsavel.hide();
                estado_rg_responsavel.hide();
                numero_documento_responsavel.prop('disabled', true);
                rg_responsavel_input.prop('required', false);
                orgao_emissor_responsavel_input.prop('required', false);
                estado_rg_responsavel_input.prop('required', false);
            } else {
                div_rg_corpo_responsavel.hide();
                div_orgao_emissor_responsavel.hide();
                estado_rg_responsavel.hide();
                numero_documento_responsavel.prop('disabled', false);
                rg_responsavel_input.prop('required', false);
                orgao_emissor_responsavel_input.prop('required', false);
                estado_rg_responsavel_input.prop('required', false);
            }
        }).trigger('change');

        $('#responsavel_nao_possui_cpf').on('change', function() {
            let cpf_responsavel = $('#cpf_responsavel');
            if ($(this).is(':checked')) {
                cpf_responsavel.prop('disabled', true);
            } else {
                cpf_responsavel.prop('disabled', false);
            }
        }).trigger('change');

        verificaParentescos();
    });
</script>