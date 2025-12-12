@extends('layout.app')

@section('title')
    <h3>Responsáveis</h3>
    <p class="text-subtitle text-muted">Gerenciamento de responsáveis do sistema</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('auditoria.logs') }}">Responsáveis</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
   <!-- Inicio card detalhes dos responsáveis -->
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">Detalhes do responsável</h4>
                    @if(isset($responsavel->corpo->id))
                    <a href="{{ route('corpos.show', $responsavel->corpo->id) }}" target="_blank" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-search"></i> Ver detalhes do corpo</a>
                    @endif
                    <a href="{{ route('responsaveis.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-arrow-left"></i> Voltar</a>
                    <br>
                    <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações referentes ao responsável.</p>
                
                </div>
                <div class="card-content">
                    <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    
                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Nome</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $responsavel->nome }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Documento</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        @if($responsavel->rg != null)
                                        <span> {{ $responsavel->orgaoEmissor->sigla ?? '' }}{{ $responsavel->estado_rg ? '/' . $responsavel->estado_rg . ' -' : '' }} {{ $responsavel->rg }} </span>
                                        @else
                                        <span> {{ $responsavel->tipo_documento }}: {{ $responsavel->numero_documento }} </span>
                                        @endif                                    
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>CPF</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $responsavel->cpf }}
                                    </div>
                                    {{-- Fim do bloco --}}
                                    
                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Endereço</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $responsavel->endereco->logradouro }}, {{ $responsavel->endereco->numero }} - {{ $responsavel->endereco->bairro }} - {{ $responsavel->endereco->cidade }}/{{ $responsavel->endereco->estado }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Telefone</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $responsavel->telefone ?? 'Não informado' }}
                                    </div>
                                    {{-- Fim do bloco --}}
                                    @if(isset($responsavel->corpo))
                                    <h6>Responsável referente ao corpo de {{ $responsavel->corpo->nome }}</h6>
                                    @else
                                    <h6>Responsável sem corpo vinculado</h6>
                                    @endif
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    {{-- Fim Card --}}


    {{-- @include('usuarios.permissoes.partials.modal-criar-permissao') --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection







