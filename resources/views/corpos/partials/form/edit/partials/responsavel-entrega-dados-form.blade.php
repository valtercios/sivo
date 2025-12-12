<div class="col-md-6 col-16">
    <div class="form-group has-icon-left">
        <label for="nome_responsavel_entrega">Nome do responsável pela entrega do corpo:</label>
        <div class="position-relative">
            <input type="text" id="nome_responsavel_entrega" class="form-control"
                value="{{ $corpo->responsavelEntrega->nome }}" placeholder="Nome" name="nome_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
{{-- @dd($corpo->responsavelCorpo) --}}
@if($corpo->responsavelCorpo != null && $corpo->responsavelCorpo->parente == 0 && $corpo->responsavelCorpo->outro_parentesco == null)
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="grau_parentesco_responsavel">Grau de parentesco</label>
        <div class="position-relative">
            <select class="form-control" id="grau_parentesco_responsavel" name="grau_parentesco_responsavel" required>
                <option value="" disabled selected>Selecione o grau de parentesco</option>
                <optgroup label="Grau por afinidade">
                    <option value="Cônjuge" @if($corpo->responsavelCorpo->grau_parentesco == "Cônjuge") {{'selected'}} @endif>Cônjuge</option>
                    <option value="Companheiro(a) com comprovante de união estável" @if($corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) com comprovante de união estável") {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
                    <option value="Companheiro(a) sem comprovante de união estável" @if($corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) sem comprovante de união estável") {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
                </optgroup>
                <optgroup label="1° Grau">
                    <option value="Filho" @if($corpo->responsavelCorpo->grau_parentesco == "Filho") {{'selected'}} @endif>Filho</option>
                    <option value="Pai" @if($corpo->responsavelCorpo->grau_parentesco == "Pai") {{'selected'}} @endif>Pai</option>
                    <option value="Mãe" @if($corpo->responsavelCorpo->grau_parentesco == "Mãe") {{'selected'}} @endif>Mãe</option>
                    <option value="Pai/Mãe" @if($corpo->responsavelCorpo->grau_parentesco == "Pai/Mãe") {{'selected'}} @endif>Pai/Mãe</option>
                </optgroup>
                <optgroup label="2° Grau">
                    <option value="Neto" @if($corpo->responsavelCorpo->grau_parentesco == "Neto") {{'selected'}} @endif>Neto</option>
                    <option value="Avós" @if($corpo->responsavelCorpo->grau_parentesco == "Avós") {{'selected'}} @endif>Avós</option>
                    <option value="Irmãos" @if($corpo->responsavelCorpo->grau_parentesco == "Irmãos") {{'selected'}} @endif>Irmãos</option>
                </optgroup>
                <optgroup label="3° Grau">
                    <option value="Bisneto" @if($corpo->responsavelCorpo->grau_parentesco == "Bisneto") {{'selected'}} @endif>Bisneto</option>
                    <option value="Bisavós" @if($corpo->responsavelCorpo->grau_parentesco == "Bisavós") {{'selected'}} @endif>Bisavós</option>
                    <option value="Tios" @if($corpo->responsavelCorpo->grau_parentesco == "Tios") {{'selected'}} @endif>Tios</option>
                    <option value="Sobrinhos" @if($corpo->responsavelCorpo->grau_parentesco == "Sobrinhos") {{'selected'}} @endif>Sobrinhos</option>
                </optgroup>
                <optgroup label="4° Grau">
                    <option value="Trineto" @if($corpo->responsavelCorpo->grau_parentesco == "Trineto") {{'selected'}} @endif>Trineto</option>
                    <option value="Trisavós" @if($corpo->responsavelCorpo->grau_parentesco == "Trisavós") {{'selected'}} @endif>Trisavós</option>
                    <option value="Sobrinho-neto" @if($corpo->responsavelCorpo->grau_parentesco == "Sobrinho-neto") {{'selected'}} @endif>Sobrinho-neto</option>
                    <option value="Tio-avô" @if($corpo->responsavelCorpo->grau_parentesco == "Tio-avô") {{'selected'}} @endif>Tio-avô</option>
                    <option value="Primo" @if($corpo->responsavelCorpo->grau_parentesco == "Primo") {{'selected'}} @endif>Primo</option>
                </optgroup>
                
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
@endif

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="sexo_responsavel_entrega">Sexo</label>
        <div class="position-relative">
            <select name="sexo_responsavel_entrega" required id="" class="form-control">
                <option value="null" selected disabled> Selecione </option>
                <option value="M" @if ($corpo->responsavelEntrega->sexo == 'M') {{ 'selected ' }} @endif>Masculino</option>
                <option value="F" @if ($corpo->responsavelEntrega->sexo == 'F') {{ 'selected ' }} @endif>Feminino</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-gender-ambiguous"></i>
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_responsavel_entrega">CPF</label>
        <div class="position-relative">
            <input type="text" id="cpf_responsavel_entrega" class="form-control" placeholder="CPF"
                name="cpf_responsavel_entrega" value="{{ $corpo->responsavelEntrega->cpf }}">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div> --}}

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cpf_responsavel_entrega">CPF</label><span class="text-danger"> *</span>
        <div class="d-inline-block float-end">
            <input type="checkbox" class="form-check-input form-check-primary" {{ $corpo->responsavelEntrega->cpf == null ? 'checked' : '' }} name="responsavel_entrega_nao_possui_cpf" id="responsavel_entrega_nao_possui_cpf">
            <label class="form-check-label" for="">Não possui</label>
        </div>
        
        <div class="position-relative">
            <input type="text" id="cpf_responsavel_entrega" class="form-control" value="{{ $corpo->responsavelEntrega->cpf ?? '' }}" {{ $corpo->responsavelEntrega->cpf == null ? 'disabled' : '' }} placeholder="CPF" name="cpf_responsavel_entrega" required>
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
            <input type="text" id="telefone_responsavel_entrega" class="form-control" placeholder="Telefone"
                name="telefone_responsavel_entrega" value="{{ $corpo->responsavelEntrega->telefone ?? '' }}">
            <div class="form-control-icon">
                <i class="bi bi-telephone-fill"></i>
            </div>
        </div>
    </div>
