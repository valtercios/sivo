@extends('layout.app')

@section('title')
    <h3>Exames</h3>
    <p class="text-subtitle text-muted">Gerenciamento de exames do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('exames.index') }}">Exames</a></li>
        <li class="breadcrumb-item active" aria-current="page">Solicitar exame
        </li>
    </ol>
@endsection

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Solicitar exame</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('exames.store') }}" method="POST">
                @method('post')
                @csrf
                <input type="hidden" name="solicitado_por" value="{{ auth()->user()->id }}">
                @include('exames.formCria')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('exames.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Solicitar</button>

                </div>
            </form>
        </div>
    </div>
@endsection

