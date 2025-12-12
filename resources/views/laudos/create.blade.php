@extends('layout.app')

@section('title')
    <h3>Laudos</h3>
    <p class="text-subtitle text-muted">Gerenciamento de laudos do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('laudos.index') }}">Laudos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo laudo
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <form action="{{ route('laudos.store') }}" method="POST">
        @method('post')
        @csrf
        @include('laudos.formCria')

        <input type="hidden" name="id_corpo" value="{{ $corpo->id }}">

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('laudos.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" class="btn btn-primary me-1 mb-1 ">Cadastrar</button>

        </div>
    </form>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endsection

@section('js')
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>
@endsection
