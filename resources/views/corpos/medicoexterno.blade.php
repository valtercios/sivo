@extends('layout.app')

@section('title')
    <h3>Médico externo</h3>
    <p class="text-subtitle text-muted">Insira as informações do médico externo.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('corpos.index') }}">Corpos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo corpo
        </li>
    </ol>
@endsection

@section('conteudo')

    <form action="{{ route('corpos.inserir_medico_externo') }}" method="POST">
        @method('post')
        @csrf
        <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
        <div class="col-12" id="cadastro-corpo">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dados do médico</h4>
                    <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Preencha as informações referentes ao médico externo.</p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="nome">Nome</label><span class="text-danger"> *</span>
                                    <div class="position-relative">
                                        <input type="text" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') ?? '' }}" placeholder="Nome do médico" name="nome">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        @error('nome')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="crm">CRM</label><span class="text-danger"> *</span>
                                    <div class="position-relative">
                                        <input type="text" id="crm" data-mask="9999999999" class="form-control @error('crm') is-invalid @enderror" value="{{ old('crm') ?? '' }}" placeholder="Insira o CRM" name="crm">
                                        <div class="form-control-icon">
                                            <i class="bi bi-file-medical"></i>
                                        </div>
                                        @error('crm')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="telefone">Telefone</label><span class="text-danger"> *</span>
                                    <div class="position-relative">
                                        <input type="text" id="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') ?? '' }}" placeholder="Telefone" name="telefone">
                                        <div class="form-control-icon">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                        @error('telefone')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="cep">CEP</label>
                                    
                                    <div class="position-relative">
                                        <input type="text" id="cep" class="form-control" placeholder="CEP" name="cep"
                                        onblur="pesquisacep(this.value);" >
                                        <div class="form-control-icon">
                                            <i class="bi bi-card-list"></i>
                                        </div>
                                        <a href="javascript:void(0)" onclick="exibirModalBuscaEndereco('')">Encontrar CEP</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="logradouro">Logradouro</label>
                                    
                                    <div class="position-relative">
                                        <input type="text" id="logradouro" class="form-control" placeholder="Logradouro" name="logradouro">
                                        <div class="form-control-icon">
                                            <i class="bi bi-card-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="form-group has-icon-left">
                                    <label for="numero">Número</label>
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" id="numero" class="form-control" placeholder="Número" name="numero">
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
                                            <input type="text" id="complemento" maxlength="30" class="form-control" placeholder="Complemento" name="complemento">
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="bairro">Bairro</label>
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro">
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="cidade">Cidade</label>
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" id="cidade" class="form-control" placeholder="Cidade" name="cidade">
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group has-icon-left">
                                    <label for="estado">Estado</label>
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" id="estado" class="form-control" placeholder="Estado" name="estado">
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('corpos.show',  $corpo->id) }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>
        </div>
    </form>
    @include('utils.modals.modal-pesquisa-cep-endereco')
@endsection

@section('js')
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>
    @include('utils.choices')
    
@endsection