@extends('layout.app')

@section('title')
    <h3>Documentos da recepção</h3>
    <p class="text-subtitle text-muted">Documentos referente a Recepção</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Documentos
    </li>
</ol>
@endsection

@section('conteudo')
   
<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">TERMO DE AUTORIZAÇÃO PARA RETIRADA DO CORPO E ENCAMINHAMENTO PARA O IML</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Reveja as informações para gerar o termo.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('documentos_recepcao.gerarEncaminhamentoIML', $corpo->id) }}" method="post" target="_blank" class="validar-form" novalidate>
            @csrf
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="nome_responsavel">Nome do responsável</label>
                        <div class="position-relative">
                            <input type="text" id="nome_responsavel" required class="form-control" value="{{ $corpo->responsavelCorpo->nome ?? '' }}" placeholder="Nome" name="nome_responsavel">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="cpf_responsavel">CPF</label>
                        <div class="position-relative">
                            <input type="text" id="cpf_responsavel" class="form-control" value="{{ $corpo->responsavelCorpo->cpf ?? '' }}" placeholder="CPF" name="cpf_responsavel">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="grau_parentesco_responsavel">Grau de parentesco</label>
                        <div class="position-relative">
                            <select class="form-control" id="grau_parentesco_responsavel" name="grau_parentesco_responsavel">
                                <option value="" disabled @if($corpo->responsavel_corpo_id != null) {{'selected'}} @endif>Selecione o grau de parentesco</option>
                                <optgroup label="Grau por afinidade">
                                    <option value="Cônjuge" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Cônjuge") {{'selected'}} @endif>Cônjuge</option>
                                    <option value="Companheiro(a) com comprovante de união estável" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) com comprovante de união estável") {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
                                    <option value="Companheiro(a) sem comprovante de união estável" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) sem comprovante de união estável") {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
                                </optgroup>
                                <optgroup label="1° Grau">
                                    <option value="Filho" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Filho") {{'selected'}} @endif>Filho</option>
                                    <option value="Pai" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Pai") {{'selected'}} @endif>Pai</option>
                                    <option value="Mãe" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Mãe") {{'selected'}} @endif>Mãe</option>
                                    <option value="Pai/Mãe" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Pai/Mãe") {{'selected'}} @endif>Pai/Mãe</option>
                                </optgroup>
                                <optgroup label="2° Grau">
                                    <option value="Neto" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Neto") {{'selected'}} @endif>Neto</option>
                                    <option value="Avós" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Avós") {{'selected'}} @endif>Avós</option>
                                    <option value="Irmãos" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Irmãos") {{'selected'}} @endif>Irmãos</option>
                                </optgroup>
                                <optgroup label="3° Grau">
                                    <option value="Bisneto" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Bisneto") {{'selected'}} @endif>Bisneto</option>
                                    <option value="Bisavós" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Bisavós") {{'selected'}} @endif>Bisavós</option>
                                    <option value="Tios" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Tios") {{'selected'}} @endif>Tios</option>
                                    <option value="Sobrinhos" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Sobrinhos") {{'selected'}} @endif>Sobrinhos</option>
                                </optgroup>
                                <optgroup label="4° Grau">
                                    <option value="Trineto" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Trineto") {{'selected'}} @endif>Trineto</option>
                                    <option value="Trisavós" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Trisavós") {{'selected'}} @endif>Trisavós</option>
                                    <option value="Sobrinho-neto" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Sobrinho-neto") {{'selected'}} @endif>Sobrinho-neto</option>
                                    <option value="Tio-avô" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Tio-avô") {{'selected'}} @endif>Tio-avô</option>
                                    <option value="Primo" @if($corpo->responsavel_corpo_id != null && $corpo->responsavelCorpo->grau_parentesco == "Primo") {{'selected'}} @endif>Primo</option>
                                </optgroup>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
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
                                <option value="RG" @if($corpo->responsavelCorpo->tipo_documento == "RG" || $corpo->responsavelCorpo->tipo_documento == null ) {{'selected'}} @endif>RG</option>
                                <option value="Certidão de nascimento" @if($corpo->responsavelCorpo->tipo_documento == "Certidão de nascimento") {{'selected'}}@endif>Certidão de nascimento</option>
                                <option value="Certidão de casamento" @if($corpo->responsavelCorpo->tipo_documento == "Certidão de casamento") {{'selected'}}@endif>Certidão de casamento</option>
                                <option value="Carteira Nacional de Habilitação"@if($corpo->responsavelCorpo->tipo_documento == "Carteira Nacional de Habilitação"){{'selected'}}@endif>Carteira Nacional de Habilitação</option>
                                <option value="Carteira de trabalho"@if($corpo->responsavelCorpo->tipo_documento == "Carteira de trabalho"){{'selected'}}@endif>Carteira de trabalho</option>
                                <option value ="Registro Geral - CPF"@if($corpo->responsavelCorpo->tipo_documento == "Registro Geral - CPF"){{'selected'}}@endif>Registro Geral - CPF</option>
                                <option value="Passaporte"@if($corpo->responsavelCorpo->tipo_documento == "Passaporte"){{'selected'}}@endif>Passaporte</option>
                                <option value="Nao Possui"@if($corpo->responsavelCorpo->tipo_documento == "Nao Possui") {{'selected'}}@endif>Nao Possui</option>
                                <option value="Outros"@if($corpo->responsavelCorpo->tipo_documento == "Outros"){{'selected'}}@endif>Outros</option>
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
                            <input type="text" id="numero_documento_responsavel" value="{{$corpo->responsavelCorpo->numero_documento ?? ' '}}"  class="form-control" placeholder="Numero do documento do corpo" name="numero_documento_responsavel">
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
                            <input type="text" id="rg_responsavel" value="{{ $corpo->responsavelCorpo->rg }}" class="form-control" placeholder="RG" name="rg_responsavel">
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
                        <label for="estado_responsavel">UF</label><span class="text-danger"> *</span>
                        <div class="position-relative">
                            <select name="estado_rg_responsavel_corpo" id="" class="form-control choices">
                                <option value="" selected disabled>Selecione o estado</option>
                                @foreach (getEstados() as $key => $estado)
                                    <option value="{{ $key }}" @if($key == $corpo->responsavelCorpo->estado_rg) {{'selected'}} @endif>{{ $estado }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="cep">CEP</label>
                        
                        <div class="position-relative">
                            <input type="text" id="cep" class="form-control" value="{{ $corpo->responsavelCorpo->endereco->cep ?? '' }}" required placeholder="CEP" name="cep"
                            onblur="pesquisacep(this.value, '');" >
                            <div class="form-control-icon">
                                <i class="bi bi-card-list"></i>
                            </div>
                            <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('')">Encontrar CEP</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="logradouro">Logradouro</label><span class="text-danger"> *</span>
                        
                        <div class="position-relative">
                            <input type="text" id="logradouro" value="{{ $corpo->responsavelCorpo->endereco->logradouro ?? '' }}" required class="form-control" placeholder="Logradouro" name="logradouro">
                            <div class="form-control-icon">
                                <i class="bi bi-card-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="form-group has-icon-left">
                        <label for="numero">Número</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="numero" required class="form-control" value="{{ $corpo->responsavelCorpo->endereco->numero ?? '' }}" placeholder="Número"  name="numero">
                                <div class="form-control-icon">
                                    <i class="bi bi-list-ol"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="form-group has-icon-left">
                        <label for="complemento">Complemento</label>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="complemento" class="form-control" value="{{ $corpo->responsavelCorpo->endereco->complemento ?? '' }}" placeholder="Complemento" name="complemento">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="bairro">Bairro</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="bairro" required class="form-control" value="{{ $corpo->responsavelCorpo->endereco->bairro ?? '' }}" placeholder="Bairro" name="bairro">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="cidade">Cidade</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="cidade" required class="form-control" value="{{ $corpo->responsavelCorpo->endereco->cidade ?? '' }}" placeholder="Cidade" name="cidade">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="estado">Estado</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" id="estado"  class="form-control" value="{{ $corpo->responsavelCorpo->endereco->estado ?? '' }}" placeholder="Estado" name="estado">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="col-md-6 col-12">
                    <div class="form-group has-icon-left">
                        <label for="telefone_contato">Telefone de contato</label>
                        <div class="position-relative">
                            <input type="text" id="telefone_contato" class="form-control" value="{{ $corpo->responsavelCorpo->telefone ?? '' }}" placeholder="Telefone" name="telefone_contato">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group ">
                        <label for="funeraria">Funerária que vai retirar o corpo</label>
                        <div class="position-relative">
                            <select name="funeraria" id="" class="choices form-control">
                                <option value="" disabled @if($corpo->funeraria_id == null) {{ 'selected' }} @endif>Selecione uma funerária</option>
                                @foreach ($funerarias as $funeraria)
                                    <option value="{{ $funeraria->id }}" @if($corpo->funeraria_retirada_id != null && $funeraria->id == $corpo->funeraria_retirada_id) {{'selected'}} @endif  >{{ $funeraria->nome }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                                        
            </div>

            <div class="col-12 d-flex justify-content-end">
                <a href="{{ URL::previous() }}" class="btn btn-secondary me-1 mb-1 ">Voltar</a>
                <button type="submit" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
            </div>
        </form>
    </div>
</div>

<script>

    //verificar se tipo_documento tem valor RG
    let tipo_documento_responsavel = document.getElementById('tipo_documento_responsavel');
    let rg_responsavel = document.getElementById('div_rg_responsavel');
    let orgao_emissor_responsavel = document.getElementById('div_orgao_emissor_responsavel');
    let div_estado_rg_responsavel = document.getElementById('div_estado_rg_responsavel');
    let numero_documento_responsavel = document.getElementById('numero_documento_responsavel');
    
    document.addEventListener('DOMContentLoaded', function() {
        if(tipo_documento_responsavel.value != 'RG'){
            tipo_documento_responsavel.dispatchEvent( new Event('change'));
        }
    });
    
    tipo_documento_responsavel.addEventListener('change', function(e){
        if(e.target.value == 'RG'){
            rg_responsavel.style.display = 'block';
            orgao_emissor_responsavel.style.display = 'block';
            div_estado_rg_responsavel.style.display = 'block';
            numero_documento_responsavel.setAttribute('disabled', 'disabled');
        }
        else if(e.target.value == 'Nao Possui'){
            rg_responsavel.style.display = 'none';
            orgao_emissor_responsavel.style.display = 'none';
            div_estado_rg_responsavel.style.display = 'none';
            numero_documento_responsavel.setAttribute('disabled', 'disabled');
        }
        else{
            rg_responsavel.style.display = 'none';
            orgao_emissor_responsavel.style.display = 'none';
            div_estado_rg_responsavel.style.display = 'none';
            numero_documento_responsavel.removeAttribute('disabled');
        }
    });

</script>

@include('utils.modals.modal-pesquisa-cep-endereco')
@endsection

@section('js')
@include('utils.choices')
<script src="{{ asset('js/corpos/cadastro.js') }}"></script>

@endsection


