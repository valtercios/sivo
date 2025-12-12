@extends('layout.app')

@section('title')
    <h3>Documentos do Serviço Social</h3>
    <p class="text-subtitle text-muted">Documentos referente ao Serviço Social</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Documentos
    </li>
</ol>
@endsection

@section('conteudo')

<form action="{{ route('documentos_servico_social.gerarDeclaracaoGrauDeParentesco') }}" method="post" target="_blank">
    @csrf
    <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
    
    @include('documentos.servico-social.declaracao-grau-de-parentesco.partials.card-parente')
    @include('documentos.servico-social.declaracao-grau-de-parentesco.partials.card-testemunha-1')
    @include('documentos.servico-social.declaracao-grau-de-parentesco.partials.card-testemunha-2')

    <div class="col-12 d-flex justify-content-end">
        <a href="{{ URL::previous() }}" class="btn btn-secondary me-1 mb-1 ">Voltar</a>
        <button type="submit" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
    </div>
</form>
@include('utils.modals.modal-pesquisa-cep-endereco')
@endsection

@section('js')

<script src="{{ asset('js/corpos/cadastro.js') }}"></script>
@endsection