</div>


{{-- @dd($corpo->responsavelCorpo) --}}
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="label_tipo_documento_responsavel_entrega">Documento de identificação</label>
        <div class="position-relative">
            <select name="tipo_documento_responsavel_entrega" class="form-control" id="tipo_documento_responsavel_entrega">
                <option value="" selected disabled>Selecione o tipo de documento</option>
                <option value="RG" @if($corpo->responsavelEntrega->tipo_documento == "RG" || $corpo->responsavelEntrega->tipo_documento == null ) {{'selected'}} @endif>RG</option>
                <option value="Certidão de nascimento" @if($corpo->responsavelEntrega->tipo_documento == "Certidão de nascimento") {{'selected'}}@endif>Certidão de nascimento</option>
                <option value="Certidão de casamento" @if($corpo->responsavelEntrega->tipo_documento == "Certidão de casamento") {{'selected'}}@endif>Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação"@if($corpo->responsavelEntrega->tipo_documento == "Carteira Nacional de Habilitação"){{'selected'}}@endif>Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho"@if($corpo->responsavelEntrega->tipo_documento == "Carteira de trabalho"){{'selected'}}@endif>Carteira de trabalho</option>
                <option value="Registro Geral - CPF"@if($corpo->responsavelEntrega->tipo_documento == "Registro Geral - CPF"){{'selected'}}@endif>Registro Geral - CPF</option>
                <option value="Passaporte"@if($corpo->responsavelEntrega->tipo_documento == "Passaporte"){{'selected'}}@endif>Passaporte</option>
                <option value="Nao Possui"@if($corpo->responsavelEntrega->tipo_documento == "Nao Possui") {{'selected'}}@endif>Nao Possui</option>
                <option value="Outros"@if($corpo->responsavelEntrega->tipo_documento == "Outros"){{'selected'}}@endif>Outros</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
