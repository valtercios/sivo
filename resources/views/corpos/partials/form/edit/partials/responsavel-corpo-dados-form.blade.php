<div class="col-md-6 col-6">
    <div class="form-group has-icon-left">
        <label for="nome_responsavel">Nome do responsável pelo corpo</label>
        <div class="position-relative">
            <input type="text" id="nome_responsavel" class="form-control" placeholder="Nome" value="{{ $corpo->responsavelCorpo->nome ?? '' }}" name="nome_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-10">
        <label for="nome_responsavel">Grau de parentesco</label>
        <div class="position-relative">

<select class="form-control" id="grau_parentesco_responsavel" name="grau_parentesco_responsavel" onchange="verificaParentescosEdit()" required >
    <option value="" disabled selected>Selecione o grau de parentesco</option>
    <optgroup label="Grau por afinidade">
        <option value="Cônjuge" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Cônjuge") {{'selected'}} @endif>Cônjuge</option>
        <option value="Companheiro(a) com comprovante de união estável" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Companheiro(a) com comprovante de união estável") {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
        <option value="Companheiro(a) sem comprovante de união estável" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Companheiro(a) sem comprovante de união estável") {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
    </optgroup>
    <optgroup label="1° Grau">
        <option value="Filho(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Filho(a)") {{'selected'}} @endif>Filho(a)</option>
        <option value="Pai" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Pai") {{'selected'}} @endif>Pai</option>
        <option value="Mãe" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Mãe") {{'selected'}} @endif>Mãe</option>
         <option value="Pai/Mãe" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Pai/Mãe") {{'selected'}} @endif>Pai/Mãe</option>
    </optgroup>
    <optgroup label="2° Grau">
        <option value="Neto(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Neto(a)") {{'selected'}} @endif>Neto(a)</option>
        <option value="Avô/Avó" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Avô/Avó") {{'selected'}} @endif>Avô/Avó</option>
        <option value="Irmão(ã)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Irmão(ã)") {{'selected'}} @endif>Irmão(ã)</option>
    </optgroup>
    <optgroup label="3° Grau">
        <option value="Bisneto(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Bisneto(a)") {{'selected'}} @endif>Bisneto(a)</option>
        <option value="Bisavô/Bisavó" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Bisavô/Bisavó") {{'selected'}} @endif>Bisavô/Bisavó</option>
        <option value="Tio(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Tio(a)") {{'selected'}} @endif>Tio(a)</option>
        <option value="Sobrinho(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Sobrinho(a)") {{'selected'}} @endif>Sobrinho(a)</option>
    </optgroup>
    <optgroup label="4° Grau">
        <option value="Trineto(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Trineto(a)") {{'selected'}} @endif>Trineto(a)</option>
        <option value="Trisavô/Trisavó" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Trisavô/Trisavó") {{'selected'}} @endif>Trisavô/Trisavó</option>
        <option value="Sobrinho(a)-neto(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Sobrinho(a)-neto(a)") {{'selected'}} @endif>Sobrinho(a)-neto(a)</option>
        <option value="Tio(a)-avô(ó)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Tio(a)-avô(ó)") {{'selected'}} @endif>Tio(a)-avô(ó)</option>
        <option value="Primo(a)" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Primo(a)") {{'selected'}} @endif>Primo(a)</option>
    </optgroup>
    <optgroup label="Outras opções">
        <option value="Outros" @if(($corpo->responsavelCorpo->grau_parentesco ?? '') == "Outros") {{'selected'}} @endif>Outros</option>
    </optgroup>
</select>
</div>
</div>


