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
            <h4 class="card-title" style="display:inline-block;">DECLARAÇÃO DE RETIRADA DO CORPO E DA DECLARAÇÃO DE
                ÓBITO NO SVO.</h4>
            <br>
            <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas
                informações adicionais para gerar a declaração.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('documentos_recepcao.gerarDeclaracaoRetiradaDoCorpo', $corpo->id) }}" method="post"
                  target="_blank" novalidate class="validar-form">
                @csrf
                <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group has-icon-left">
                            <label for="nome_responsavel">Nome do responsável</label>
                            <div class="position-relative">
                                <input type="text" id="nome_responsavel" required class="form-control"
                                       value="{{ $corpo->responsavelCorpo->nome ?? '' }}" placeholder="Nome"
                                       name="nome_responsavel">
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
                                <input type="text" id="cpf_responsavel" class="form-control"
                                       value="{{ $corpo->responsavelCorpo->cpf ?? '' }}" placeholder="CPF"
                                       name="cpf_responsavel">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="grau_parentesco_responsavel">Grau de parentesco**</label>

                                <div class="position-relative">
                                    <select class="form-control" id="grau_parentesco_responsavel"
                                            name="grau_parentesco_responsavel" onchange="verificaParentescosEdit()"
                                            required>
                                        <option value="" disabled selected>Selecione o grau de parentesco</option>
                                        <optgroup label="Grau por afinidade">
                                            <option value="Cônjuge" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Cônjuge")
                                                {{'selected'}}
                                                    @endif>Cônjuge
                                            </option>
                                            <option value="Companheiro(a) com comprovante de união estável" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Companheiro(a) com comprovante de união estável")
                                                {{'selected'}}
                                                    @endif>Companheiro(a) com comprovante de união estável
                                            </option>
                                            <option value="Companheiro(a) sem comprovante de união estável" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Companheiro(a) sem comprovante de união estável")
                                                {{'selected'}}
                                                    @endif>Companheiro(a) sem comprovante de união estável
                                            </option>
                                        </optgroup>
                                        <optgroup label="1° Grau">
                                            <option value="Filho" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Filho")
                                                {{'selected'}}
                                                    @endif>Filho
                                            </option>
                                            <option value="Pai" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Pai")
                                                {{'selected'}}
                                                    @endif>Pai
                                            </option>
                                            <option value="Mãe" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Mãe")
                                                {{'selected'}}
                                                    @endif>Mãe
                                            </option>
                                            <option value="Pai/Mãe" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Pai/Mãe")
                                                {{'selected'}}
                                                    @endif>Pai/Mãe
                                            </option>
                                        </optgroup>
                                        <optgroup label="2° Grau">
                                            <option value="Neto" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Neto")
                                                {{'selected'}}
                                                    @endif>Neto
                                            </option>
                                            <option value="Avós" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Avós")
                                                {{'selected'}}
                                                    @endif>Avós
                                            </option>
                                            <option value="Irmãos" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Irmãos")
                                                {{'selected'}}
                                                    @endif>Irmãos
                                            </option>
                                        </optgroup>
                                        <optgroup label="3° Grau">
                                            <option value="Bisneto" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Bisneto")
                                                {{'selected'}}
                                                    @endif>Bisneto
                                            </option>
                                            <option value="Bisavós" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Bisavós")
                                                {{'selected'}}
                                                    @endif>Bisavós
                                            </option>
                                            <option value="Tios" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Tios")
                                                {{'selected'}}
                                                    @endif>Tios
                                            </option>
                                            <option value="Sobrinhos" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Sobrinhos")
                                                {{'selected'}}
                                                    @endif>Sobrinhos
                                            </option>
                                        </optgroup>
                                        <optgroup label="4° Grau">
                                            <option value="Trineto" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Trineto")
                                                {{'selected'}}
                                                    @endif>Trineto
                                            </option>
                                            <option value="Trisavós" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Trisavós")
                                                {{'selected'}}
                                                    @endif>Trisavós
                                            </option>
                                            <option value="Sobrinho-neto" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Sobrinho-neto")
                                                {{'selected'}}
                                                    @endif>Sobrinho-neto
                                            </option>
                                            <option value="Tio-avô" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Tio-avô")
                                                {{'selected'}}
                                                    @endif>Tio-avô
                                            </option>
                                            <option value="Primo" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Primo")
                                                {{'selected'}}
                                                    @endif>Primo
                                            </option>
                                        </optgroup>
                                        <optgroup label="Outras opções">
                                            <option value="Outros" @if(($corpo->responsavelCorpo->grau_parentesco?? '') == "Outros")
                                                {{'selected'}}
                                                    @endif>Outros
                                            </option>
                                        </optgroup>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12" id='grau_parentesco_responsavel_outroDiv' style="display: block;">
                        <div class="form-group has-icon-left">
                            <label for="grau-parentesco">Outro grau de parentesco</label><span
                                    class="text-danger"> *</span>

                                <div class="form-group">
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                               @if(($corpo->responsavelCorpo->outro_parentesco?? '') == null)
                                                   {{ 'disabled' }}
                                               @endif id="grau_parentesco_responsavel_outro"
                                               value="{{($corpo->responsavelCorpo->outro_parentesco?? '')}}"
                                               name="grau_parentesco_responsavel_outro"
                                               value="{{ old('grau_parentesco_responsavel_outros') }}"
                                               placeholder="Digite o grau de parentesco">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="label_tipo_documento_responsavel">Documento de identificação</label>
                            <div class="position-relative">

                                <select name="tipo_documento_responsavel" class="form-control"
                                        id="tipo_documento_responsavel">
                                    <option value="" selected disabled>Selecione o tipo de documento</option>
                                    <option value="RG" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "RG" || ($corpo->responsavelCorpo->tipo_documento?? '') == null )
                                        {{'selected'}}
                                            @endif>RG
                                    </option>
                                    <option value="Certidão de nascimento" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "Certidão de nascimento")
                                        {{'selected'}}
                                            @endif>Certidão de nascimento
                                    </option>
                                    <option value="Certidão de casamento" @if(($corpo->responsavelCorpo->tipo_documento?? '') == "Certidão de casamento")
                                        {{'selected'}}
                                            @endif>Certidão de casamento
                                    </option>
                                    <option value="Carteira Nacional de Habilitação"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Carteira Nacional de Habilitação")
                                        {{'selected'}}
                                            @endif>Carteira Nacional de Habilitação
                                    </option>
                                    <option value="Carteira de trabalho"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Carteira de trabalho")
                                        {{'selected'}}
                                            @endif>Carteira de trabalho
                                    </option>
                                    <option value="Registro Geral - CPF"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Registro Geral - CPF")
                                        {{'selected'}}
                                            @endif>Registro Geral - CPF
                                    </option>
                                    <option value="Passaporte"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Passaporte")
                                        {{'selected'}}
                                            @endif>Passaporte
                                    </option>
                                    <option value="Nao Possui"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Nao Possui")
                                        {{'selected'}}
                                            @endif>Nao Possui
                                    </option>
                                    <option value="Outros"@if(($corpo->responsavelCorpo->tipo_documento?? '') == "Outros")
                                        {{'selected'}}
                                            @endif>Outros
                                    </option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-8">
                        <div class="form-group has-icon-left">
                            <label for="label_numero_documento_responsavel">Numero do documento</label><span
                                    class="text-danger"> *</span>
                            <div class="position-relative">
                                <input type="text" id="numero_documento_responsavel"
                                       value="{{$corpo->responsavelCorpo->numero_documento ?? ' '}}"
                                       class="form-control" placeholder="Numero do documento do corpo"
                                       name="numero_documento_responsavel">
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
                                <input type="text" id="rg_responsavel" value="{{ $corpo->responsavelCorpo->rg ?? ''}}"
                                       class="form-control" placeholder="RG" name="rg_responsavel">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12" id='div_orgao_emissor_responsavel' style='display=none'>
                        <div class="form-group">
                            <label for="orgao_emissor_responsavel">Orgão emissor</label>
                            <div class="position-relative">
                                <select name="orgao_emissor_responsavel" id="orgao_emissor_responsavel"
                                        class="choices form-control">
                                    <option value="" selected disabled>Selecione o orgão emissor</option>
                                    @foreach ($orgaos_emissores as $orgao)
                                        <option value="{{ $orgao->id }}" @if(($corpo->responsavelCorpo->orgao_emissor??'') == $orgao->id)
                                            {{'selected'}}
                                                @endif>{{ $orgao->sigla }} - {{ $orgao->nome }}</option>
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
                                        <option value="{{ $key }}" @if($key == ($corpo->responsavelCorpo->estado_rg ?? ''))
                                            {{'selected'}}
                                                @endif>{{ $estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group has-icon-left">
                            <label for="telefone_contato">Telefone de contato</label>
                            <div class="position-relative">
                                <input type="text" id="telefone_contato" class="form-control"
                                       value="{{ $corpo->responsavelCorpo->telefone ?? '' }}" placeholder="Telefone"
                                       name="telefone_contato">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
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

        function verificaParentescosEdit() {
            var grau_parentesco = $("#grau_parentesco_responsavel option:selected").val();
            var outro_parentescoEdit = document.getElementById('grau_parentesco_responsavel_outroDiv');
            if (grau_parentesco === "Outros") {
                outro_parentescoEdit.style.display = 'block';
            } else {
                outro_parentescoEdit.style.display = 'none';
            }
        }


        //verificar se tipo_documento tem valor RG
        let tipo_documento_responsavel = document.getElementById('tipo_documento_responsavel');
        console.log(tipo_documento_responsavel);
        let rg_responsavel = document.getElementById('div_rg_responsavel');
        let orgao_emissor_responsavel = document.getElementById('div_orgao_emissor_responsavel');
        let div_estado_rg_responsavel = document.getElementById('div_estado_rg_responsavel');
        let numero_documento_responsavel = document.getElementById('numero_documento_responsavel');

        document.addEventListener('DOMContentLoaded', function () {
            if (tipo_documento_responsavel.value != 'RG') {
                tipo_documento_responsavel.dispatchEvent(new Event('change'));
            }
        });

        tipo_documento_responsavel.addEventListener('change', function (e) {
            if (e.target.value == 'RG') {
                rg_responsavel.style.display = 'block';
                orgao_emissor_responsavel.style.display = 'block';
                div_estado_rg_responsavel.style.display = 'block';
                numero_documento_responsavel.setAttribute('disabled', 'disabled');
            } else if (e.target.value == 'Nao Possui') {
                rg_responsavel.style.display = 'none';
                orgao_emissor_responsavel.style.display = 'none';
                div_estado_rg_responsavel.style.display = 'none';
                numero_documento_responsavel.setAttribute('disabled', 'disabled');
            } else {
                rg_responsavel.style.display = 'none';
                orgao_emissor_responsavel.style.display = 'none';
                div_estado_rg_responsavel.style.display = 'none';
                numero_documento_responsavel.removeAttribute('disabled');
            }
        });
    </script>

@endsection

@section('js')
    @include('utils.choices')

@endsection