@if( $corpo->responsavelEntrega->tipo_documento != 'RG' && $corpo->responsavelEntrega->tipo_documento != null)
<div class="col-md-8 col-8">
    <div class="form-group has-icon-left">
        <label for="label_numero_documento_responsavel_entrega">Numero do documento</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="text" id="numero_documento_responsavel_entrega" value="{{$corpo->responsavelEntrega->numero_documento ?? ' '}}"  class="form-control" placeholder="Numero do documento do corpo" name="numero_documento_responsavel_entrega">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-md-4 col-12" id='div_rg_responsavel_entrega' style="display: block">
    <div class="form-group has-icon-left">
        <label for="rg_responsavel_entrega">RG</label>
        <div class="position-relative">
            <input type="text" id="rg_responsavel_entrega" class="form-control" placeholder="RG"
                name="rg_responsavel_entrega" value="{{ $corpo->responsavelEntrega->rg }}">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" id='div_orgao_emissor_responsavel_entrega' style="display: block">
    <div class="form-group ">
        <label for="orgao_emissor_responsavel_entrega">Orgão emissor</label>
        <div class="position-relative">
            <select name="orgao_emissor_responsavel_entrega" id="" class="choices form-control">
                <option value="" selected disabled>Selecione o orgão emissor</option>
                @foreach ($orgaos_emissores as $orgao)
                    <option value="{{ $orgao->id }}" @if ($orgao->id == $corpo->responsavelEntrega->orgao_emissor) {{ 'selected ' }} @endif>{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
<div class="col-md-4 col-12" id='div_estado_rg_responsavel_entrega' style="display: block">
    <div class="form-group ">
        <label for="estado_rg_responsavel_entrega">UF</label>
        <div class="position-relative">
            <select name="estado_rg_responsavel_entrega" id="" class="form-control choices">
                <option value="" selected disabled>Selecione o estado</option>
                @foreach (getEstados() as $key => $estado)
                    <option value="{{ $key }}" @if($key == $corpo->responsavelEntrega->estado_rg) {{'selected'}} @endif>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endif
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep_responsavel_entrega">CEP</label>

        <div class="position-relative">
            <input type="text" id="cep_responsavel_entrega" class="form-control" placeholder="CEP"
                name="cep_responsavel_entrega" onblur="pesquisacep(this.value, '_responsavel_entrega');" value="{{ $corpo->responsavelEntrega->endereco->cep }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('_responsavel_entrega')">Encontrar CEP</a>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro_responsavel_entrega">Logradouro</label>

        <div class="position-relative">
            <input type="text" id="logradouro_responsavel_entrega" class="form-control" placeholder="Logradouro"
                name="logradouro_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->logradouro }}">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="numero_responsavel_entrega">Número</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="numero_responsavel_entrega" class="form-control" maxlength="10"
                    placeholder="Numero da residência" name="numero_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->numero }}">
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
                <input type="text" id="complemento_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->complemento ?? '' }}"  class="form-control" maxlength="30" placeholder="Complemento" name="complemento_responsavel_entrega">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro_responsavel_entrega">Bairro</label>
        <div class="form-group">
            <div class="position-relative" style="display: block">
                <input type="text" id="bairro_responsavel_entrega" class="form-control" placeholder="Bairro"
                    name="bairro_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->bairro }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade_responsavel_entrega">Cidade</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_responsavel_entrega" class="form-control" placeholder="Cidade"
                    name="cidade_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->cidade }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_responsavel_entrega">Estado</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_responsavel_entrega" class="form-control" placeholder="Estado"
                    name="estado_responsavel_entrega" value="{{ $corpo->responsavelEntrega->endereco->estado }}">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    //verificar se tipo_documento tem valor RG
    let tipo_documento_responsavel_entrega = document.getElementById('tipo_documento_responsavel_entrega');
    let rg_responsavel_entrega = document.getElementById('div_rg_responsavel_entrega');
    let orgao_emissor_responsavel_entrega = document.getElementById('div_orgao_emissor_responsavel_entrega');
    let div_estado_rg_responsavel_entrega = document.getElementById('div_estado_rg_responsavel_entrega');
    let numero_documento_responsavel_entrega = document.getElementById('numero_documento_responsavel_entrega');
    let responsavel_entrega_nao_possui_cpf = document.getElementById('responsavel_entrega_nao_possui_cpf');
    
    // Inputs para adicionar/remover required
    let rg_responsavel_entrega_input = document.querySelector('input[name="rg_responsavel_entrega"]');
    let orgao_emissor_responsavel_entrega_select = document.querySelector('select[name="orgao_emissor_responsavel_entrega"]');
    let estado_rg_responsavel_entrega_select = document.querySelector('select[name="estado_rg_responsavel_entrega"]');

    document.addEventListener('DOMContentLoaded', function() {
        // Dispara o evento change para aplicar a lógica inicial
        tipo_documento_responsavel_entrega.dispatchEvent(new Event('change'));
    });
    
    tipo_documento_responsavel_entrega.addEventListener('change', function(e){
        if(e.target.value == 'RG'){
            if(rg_responsavel_entrega) rg_responsavel_entrega.style.display = 'block';
            if(orgao_emissor_responsavel_entrega) orgao_emissor_responsavel_entrega.style.display = 'block';
            if(div_estado_rg_responsavel_entrega) div_estado_rg_responsavel_entrega.style.display = 'block';
            if(numero_documento_responsavel_entrega) numero_documento_responsavel_entrega.setAttribute('disabled', 'disabled');
            // Adicionar required
            if(rg_responsavel_entrega_input) rg_responsavel_entrega_input.setAttribute('required', 'required');
            if(orgao_emissor_responsavel_entrega_select) orgao_emissor_responsavel_entrega_select.setAttribute('required', 'required');
            if(estado_rg_responsavel_entrega_select) estado_rg_responsavel_entrega_select.setAttribute('required', 'required');
        }
        else if(e.target.value == 'Nao Possui'){
            if(rg_responsavel_entrega) rg_responsavel_entrega.style.display = 'none';
            if(orgao_emissor_responsavel_entrega) orgao_emissor_responsavel_entrega.style.display = 'none';
            if(div_estado_rg_responsavel_entrega) div_estado_rg_responsavel_entrega.style.display = 'none';
            if(numero_documento_responsavel_entrega) numero_documento_responsavel_entrega.setAttribute('disabled', 'disabled');
            // Remover required
            if(rg_responsavel_entrega_input) rg_responsavel_entrega_input.removeAttribute('required');
            if(orgao_emissor_responsavel_entrega_select) orgao_emissor_responsavel_entrega_select.removeAttribute('required');
            if(estado_rg_responsavel_entrega_select) estado_rg_responsavel_entrega_select.removeAttribute('required');
        }
        else{
            if(rg_responsavel_entrega) rg_responsavel_entrega.style.display = 'none';
            if(orgao_emissor_responsavel_entrega) orgao_emissor_responsavel_entrega.style.display = 'none';
            if(div_estado_rg_responsavel_entrega) div_estado_rg_responsavel_entrega.style.display = 'none';
            if(numero_documento_responsavel_entrega) numero_documento_responsavel_entrega.removeAttribute('disabled');
            // Remover required
            if(rg_responsavel_entrega_input) rg_responsavel_entrega_input.removeAttribute('required');
            if(orgao_emissor_responsavel_entrega_select) orgao_emissor_responsavel_entrega_select.removeAttribute('required');
            if(estado_rg_responsavel_entrega_select) estado_rg_responsavel_entrega_select.removeAttribute('required');
        }
    });

    
    responsavel_entrega_nao_possui_cpf.addEventListener('change', function(e){
        let cpf_responsavel_entrega = document.getElementById('cpf_responsavel_entrega');
        if(e.target.checked){
            cpf_responsavel_entrega.setAttribute('disabled', 'disabled');
        }
        else{
            cpf_responsavel_entrega.removeAttribute('disabled');
        }
    });

</script>