<div class="col-md-6 col-12" id='grau_parentesco_responsavel_outroDiv' style="display: block;" >
    <div class="form-group has-icon-left">
        <label for="grau-parentesco">Outro grau de parentesco</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" class="form-control" @if(($corpo->responsavelCorpo->outro_parentesco ?? '') == null){{ 'disabled' }} @endif id="grau_parentesco_responsavel_outro" value="{{isset($corpo->responsavelCorpo->outro_parentesco)}}" name="grau_parentesco_responsavel_outro" value="{{ old('grau_parentesco_responsavel_outros') }}" placeholder="Digite o grau de parentesco" >
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="sexo_responsavel">Sexo</label>
        <div class="position-relative">
            <select name="sexo_responsavel" required id="" class="form-control">
                <option value="M" @if(($corpo->responsavelCorpo->sexo ?? '') == "M") {{'selected'}} @endif>Masculino</option>
                <option value="F" @if(($corpo->responsavelCorpo->sexo ?? '') == "F") {{'selected'}} @endif>Feminino</option>
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
            <input type="checkbox" class="form-check-input form-check-primary" {{ ($corpo->responsavelCorpo->cpf ?? '') == null ? 'checked' : '' }} name="responsavel_nao_possui_cpf" id="responsavel_nao_possui_cpf">
            <label class="form-check-label" for="">Não possui</label>
        </div>
        
        <div class="position-relative">
            <input type="text" id="cpf_responsavel" class="form-control" value="{{ ($corpo->responsavelCorpo->cpf ?? '') ?? '' }}" {{ ($corpo->responsavelCorpo->cpf ?? '') == null ? 'disabled' : '' }} placeholder="CPF do corpo" name="cpf_responsavel" >
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
            <input type="text" id="telefone_responsavel" value="{{ $corpo->responsavelCorpo->telefone ?? '' }}" class="form-control" placeholder="Telefone" name="telefone_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-telephone-fill"></i>
            </div>
        </div>
    </div>
</div>

