@extends('layout.app')

@section('title')
    <h3>Auditoria</h3>
    <p class="text-subtitle text-muted">Gerenciamento de logs do sistema</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('auditoria.logs') }}">Auditoria</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    <!-- Inicio card detalhes de auditoria -->
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">Detalhes</h4>
                    <a href="{{ route('auditoria.logs') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-arrow-left-short"></i> Voltar</a>
                    <br>
                    <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Informações sobre o registro auditado</p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>ID</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->id }}
                                    </div>
                                    {{-- Fim do bloco --}}
                                    
                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Usuário</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ strtoupper($log->usuario->username ?? "") }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Evento</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ strtoupper($log->event) }} - {{ $log->auditable_type }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Registro auditado ID</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->auditable_id }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>URL</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->url }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Endereço IP</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->ip_address }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>User Agent</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->user_agent }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    {{-- Inicio do bloco --}}
                                    <div class="col-md-4">
                                        <label>Query SQL</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $log->tags }}
                                    </div>
                                    {{-- Fim do bloco --}}

                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    {{-- Fim Card --}}

    {{-- Inicio Cards dos antigos e novos valores --}}
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Antigos valores</h4>
                    <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Detalhes dos antigos valores</p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="dadosAntigos">
                            @foreach (json_decode($log->old_values) as $key => $old_value)
                                @if ($key != 'password')
                                    <div>
                                        <b>{{ $key }}: </b><span style="float:right;">{{ $old_value ?? '-' }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Novos valores</h4>
                    <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Detalhes dos novos valores</p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="dadosNovos">
                            @foreach (json_decode($log->new_values) as $key => $old_value)
                                @if ($key != 'password')
                                    <div>
                                        <b>{{ $key }}: </b><span style="float:right;">{{ $old_value ?? '-' }}</span>
                                    </div>
                                @endif
                            @endforeach
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







