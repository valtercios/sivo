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
        <h4 class="card-title" style="display:inline-block;">Termo de responsabilidade de retirada de cadáver sem exame de necropsia.</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas informações adicionais para gerar a declaração.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('documentos_recepcao.gerarTermoResponsabilidade', $corpo->id) }}" method="post" target="_blank" novalidate class="validar-form">
            @csrf
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="row">
                <div class="col-md-12 col-12">
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
                            <input type="text" id="cpf_responsavel"  class="form-control" value="{{ $corpo->responsavelCorpo->cpf ?? '' }}" placeholder="CPF" name="cpf_responsavel">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="form-group has-icon-left">
                        <label for="rg_responsavel">RG</label>
                        <div class="position-relative">
                            <input type="text" id="rg_responsavel" value="{{ $corpo->responsavelCorpo->rg ?? '' }}" class="form-control" placeholder="RG" name="rg_responsavel">
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
@endsection

@section('js')
    @include('utils.choices')
@endsection