{{-- @dd($corpo->responsavelCorpo) --}}
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="label_tipo_documento_responsavel">Documento de identificação</label>
        <div class="position-relative">
            <select name="tipo_documento_responsavel" class="form-control" id="tipo_documento_responsavel">
                <option value="" selected disabled>Selecione o tipo de documento</option>
                <option value="RG" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "RG" || ($corpo->responsavelCorpo->tipo_documento?? '') == null ) {{'selected'}} @endif>RG</option>
                <option value="Certidão de nascimento" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "Certidão de nascimento") {{'selected'}}@endif>Certidão de nascimento</option>
                <option value="Certidão de casamento" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "Certidão de casamento") {{'selected'}}@endif>Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Carteira Nacional de Habilitação"){{'selected'}}@endif>Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Carteira de trabalho"){{'selected'}}@endif>Carteira de trabalho</option>
                <option value="Registro Geral - CPF"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Registro Geral - CPF"){{'selected'}}@endif>Registro Geral - CPF</option>
                <option value="Passaporte"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Passaporte"){{'selected'}}@endif>Passaporte</option>
                <option value="Nao Possui"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Nao Possui") {{'selected'}}@endif>Nao Possui</option>
                <option value="Outros"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Outros"){{'selected'}}@endif>Outros</option>
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
            <input type="text" id="numero_documento_responsavel" disabled value="{{$corpo->responsavelCorpo->numero_documento ?? ' '}}"  class="form-control" placeholder="Numero do documento do corpo" name="numero_documento_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12" id='div_rg_responsavel'>
    <div class="form-group has-icon-left">
        <label for="rg_responsavel">RG</label>
        <div class="position-relative">
            <input type="text" id="rg_responsavel" value="{{ $corpo->responsavelCorpo->rg?? '' }}" class="form-control" placeholder="RG" name="rg_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" id='div_orgao_emissor_responsavel'style='display=none'>
    <div class="form-group">
        <label for="orgao_emissor_responsavel">Orgão emissor</label>
        <div class="position-relative">
            <select name="orgao_emissor_responsavel" id="orgao_emissor_responsavel" class="choices form-control">
                <option value="" selected disabled>Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                    <option value="{{ $orgao->id }}" @if(($corpo->responsavelCorpo->orgao_emissor ?? '') == $orgao->id) {{'selected'}} @endif>{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" id='div_estado_rg_responsavel'>
    <div class="form-group ">
        <label for="estado_responsavel">UF</label>
        <div class="position-relative">
            <select name="estado_rg_responsavel_corpo" id="" class="form-control choices">
                <option value="" selected disabled>Selecione o estado</option>
                @foreach (getEstados() as $key => $estado)
                    <option value="{{ $key }}" @if($key == ($corpo->responsavelCorpo->estado_rg ??'')) {{'selected'}} @endif>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_responsavel">CEP</label>
        
        <div class="position-relative">
            <input type="text" id="cep_responsavel" value="{{ $corpo->responsavelCorpo->endereco->cep ?? '' }}" class="form-control" placeholder="CEP" name="cep_responsavel"
            onblur="pesquisacep(this.value, '_responsavel');" >
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_responsavel')">Encontrar CEP</a>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_responsavel">Logradouro</label>
        
        <div class="position-relative">
            <input type="text" id="logradouro_responsavel" value="{{ $corpo->responsavelCorpo->endereco->logradouro ?? '' }}" class="form-control" placeholder="Logradouro" name="logradouro_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="numero_responsavel">Número</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_responsavel" value="{{ $corpo->responsavelCorpo->endereco->numero ?? ''}}" class="form-control" maxlength="10" placeholder="Numero da residência" name="numero_responsavel">
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
                <input type="text" id="complemento_responsavel" maxlength="30" class="form-control" value="{{ $corpo->responsavelCorpo->endereco->complemento ?? '' }}" placeholder="Complemento" name="complemento_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_responsavel">Bairro</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_responsavel" value="{{ $corpo->responsavelCorpo->endereco->bairro ?? '' }}" class="form-control" placeholder="Bairro" name="bairro_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_responsavel">Cidade</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_responsavel" value="{{ $corpo->responsavelCorpo->endereco->cidade ?? '' }}" class="form-control" placeholder="Cidade" name="cidade_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_responsavel">Estado</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_responsavel" value="{{ $corpo->responsavelCorpo->endereco->estado ?? '' }}" class="form-control" placeholder="Estado" name="estado_responsavel">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="corpoSera">Familia informa que o corpo será</label>
        <div class="form-group">
            <div class="position-relative">
                <select name="corpoSera" class="form-control" id="corpoSera">
                    <option value="" disabled>Selecione uma opção</option>
                    <option value="sepultado" @if($corpo->corpoSera == "sepultado") {{'selected'}} @endif>Sepultado</option>
                    <option value="cremado" @if($corpo->corpoSera == "cremado") {{'selected'}} @endif>Cremado</option>
                    <option value="doado" @if($corpo->corpoSera == "doado") {{'selected'}} @endif>Doado</option>
                    <option value="outros" @if($corpo->corpoSera == "outros") {{'selected'}} @endif>Outros</option>


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
            <input type="text" class="form-control" value="{{$corpo->destino_do_corpo ?? ''}}" id="destino_do_corpo" name="destino_do_corpo" placeholder="Destino do corpo">
            <div class="form-control-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="nacionalidade_responsavel">Nacionalidade</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" id="responsavel_estrangeiro"
                name="responsavel_estrangeiro_check" value="1"
                {{ old('responsavel_estrangeiro_check') ? 'checked' : '' }}>
            <label class="form-check-label" for="responsavel_estrangeiro_2">Estrangeiro</label>
        </div>
        <div class="position-relative">
            <input type="text" id="nacionalidade_responsavel"
                value="{{ $corpo->responsavelCorpo->nacionalidade ?? '' }}" required
                class="form-control" {{ !old('responsavel_estrangeiro_check') ? 'disabled' : '' }}
                placeholder="Nacionalidade" name="nacionalidade_responsavel">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<script>
    function verificaParentescosEdit() {
        var grau_parentesco = $("#grau_parentesco_responsavel option:selected").val();
        var outro_parentescoEdit = document.getElementById('grau_parentesco_responsavel_outro');
        
        if (grau_parentesco === "Outros") {
            outro_parentescoEdit.value = ''; // Define o valor como uma string vazia quando "Outros" é selecionado
            outro_parentescoEdit.disabled = false; // Habilita o campo quando "Outros" é selecionado
        } else {
            outro_parentescoEdit.value = ''; // Define o valor como uma string vazia quando "Outros" não está selecionado
            outro_parentescoEdit.disabled = true; // Desabilita o campo quando "Outros" não está selecionado
        }
    }

    

    //verificar se tipo_documento tem valor RG
    let tipo_documento_responsavel = document.getElementById('tipo_documento_responsavel');
    let rg_responsavel = document.getElementById('div_rg_responsavel');
    let orgao_emissor_responsavel = document.getElementById('div_orgao_emissor_responsavel');
    let div_estado_rg_responsavel = document.getElementById('div_estado_rg_responsavel');
    let numero_documento_responsavel = document.getElementById('numero_documento_responsavel');
    let responsavel_nao_possui_cpf = document.getElementById('responsavel_nao_possui_cpf');
    
    // Inputs para adicionar/remover required
    let rg_responsavel_input = document.querySelector('input[name="rg_responsavel"]');
    let orgao_emissor_responsavel_select = document.querySelector('select[name="orgao_emissor_responsavel"]');
    let estado_rg_responsavel_select = document.querySelector('select[name="estado_rg_responsavel_corpo"]');
    
    document.addEventListener('DOMContentLoaded', function() {
        // Dispara o evento change para aplicar a lógica inicial
        tipo_documento_responsavel.dispatchEvent(new Event('change'));
    });
    
    tipo_documento_responsavel.addEventListener('change', function(e){
        if(e.target.value == 'RG'){
            if(rg_responsavel) rg_responsavel.style.display = 'block';
            if(orgao_emissor_responsavel) orgao_emissor_responsavel.style.display = 'block';
            if(div_estado_rg_responsavel) div_estado_rg_responsavel.style.display = 'block';
            if(numero_documento_responsavel) numero_documento_responsavel.setAttribute('disabled', 'disabled');
            // Adicionar required
            if(rg_responsavel_input) rg_responsavel_input.setAttribute('required', 'required');
            if(orgao_emissor_responsavel_select) orgao_emissor_responsavel_select.setAttribute('required', 'required');
            if(estado_rg_responsavel_select) estado_rg_responsavel_select.setAttribute('required', 'required');
        }
        else if(e.target.value == 'Nao Possui'){
            if(rg_responsavel) rg_responsavel.style.display = 'none';
            if(orgao_emissor_responsavel) orgao_emissor_responsavel.style.display = 'none';
            if(div_estado_rg_responsavel) div_estado_rg_responsavel.style.display = 'none';
            if(numero_documento_responsavel) numero_documento_responsavel.setAttribute('disabled', 'disabled');
            // Remover required
            if(rg_responsavel_input) rg_responsavel_input.removeAttribute('required');
            if(orgao_emissor_responsavel_select) orgao_emissor_responsavel_select.removeAttribute('required');
            if(estado_rg_responsavel_select) estado_rg_responsavel_select.removeAttribute('required');
        }
        else{
            if(rg_responsavel) rg_responsavel.style.display = 'none';
            if(orgao_emissor_responsavel) orgao_emissor_responsavel.style.display = 'none';
            if(div_estado_rg_responsavel) div_estado_rg_responsavel.style.display = 'none';
            if(numero_documento_responsavel) numero_documento_responsavel.removeAttribute('disabled');
            // Remover required
            if(rg_responsavel_input) rg_responsavel_input.removeAttribute('required');
            if(orgao_emissor_responsavel_select) orgao_emissor_responsavel_select.removeAttribute('required');
            if(estado_rg_responsavel_select) estado_rg_responsavel_select.removeAttribute('required');
        }
    });

    responsavel_nao_possui_cpf.addEventListener('change', function(e){
        let cpf_responsavel = document.getElementById('cpf_responsavel');
        if(e.target.checked){
            cpf_responsavel.setAttribute('disabled', 'disabled');
        }
        else{
            cpf_responsavel.removeAttribute('disabled');
        }
    });

</script>
